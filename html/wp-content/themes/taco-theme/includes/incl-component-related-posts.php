<?php // related posts vars
$related_post_title = "Latest Posts";
$related_post_class = "";
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
}
if(count($related_posts) % 3 === 0) {
  $related_post_class = "three-across";
}
?>

<?php if($page->show_posts && Arr::iterable($related_posts)) { ?>
<div class="panel related-posts <?php echo $related_post_class; ?>">
  <div class="row panel-title center">
    <h2><?php echo $related_post_title; ?></h2>
  </div>
  <div class="row">
    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL; ?>">
      <ul>
        <?php foreach($related_posts as $related_post) {
        // get featured image path if any
        $related_post_featured_image_bool = has_post_thumbnail($related_post->ID);
        $related_post_featured_image_url = get_asset_path('_/img/post-placeholder-400x400.jpg');
        if($related_post_featured_image_bool) {
            $related_post_featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $related_post->ID ), 'medium' );
            $related_post_featured_image_url = $related_post_featured_image_url[0];
        }
        ?>
        <li>
          <div class="featured-image">
            <img src="<?php echo $related_post_featured_image_url; ?>" alt="<?php echo $related_post->getTheTitle(); ?>">
          </div>
          <h3><?php echo $related_post->getTheTitle(); ?></h3>
          <?php echo $related_post->getTheExcerpt(); ?>
          <p>
            <span class="cta-wrapper">
              <a href="<?php echo $related_post->getPermalink(); ?>">Read the Article</a>
            </span>
          </p>
        </li>
        <?php } // foreach related post ?>
      </ul>
    </div>
  </div>
</div>
<?php } // if show posts ?>