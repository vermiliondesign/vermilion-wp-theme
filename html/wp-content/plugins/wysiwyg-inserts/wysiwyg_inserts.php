<?php
/**
 * Plugin Name: TinyMCE Inserts
 * Description: Add custom inserts to posts
 * Tutorial: https://www.gavick.com/blog/wordpress-tinymce-custom-buttons
 */

/*
* WYSIWYG COLORS AND FORMATS
*/

add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
function tuts_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

// customize caption or cta by selecting text and from Format dropdown
add_filter( 'tiny_mce_before_init', 'add_theme_colors_before_init' );
function add_theme_colors_before_init( $settings ) {
    $colors = get_primary_colors();
    $settings['textcolor_map'] = '['.$colors.']';
    $settings['theme_advanced_more_colors'] = false;


    $style_formats = array(
        array(
            'title' => 'CTA Wrapper',
            'inline' => 'span',
            'classes' => 'cta-wrapper yellow',
            'wrapper' => true,
        ),
        array(
            'title' => 'CTA Wrapper - Red',
            'inline' => 'span',
            'classes' => 'cta-wrapper red',
            'wrapper' => true,
        ),
        array(
            'title' => 'CTA Wrapper - Blue',
            'inline' => 'span',
            'classes' => 'cta-wrapper blue',
            'wrapper' => true,
        ),
        array(
            'title' => 'Font - Caption',
            'block' => 'div',
            'classes' => 'caption',
            'wrapper' => true,
        ),
        array(
            'title' => 'Font - Heading XLarge',
            'block' => 'div',
            'classes' => 'heading-xlarge',
            'wrapper' => true,
        ),
        array(
            'title' => 'Font - Heading Secondary - Bold',
            'block' => 'div',
            'classes' => 'heading-secondary-bold',
            'wrapper' => true,
        ),
        array(
            'title' => 'Font - Heading Secondary - Regular',
            'block' => 'div',
            'classes' => 'heading-secondary',
            'wrapper' => true,
        ),
        array(
            'title' => 'Font - Heading Tertiary - Upper',
            'block' => 'div',
            'classes' => 'heading-tertiary-upper',
            'wrapper' => true,
        ),
        array(
            'title' => 'Font - Heading Tertiary',
            'block' => 'div',
            'classes' => 'heading-tertiary',
            'wrapper' => true,
        ),
    );
 
    $settings['style_formats'] = json_encode( $style_formats );
 
    return $settings;
    
}

// WYSIWYG Primary Color Options
function get_primary_colors() {
  $colors = array(
    'ff0000' => 'Red',
    '00ff00' => 'Green',
    '0000ff' => 'Blue',
  );
  $temp = array();
  foreach($colors as $k => $v) {
    $temp[] = '"'.$k.'", '.'"'.$v.'"';
  }
  return join(', ', $temp);
}