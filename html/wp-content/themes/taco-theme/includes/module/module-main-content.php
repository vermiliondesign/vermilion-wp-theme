<article>
  <?php // get the content with read more
  $contents = explode('<!--more-->', $page->getTheContent());
  ?>
  <!-- read more -->
  <div class="accordion-wrapper">
    <div class="content">
      <?php echo current($contents); ?>
    </div>
    
    <?php // if there is a read-more
    if(count($contents) > 1): ?>
    <span class="cta-wrapper-accordion">
      <a class="toggle-accordion" href="javascript:void(0)">Read <span class="status"></span>&nbsp;
        <i class="icon-angle-down"></i>
      </a>
    </span>
      <div class="more-summary content">
        <?php for($i=1; $i<count($contents)+1; $i++): ?>
          <?php echo apply_filters('the_content', $contents[$i]); ?>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</article>