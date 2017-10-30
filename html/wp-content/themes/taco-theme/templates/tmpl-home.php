<?php /* Template Name: Page - Home */
get_header();

//setup the page
$page = \Taco\Post\Factory::create($post);
// get theme
$theme = AppOption::getInstance();
?>

<?php // get slider
include_with(__DIR__ . '/../includes/incl-component-slider.php', array('page' => $page));
?>

<?php // get main content
include_with(__DIR__ . '/../includes/incl-component-main-content-home.php', array('page' => $page));
?>

<?php get_footer(); ?>