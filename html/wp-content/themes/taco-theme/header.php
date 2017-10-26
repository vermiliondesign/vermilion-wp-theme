<?php include __DIR__.'/includes/incl-head.php'; ?>

<header>
  <h1 class="logo">
    <a href="<?php echo get_home_url(); ?>">
      <img src="<?php // echo get_asset_path('src/img/logo.png'); ?>" alt="" />
      <img src="https://placehold.it/300x80" alt="">
    </a>
  </h1>

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
</header>


<!-- to achieve sticky footer -->
<div class="page-wrap">

