<?php

/**
 * Register the CSS
 * @return array
 */
function app_get_css() {
  return array(
    'all' => [
      'main' => '_/dist/main.css',
    ],
  );
}


/**
 * Register the JS
 * @return array
 */
function app_get_js() {
  return [
    'jquery' => '_/dist/main.js',
  ];
}


/**
 * Register admin CSS
 * @return array
 */
function app_admin_get_css() {
  return [
    'all' => [],
  ];
}


/**
 * Register admin JS
 * @return array
 */
function app_admin_get_js() {
  return [
    // 'admin' => '_/js/admin-min.js',
  ];
}


/**
 * Register menus
 */
add_theme_support('menus');
define('MENU_PRIMARY', 'menu_primary');
define('MENU_UTILITY', 'menu_utility');
define('MENU_FOOTER', 'menu_footer');
function app_menus() {
  $locations = array(
    MENU_PRIMARY => __('Primary'),
    MENU_UTILITY => __('Utility'),
    MENU_FOOTER => __('Footer'),
  );
  register_nav_menus($locations);
}
add_action('init', 'app_menus');

/**
 * Add editor styles for Page Inserts
*/
add_editor_style('style-wysiwyg.css');

/**
 * Add new thumbnail size
*/
// please note the og:image size must be at least 600 x 315 hence the special image size used for thumbnails and featured images
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'medium_featured', 600, 450, true ); //(cropped)
  // add_image_size( 'midsize', 530, 450, true ); //(cropped)
}

/**
 * Only show custom sizes in dropdown image menu
*/
add_filter('image_size_names_choose', 'my_image_sizes');
function my_image_sizes($sizes) {
  $addsizes = array(
    "thumbnail" => __( "Thumbnail"),
    "medium" => __( "Medium"),
    // "medium_square" => __( "Medium Square"),
    // "midsize" => __( "Mid-Size"),
    "large" => __( "Large"),
  );
  $newsizes = array_merge($sizes, $addsizes);
  return $addsizes;
}

/**
 * Add support for excerpt
*/
add_post_type_support('page', 'excerpt');
/**
 * add theme support for post-thumbnails
*/
add_theme_support('post-thumbnails');


/**
 * Get an image
 * @param string $path
 * @param size string $size (size keys that you've passed to add_image_size)
 * @return string Relative URL
 */
function app_image_path($path, $size) {
  // Which image size was requested?
  global $_wp_additional_image_sizes;
  $image_size = $_wp_additional_image_sizes[$size];

  // Get the path info
  $pathinfo = pathinfo($path);
  $fname = $pathinfo['basename'];
  $fext = $pathinfo['extension'];
  $dir = $pathinfo['dirname'];
  $fdir = realpath(str_replace('//', '/', ABSPATH.$dir)).'/';

  // Filename without any size suffix or extension (e.g. without -144x200.jpg)
  $fname_prefix = preg_replace('/(?:-\d+x\d+)?\.'.$fext.'$/i', '', $fname);
  $out_fname = sprintf(
    '%s-%sx%s.%s',
    $fname_prefix,
    $image_size['width'],
    $image_size['height'],
    $fext
  );

  // See if the file that we're predicting exists
  // If so, we can avoid a call to the database
  $fpath = $fdir.$out_fname;
  if(file_exists($fpath)) {
    return sprintf(
      '%s/%s',
      $pathinfo['dirname'],
      $out_fname
    );
  }

  // Can't find the file? Figure out the correct path from the database
  global $wpdb;
  $guid = site_url().$dir.'/'.$fname_prefix.'.'.$fext;
  $prepared = $wpdb->prepare(
    "SELECT
      pm.meta_value
    FROM $wpdb->posts p
    INNER JOIN $wpdb->postmeta pm
      ON p.ID = pm.post_id
    WHERE p.guid = %s
    AND pm.meta_key = '_wp_attachment_metadata'
    LIMIT 1",
    $guid
  );
  $row = $wpdb->get_row($prepared);
  if(is_object($row)) {
    $meta = unserialize($row->meta_value);
    if(isset($meta['sizes'][$size]['file'])) {
      $meta_fname = $meta['sizes'][$size]['file'];
      return sprintf(
        '%s/%s',
        $pathinfo['dirname'],
        $meta_fname
      );
    }
  }

  // Still nothing? Just return the path given
  return $path;
}


/**
 * Get the asset path
 * @param string $relative_path
 * @return string
 */
function get_asset_path($relative_path) {
  $clean_relative_path = $relative_path;
  $clean_relative_path = preg_replace('/^[\/_]+/', '', $clean_relative_path);
  return sprintf(
    '%s/_/%s%s',
    get_template_directory_uri(),
    $clean_relative_path,
    THEME_SUFFIX
  );
}


/**
 * Get an html string of all links to app icons
 * @return string
 */
function get_app_icons() {

  $app_dir = __DIR__.'/../';

  $files = scandir($app_dir.'/_/img/app-icons');
  $paths = [];
  foreach($files as $file)  {
    if(!preg_match('/\.png/', $file)) continue;
    preg_match('/(\d+x\d+)/', $file, $sizes);

    $file = '/wp-content/themes/taco-theme/_/img/app-icons/'.$file;
    if(preg_match('/apple-icon|android/', $file)) {
      $paths[] = '<link rel="apple-touch-icon" sizes="'.$sizes[0].'" href="'.$file.'">';
      continue;
    }
    if(preg_match('/favicon/', $file) && !preg_match('/\d+/', $file)) {
      $paths[] = '<link rel="icon" type="image/ico" sizes="'.$sizes[0].'" href="'.$file.'">';
      continue;
    }
  }
  $paths[] = '<link rel="icon" href="/wp-content/themes/taco-theme/_/img/app-icons/favicon.ico">';
  return join('', $paths);
}

// hide links
add_action( 'admin_menu', 'remove_links_menu' );
function remove_links_menu() {
     remove_menu_page('link-manager.php');
}


/* This function serves the purpose of including a php template and
 * be explicit about what vars it injects.
 * Typically, you would just set the variable above the include, but
 * doing it that way makes it hard to follow. In a sense, this also serves
 * another purpose of stopping the ugly html that some functions/methods generate.
 * @example include_with(__DIR__.'/incl-filename.php', array('foo' => $foo, 'bar' => $bar));
 */
function include_with($path, $array_vars, $once=false) {
  extract($array_vars);
  if($once) {
    include_once $path;
  } else {
    include $path;
  }
  foreach($array_vars as $k => $v) {
    unset($$k);
  }
  return;
}


// make the search engines discouraged text more visible
add_action('admin_print_styles', function() {
  echo '<style>p a[href*="options-reading.php"] { padding: 2px; background-color: red; color: white; };</style>';
});

// use the singles folder for all single-{post_type} or single.php template/s
add_filter('single_template', function() {
  global $post;
  if(!file_exists(__DIR__.sprintf('/../singles/single-%s.php', $post->post_type))) {
    return __DIR__.'/../singles/single.php';
  }
  return __DIR__.sprintf('/../singles/single-%s.php', $post->post_type);
});


// use the archives folder for all archive-{post_type} or archive.php template/s
add_filter('archive_template', function() {
  global $post;
  if(!file_exists(__DIR__.sprintf('/../archives/archive-%s.php', $post->post_type))) {
    return __DIR__.'/../archives/archive.php';
  }
  return __DIR__.sprintf('/../archives/archive-%s.php', $post->post_type);
});


/**
 * Get edit link when admin is logged in
 * @param int $id (post ID or term ID)
 * @param string $edit_type (post type or taxonomy slug)
 * @param string $label (optional admin-facing name for $edit_type)
 * @param bool $display_inline (omit wrapping paragraph)
 * @return string (HTML)
 */
function get_edit_link($id=null, $edit_type='post', $label=null, $display_inline=false) {
  if(!(is_user_logged_in() && current_user_can('manage_options'))) return null;

  $link_class = 'class="front-end-edit-link"';
  $link_tag = ($display_inline) ? 'span' : 'p';
  if(is_null($label)) {
    $label = Str::human(str_replace('-', ' ', $edit_type));
  }
  $subclasses = \Taco\Post\Loader::getSubclasses();
  $subclasses_machine = array_map(function($el){
    $el = substr($el, strrpos($el, '\\'));
    $el = Str::camelToHuman($el);
    $el = Str::machine($el, '-');
    return $el;
  }, $subclasses);
  if(in_array($edit_type, $subclasses_machine)) {
    // Edit post or display list of posts of this type
    $post_type_link = (!is_null($id))
      ? get_edit_post_link($id)
      : '/wp-admin/edit.php?post_type='.$edit_type;
    return sprintf(
      '<%s %s><a href="%s">Edit %s</a></%s>',
      $link_tag,
      $link_class,
      $post_type_link,
      $label,
      $link_tag
    );
  }

  // Find an applicable post type for editing a custom term
  $post_type = null;
  $post_types_by_taxonomy = [];
  foreach($subclasses as $subclass) {
    if(strpos($subclass, '\\') !== false) {
      $subclass = '\\'.$subclass;
    }
    $taxonomies = \Taco\Post\Factory::create($subclass)->getTaxonomies();
    if(Arr::iterable($taxonomies)) {
      foreach($taxonomies as $key => $taxonomy) {
        $taxonomy_slug = (is_array($taxonomy))
          ? $key
          : $taxonomy;
        $post_types_by_taxonomy[$taxonomy_slug][] = $subclass;
      }
    }
  }
  $post_types_by_taxonomy = array_unique($post_types_by_taxonomy);
  if(array_key_exists($edit_type, $post_types_by_taxonomy)) {
    $post_type = reset($post_types_by_taxonomy[$edit_type]);
    $post_type = substr($post_type, strrpos($post_type, '\\'));
    $post_type = Str::camelToHuman($post_type);
    $post_type = Str::machine($post_type, '-');
  } else {
    $post_type = 'post';
  }

  if(is_null($id)) {
    // View taxonomy term list
    return sprintf(
      '<%s %s><a href="/wp-admin/edit-tags.php?taxonomy=%s&post_type=%s">View %ss</a></%s>',
      $link_tag,
      $link_class,
      $edit_type,
      $post_type,
      $label,
      $link_tag
    );
  }

  // Edit term
  return sprintf(
    '<%s %s><a href="%s">Edit %s</a></%s>',
    $link_tag,
    $link_class,
    get_edit_term_link($id, $edit_type, $post_type),
    $label,
    $link_tag
  );
}


/**
 * Get App Options link when admin is logged in
 * @param string $description
 * @param bool $display_inline
 * @return type
 */
function get_app_options_link($description=null, $display_inline=false) {
  if(!(is_user_logged_in() && current_user_can('manage_options'))) return null;

  if(is_null($description)) {
    $description = 'this';
  }
  $options = AppOption::getInstance();
  return get_edit_link($options->ID, 'app-option', $description.' in '.$options->getPlural(), $display_inline);
}


function add_slug_to_body_class($classes=[]) {
  global $post;
  $file_name = basename($_SERVER['SCRIPT_FILENAME'], '.php');
  $queried_object = get_queried_object();
  $is_term = (is_object($queried_object) && property_exists($queried_object, 'term_taxonomy_id'));
  if(!$is_term && !is_null($post)) {
    $classes[] = $post->post_name;
  } else {
    $classes[] = Str::machine($file_name, '-');
  }
  return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');


function add_slug_to_menu_item_class($menu_html) {
  // Get menu item IDs and link slugs
  preg_match_all('/menu-item-(\d+).*href="(?:(?:.*?)\/\/(?:.*?))?\/(.*?)\/?"/', $menu_html, $matches);

  // Combine match groups into array
  $menu_items = array_combine($matches[1], $matches[2]);

  // Strip slugs down to last segment
  $menu_items = array_map(function($el){
    $slash_index = strrpos($el, '/');
    return ($slash_index)
      ? substr($el, $slash_index + 1)
      : $el;
  }, $menu_items);

  // Search/replace
  foreach($menu_items as $menu_item_id => $link_slug) {
    $menu_html = preg_replace('/menu-item-'.$menu_item_id.'">/', 'menu-item-'.$menu_item_id.' menu-item-'.$link_slug.'">', $menu_html, 1);
  }
  return $menu_html;
}
add_filter('wp_nav_menu', 'add_slug_to_menu_item_class');

/**
 * Arrow Down Mobile-only Walker Menu
*/
// used for mobile menu, hide the arrow-down-mobile typically for desktop only
class Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = []) {
    $indent = str_repeat("\t", $depth);
    if($depth ==0) {
      $output .='<span class="arrow-down-mobile"><i class="fa fa-arrow-down"></i></span>';
    }
    $output .= "\n$indent<ul class=\"sub-menu\">\n";
  }
}

/**
 * Get pagination links
 * @param int $current_page
 * @param int $total_posts_to_paginate
 * @param int $max_pages
 * @param int $per_page
 * @param bool $is_resource If true, render <a> as <span> that triggers JS event
 * @param string $link_prefix
 * @return string HTML
 */
function get_pagination($current_page, $total_posts_to_paginate, $max_pages=5, $per_page=10, $is_resource=false, $link_prefix=null) {

  $pagination = '';
  $page_count = ceil($total_posts_to_paginate / $per_page);
  $first_page = max($current_page - floor($max_pages / 2), 1);
  $last_page = min($first_page + ($max_pages - 1), $page_count);

  // Evaluate first page again, for when one of the last pages is selected
  if($max_pages >= $page_count) {
    $first_page = 1;
  } elseif($max_pages <= $page_count) {
    $first_page = min($first_page, $last_page - ($max_pages - 1));
  }

  $link_prefix = (!$is_resource) ? $link_prefix.'/page/' : null;
  $link_prefix = preg_replace('/\/+/', '/', $link_prefix);

  $pagination .= ($first_page != 1) ? '<li class="cta prev" data-page="'.($first_page - 1).'"><a href="'.(($is_resource) ? '#' : $link_prefix.($first_page - 1).'/').'"><i class="fa fa-caret-left">&nbsp;</i></a></li>' : '';

  for($i = $first_page; $i <= $last_page; $i++) {
    $pagination .= '<li'.(($i == $current_page) ? ' class="on"' : '').' data-page="'.$i.'"><a href="'.(($is_resource) ? '#' : $link_prefix.$i.'/').'">'.$i.'</a></li>';
  }

  $pagination .= ($last_page < $page_count) ? '<li class="cta next" data-page="'.($last_page + 1).'"><a href="'.(($is_resource) ? '#' : $link_prefix.($last_page + 1).'/').'"><i class="fa fa-caret-right">&nbsp;</i></a></li>' : '';

  return $pagination;
}

/* enable auto updates locally */
function allow_local_autoupdates( $checkout, $context) {
  return false;
}

add_filter( 'automatic_updates_is_vcs_checkout', 'allow_local_autoupdates', 10, 2);

// If WP Super Cache is installed, clear the cache on post save to uncomplicate things
if (function_exists('prune_super_cache')) {
  function wp_super_cache_clear_cache() {
    global $cache_path;
    prune_super_cache( $cache_path . 'supercache/', true );
    prune_super_cache( $cache_path, true );
  }

  add_action( 'save_post', 'wp_super_cache_clear_cache' );
}

// get page/post featured image
function getPostFeaturedImage($post) {
  $post_image_bool = has_post_thumbnail($post->ID);
  $post_image_url = "";
  if($post_image_bool) {
      $post_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
      $post_image_url = $post_image_url[0];
  }
  return $post_image_url;
}

// get number of columns across based on count
function getPostListColumnedVersionClasses($posts) {
  $post_columns_class = "";
  $post_width_class = STYLES_COLUMNS_MAIN_CONTENT_FULL;
  $results = array();
  if(count($posts) % 2 === 0) {
    $post_columns_class = "two-across";
    $post_width_class = STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW;
  }
  if(count($posts) % 3 === 0) {
    $post_columns_class = "three-across";
    $post_width_class = STYLES_COLUMNS_MAIN_CONTENT_FULL_WIDE;
  }
  $results['post_columns_class'] = $post_columns_class;
  $results['post_width_class'] = $post_width_class;
  return $results;
}

function getPostListCuratedTitle($posts) {
  $title = "Latest Posts";
  if($posts) {
    $title = "Related Posts";
  }
  return $title;
}

function getLatestOrCuratedPosts($data, $default_count = 1) {
  $posts = Post::getWhere(array(
   'orderby' =>'post_date',
   'order'   =>'DESC',
   'posts_per_page' => $default_count
  ));
  if($data) {
    $posts = $data;
  }
  return $posts;
}

function getTaxonomyLabel($name) {
  $label = "";
  if($name === 'category') {
    $label = "Categories";
  }
  return $label;
}

function getPaginationRange($paged, $per_page, $all_count) {
  $range = "";
  if($paged !== 0) {
    $first_range = ($per_page * ($paged - 1)) + 1;
    $second_range = $per_page * $paged;
    if($second_range > $all_count) {
      $second_range = $all_count;
    }
    $range = $first_range . '-' . $second_range;
  }
  return $range;
}

function getFirstPageStatus($current_page) {
  $first_page = false;
  if($current_page === 1) {
    $first_page = true;
  }
  return $first_page;
}

// render banner function
function renderBanner($dir_path, $page) {
  $panel_style = ($page->get('banner_style'))
    ? $page->get('banner_style')
    : 'default';

  $path = null;
  switch($panel_style) {
    case 'default':
      $path = 'incl-banner-default.php';
    break;
    case 'banner_with_image':
      $path = 'incl-banner-with-image.php';
    break;
    default:
      $path = 'incl-banner-default.php';
  }
  return include_with(
     $dir_path . $path,
    ['page' => $page]
  );
}
