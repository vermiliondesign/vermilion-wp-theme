<?php
/* post-list-item vars include:
* list_version (columned-version or stacked-version)
* list_column_class (for columned-version, two-across or three-across)
* list_title
* list_width
* list_item_image_fallback
*/
?>

<?php if(Arr::iterable($posts)) { ?>

<div class="panel post-list <?php echo $list_version; ?> <?php echo $list_column_class; ?>">
  <?php if(strlen($list_title)) { ?>
  <div class="row panel-title center">
    <h2><?php echo $list_title; ?></h2>
  </div>
  <?php } // if list_title ?>
  <div class="row">
    <div class="<?php echo $list_width; ?>">
      <ul>
        <?php foreach($posts as $post) {
          
        // get featured image or set fallback
        $post_image_url = ( strlen(getPostFeaturedImage($post)) ) ? getPostFeaturedImage($post) : $list_item_image_fallback;
        ?>
        
        <?php
        include_with(__DIR__ . '/module/module-post-list-item.php', array(
          'post' => $post,
          'post_image_url' => $post_image_url,
          'list_item_show_date' => $list_item_show_date,
          'list_item_taxonomies' => $list_item_taxonomies,
          'list_item_cta_text' => $list_item_cta_text,
        )); ?>
        
        <?php } // foreach related post ?>
      </ul>
    </div>
  </div>
</div>
<?php } // if iterable ?>