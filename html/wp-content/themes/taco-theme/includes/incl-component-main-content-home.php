<!-- main-content -->
<div class="panel main-content">
  <div class="row">
    <div class="columns small-12 columns-centered">
      <div class="row">
        
        <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL; ?>">

            <?php // get main content
            include_with(__DIR__ . '/module/module-main-content.php', array('page' => $page)); ?>
          
        </div>

      </div><!-- /.row-->
    </div><!-- /.main-page -->
  </div><!-- /.row -->
</div><!-- /.main-content -->