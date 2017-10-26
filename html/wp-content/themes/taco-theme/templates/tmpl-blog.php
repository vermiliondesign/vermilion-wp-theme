<?php /* Template Name: Page - Blog */
get_header();

//setup the page
$page = \Taco\Post\Factory::create($post);
// set immediate pagination vars for query
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$per_page = get_option('posts_per_page');

// get blog posts
$blog_posts = Post::getWhere(array(
  'orderby' => 'date',
  'order' => 'DESC',
  'posts_per_page' => $per_page,
  'offset' => ($current_page -1) * $per_page,
  'post__not_in' => array($featured_post_id)
));

// setup pagination information
$link_prefix = '/blog';
$range = '';
$all_count = Post::getCount();

// setup pagination report information, only for paged pages
if($paged !== 0) {
  $first_range = ($per_page * ($paged - 1)) + 1;
  $second_range = $per_page * $paged;
  if($second_range > $all_count) {
    $second_range = $all_count;
  }
  $range = $first_range . '-' . $second_range;
}

?>




<?php // get blog posts
if(Arr::iterable($blog_posts)) : ?>

<div class="row">
  <div class="columns small-12 medium-11 large-8">
    <div class="post-pagination table">
      <div class="cell">
        <?php if($range) { // if not the first page ?>
        <p>Displaying <?php echo $range; ?> of <?php echo $all_count; ?></p>
        <?php } else { ?>
        <p>Displaying 1-<?php echo $per_page; ?> of <?php echo $all_count; ?></p>
        <?php } ?>
      </div>
      <div class="cell">
        <div class="pagination">
          <ul>
          <?php echo get_pagination($current_page, $all_count, 5, $per_page, false, $link_prefix); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="columns small-12">
    <ul>
      <?php foreach($blog_posts as $blog_post) { ?>
      <li class="post-item">
        <a href="<?php echo $blog_post->getPermalink(); ?>">
          <h3><?php echo $blog_post->getTheTitle(); ?></h3>
          <p class="post-date-wrapper">
            <span class="post-date">
              <?php echo date('l, M d, Y', strtotime($blog_post->get('post_date'))); ?>
            </span>
          </p>
          <?php echo $blog_post->getTheExcerpt(); ?>
        </a>
      </li>
      <?php } // foreach ?>
    </ul>
  </div>
</div>


<div class="row">
  <div class="columns small-12">
    <div class="post-pagination table">
      <div class="cell">
        <?php if($range) { // if not the first page ?>
        <p>Displaying <?php echo $range; ?> of <?php echo $all_count; ?></p>
        <?php } else { ?>
        <p>Displaying 1-<?php echo $per_page; ?> of <?php echo $all_count; ?></p>
        <?php } ?>
      </div>
      <div class="cell">
        <div class="pagination">
          <ul>
          <?php echo get_pagination($current_page, $all_count, 5, $per_page, false, $link_prefix); ?>
          </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>

<?php endif; // if blog posts ?>

<?php get_footer(); ?>