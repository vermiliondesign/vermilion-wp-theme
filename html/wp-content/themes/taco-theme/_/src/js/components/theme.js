// sample module
var vermilionThemeFeatures = function() {
  
  // define vars first
  var box_json_html = '<div class="sample-page-colorwheel-json"></div>';
  var box_grid_html = '<h3 class="center">All Theme Colors</h3>';
  box_grid_html += '<div class="sample-page-colorwheel"><ul></ul></div>';

  // create elements then add vars
  var create_samplepage_elements = function(callback) {
    // add box to samplepage
    $('body.sample-page .page-wrap').append(box_grid_html);
    $('body.sample-page .page-wrap').append(box_json_html);
    callback();
  };
  
  var populate_colorwheel = function() {
    // colors to object
    var colorsDataEl = $('.sample-page-colorwheel-json');
    var colorsData = colorsDataEl.sassToJs({pseudoEl:":before", cssProperty: "content"});
    colorsDataEl.html(JSON.stringify(colorsData));
    // create the grid
    $.each(colorsData, function(index, data) {
      $('.sample-page-colorwheel ul').append('<li><span class="color" style="background: ' + data + ';"></span><span class="hex"><span class="label">'+ index + '</span> : ' + data +'</span></li>');
    });
  };
  
  // init the creation of the colorwheel
  create_samplepage_elements(populate_colorwheel);
  
  // make videos in wysiwyg responsive
  var makeVideosResponsive = function() {
   $('.content').find('iframe').wrap('<div class="flex-video"></div>');
  };
  // init
  makeVideosResponsive();
  
  // accordion functionality in main wysiwyg
  var toggle_accordion = function() {
    $('.accordion-wrapper').find('a.toggle-accordion').on('click', function(e) {
      e.preventDefault();
      $(this).parents('.accordion-wrapper').find('.more-summary').slideToggle();
      $(this).parents('.accordion-wrapper').toggleClass('active');
      $(this).parents('.accordion-wrapper').find('i').toggleClass('fa-angle-down fa-angle-up');
    });
  };
  // init toggle accordion
  toggle_accordion();
  
};


export default vermilionThemeFeatures;