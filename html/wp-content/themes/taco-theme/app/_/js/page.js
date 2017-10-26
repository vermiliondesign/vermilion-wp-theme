(function($){
  
  /*
  *  hide_fields
  *
  *  @description: a small function to hide all the conditional fields
  */
  
  function page_hide_fields() {

    $('.banner_image').hide();
  }
  
  
  $(function(){
    
  
  /*
  *  Show Custom Module Inputs if Custom style is selected
  */
      
      $('.banner_style select').on('change', function(){
        
        
        // vars
        var value = $(this).val();
        
        // hide all fields
        page_hide_fields();
        
        
        if(value === 'banner_with_image') {
          $('.banner_image').show();
        }
        
      });
    
    // trigger change on the select field to show selected field
    $('.banner_style select').trigger('change');
    
  });

  
  

})(jQuery);