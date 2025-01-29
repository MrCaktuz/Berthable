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

function prevent_publish_without_featured_image($post_id, $post, $update)
{
  // Vérifier si l'action est un enregistrement ou une mise à jour d'un post
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Vérifier que l'utilisateur a les permissions nécessaires
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Ne pas appliquer aux révisions ou aux autres types que "post"
  if ($post->post_type !== 'post' || wp_is_post_revision($post_id)) {
    return;
  }

  // Si le post est "Publié" et qu'il n'a pas d'image mise en avant
  if ($post->post_status === 'publish' && !has_post_thumbnail($post_id)) {
    // Renvoyer le statut du post à "Brouillon"
    wp_update_post([
      'ID' => $post_id,
      'post_status' => 'draft',
    ]);

    // Afficher un message d'erreur à l'utilisateur
    add_filter('redirect_post_location', function ($location) {
      return add_query_arg('no_featured_image', 'true', $location);
    });
  }
}
add_action('save_post', 'prevent_publish_without_featured_image', 10, 3);

function notify_missing_featured_image()
{
  if (
    !empty($_GET['no_featured_image']) &&
    $_GET['no_featured_image'] === 'true'
  ) {
    echo '<div class="notice notice-error is-dismissible">
            <p><strong>Erreur :</strong> Vous devez ajouter une image mise en avant avant de publier ce post.</p>
        </div>';
  }
}

add_action('admin_notices', 'notify_missing_featured_image');
