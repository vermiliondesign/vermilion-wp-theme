<?php

class Page extends \Taco\Post {

  public $loaded_post = null;
  
  use \Taco\AddMany\Mixins;

/**
 * Get the fields for this page type by merging the default template fields
 * with page specific ones
 * @return array The array of fields
*/
  public function getFields() {
    $this->loadPost();
    $loaded_post_fields = [];

    if (!empty($this->loaded_post)) {
      $loaded_post_fields = $this->getFieldsByPageTemplate(
        get_page_template_slug($this->loaded_post->ID)
      );
    } else {
      $loaded_post_fields = [];
    }

    return $loaded_post_fields;
  }

  /**
   * Get the template of this page and populate $this->_wp_page_template with it
   * @return string The template of this
   */
  public function getTemplate() {
    // If this is the user facing page, then _wp_page_template will be populated
    // and that can be used as the template.
    //
    // If this is the admin facing page, then loadPost() is run to figure out
    // the page ID and the template is determined that way
    if (!empty($this->_wp_page_template)) {
      $template = $this->_wp_page_template;
    } else {
      if(!$this->loadPost() || !Obj::iterable($this->loaded_post)) {
        return [];
      }

      $template = get_page_template_slug($this->loaded_post->ID);
      $this->_wp_page_template = $template;
    }

    return $template;
  }

  public function getFieldsByPageTemplate($template_file_name) {
    // Default empty template fields array
    $template_fields = [];
    
    switch($template_file_name) {
      case 'templates/tmpl-home.php':
        $template_fields = $this->getHomeFields();
      break;
      case 'templates/tmpl-page-with-modules.php':
        $template_fields = array_merge(
          $this->getBannerFields(),
          $this->getSliderDefaultFields()
        );
      break;
      default :
        $template_fields = array_merge(
          $this->getBannerFields(),
          $this->getSidebarDefaultFields()
        );
      break;
    }
    
    return $template_fields;
  }

  public function getAdminColumns() {
    return ['title'];
  }

  // get metaboxes and conditional js to hide/show fields
  public function getMetaBoxes() {
    wp_register_script('taco_page_conditionals', sprintf('%s/themes/taco-theme/app/_/js/page.js', content_url()), 'jquery', THEME_VERSION);
    wp_enqueue_script('taco_page_conditionals');

    $template = $this->getTemplate();

    return $this->getMetaBoxesByTemplate($template);
  }

  public function getMetaBoxesByTemplate($template_file_name) {
    // Default boxes get prepended to returned array
    $default_boxes = [
      'Page' => array_keys($this->getBannerFields()),
    ];
        

    // Initialize empty boxes for template
    $template_boxes = [];

    switch ($template_file_name) {
      case 'templates/tmpl-home.php':
        $template_boxes = [
          'Home' => array_keys($this->getHomeFields()),
        ];
      break;
      case 'templates/tmpl-page-with-modules.php':
        $template_boxes = [
          'Modules' => array_keys($this->getSliderDefaultFields()),
        ];
        $template_boxes = array_merge($default_boxes, $template_boxes);
      break;
      case 'default':
        $template_boxes = [
          'Sidebar' => array_keys($this->getSidebarDefaultFields()),
        ];
        $template_boxes = array_merge($default_boxes, $template_boxes);
      break;
    }

    return $template_boxes;
  }

  
  public function getBannerFields() {
    return [
      'banner_style' => [
        'type'=>'select',
        'description'=>'If no banner style is selected, banner will have default theme style.',
        'options'=>[
          'banner_with_image'=>'Banner - with Image',
        ]
      ],
      'banner_image' => [
        'type' => 'image',
        'description' => 'To be used for the Banner - with Image, 1400 x 400 px is best resolution pre-cropped.'
      ],
      'banner_subtitle' => [
        'type' => 'textarea',
        'description' => 'Appears in banner as subtitle.'
      ],
    ];
  }
  
  public function getSidebarDefaultFields() {
    return [
      'show_sidebar_breadcrumbs' => [
        'type' => 'checkbox',
        'description' => 'Check this box to show sidebar breadcrumbs.'
      ]
    ];
  }
  
  public function getHomeFields() {
    return $this->getSliderDefaultFields();
  }
  
  public function getSliderDefaultFields() {
    return [
      'slider' => \Taco\AddMany\Factory::create(
        array(
          'slide_image' => array('type' => 'image'),
          'slide_textarea' => array('type' => 'textarea', 'class' => 'wysiwyg'),
          'slide_link' => array('type' => 'link'),
        )
      )->toArray(),
    ];
  }
  
  
  /* used in sidebar breadcrumbs */
  public static function getBreadcrumbVars($page) {

    $nav_parent_title = '';
    $nav_parent_permalink = '';
        
    // if this page has a post parent
    if($page->post_parent !== 0) {
      // $has_hierarchical_nav = true;
      $nav_parent_title = get_the_title($page->post_parent);
      $nav_parent_permalink = get_the_permalink($page->post_parent);
      $args = array(
        'child_of'     => $page->post_parent,
        'depth'        => 0,
        'echo'         => 2,
        'sort_column'  => 'menu_order, post_title',
        'sort_order'   => 'ASC',
        'title_li'     => __(''),
      );
    }
    elseif($page->post_parent === 0) {
      // $has_hierarchical_nav = true;
      $nav_parent_title = get_the_title($page->ID);
      $nav_parent_permalink = get_the_permalink($page->ID);
      $args = array(
        'child_of'     => $page->ID,
        'depth'        => 1,
        'echo'         => 1,
        'sort_column'  => 'menu_order, post_title',
        'sort_order'   => 'ASC',
        'title_li'     => __(''),
      );
    }
    return array(
      'nav_parent_title' => $nav_parent_title,
      'nav_parent_permalink' => $nav_parent_permalink,
      'args' => $args
    );
    
  }
  
  /* for the sidebar-breadcrumb, return bool */
  public function isGrandchildPage() {
    global $post;
     if ( is_page() && (count(get_post_ancestors($post->ID)) >= 2) ) {
      return true;
     } else {
      return false;
     }
  }
  
  public function getTopAncestor($id) {
    $current = get_post($id);
    if(!$current->post_parent){
      return $current->ID;
    } else {
      return self::getTopAncestor($current->post_parent);
    }
  }
  

    /**
   * Load the post fields based on the ID, or by using
   * GET and POST vars on the admin side
   */
  public function loadPost() {
    // Don't do anything if post already loaded
    if (!empty($this->loaded_post)) {
      return true;
    }

    // Don't do extra work to load the post if this post is the same as the global post
    global $post;

    if (!empty($post) && !empty($this->ID) && $post->ID === $this->ID) {
      $this->loaded_post = $post;
      return true;
    }

    // When we're loading the page, it's in the query string.
    // When we're saving the page, it's in the post vars
    if (!empty($this->ID)) {
      $post_id = $this->ID;
    } else if (!empty($_POST['post_ID'])) {
      $post_id = $_POST['post_ID'];
    } else if (!empty($_GET['post'])) {
      $post_id = $_GET['post'];
    }

    if(empty($post_id)) {
      return false;
    }

    $post_object = get_post($post_id);
    if(is_object($post_object)) {
      $this->loaded_post = $post_object;
      return true;
    }
    return false;
  }
}