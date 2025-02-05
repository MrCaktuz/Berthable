<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <title><?php bloginfo('name'); ?> - <?php the_title(); ?></title>
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Megrim&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
  <!-- WP generated heads -->
  <?php wp_head(); ?>
</head>
<body>
  <header class="header">
    <div class="container">
      <div class="header__content">
        <?php include BT_THEME_DIR . '/parts/header/brand.php'; ?>
        <div class="header__nav">
          <?php include BT_THEME_DIR . '/parts/btnAllRecipes.php'; ?>
          <?php include BT_THEME_DIR . '/parts/header/menu.php'; ?>
        </div>
      </div>
    </div>
    <?php include BT_THEME_DIR . '/parts/header/filters.php'; ?>
  </header>
