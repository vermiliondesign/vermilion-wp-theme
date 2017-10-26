<!doctype html>
<?php
$theme = AppOption::getInstance();
?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo the_title(); ?></title>
  
  <?php include __DIR__.'/incl-google-tag-manager.php'; ?>

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <?php echo get_app_icons(); ?>
    
  <?php wp_head(); ?>

</head>

<?php global $body_class; ?>
<body <?php body_class((isset($body_class)) ? $body_class : null); ?>>

<?php include __DIR__.'/incl-google-tag-manager-noscript.php'; ?>
