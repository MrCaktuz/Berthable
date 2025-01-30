<?php

define('BT_THEME_DIR_URI', get_template_directory_uri());
define('BT_THEME_DIR', get_template_directory());
define('BT_INC_DIR', get_template_directory() . '/inc');

class Bertheme
{
  private static $instance = null;

  private function __construct()
  {
    include BT_INC_DIR . '/media.php';
    include BT_INC_DIR . '/menuAdmin.php';
    include BT_INC_DIR . '/recipe.php';
    include BT_INC_DIR . '/roles.php';
    include BT_INC_DIR . '/scripts.php';
    include BT_INC_DIR . '/search.php';
    include BT_INC_DIR . '/wysiwyg.php';

    // Hide admin tool bar on website.
    add_filter('show_admin_bar', '__return_false');
  }

  public static function get_instance()
  {
    if (null == self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}

Bertheme::get_instance();
