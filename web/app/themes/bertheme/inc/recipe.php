<?php

// Enable Featured Image support
add_theme_support('post-thumbnails');
set_post_thumbnail_size(800, 800, 'center');

// Add ingreadiants repeatable fields
include BT_INC_DIR . '/fields/ingredients.php';

add_action('admin_menu', 'hide_unwanted_meta_boxes');

function hide_unwanted_meta_boxes()
{
  // Remove 'Tags' meta box
  remove_meta_box('tagsdiv-post_tag', 'post', 'side');
  // Remove 'Comments' meta box
  remove_meta_box('commentsdiv', 'post', 'side');
}

function is_post_vege($postID)
{
  $categories = get_the_category($postID);
  if (!empty($categories)) {
    foreach ($categories as $category) {
      if ($category->slug === 'vege') {
        return esc_html($category->name);
      }
    }
  }
  return '';
}
