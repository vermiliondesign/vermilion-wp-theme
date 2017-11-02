/*
* open_close_list_as_dropdown
* list as dropdown aka quicklinks functionality
*/
var listAsDropdown = function() {
  // on blog landing page
  var $blog_toggle_topic_button = $('.list-as-dropdown .list-wrapper > a.active-archive');
  var $blog_toggle_topic_list = $('.list-as-dropdown .list-wrapper > ul');

  // hide lists
  $blog_toggle_topic_list.hide();
  
  function list_collapse_this(self) {
    var self = self;
    var $this = $(self);
    $this.parents('.list-as-dropdown').removeClass('active');
    $this.parents('.list-wrapper').find('a.active-archive span.arrow i').removeClass('fa-caret-up').addClass('fa-caret-down');
    $this.parents('.list-wrapper').find('ul').removeClass('active').slideUp();
  }
  
  function list_expand_this(self) {
    var self = self;
    var $this = $(self);
    $this.parents('.list-as-dropdown').addClass('active');
    $this.parents('.list-wrapper').find('a.active-archive span.arrow i').removeClass('fa-caret-down').addClass('fa-caret-up');
    $this.parents('.list-wrapper').find('ul').addClass('active').slideDown();
  }
  
  function list_collapse_general() {
      $('.list-as-dropdown').removeClass('active');
      $('.list-wrapper').find('a.active-archive span.arrow i').removeClass('fa-caret-up').addClass('fa-caret-down');
      $('.list-wrapper').find('ul').removeClass('active').slideUp();
  }

  // open lists when the a.active-archive button is clicked
  $blog_toggle_topic_button.on('click', function(e) {
    e.preventDefault();
    
    // if already showing, hide it
    if($(this).parents('.list-as-dropdown').find('ul').is(':visible')) {

      list_collapse_this(this);
    }
    // if hiding show it
    if($(this).parents('.list-as-dropdown').find('ul').is(':hidden')) {

      list_collapse_general();
      list_expand_this(this);
    }
  });

  // handle to close this if body is clicked
  // close the list if the body is clicked not in the target
  $(document).mouseup(function(e) {
    var $container = $('.list-as-dropdown');
    // if the target of the click isnt the container
    if(!$container.is(e.target) && $container.has(e.target).length === 0) {
      $container.removeClass('active');
      $container.find('a.active-archive span.arrow i').removeClass('fa-caret-up').addClass('fa-caret-down');
      $container.find('ul').removeClass('active').slideUp();
    }
  });
  
  $(window).on('hashchange', function() {
    list_collapse_general();
  });
  
};

export default listAsDropdown;