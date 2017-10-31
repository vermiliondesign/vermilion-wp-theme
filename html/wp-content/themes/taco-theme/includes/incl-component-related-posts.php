<?php // related posts vars
$related_post_title = "Latest Posts";
$related_post_class = "";
$related_post_class_width = STYLES_COLUMNS_MAIN_CONTENT_FULL;
$related_posts = Post::getWhere(array(
   'orderby' =>'post_date',
   'order'   =>'DESC',
   'posts_per_page' => 3
));
if($page->related_posts) {
  $related_post_title = "Related Posts";
  $related_posts = $page->related_posts;
}
if(count($related_posts) % 2 === 0) {
  $related_post_class = "two-across";
  $related_post_class_width = STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW;
}
if(count($related_posts) % 3 === 0) {
  $related_post_class = "three-across";
  $related_post_class_width = STYLES_COLUMNS_MAIN_CONTENT_FULL_WIDE;
}
?>

<?php if($page->show_posts && Arr::iterable($related_posts)) { ?>
<div class="panel post-list columned-version <?php echo $related_post_class; ?>">
  <div class="row panel-title center">
    <h2><?php echo $related_post_title; ?></h2>
  </div>
  <div class="row">
    <div class="<?php echo $related_post_class_width; ?>">
      <ul>
        <?php foreach($related_posts as $post) {
          
        // get featured image or set fallback
        $post_image_url = ( strlen(getPostFeaturedImage($post)) ) ? getPostFeaturedImage($post) : get_asset_path('_/img/post-placeholder-400x400.jpg');
        ?>
        
        <?php
        include_with(__DIR__ . '/module/module-post-list-item.php', array(
          'post' => $post,
          'show_date' => true,
          'post_image_url' => $post_image_url,
          'cta_text' => 'Read the Article'
        )); ?>
        
        <?php } // foreach related post ?>
      </ul>
    </div>
  </div>
</div>
<?php } // if show posts ?>