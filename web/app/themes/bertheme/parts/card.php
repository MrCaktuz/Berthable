<a class="card" href="<?php the_permalink(); ?>" >
  <div class="card__group">
    <div class="card__illu">
      <?php if (get_the_post_thumbnail_url()) {
        $thumbnail = get_the_post_thumbnail_url();
      } else {
        $thumbnail =
          get_template_directory_uri() . '/assets/img/default-recipe.jpeg';
      } ?>
      <img class="card__img" src="<?php echo $thumbnail; ?>" />
    </div>
    <div class="card__content">
      <p class="card__info card__info--start">
        <?php if ($vege): ?>
          <i class="icon icon--vege icon--2 icon--secondary"></i>
          Végé
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