<?php
get_header();
//setup the page
$page = \Taco\Post\Factory::create($post);
?>

<?php // get banner style
include_with(__DIR__ . '/includes/incl-banner.php', array('page' => $page));
?>

<article class="content">
  
  <?php echo $page->getTheContent(); ?>
</article>


<?php get_footer(); ?>