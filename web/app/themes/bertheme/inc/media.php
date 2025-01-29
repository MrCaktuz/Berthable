<?php

function custom_square_crop_image($metadata, $attachment_id)
{
  // Get file path
  $upload_dir = wp_upload_dir();
  $file_path = $upload_dir['basedir'] . '/' . $metadata['file'];

  // Initialize WP Image Editor
  $image = wp_get_image_editor($file_path);
  if (is_wp_error($image)) {
    return $metadata; // Exit if image editor failed
  }

  // Get original dimensions
  $size = $image->get_size();
  $width = $size['width'];
  $height = $size['height'];

  // Define the square size
  $square_size = min($width, $height);
  $x = ($width - $square_size) / 2;
  $y = ($height - $square_size) / 2;

  // Crop the image to a square
  $image->crop($x, $y, $square_size, $square_size, $square_size, $square_size);

  // Generate a new filename for the square image
  $cropped_path = $image->generate_filename('square');

  // Save the cropped image
  $saved = $image->save($cropped_path);
  if (is_wp_error($saved)) {
    return $metadata; // Exit if saving failed
  }

  // Get the relative path of the new image
  $relative_cropped_path = str_replace(
    $upload_dir['basedir'] . '/',
    '',
    $cropped_path
  );

  // Attach the cropped image to metadata
  $metadata['sizes']['custom_square'] = [
    'file' => wp_basename($relative_cropped_path),
    'width' => $square_size,
    'height' => $square_size,
    'mime-type' => mime_content_type($cropped_path),
  ];

  return $metadata;
}
add_filter(
  'wp_generate_attachment_metadata',
  'custom_square_crop_image',
  10,
  2
);
