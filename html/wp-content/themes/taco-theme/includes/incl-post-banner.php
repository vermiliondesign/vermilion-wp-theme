<?php
$post_featured_image = Post::getPostFeaturedImage($post, 'medium_featured');
?>
<div class="post-banner">

  <p class="date">
    <?php echo date('M d, Y', strtotime($single->post_date)); ?>
  </p>
  
  <h1><?php echo $single->getTheTitle(); ?></h1>

  <?php if($post_featured_image) { ?>
  <div class="featured-image">
    <img src="<?php echo $post_featured_image; ?>" alt="">
  </div>
  <?php } // if post_featured_image ?>
  
  
</div>
