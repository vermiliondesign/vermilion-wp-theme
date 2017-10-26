<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('ENVIRONMENT_DEV', 'dev');
define('ENVIRONMENT_STAGE', 'stage');
define('ENVIRONMENT_PROD', 'prod');

// get creds not in repo
include(__DIR__.'/../db.php');
define('DB_USER',     CLIENT_DB_USER);
define('DB_PASSWORD', CLIENT_DB_PASSWORD);
define('DB_HOST',     CLIENT_DB_HOSTNAME);
define('DB_NAME',     CLIENT_DB_NAME);
define('SAVEQUERIES', true);

// match creds to environment
if(preg_match('/(localhost|\.dev|\.vera)/', $_SERVER['HTTP_HOST'])) {
  define('ENVIRONMENT', ENVIRONMENT_DEV);
} elseif(preg_match('/(\.vermilion\.com)/', $_SERVER['HTTP_HOST'])) {
  define('ENVIRONMENT', ENVIRONMENT_STAGE);
} else {
  define('ENVIRONMENT', ENVIRONMENT_PROD);
}

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'vermilion_wp';


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'aLeQ+ y)d+QItVRM&c(}qdR8_3f 8u7MpQ7t:afUp+_JHL5![17+jq{f^O& !W|~');
define('SECURE_AUTH_KEY',  '-g0q-&[-r5<zn+tL33hblG_akT+s=KD+yFbfc7t`QLX->k]Av)~i<UC6l|%5K>8c');
define('LOGGED_IN_KEY',    '0h|S{yOu6b|C__I_,OHMP9Bm_1|k~ReURgXxGG4 I+}4#xxl-CW`4?G[<H@.7Dbz');
define('NONCE_KEY',        '4){Zx]5>E%>Scovhc&<~I5Qk13|0[l@qPOTssVa{j1!PG )Am|G-cuD75DLdo4o6');
define('AUTH_SALT',        '<DcOie]3L}4l`4FP4=9t>~eYkmOxvb y{AJ$7E-j{G{%7&BP!|f5`?^j)4T1/,e@');
define('SECURE_AUTH_SALT', '-w-!tQ?*${eDBC7(b6|&!ZG+to8Da7Amk,[wN*[#:;7,N%}hp~?eBJG*8:J  {n1');
define('LOGGED_IN_SALT',   '4t2#)O< |ukXvl]0Ls>4uS/8uaCIM_|[/$PCjhGd[!6iyug: HWD`AGGlP-nA9MA');
define('NONCE_SALT',       '1Qi}$`?ypT+BSwtdMzTG Qw *t(<Xj@q6YH:oHF!:Jvk-4jHuprr|H4qW-l=[yD&');


// define where wp-content is since wordpress is in its own directory not committed through version control
define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
define('WP_CONTENT_URL', '/wp-content');

define('WP_DEFAULT_THEME', 'taco-theme');

// enable minor auto updates
define('WP_AUTO_UPDATE_CORE', 'minor');

/** no errors on production **/
if(ENVIRONMENT === ENVIRONMENT_PROD) {
  error_reporting(0);
  @ini_set('display_errors', 0);
} else {
  error_reporting(E_ALL);
  @ini_set('display_errors', true);
}


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG',  (bool) getenv('WP_DEBUG'));

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
