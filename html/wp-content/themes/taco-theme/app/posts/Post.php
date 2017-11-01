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