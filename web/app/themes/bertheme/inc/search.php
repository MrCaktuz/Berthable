<?php

function custom_search_query($query)
{
  if (!is_admin() && $query->is_search && $query->is_main_query()) {
    $query->set('post_type', 'post'); // Search only in posts
    $query->set('search', get_search_query()); // Ensure the query uses the search term
  }
}

add_action('pre_get_posts', 'custom_search_query');
