<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <?php if (have_posts()): ?>
      <ul class="card__list">
          <?php while (have_posts()):

            the_post();

            $vege = is_post_vege(get_the_ID());
            $duration = get_post_meta(get_the_ID(), '_recipe_duration', true);
            ?>
              <a class="card" href="<?php the_permalink(); ?>" >
                <div class="card__group">
                  <div class="card__illu">
                    <?php if (get_the_post_thumbnail_url()) {
                      $thumbnail = get_the_post_thumbnail_url();
                    } else {
                      $thumbnail =
                        get_template_directory_uri() .
                        '/assets/img/default-recipe.jpeg';
                    } ?>
                    <img class="card__img" src="<?php echo $thumbnail; ?>" />
                  </div>
                  <div class="card__content">
                    <p class="card__info card__info--start">
                      <?php if ($vege): ?>
                        <i class="icon icon--vege icon--2 icon--secondary"></i>
                        <?php echo $vege; ?>
                      <?php endif; ?>
                    </p>
                    <p class="card__info card__info--end">
                      <?php if ($duration): ?>
                        <?php echo $duration; ?>
                        <i class="icon icon--timer icon--2 icon--primary"></i>
                      <?php endif; ?>
                    </p>
                  </div>
                </div>
                <h2 class="card__title"><?php the_title(); ?></h2>
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
