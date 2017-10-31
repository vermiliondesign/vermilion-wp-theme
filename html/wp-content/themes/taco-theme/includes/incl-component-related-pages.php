<?php if(Arr::iterable($related_pages = $page->related_pages)) { ?>
<div class="panel post-list stacked-version">
  <div class="row panel-title center">
    <h2>Related Pages</h2>
  </div>
  <div class="row">
    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW; ?>">
      <ul>
        <?php foreach($related_pages as $post) {
        // get featured image path if any
        $post_image_url = getPostFeaturedImage($post);
        ?>
        <?php
        include_with(__DIR__ . '/module/module-post-list-item.php', array(
          'post' => $post,
          'show_date' => false,
          'post_image_url' => $post_image_url,
          'cta_text' => 'Learn More'
        )); ?>
        <?php } // foreach related post ?>
      </ul>
    </div>
  </div>
</div>
<?php } // if show posts ?>