<?php

function add_category_creation_capability_to_author() {
    $authorRole = get_role('author');

    if ($authorRole) {
        $authorRole->add_cap('manage_categories');
    }
}

add_action('init', 'add_category_creation_capability_to_author');