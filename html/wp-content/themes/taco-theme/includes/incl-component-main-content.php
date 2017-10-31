<?php
// get breadcrumb vars
$current_page_slug = get_home_url() . '/' . $page->post_name . '/';
$breadcrumb_vars = Page::getBreadcrumbVars($page);
$is_grandchild = Page::isGrandchildPage();
?>

<!-- main-content -->
<?php // get breadcrumb layout
if($page->show_sidebar_breadcrumbs) { ?>
<div class="panel main-content has-sidebar">

  <div class="row">
        
    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_SIDEBAR_ARTICLE; ?>">
      
      <?php // get main content
      include_with(__DIR__ . '/module/module-main-content.php', array('page' => $page)); ?>
      
    </div>

    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_SIDEBAR_BREADCRUMB; ?>">
      
      <?php // get breadcrumbs
      if($page->show_sidebar_breadcrumbs) {
        include_with(__DIR__ . '/module/module-sidebar-breadcrumb.php', array('page' => $page));
      }
      ?>
      
    </div>
        
  </div><!-- /.row -->

</div><!--/.main-content -->

<?php } else { // get one-column layout no breadcrumbs
// make sure there's content
if( strlen($page->getTheContent()) ) { ?>
<!-- main-content -->
<div class="panel main-content">

  <div class="row">
    
    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW; ?>">

        <?php // get main content
        include_with(__DIR__ . '/module/module-main-content.php', array('page' => $page)); ?>
      
    </div>

  </div><!-- /.row-->

</div><!-- /.main-content -->
<?php } // ifthere is content ?>
<?php } // else ?>