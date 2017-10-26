<?php

get_header();

global $wp_query;

$queried_post_year = $wp_query->query['year'];

// make sure only the queried post type is queried, otherwise it could display all
$args = array_merge( $wp_query->query_vars, array( 'post_type' => 'post' ) );
$results = query_posts( $args );

// turn into taco object
$results = \Taco\Post\Factory::createMultiple($results);

$results_count = count($results);

?>

<div class="first-panel">
  <div class="banner default">
    <div class="figure-wrapper">
      &nbsp;
    </div>
    <div class="row">
      <div class="inner">
        <h1>Year of News:</h1>
        <p class="sub-title"><?php echo $queried_post_year; ?></p>
      </div>
    </div>
  </div>
</div>


<!-- main-content -->
<div class="panel main-content">
  
<div class="row">
  <div class="columns small-12 medium-11 large-8">
    <div class="post-pagination table">
      <div class="cell">
        <p>Found <?php echo $results_count; ?> result<?php echo ($results_count === 1) ? '' : 's' ; ?></p>
      </div>
    </div>
  </div>
</div>
  
  <article class="row">
    <div class="columns small-10 medium-8 content">

      <?php if(Arr::iterable($results)) : ?>
      
      <ol>
      <?php foreach($results as $post): ?>
        
        <li>
          
          <h3>
            <a href="<?php echo $post->getPermalink(); ?>"><?php echo $post->getTheTitle(); ?></a>
          </h3>
          <p class="post-date-wrapper">
            <span class="post-date">
              <?php echo date('l, M d, Y', strtotime($post->get('post_date'))); ?>
            </span>
          </p>

            <p>
              <?php echo $post->getTheExcerpt(); ?>
              <span class="cta-wrapper blue">
                <a href="<?php echo $post->getPermalink(); ?>">View</a>
              </span>
            </p>
        </li>
      <?php endforeach; ?>
      </ol>
      
      <?php else : ?>
      <p>Sorry, no search results were found matching <strong><?php echo $_GET['s']; ?></strong>.</p>
      <?php endif; ?>

      
      <p class="panel" style="padding-bottom: 0;">
        <span class="cta-wrapper red">
          <a href="<?php echo PAGE_SLUG_NEWS; ?>">See all <?php echo get_the_title(PAGE_ID_NEWS); ?></a>
        </span>
      </p>
      
    </div>
  </article>
</div>
    

<?php get_footer(); ?>