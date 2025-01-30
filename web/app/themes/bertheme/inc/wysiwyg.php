<?php

function custom_tiny_mce_settings($init_array)
{
  // Liste des boutons à garder (en supprimant ceux que tu veux enlever)
  $init_array['toolbar1'] =
    'formatselect,bold,italic,underline,bullist,numlist,link';
  return $init_array;
}
add_filter('tiny_mce_before_init', 'custom_tiny_mce_settings');

function custom_tinymce_format_options($init_array)
{
  $style_formats = [
    [
      'title' => 'Titre 1', // On renomme H3 en Titre 1
      'block' => 'h3',
    ],
    [
      'title' => 'Titre 2', // On renomme H4 en Titre 2
      'block' => 'h4',
    ],
    [
      'title' => 'Titre 3', // On renomme H5 en Titre 3
      'block' => 'h5',
    ],
    [
      'title' => 'Titre 4', // On renomme H6 en Titre 4
      'block' => 'h6',
    ],
  ];

  $init_array['style_formats'] = json_encode($style_formats);
  // Supprime les formats de titres non souhaités et "Préformaté"
  $init_array['block_formats'] =
    'Paragraphe=p; Titre 1=h3; Titre 2=h4; Titre 3=h5; Titre 4=h6';

  return $init_array;
}
add_filter('tiny_mce_before_init', 'custom_tinymce_format_options');

function add_link_class_to_content($content)
{
  return preg_replace('/<a(.*?)>/', '<a class="link"$1>', $content);
}
add_filter('the_content', 'add_link_class_to_content');
