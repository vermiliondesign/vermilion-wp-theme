<?php /* Template Name: Default Template with Modules */
get_header();
//setup the page
$page = \Taco\Post\Factory::create($post);
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

<?php // get main content
include_with(__DIR__ . '/../includes/incl-component-related-pages.php', array('page' => $page));
?>

<?php // get main content
include_with(__DIR__ . '/../includes/incl-component-related-posts.php', array('page' => $page));
?>


<?php get_footer(); ?>