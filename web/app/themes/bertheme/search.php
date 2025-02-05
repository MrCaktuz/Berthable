<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <?php if (have_posts()): ?>
      <ul class="card__list">
          <?php while (have_posts()) {
            the_post();
            $vege = is_post_vege(get_the_ID());
            $duration = get_post_meta(get_the_ID(), '_recipe_duration', true);
            include BT_THEME_DIR . '/parts/card.php';
          } ?>
      </ul>
  <?php else: ?>
      <div class="card__list--empty">
        <p class="card__list--emptyMessage">Aucune recette ne correspond à tes critères de recherche...</p>
        <a class="btn" href="/?s=">Voir toutes nos recettes</a>
      </div>
  <?php endif; ?>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
