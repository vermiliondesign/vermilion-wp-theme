<?php

// include getenv('HTTP_BOOTSTRAP_WP'); // bootstrap WordPress

$install_dir = __DIR__.'/../../../../wordpress';
chdir($install_dir);
include('wp-load.php');

header('Content-type: text/plain'); ?>
<?php if(ENVIRONMENT !== ENVIRONMENT_PROD): ?>
User-agent: *
Disallow: /
<?php else: ?>
User-agent: *
Disallow: /wp-admin/
<?php endif; ?>

#Sitemap: <?php echo get_site_url(); ?>/sitemap.xml