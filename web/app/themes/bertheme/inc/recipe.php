<?php

class BT_Recipe
{
  private static $instance = null;

  private function __construct()
  {
    // Enable Featured Image support
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(800, 800, 'center');

    // Add ingreadiants repeatable fields
    include BT_INC_DIR . '/fields/ingredients.php';
  }

  public static function get_instance()
  {
    if (null == self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}

BT_Recipe::get_instance();
