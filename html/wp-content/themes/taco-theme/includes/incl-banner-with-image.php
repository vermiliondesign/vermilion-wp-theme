<?php
$banner_image = ($page->banner_image) ? $page->banner_image : get_asset_path('_/img/banner-placeholder-1200x400.jpg');
?>
<div class="banner with-image" style="background-image: url('<?php echo $banner_image; ?>');">
  <div class="row table">
    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL; ?> cell details">

      <h1><?php echo $page->getTheTitle(); ?></h1>
      <?php if($page->banner_subtitle) { ?>
      <p class="subtitle"><?php echo nl2br($page->banner_subtitle); ?></p>
      <?php } ?>

    </div>
  </div>
</div>