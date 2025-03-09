<?php

function add_category_creation_capability_to_author()
{
  $authorRole = get_role('author');

  if ($authorRole) {
    $authorRole->add_cap('manage_categories');
  }
}

add_action('init', 'add_category_creation_capability_to_author');

function notify_admin_on_author_post_publish($post_ID, $post)
{
  // Vérifier si l'auteur est de rôle "Author"
  $author = get_userdata($post->post_author);
  if (in_array('author', $author->roles)) {
    // Définir les destinataires (Admin)
    $admin_email = get_option('admin_email');

    // Sujet de l'email
    $subject = 'Un nouvel article a été publié';

    // Contenu du message
    $message =
      "L'auteur " .
      $author->display_name .
      ' vient de publier un nouvel article : ' .
      get_the_title($post_ID) .
      "\n\n";
    $message .= 'Lien : ' . get_permalink($post_ID) . "\n\n";
    $message .= "Connectez-vous à l'admin pour le vérifier.";

    // Headers
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    // Envoyer l'email
    wp_mail($admin_email, $subject, $message, $headers);
  }
}
add_action('publish_post', 'notify_admin_on_author_post_publish', 10, 2);
