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
            'classes' => 'cta-wrapper',
            'wrapper' => true,
        ),
        array(
            'title' => 'Accordion List for Desc. (use H4 as Title and indented li as Desc.)',
            'selector' => 'ul, ol',
            'classes' => 'wysiwyg-accordion-list',
        ),
        array(
            'title' => 'Accordion List for Bullets (use H4 as Title and indented li as Bullets)',
            'selector' => 'ul, ol',
            'classes' => 'wysiwyg-accordion-list-with-bullets',
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