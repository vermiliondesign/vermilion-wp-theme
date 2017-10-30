<?php include __DIR__.'/includes/incl-head.php'; ?>

<header>
  <div class="container">
    <div class="logo-wrapper">
      <h1 class="logo">
        <a href="<?php echo get_home_url(); ?>">
          <img src="https://placehold.it/300x80" alt="">
        </a>
      </h1>
    </div>
    
    <a href="javascript:void(0)" class="mobile-menu-button">Menu</a>
    
    <div class="menu-wrapper">
      <div class="primary-wrapper">
        <nav>
          <?php if(has_nav_menu('menu_primary')) {
            wp_nav_menu( array(
              'theme_location' => 'menu_primary',
              'container' => false,
              'walker'=> new Arrow_Walker_Nav_Menu()
            ) );
          }
          ?>
        </nav>
      </div>
      <div class="utility-wrapper">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'menu_utility',
            'container' => false,
          ) );
          ?>
      </div>
    </div>
    
  </div>
</header>


<!-- to achieve sticky footer -->
<div class="page-wrap">

