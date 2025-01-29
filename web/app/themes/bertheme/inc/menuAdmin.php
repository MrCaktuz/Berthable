<?php

class BT_Menu
{
  private static $instance = null;

  private function __construct()
  {
    function change_posts_menu_label()
    {
      global $menu;
      global $submenu;

      // Change the "Posts" menu label
      $menu[5][0] = 'Recettes'; // Index 5 corresponds to the Posts menu
      $menu[5][6] = 'dashicons-media-document'; // Index 5 corresponds to the Posts menu

      // Change the submenu labels
      $submenu['edit.php'][5][0] = 'Mes recettes'; // Index 5 corresponds to "All Posts"
      $submenu['edit.php'][10][0] = 'Ajouter une recette'; // Index 10 corresponds to "Add New"
    }
    add_action('admin_menu', 'change_posts_menu_label');

    function remove_comments_menu_page()
    {
      remove_menu_page('edit-comments.php');
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
