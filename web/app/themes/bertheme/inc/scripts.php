<?php

function enqueue_scripts()
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

function enqueue_admin_styles()
{
  wp_enqueue_style(
    'BerthemeAdminStyles',
    get_stylesheet_directory_uri() . '/style-admin.css'
  );
}

// Link our custom admin styles.
add_action('admin_enqueue_scripts', 'enqueue_admin_styles');
// Link our custom scripts & styles.
add_action('wp_enqueue_scripts', 'enqueue_scripts');
