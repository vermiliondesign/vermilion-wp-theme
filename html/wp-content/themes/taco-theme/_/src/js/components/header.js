/*
* generic header with one level dropdowns for mobile
*/
var vermilionMobileHeader = function() {
  
  var opened_menu = false;
  var $btn = $('header a.mobile-menu-button');
  var $nav = $('header .menu-wrapper');
  var $sub_menu_btn = $('.menu .arrow-down-mobile');
  // matches breakpoint in header.scss
  var desktop_only_width = 801;
  
  // mobile menu and resizing
  
    
  $(window).on('resize', function() {
    // ensure nav is hidden when collapsed if not left to keep-open
    if ($(this).width() < desktop_only_width && $nav.hasClass('keep-open')) {
      $nav.removeClass('keep-open').hide();
    }
    // make sure primary nav is visible for desktop if it's been toggled shut
    if ($btn.is(':hidden') && $nav.is(':hidden') && $(window).width() > (desktop_only_width - 1)) {
      $nav.addClass('keep-open').show();
    }
    // make sure sub-menu nav is not visible for desktop if it's been toggled open
    if ($btn.is(':hidden') && $('ul.sub-menu').is(":visible") && $(window).width() > (desktop_only_width - 1)) {
      // $('.menu li').removeClass('open-sub-menu');
      // $sub_menu_btn.find('i').toggleClass('fa-angle-up fa-angle-down');
    }
  });
    
    
  

  // mobile menu button
  $btn.on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    if(opened_menu === false) {
      $nav.slideDown(350);
      $(this).find('i').removeClass('fa-bars').addClass('fa-close');
      $('body').addClass('nav-open');
      opened_menu = true;
    } else {
      $nav.slideUp(350);
      $(this).find('i').removeClass('fa-close').addClass('fa-bars');
      $('body').removeClass('nav-open');
      opened_menu = false;
    }
  });
  
  
  
  // sub menu button
  $sub_menu_btn.on('click', function() {
    console.log('clicked');
    
    var $parent_li = $(this).parent('li');
    // toggle the arrow
    $(this).find('i').toggleClass('fa-arrow-down fa-arrow-up');
    // open the menu with a class
    $parent_li.toggleClass('open-sub-menu');
    
  });
};


export default vermilionMobileHeader;