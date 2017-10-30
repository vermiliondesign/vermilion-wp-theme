/* Get CSS */
import '../scss/main.scss';


// get libraries
require('flexslider');
require('jquery-lazyload');

/* Pages */
import './pages/sample-page.js';

/* components */
import themeSlider from './components/slider.js';
import vermilionMobileHeader from './components/header.js';


/* Global Functions */
import './util/smooth-scroll.js';

// init when doc is ready
$(function() {
  vermilionMobileHeader();
  themeSlider('.slider-container .flexslider');
});
