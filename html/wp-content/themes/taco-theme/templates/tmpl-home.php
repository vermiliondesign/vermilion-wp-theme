<?php /* Template Name: Page - Home */
get_header();

//setup the page
$page = \Taco\Post\Factory::create($post);
// get theme
$theme = AppOption::getInstance();
?>

<?php // get slider
include_with(__DIR__ . '/../includes/incl-slider.php', array('page' => $page));
?>

<div class="main-content">
  <div class="row">
    <div class="columns small-12 medium-10">
      <article class="content">
        <?php echo $page->getTheContent(); ?>
      </article>
    </div>
  </div>
</div>

<?php get_footer(); ?>