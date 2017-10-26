'use strict';

const ExtractTextPlugin     = require('extract-text-webpack-plugin');
const WebpackNotifierPlugin = require('webpack-notifier');
const webpack               = require('webpack');
const fs                    = require('fs');
const path                  = require('path');
const merge                 = require('merge');

const RESOURCES_PATH = __dirname + '/_/';
const RESOURCES_URL_BASE = '/wp-content/themes/taco-theme/_/dist/';

function EmitHash(options) {
  this.options = merge({}, {
    outputPath: '',
    outputFileName: '',
  }, options);
}

EmitHash.prototype.apply = function(compiler) {
  compiler.plugin('after-emit', function(compilation, callback) {
    let output_file = path.join(this.options.outputPath, this.options.outputFileName);

    fs.writeFileSync(
      output_file,
      compilation.getStats().hash
    );

    callback();

    console.log('Writing hash file: ' + output_file);
  }.bind(this));
}

let is_production = false;
process.argv.forEach(function(arg) {
  if (arg === '-p' || arg === '--production') {
    is_production = true;
  }
});

let source_path = __dirname + '/_/src/js/';
let output_path = __dirname + '/_/dist/';

let node_dir = __dirname + '/node_modules/';

let CONFIG = require(source_path + 'util/config.js');

// Get all top level files
let files = fs.readdirSync(source_path);

let entry_points = {};
files.forEach(function(file) {
  if(file[0] === '.') {
    return;
  }

  let stat = fs.statSync(source_path + file);

  if (stat.isFile()) {
    let base_name = path.basename(file, path.extname(file));
    entry_points[base_name] = source_path + file;
  }
});

let config = {
  entry: entry_points,
  devtool: is_production ? 'none' : 'module-inline-source-map',
  output: {
    path: output_path,
    filename: '[name]' + '.js'
  },
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.esm.js' // 'vue/dist/vue.common.js' for webpack 1
    }
  },
  stats: { children: false },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {
              loader: 'css-loader',
              options: {
                sourceMap: true,
                minimize: true
              }
            },
            {
              loader: 'sass-loader',
              options: {
                sourceMap: true,
                data: '$ENVIRONMENT: ' + (is_production === true ? 'production' : 'development') + '; \
                $ANIMATION_DURATION: ' + CONFIG.ANIMATION_DURATION + '; \
                ',
              }
            }
          ],
        }),
      },
      {
        test: /\.(jpg|png|svg|gif|eot|ttf|woff|woff2)(\?.+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'assets/[path][name].[ext]'
            },
          },
        ],
      },
      {
        test: /\.vue$/,
        use: [
          {
            loader: 'vue-loader',
          },
        ],
      },
      {
        test: /\.jsx?$/,
        use: {
          loader: 'babel-loader',
          options: {
            retainLines: true,
          },
        },
      },
    ],
  },
  plugins: [
    new ExtractTextPlugin({
      filename: '[name]' +  '.css'
    }),
    new WebpackNotifierPlugin(),
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': (is_production === true ? '"production"' : '"development"'),
      'RESOURCES_PATH': JSON.stringify(RESOURCES_PATH),
      'RESOURCES_URL_BASE': JSON.stringify(RESOURCES_URL_BASE),
    }),
    new webpack.ProvidePlugin({
      '$': 'jquery',
      'jQuery': 'jquery',
      'window.$': 'jquery',
      'window.jQuery': 'jquery',
      '_': 'lodash',
      'window._': 'lodash',
      'CONFIG': source_path + 'util/config.js',
    }),
    new EmitHash({
      outputPath: output_path,
      outputFileName: 'webpack_hash',
    }),
  ],
};

module.exports = config;
