<?php
$sliders = $page->slider;
?>
<?php if($sliders) : ?>
<div class="slider-container default">
<div class="flex-container">
<div class="flexslider">
<ul class="slides">
  <?php foreach($sliders as $slide) {
  ?>
  <li>
    <div class="table">
      <?php if(strlen($slide->slide_image)) { ?>
      <div class="cell image" style="background-image: url('<?php echo app_image_path($slide->slide_image, 'original'); ?>'); ">
        &nbsp;
      </div>
      <?php } // if image_path ?>
      <div class="cell details center">
        <div class="inner content">

          <?php echo $slide->getThe('slide_textarea'); ?>
          
          <?php if(strlen($slide->slide_link)) { ?>
          <p>
            <span class="cta-wrapper">
              <?php echo $slide->getLinkHTML('slide_link'); ?>
            </span>
          </p>
          <?php } // if link ?>
        </div>
      </div>
    </div>
  </li>
  <?php } // foreach ?>
</ul>
</div>
<div class="slider-pagination">
  <div class="inner">
    <a href="#" class="prev-next flex-prev" title="Previous"></a>
    <div class="circle-pagination"></div>
    <a href="#" class="prev-next flex-next" title="Next"></a>
  </div>
</div>
</div>
</div>
<?php endif; ?>