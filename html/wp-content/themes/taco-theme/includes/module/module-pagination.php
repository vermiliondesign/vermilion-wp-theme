<?php if($all_count > $per_page) { ?>
<div class="module post-pagination table">
  <div class="cell range">
    <?php if($range) { // if not the first page ?>
    <p>Displaying <?php echo $range; ?> of <?php echo $all_count; ?></p>
    <?php } else {
      if($per_page > $all_count) {
        $per_page = $all_count;
      } ?>
    <p>Displaying 1-<?php echo $per_page; ?> of <?php echo $all_count; ?></p>
    <?php } ?>
  </div>
  <div class="cell pagination">
    <ul>
    <?php echo get_pagination($current_page, $all_count, 5, $per_page, false, $link_prefix); ?>
    </ul>
  </div>
</div>
<?php } // if paged show pagination ?>
