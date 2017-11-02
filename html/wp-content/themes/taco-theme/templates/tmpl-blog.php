<?php /* Template Name: Page - Blog */
get_header();

//setup the page
$page = \Taco\Post\Factory::create($post);

// set immediate pagination vars for query
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$per_page = get_option('posts_per_page');

// get latest or featured posts
$featured_posts = Page::getPostsLatestOrCurated($page->featured_posts, 3);
$featured_posts_ids = Collection::pluck($featured_posts, 'ID');



// get blog posts
$blog_posts = Post::getWhere(array(
  'orderby' => 'date',
  'order' => 'DESC',
  'posts_per_page' => $per_page,
  'offset' => ($current_page -1) * $per_page,
  'post__not_in' => $featured_posts_ids
));

// additional pagination information
$link_prefix = '/blog';
$all_count = (Post::getCount() - count($featured_posts));
$range = getPaginationRange($paged, $per_page, $all_count);


// setup first page var
$first_page = getFirstPageStatus($current_page);
?>


<?php // get banner
include_with(__DIR__ . '/../includes/incl-banner.php', array('page' => $page));
?>


<?php // get main content
if($first_page) :
include_with(__DIR__ . '/../includes/incl-component-main-content.php', array('page' => $page));
endif; // only on first page
?>


<?php // get blog posts
if(Arr::iterable($blog_posts)) : ?>


<?php // get featured (or latest) posts
if($first_page) :
include_with(__DIR__ . '/../includes/incl-component-post-list.php', array(
  'page' => $page,
  'posts' => $featured_posts,
  'list_version' => 'columned-version',
  'list_column_class' => Page::getPostListColumnedVersionClasses($featured_posts)['post_columns_class'],
  'list_width' => Page::getPostListColumnedVersionClasses($featured_posts)['post_width_class'],
  'list_title' => Page::getCuratedTitleFeaturedPost($page->featured_posts),
  'list_item_image_fallback' => get_asset_path('_/img/post-placeholder-600x450.jpg'),
  'list_item_show_date' => true,
  'list_item_taxonomies' => false,
  'list_item_cta_text' => 'Read the Article'
));
endif; // only on first page
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