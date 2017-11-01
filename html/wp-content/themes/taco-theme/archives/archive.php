<?php
get_header();

// setup archive vars
global $wp_query;

// make sure only blog posts are queried, otherwise resources will show up too
$args = array_merge( $wp_query->query_vars, array( 'post_type' => 'post' ) );
$blog_posts = query_posts( $args );
// setup taco posts based on $wp_query
$blog_posts = \Taco\Post\Factory::createMultiple($blog_posts);

// query vars
$category       = get_queried_object();
$category_title = $category->name; // Same as single_tag_title()
$category_slug  = $category->slug;
$category_id  = $category->term_id;
$category_taxonomy = $category->taxonomy;
$category_taxonomy_title = $category_taxonomy;

// taxonomies
// categories
$categories = Post::getAllCategories();
$categories = array_filter($categories, function($category) {
  // Remove 'Uncategorized' category
  return ($category->name !== 'Uncategorized');
});

// PAGINATION VARS
// set immediate pagination vars for query
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$per_page = get_option('posts_per_page');
$link_prefix = '/' . $category_taxonomy . '/' . $category_slug;
// find out total number in term group
$all_blog_posts = Post::getByTerm($category_taxonomy, $category_slug);
$all_count = count($all_blog_posts);
$range = getPaginationRange($paged, $per_page, $all_count);

?>

<!-- to be same markup as banner-default -->
<div class="first-panel">
  <div class="banner default">
    <div class="row">
      <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL; ?>">
        <h1>Archive</h1>
      </div>
    </div>
  </div>
</div>


<?php // get blog posts
if(Arr::iterable($blog_posts)) : ?>

<?php // get pagination
include_with(__DIR__ . '/../includes/module/module-pagination.php', array(
  'page' => $page,
  'range' => $range,
  'all_count' => $all_count,
  'per_page' => $per_page,
  'current_page' => $current_page,
  'link_prefix' => $link_prefix
));
?>

<?php // get blog posts
include_with(__DIR__ . '/../includes/incl-component-post-list.php', array(
  'page' => $page,
  'posts' => $blog_posts,
  'list_version' => 'stacked-version',
  'list_column_class' => '',
  'list_width' => STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW,
  'list_title' => '',
  'list_item_image_fallback' => '',
  'list_item_show_date' => true,
  'list_item_taxonomies' => array('category'),
  'list_item_cta_text' => 'Read the Article'
));
?>

<?php // get pagination
include_with(__DIR__ . '/../includes/module/module-pagination.php', array(
  'page' => $page,
  'range' => $range,
  'all_count' => $all_count,
  'per_page' => $per_page,
  'current_page' => $current_page,
  'link_prefix' => $link_prefix
));
?>

<?php endif; // if blog posts ?>

<?php get_footer(); ?>