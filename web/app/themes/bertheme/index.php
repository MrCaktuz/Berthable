<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <?php
  $selectedCategories = ['plats-principaux', 'vege', 'desserts'];
  foreach ($selectedCategories as $categorySlug):
    $category = get_category_by_slug($categorySlug); ?>
    <?php
    $recipes = new WP_Query([
      'post_type' => 'post',
      'posts_per_page' => 5,
      'category_name' => $categorySlug,
    ]);
    if ($recipes->have_posts()): ?>
      <section class="section">
        <h2 class="section__title">Les derniers <?php echo $category->name; ?></h2>
        <div class="card__list">
          <?php while ($recipes->have_posts()) {
            $recipes->the_post();
            $vege = is_post_vege(get_the_ID());
            $duration = get_post_meta(get_the_ID(), '_recipe_duration', true);
            include BT_THEME_DIR . '/parts/card.php';
          } ?>
          <a class="card" href="/?s=&category[]=<?php echo $category->term_id; ?>" >
            <div class="card__illu">
              <img class="card__img" src="<?php echo get_template_directory_uri() .
                '/assets/img/more-recipes.jpeg'; ?>" />
            </div>
            <h2 class="card__title">Voir tous les <?php echo $category->name; ?></h2>
          </a>
        </div>
      </section>
    <?php endif;
    ?>
  <?php
  endforeach;
  ?>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
