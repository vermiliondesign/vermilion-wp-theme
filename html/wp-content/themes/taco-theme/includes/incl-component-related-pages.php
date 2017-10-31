<?php if(Arr::iterable($related_pages = $page->related_pages)) { ?>
<div class="panel post-list stacked-version">
  <div class="row panel-title center">
    <h2>Related Pages</h2>
  </div>
  <div class="row">
    <div class="<?php echo STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW; ?>">
      <ul>
        <?php foreach($related_pages as $related_page) {
        // get featured image path if any
        $related_page_featured_image_bool = has_post_thumbnail($related_page->ID);
        $related_page_featured_image_url = "";
        if($related_page_featured_image_bool) {
            $related_page_featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $related_page->ID ), 'medium' );
            $related_page_featured_image_url = $related_page_featured_image_url[0];
        }
        ?>
        <li>
          <?php if(strlen($related_page_featured_image_url)) { ?>
          <div class="featured-image">
            <a href="<?php echo $related_page->getPermalink(); ?>">
              <img src="<?php echo $related_page_featured_image_url; ?>" alt="<?php echo $related_page->getTheTitle(); ?>">
            </a>
          </div>
          <?php } // if featured image ?>
          <div class="details">
            <h3>
              <a href="<?php echo $related_page->getPermalink(); ?>">
                <?php echo $related_page->getTheTitle(); ?>
              </a>
            </h3>
            <?php echo $related_page->getTheExcerpt(); ?>
            <p>
              <span class="cta-wrapper">
                <a href="<?php echo $related_page->getPermalink(); ?>">Learn More</a>
              </span>
            </p>
          </div>
        </li>
        <?php } // foreach related post ?>
      </ul>
    </div>
  </div>
</div>
<?php } // if show posts ?>