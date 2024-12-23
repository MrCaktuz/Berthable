<?php

define('BT_THEME_DIR_URI', get_template_directory_uri());
define('BT_THEME_DIR', get_template_directory());
define('BT_INC_DIR', get_template_directory() . '/inc');

class Bertheme
{
  private static $instance = null;

  private function __construct()
  {
    include BT_INC_DIR . '/menuAdmin.php';
    include BT_INC_DIR . '/recipe.php';

    // Hide admin tool bar on website.
    add_filter('show_admin_bar', '__return_false');
    // Link our custom scripts & styles.
    add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
  }

  public function enqueue_scripts()
  {
    // Styles
    wp_enqueue_style('BerthemeStyles', get_stylesheet_uri());
    // Scripts
    wp_enqueue_script(
      'BerthemeScript',
      get_template_directory_uri() . '/assets/js/script.js'
    );
    // Add `type="module"` to the script tag
    add_filter(
      'script_loader_tag',
      function ($tag, $handle, $src) {
        if ($handle === 'BerthemeScript') {
          $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
      },
      10,
      3
    );
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
