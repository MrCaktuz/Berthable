<?php
/**
 * Template Name: Recipies
 * Description: A custom template for the list of recipies.
 *
 * @package Bertheme
 */
?>

<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <h1 class="page__title"><?php the_title(); ?></h1>
  <div class="page__intro"><?php the_content(); ?></div>
  <div class="archive-posts">
    <?php while (get_posts()):
      the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-excerpt"><?php the_excerpt(); ?></div>
      </article>
    <?php
    endwhile; ?>
  </div>
  <?php the_posts_pagination(); ?>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
