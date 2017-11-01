<?php if($all_count > $per_page) { ?>
<div class="row module post-pagination">
  <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW; ?>">
    <div class="table">
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
  </div>
</div>
<?php } else { // no pages ?>
<div class="row module post-pagination">
  <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW; ?>">
    <div class="table">
      <div class="cell range">
        <p>Displaying <?php echo $all_count; ?> Result<?php echo (count($all_count) > 1) ? 's' : '' ; ?>:</p>
      </div>
    </div>
  </div>
</div>
<?php } // no pages ?>