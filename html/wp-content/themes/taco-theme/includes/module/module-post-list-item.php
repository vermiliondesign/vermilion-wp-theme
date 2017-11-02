<?php
/* post-list-item vars include
* post_image_url
* list_item_show_date
* list_item_taxonomies (either array of keys or false)
* list_item_cta_text
*/
?>
<li class="post-item">
  <?php if(strlen($post_image_url)) { ?>
  <div class="featured-image">
    <a href="<?php echo $post->getPermalink(); ?>">
      <img src="<?php echo $post_image_url; ?>" alt="<?php echo $post->getTheTitle(); ?>">
    </a>
  </div>
  <?php } // if post image url ?>
  <div class="details">
    <?php if($list_item_show_date) { ?>
    <p class="date">
      <?php echo date('M d, Y', strtotime($post->post_date)); ?>
    </p>
    <?php } // if show date ?>
    <h3>
      <a href="<?php echo $post->getPermalink(); ?>">
        <?php echo $post->getTheTitle(); ?>
      </a>
    </h3>
    <div class="excerpt">
      <?php echo $post->getTheExcerpt(); ?>
    </div>

    <?php if(Arr::iterable($list_item_taxonomies)) {
      foreach($list_item_taxonomies as $taxonomy) {
        
        include_with(__DIR__ . '/module-post-list-item-terms.php', array(
          'post' => $post,
          'taxonomy' => $taxonomy,
        ));
      } // foreach taxonomy
    } // if taxonomies iterable ?>
    <p>
      <span class="cta-wrapper">
        <a href="<?php echo $post->getPermalink(); ?>"><?php echo $list_item_cta_text; ?></a>
      </span>
    </p>
  </div>
</li>