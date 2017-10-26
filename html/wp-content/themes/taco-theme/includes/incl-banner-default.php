<div class="banner default">
  <div class="row">
    <div class="columns small-12 medium-10 columns-centered">
      <h1><?php echo $page->getTheTitle(); ?></h1>
      <?php if($page->banner_subtitle) { ?>
      <p><?php echo nl2br($page->banner_subtitle); ?></p>
      <?php } ?>
    </div>
  </div>
</div>