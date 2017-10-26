import sassToJs from 'sass-to-js/js/dist/sass-to-js.min.js';

$(function() {
  if (!$('body').hasClass('page-template-tmpl-sample-page')) {
    return;
  }

  /**
   * Create elements on the page
   * Place a top level div with the class sample-page-colors to use
   */
  var create_samplepage_elements = function() {
    // define vars first
    var box_json_html = '<div class="sample-page-colors-json"></div>';
    var box_grid_html = '<h3>All Theme Colors</h3> \
                         <ul class="sample-page-colors-list large-up-4"></ul>';

    // add box to samplepage
    $('.sample-page-colors').append(box_json_html);
    $('.sample-page-colors').append(box_grid_html);
  };

  var populate_colorwheel = function() {
    // Convert colors to object
    var colorsData = $('.sample-page-colors-json').sassToJs({pseudoEl: '::after', cssProperty: 'content'});

    // create the grid
    $.each(colorsData, function(index, data) {
      $('.sample-page-colors-list').append(
        '<li class="columns column-block"> \
          <div class="sample-color-block bg-' + index + '"> \
            <p>' + index + ': ' + data + '</p> \
          </div> \
        </li>');
    });
  };

  create_samplepage_elements();
  populate_colorwheel();

});