/* Get CSS */
import '../scss/main.scss';


// get libraries
require('flexslider');
require('jquery-lazyload');
require('sass-to-js/js/dist/sass-to-js.min.js');

/* utils */
import './util/smooth-scroll.js';

/* components */
import vermilionMobileHeader from './components/header.js';
import vermilionThemeFeatures from './components/theme.js';
import wysiwygInserts from './components/wysiwyg-inserts.js';
import themeSlider from './components/slider.js';
import listAsDropdown from './components/list-as-dropdown.js';


// init when doc is ready
$(function() {
  
  // bigger components
  vermilionMobileHeader();
  vermilionThemeFeatures();
  themeSlider('.slider-container .flexslider');
  
  // smaller components
  wysiwygInserts();
  listAsDropdown();
});
