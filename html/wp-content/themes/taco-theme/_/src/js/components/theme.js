// sample module
var vermilionThemeFeatures = function() {
  
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
      $(this).parents('.accordion-wrapper').find('i').toggleClass('icon-angle-down icon-angle-up');
    });
  };
  // init toggle accordion
  toggle_accordion();
  
};


export default vermilionThemeFeatures;