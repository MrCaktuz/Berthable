<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <?php if (have_posts()): ?>
      <ul class="card__list">
          <?php while (have_posts()):

            the_post();
            $duration = get_post_meta(get_the_ID(), '_recipe_duration', true);
            ?>
              <a class="card" href="<?php the_permalink(); ?>" >
                <h2 class="card__title"><?php the_title(); ?></h2>
                <div class="card__content">
                  <p class="card__info"></p>
                  <img class="card__img" src="<?php echo get_the_post_thumbnail_url(); ?>" />
                  <p class="card__info <?php if ($duration) {
                    echo 'timer';
                  } ?>">
                    <?php echo $duration; ?>
                  </p>
                </div>
              </a>
          <?php
          endwhile; ?>
      </ul>
  <?php else: ?>
      <div class="card__list--empty">
        <p class="card__list--emptyMessage">Aucune recette ne correspond à tes critères de recherche...</p>
        <a class="btn" href="/?s=">Voir toutes nos recettes</a>
      </div>
  <?php endif; ?>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
