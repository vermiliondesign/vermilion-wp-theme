var themeSlider = function(target) {
  $(target).flexslider({
    animation: "fade",
    slideshow: true,
    pauseOnHover: true,
    touch: true,
    prevText: "",
    nextText: "",
    controlsContainer: ".home-slider .slider-pagination .circle-pagination",
    customDirectionNav: $(".home-slider .slider-pagination .prev-next")
  }).addClass('loaded');
};

export default themeSlider;