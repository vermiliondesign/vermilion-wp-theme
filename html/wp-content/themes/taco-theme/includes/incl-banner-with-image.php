<?php
$banner_image = ($page->banner_image) ? $page->banner_image : "https://placehold.it/1400x400" ;
?>
<div class="banner with-image" style="background-image: url('<?php echo $banner_image; ?>');">
  <div class="row table">
    <div class="columns small-12 medium-10 columns-centered cell">

      <h1><?php echo $page->getTheTitle(); ?></h1>
      <?php if($page->banner_subtitle) { ?>
      <p><?php echo nl2br($page->banner_subtitle); ?></p>
      <?php } ?>

    </div>
  </div>
</div>