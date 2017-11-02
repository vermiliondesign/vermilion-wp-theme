<div class="banner default">
  <div class="table container">
    <div class="cell details">
        <h1><?php echo $page->getTheTitle(); ?></h1>
        <?php if($page->banner_subtitle) { ?>
        <p class="subtitle"><?php echo nl2br($page->banner_subtitle); ?></p>
        <?php } ?>
    </div>
  </div>
</div>