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

  // Hide extra option from left nav in admin UI
  public function getPostTypeConfig() {
    return null;
  }
  
}