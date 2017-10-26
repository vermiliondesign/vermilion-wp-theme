<?php
get_header();
// get page
$single = \Taco\Post\Factory::create($post);
?>

<h1>
  <?php echo $single->getTheTitle(); ?>
</h1>

<article class="content">
  <?php echo $single->getTheContent(); ?>
</article>
          

<?php get_footer(); ?>
