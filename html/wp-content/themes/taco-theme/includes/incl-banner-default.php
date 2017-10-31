<div class="banner default">
  <div class="row">
    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL; ?>">
      <h1><?php echo $page->getTheTitle(); ?></h1>
      <?php if($page->banner_subtitle) { ?>
      <p><?php echo nl2br($page->banner_subtitle); ?></p>
      <?php } ?>
    </div>
  </div>
</div>