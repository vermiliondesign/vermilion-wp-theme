<?php /* Template Name: Default Template with Modules */
get_header();
//setup the page
$page = \Taco\Post\Factory::create($post);

// check for related pages
$related_pages = $page->related_pages;
// check for related posts
$related_posts = getLatestOrCuratedPosts($page->related_posts, 3);

?>

<?php // get banner
include_with(__DIR__ . '/../includes/incl-banner.php', array('page' => $page));
?>

<?php // get main content
include_with(__DIR__ . '/../includes/incl-component-main-content.php', array('page' => $page));
?>

<!-- modules pre-baked -->
<?php // get main content
include_with(__DIR__ . '/../includes/incl-component-slider.php', array('page' => $page));
?>

<?php // get related pages
include_with(__DIR__ . '/../includes/incl-component-post-list.php', array(
  'page' => $page,
  'posts' => $related_pages,
  'list_version' => 'stacked-version',
  'list_column_class' => '',
  'list_width' => STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW,
  'list_title' => 'Related Pages',
  'list_item_image_fallback' => '',
  'list_item_show_date' => false,
  'list_item_taxonomies' => false,
  'list_item_cta_text' => 'Learn More'
));
?>



<?php // get related posts
include_with(__DIR__ . '/../includes/incl-component-post-list.php', array(
  'page' => $page,
  'posts' => $related_posts,
  'list_version' => 'columned-version',
  'list_column_class' => getPostListColumnedVersionClasses($related_posts)['post_columns_class'],
  'list_width' => getPostListColumnedVersionClasses($related_posts)['post_width_class'],
  'list_title' => getPostListCuratedTitle($page->related_posts),
  'list_item_image_fallback' => get_asset_path('_/img/post-placeholder-600x450.jpg'),
  'list_item_show_date' => true,
  'list_item_taxonomies' => false,
  'list_item_cta_text' => 'Read the Article'
));
?>

<?php get_footer(); ?>