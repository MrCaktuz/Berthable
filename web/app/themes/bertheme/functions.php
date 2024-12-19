<?php

define("BT_THEME_DIR_URI", get_template_directory_uri());
define("BT_THEME_DIR", get_template_directory());
define("BT_INCLUDES_DIR", get_template_directory() . "/includes");

class Bertheme {

  private static $instance = null;

  private function __construct() {
    include BT_INCLUDES_DIR . "/menuAdmin.php";
    // Hide admin tool bar on website.
    add_filter("show_admin_bar", "__return_false");
    // Link our custom stylesheet.
    add_action("wp_enqueue_scripts", [$this, "enqueue_styles"]);
  }

  public function enqueue_styles() {
    wp_enqueue_style("Bertheme", get_stylesheet_uri());
  }

  public static function get_instance() {
    if (null == self::$instance) {
      self::$instance = new self;
    }
    return self::$instance;
  }

}

Bertheme::get_instance();