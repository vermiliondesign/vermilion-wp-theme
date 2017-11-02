<div class="module list-as-dropdown">
  <div class="list-wrapper">
    <a href="#" class="active-archive">
      <span class="taxonomy-selection">
        Categories
      </span>
      <span class="arrow"><i class="fa fa-caret-down"></i></span>
    </a>
    <ul>
      <?php foreach($categories as $category) { ?>
      <li class="<?php echo ($category_slug === $category->slug) ? 'active' : '' ; ?>"><a href="<?php echo get_category_link($category->term_id); ?>">
        <?php echo $category->name; ?>
      </a></li>
      <?php } // foreach ?>
    </ul>
  </div>
</div>