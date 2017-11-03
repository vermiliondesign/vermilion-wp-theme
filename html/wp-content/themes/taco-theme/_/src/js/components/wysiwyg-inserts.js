var wysiwygInserts = function() {
  

  
  var wysiwygAccordions = function() {

    // initial wysiwyg
    var $wysiwyg_accordion_li = $('ul.wysiwyg-accordion-list > li > h4');
    var $wysiwyg_accordion_li_details = $('ul.wysiwyg-accordion-list > li > ul').not('ul.wysiwyg-accordion-list > li > ul > li > ul');
    
    // initial wysiwyg with bullets styling instead
    var $wysiwyg_accordion_li_bullets = $('ul.wysiwyg-accordion-list-with-bullets > li > h4');
    var $wysiwyg_accordion_li_details_bullets = $('ul.wysiwyg-accordion-list-with-bullets > li > ul').not('ul.wysiwyg-accordion-list-with-bullets > li > ul > li > ul');
    
    
    // dont hide with css only if javascript is enabled
    $wysiwyg_accordion_li_details.hide();
    $wysiwyg_accordion_li_details_bullets.hide();
    
    
    $wysiwyg_accordion_li.on('click touch', function(e) {
      $(this).toggleClass('active');
      $(this).parent('li').find('> ul').not('> ul > li > ul').slideToggle();
    });
    
    $wysiwyg_accordion_li_bullets.on('click touch', function(e) {
      $(this).toggleClass('active');
      $(this).parent('li').find('> ul').not('> ul > li > ul').slideToggle();
    });
      
  };
  
  // init
  wysiwygAccordions();
    
  

};

export default wysiwygInserts;