<?php
$taxonomy = get_taxonomy($taxonomy);
$terms = $post->getTerms($taxonomy->name);
$terms = array_filter($terms, function($term) {
  // Remove 'Uncategorized'
  return ($term->name !== 'Uncategorized');
});
?>
<?php if(Arr::iterable($terms)) { ?>
<div class="module terms-group">
  <span class="label"><?php echo getTaxonomyLabel($taxonomy->name); ?>:</span>&nbsp;
  <ul>
  <?php foreach($terms as $term) { ?>
    <li class="post-term">
      <a href="<?php echo get_home_url() . '/' . $term->taxonomy . '/' . $term->slug; ?>">
        <?php echo $term->name; ?><span class="comma">,</span>
      </a>&nbsp;
    </li>
  <?php } // foreach ?>
  </ul>
</div>
<?php } // if iterable ?>