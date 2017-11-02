<?php
get_header();
// get post
$single = \Taco\Post\Factory::create($post);
$taxonomies = array('category');

$related_posts = $single->related_posts;

?>

<div class="first-panel">
  
<div class="panel main-content has-sidebar">

  <div class="row narrow">
        
    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_SIDEBAR_ARTICLE; ?>">
      
      <?php // get main content
            
      include_with(__DIR__ . '/../includes/incl-post-banner.php', array('single' => $single)); ?>
      
      <?php // get main content
      include_with(__DIR__ . '/../includes/module/module-main-content.php', array('main_content' => $single)); ?>
      
      <p class="back-button">
        <a href="<?php echo get_permalink(PAGE_ID_BLOG); ?>">
          <i class="fa fa-angle-left"></i>&nbsp;Back to <?php echo get_the_title(PAGE_ID_BLOG); ?></a>
      </p>
      
    </div>

    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_SIDEBAR_BREADCRUMB; ?>">

      <?php
        include_with(__DIR__ . '/../includes/module/module-post-list-item-terms.php', array(
          'post' => $single,
          'taxonomy' => 'category',
        ));
      ?>
    
      <div class="share-wrapper">
        <span class="label">Share:</span>
        <ul>
          <li>
            <a href="#" title="Share on Facebook"><i class="fa fa-facebook"></i></a>
          </li>
          <li>
            <a href="#" title="Share on Twitter"><i class="fa fa-twitter"></i></a>
          </li>
        </ul>
      </div>
  
        
      <?php if(Arr::iterable($related_posts)) { ?>
      <div class="module single-related-posts">
        <h3>Related Posts:</h3>
        <ul>
          <?php foreach($related_posts as $related_post) { ?>
          <li>
            <a href="<?php echo $related_post->getPermalink(); ?>"><?php echo $related_post->getTheTitle(); ?></a>
          </li>
          <?php } // foreach ?>
        </ul>
      </div>
      <?php } // if related_posts ?>
      
    </div>
        
  </div><!-- /.row -->

</div><!--/.main-content -->
          
</div>


<?php get_footer(); ?>
