<?php

class BT_Menu
{
  private static $instance = null;

  private function __construct()
  {
    function rename_post_labels()
    {
      global $wp_post_types;
      // Ensure 'post' is registered
      if (isset($wp_post_types['post'])) {
        $labels = &$wp_post_types['post']->labels;

        // Change the labels
        $labels->name = 'Recettes';
        $labels->singular_name = 'Recette';
        $labels->menu_name = 'Recettes';
        $labels->name_admin_bar = 'Recette';
        $labels->view_items = 'Voir les recettes';
        $labels->add_new = 'Ajouter une recette';
        $labels->add_new_item = 'Ajouter une recette';
        $labels->edit_item = 'Modifier la recette';
        $labels->new_item = 'Nouvelle recette';
        $labels->view_item = 'Voir la recette';
        $labels->search_items = 'Rechercher des recettes';
        $labels->not_found = 'Aucune recette trouvée';
        $labels->not_found_in_trash =
          'Aucune recette trouvée dans la corbeille';
        $labels->all_items = 'Toutes les recettes';
        $labels->archives = 'Archives des recettes';
        $labels->insert_into_item = 'Insérer dans une recette';
        $labels->uploaded_to_this_item = 'Téléversé dans cette recette';
        $labels->featured_image = 'Image mise en avant de la recette';
        $labels->set_featured_image = 'Définir une image mise en avant';
        $labels->remove_featured_image = 'Supprimer l’image mise en avant';
        $labels->use_featured_image = 'Utiliser comme image mise en avant';
      }
    }
    add_action('init', 'rename_post_labels');

    function remove_comments_menu_page()
    {
      remove_menu_page('edit-comments.php');
      remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
    }

    add_action('admin_menu', 'remove_comments_menu_page');
  }

  public static function get_instance()
  {
    if (null == self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}

BT_Menu::get_instance();
