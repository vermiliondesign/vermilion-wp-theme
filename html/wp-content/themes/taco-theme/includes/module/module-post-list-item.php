<?php
/* post-item vars include
* post_image_url
* show_date
* cta_text
*/
?>
<li>
  <?php if(strlen($post_image_url)) { ?>
  <div class="featured-image">
    <a href="<?php echo $post->getPermalink(); ?>">
      <img src="<?php echo $post_image_url; ?>" alt="<?php echo $post->getTheTitle(); ?>">
    </a>
  </div>
  <?php } // if post image url ?>
  <div class="details">
    <?php if($show_date) { ?>
    <p class="date">
      <?php echo date('M d, Y', strtotime($post->post_date)); ?>
    </p>
    <?php } // if show date ?>
    <h3>
      <a href="<?php echo $post->getPermalink(); ?>">
        <?php echo $post->getTheTitle(); ?>
      </a>
    </h3>
    <?php echo $post->getTheExcerpt(); ?>
    <p>
      <span class="cta-wrapper">
        <a href="<?php echo $post->getPermalink(); ?>"><?php echo $cta_text; ?></a>
      </span>
    </p>
  </div>
</li>