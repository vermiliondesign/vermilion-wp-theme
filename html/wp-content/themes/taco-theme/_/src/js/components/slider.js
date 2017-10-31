var themeSlider = function(target) {
  $(target).flexslider({
    animation: "fade",
    slideshow: true,
    pauseOnHover: true,
    touch: true,
    prevText: "",
    nextText: "",
    controlsContainer: ".slider-container.default .slider-pagination .circle-pagination",
    customDirectionNav: $(".slider-container.default .slider-pagination .prev-next")
  }).addClass('loaded');
};

export default themeSlider;