<?php
// get theme
$theme = AppOption::getInstance();
?>


</div>
<!--/.page-wrap -->


<div id="breakpoint-detector"></div>

<footer class="panel">
  <div class="row">
    <div class="columns small-12 medium-6">
      <div class="footer-menu-wrapper">
        <?php if(has_nav_menu('menu_footer')) {
          wp_nav_menu( array(
            'theme_location' => 'menu_footer',
            'container' => false,
            'walker'=> new Arrow_Walker_Nav_Menu()
          ) );
        }
        ?>
      </div>
    </div>
    <div class="columns small-12 medium-6" style="text-align: right;">
      <a href="<?php echo get_home_url(); ?>" class="logo">
        <img src="https://placehold.it/150x70" alt="<?php echo get_bloginfo('name'); ?>">
      </a>
      <ul class="social-menu">
        <li>
          <a href="<?php echo $theme->social_facebook; ?>" title="Facebook">
            <i class="fa fa-facebook"></i>
          </a>
        </li>
        <li>
          <a href="<?php echo $theme->social_twitter; ?>" title="Twitter">
            <i class="fa fa-twitter"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</footer>


<?php wp_footer(); ?>

<!-- Deferred styles https://developers.google.com/speed/docs/insights/OptimizeCSSDelivery -->
<noscript id="deferred-styles">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Quattrocento:400,700" rel="stylesheet">
</noscript>

<script>
  var loadDeferredStyles = function() {
    var addStylesNode = document.getElementById("deferred-styles");
    var replacement = document.createElement("div");
    replacement.innerHTML = addStylesNode.textContent;
    document.body.appendChild(replacement)
    addStylesNode.parentElement.removeChild(addStylesNode);
  };
  var raf = requestAnimationFrame || mozRequestAnimationFrame ||
      webkitRequestAnimationFrame || msRequestAnimationFrame;
  if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
  else window.addEventListener('load', loadDeferredStyles);
</script>

<!-- addthis script goes here -->

</body>
</html>