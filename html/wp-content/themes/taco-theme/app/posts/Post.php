<?php

class Post extends \Taco\Post {

  public function getFields() {
    return array();
  }

  public function getSingular() {
    return 'Post';
  }

  public function getPlural() {
    return 'Posts';
  }
  
  public function getDefaultOrderBy() {
    return 'post_date';
  }

  public function getDefaultOrder() {
    return 'DESC';
  }
  
  public function getTaxonomies() {
    return array(
      'category'
    );
  }
  
  public function getPostFeaturedImage($post) {
    $post_image_bool = has_post_thumbnail($post->ID);
    $post_image_url = "";
    if($post_image_bool) {
        $post_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        $post_image_url = $post_image_url[0];
    }
    return $post_image_url;
  }
  
  /**
   * Get all the categories
   * @return array
   */
  public static function getAllCategories() {
    return get_terms('category');
  }

  // Hide extra option from left nav in admin UI
  public function getPostTypeConfig() {
    return null;
  }
  
}