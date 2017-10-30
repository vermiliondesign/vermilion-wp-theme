<?php
// get breadcrumb vars
$current_page_slug = get_home_url() . '/' . $page->post_name . '/';
$breadcrumb_vars = Page::getBreadcrumbVars($page);
$is_grandchild = Page::isGrandchildPage();
?>
<!-- breadcrumbs -->
<div class="breadcrumbs">
  
  <?php // check if grandshild, to show grandparent if so
  if($is_grandchild) {
    $ancestor_id = Page::getTopAncestor($page->ID);
    $ancestor = Page::find($ancestor_id);
  ?>
  <p class="ancestor" style="font-size: 13px; display: inline-block;">
    <a href="<?php echo $ancestor->getPermalink(); ?>"><?php echo $ancestor->getTheTitle(); ?></a>
  </p>
  <br>
  <?php } // if grandchild, show top ancestor ?>
  
  <h2>
    <a href="<?php echo $breadcrumb_vars['nav_parent_permalink']; ?>" class="<?php echo ($current_page_slug === $breadcrumb_vars['nav_parent_permalink']) ? 'active' : ''; ?>">
      <?php echo $breadcrumb_vars['nav_parent_title']; ?>
    </a>
  </h2>
  
  <?php
  // get breadcrumbs
  echo '<ul>';
  wp_list_pages( $breadcrumb_vars['args'] );
  echo '</ul>';
  ?>
</div>