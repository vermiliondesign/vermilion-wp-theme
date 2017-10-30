<?php
get_header();
//setup the page
$page = \Taco\Post\Factory::create($post);
?>

<?php // get banner
include_with(__DIR__ . '/includes/incl-banner.php', array('page' => $page));
?>

<?php // get main content
include_with(__DIR__ . '/includes/incl-component-main-content.php', array('page' => $page));
?>


<?php get_footer(); ?>