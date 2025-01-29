<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <?php
  $selectedCategories = ['plat', 'vege', 'dessert'];
  foreach ($selectedCategories as $categorySlug):
    $category = get_category_by_slug($categorySlug); ?>
    <?php
    $latest = new WP_Query([
      'post_type' => 'post',
      'posts_per_page' => 3,
      'category_name' => $categorySlug,
    ]);
    if ($latest->have_posts()): ?>
      <section class="section">
        <h2 class="section__title"><?php echo $category->name; ?></h2>
        <div class="card__list">
          <?php while ($latest->have_posts()):

            $latest->the_post();
            $vege = is_post_vege(get_the_ID());
            $duration = get_post_meta(get_the_ID(), '_recipe_duration', true);
            ?>
            <a class="card" href="<?php the_permalink(); ?>" >
              <h2 class="card__title"><?php the_title(); ?></h2>
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
            </a>
          <?php
          endwhile; ?>
        </div>
      </section>
    <?php endif;
    ?>
  <?php
  endforeach;
  ?>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
