<?php
function custom_search_ingredients($query)
{
  if ($query->is_search() && $query->is_main_query() && !is_admin()) {
    // Restreindre la recherche uniquement aux articles (post)
    $query->set('post_type', 'post');
    // Rend le resultat trié de mainière random.
    $query->set('orderby', 'rand');

    // Ajoutez le filtre pour les auteurs si un ou plusieurs auteurs sont sélectionnés
    if (!empty($_GET['author']) && is_array($_GET['author'])) {
      $query->set('author__in', array_map('intval', $_GET['author']));
    }

    // Ajoutez le filtre pour les catégories si elles sont sélectionnées
    if (!empty($_GET['category']) && is_array($_GET['category'])) {
      $query->set('tax_query', [
        [
          'taxonomy' => 'category',
          'field' => 'term_id',
          'terms' => array_map('intval', $_GET['category']),
          'operator' => 'IN',
        ],
      ]);
    }

    // Get the search term
    $search_term = esc_sql($query->query_vars['s']);

    if ($search_term) {
      // Modify the query
      add_filter(
        'posts_where',
        function ($where, $wp_query) use ($search_term) {
          global $wpdb;

          // Search ingredients in post meta
          $where .= $wpdb->prepare(
            " OR EXISTS (
                      SELECT 1
                      FROM {$wpdb->postmeta}
                      WHERE {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id
                      AND {$wpdb->postmeta}.meta_key = '_ingredients'
                      AND {$wpdb->postmeta}.meta_value LIKE %s
                  )",
            '%' . $wpdb->esc_like($search_term) . '%'
          );

          return $where;
        },
        10,
        2
      );
    }
  }
}
add_action('pre_get_posts', 'custom_search_ingredients');

function get_users_with_posts()
{
  global $wpdb;

  // Query the database for user IDs with published posts
  $user_ids = $wpdb->get_col("
        SELECT DISTINCT post_author 
        FROM {$wpdb->posts} 
        WHERE post_status = 'publish'
        AND post_type = 'post'
    ");

  // If no users found, return an empty array
  if (empty($user_ids)) {
    return [];
  }

  // Retrieve user objects based on the IDs
  return get_users([
    'include' => $user_ids, // Include only users with posts
  ]);
}
