<?php

get_header();

// global query
global $wp_query;

$results = \Taco\Post\Factory::createMultiple($posts);

// set immediate pagination vars for query
// $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$per_page = get_option('posts_per_page');
$range = '';
global $wp_query;
$all_count = $wp_query->found_posts;

// setup pagination report information, only for paged pages
if($paged !== 0) {
  $first_range = ($per_page * ($paged - 1)) + 1;
  $second_range = $per_page * $paged;
  if($second_range > $all_count) {
    $second_range = $all_count;
  }
  if($all_count <= 10) {
    $second_range = '';
  }
  $range = $first_range . '-' . $second_range;
}

?>

<div class="row">
  <div class="small-12">
    <h1>Search Results:</h1>
    <p class="sub-title"><?php echo $_GET['s']; ?></p>
  </div>
</div>


<!-- main-content -->

<article class="row">
  <div class="columns small-10 medium-8 content">

    <?php if(Arr::iterable($results)) : ?>
    
    
    <?php if($all_count > 10): ?>
      <div class="post-pagination table">
        <div class="cell">
          <?php if($range) { // if not the first page ?>
          <p>Displaying <?php echo $range; ?> of <?php echo $all_count; ?></p>
          <?php } else { ?>
          <p>Displaying 1-<?php echo $per_page; ?> of <?php echo $all_count; ?></p>
          <?php } ?>
        </div>

        <div class="cell">
          <div class="pagination default-wp-pagination">
          <?php echo paginate_links(array(
          'prev_text'=> __('<i class="fa fa-caret-left">&nbsp;</i>'),
          'next_text'=> __('<i class="fa fa-caret-right">&nbsp;</i>'),
          )); ?>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="post-pagination table">
        <div class="cell">
          <p>Displaying 1-<?php echo $all_count; ?> of <?php echo $all_count; ?></p>
        </div>
        <div class="cell"></div>
      </div>
    <?php endif; ?>
    
    
    
    <ol>
    <?php foreach($results as $result): ?>
      <li>
        
        <h3>
          <a href="<?php echo $result->getPermalink(); ?>"><?php echo $result->getTheTitle(); ?></a>
        </h3>
        <strong class="post-type">
          <?php // show post type, but never panel
          echo $result->post_type;
          ?>
        </strong>

          <p>
            <?php echo $result->getTheExcerpt(); ?>
            <span class="cta-wrapper">
              <a href="<?php echo $result->getPermalink(); ?>">View</a>
            </span>
          </p>
        
      </li>
    <?php endforeach; ?>
    </ol>
    
    
    <?php if($all_count > 10): ?>
      <div class="post-pagination table">
        <div class="cell">
          <?php if($range) { // if not the first page ?>
          <p>Displaying <?php echo $range; ?> of <?php echo $all_count; ?></p>
          <?php } else { ?>
          <p>Displaying 1-<?php echo $per_page; ?> of <?php echo $all_count; ?></p>
          <?php } ?>
        </div>

        <div class="cell">
          <div class="pagination default-wp-pagination">
          <?php echo paginate_links(array(
          'prev_text'=> __('<i class="fa fa-caret-left">&nbsp;</i>'),
          'next_text'=> __('<i class="fa fa-caret-right">&nbsp;</i>'),
          )); ?>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="post-pagination table">
        <div class="cell">
          <p>Displaying 1-<?php echo $all_count; ?> of <?php echo $all_count; ?></p>
        </div>
        <div class="cell"></div>
      </div>
    <?php endif; ?>
    
          
    
    <?php else : ?>
    <p>Sorry, no search results were found matching <strong><?php echo $_GET['s']; ?></strong>.</p>
    <?php endif; ?>

    
  </div>
</article>




    

<?php get_footer(); ?>
