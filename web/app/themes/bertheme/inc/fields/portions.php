<?php

class BT_Ingredients
{
  private static $instance = null;

  private function __construct()
  {
    add_filter('rwmb_meta_boxes', function ($meta_boxes) {
      $meta_boxes[] = [
        'title' => 'Ingredients',
        'id' => 'ingredients',
        'post_types' => ['post'], // Change this to your specific post type
        'fields' => [
          [
            'id' => 'ingredients',
            'type' => 'group',
            'clone' => true, // Enables repeater functionality
            'sort_clone' => true, // Allow sorting of items
            'name' => 'Ingredients',
            'fields' => [
              [
                'id' => 'ingredient_name',
                'name' => 'Ingredient Name',
                'type' => 'text',
                'clone' => false,
              ],
              [
                'id' => 'ingredient_quantity',
                'name' => 'Quantity',
                'type' => 'number',
                'step' => '0.1',
                'clone' => false,
              ],
              [
                'id' => 'ingredient_unit',
                'name' => 'Unit',
                'type' => 'text',
                'clone' => false,
              ],
            ],
          ],
        ],
      ];
      return $meta_boxes;
    });
  }

  public static function get_instance()
  {
    if (null == self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}

BT_Ingredients::get_instance();
