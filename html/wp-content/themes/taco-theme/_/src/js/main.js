/* Get CSS */
import '../scss/main.scss';


// get libraries
require('flexslider');
require('jquery-lazyload');

/* Pages */
import './pages/sample-page.js';

/* components */
import vermilionMobileHeader from './components/header.js';
import vermilionThemeFeatures from './components/theme.js';
import themeSlider from './components/slider.js';
import listAsDropdown from './components/list-as-dropdown.js';


/* Global Functions */
//import './util/smooth-scroll.js';

// init when doc is ready
$(function() {
  vermilionMobileHeader();
  vermilionThemeFeatures();
  themeSlider('.slider-container .flexslider');
  listAsDropdown();
});
