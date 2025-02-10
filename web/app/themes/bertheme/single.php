<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <div class="recipe">
    <h1 class="recipe__title">
      <?php the_title(); ?>
    </h1>
    <div class="recipe__categories">
      <?php
      $categories = get_the_category();
      foreach ($categories as $category): ?>
        <a class="btn btn--light btn--combined btn--xs" href="/?s=&category[]=<?php echo $category->cat_ID; ?>">
          <?php echo esc_html($category->name); ?>
        </a>
      <?php endforeach;
      ?>
    </div>

    <div class="recipe__section recipe__section--split">
      <div class="recipe__imgContainer">
        <?php if (is_post_vege(get_the_ID())): ?>
          <div class="recipe__info recipe__info--vege">
            <i class="icon icon--vege icon--2 icon--secondary"></i>
          </div>
        <?php else: ?>
          <div></div>
        <?php endif; ?>
        <?php
        $duration = get_post_meta(get_the_ID(), '_recipe_duration', true);
        if ($duration): ?>
          <div class="recipe__info recipe__info--duration">
            <?php echo $duration; ?>
            <i class="icon icon--timer icon--2 icon--primary"></i>
          </div>
        <?php else: ?>
          <div></div>
        <?php endif;
        ?>
        <div class="recipe__info recipe__info--author">
          <i class="icon icon--author icon--2 icon--primary"></i>
          <?php echo get_the_author_meta(
            'display_name',
            get_post(get_the_ID())->post_author
          ); ?>
        </div>
        <?php if (get_the_post_thumbnail_url()) {
          $thumbnail = get_the_post_thumbnail_url();
        } else {
          $thumbnail =
            get_template_directory_uri() . '/assets/img/default-recipe.jpeg';
        } ?>
        <img class="recipe__img" src="<?php echo $thumbnail; ?>" />
      </div>
      <?php
      $ingredients = get_post_meta(get_the_ID(), '_ingredients', true);
      if ($ingredients): ?>
        <div class="recipe__ingredients">
          <h2 class="recipe__subtitle">
            Ingrédients
          </h2>
          <?php
          $portion = get_post_meta(get_the_ID(), '_recipe_portion', true);
          if ($portion): ?>
            <div class="recipe__portionContainer">
              <button class="btn btn--combined btn--s btn--portion" id="btnLessPortion">
                <i class="btn__icon icon--lessPortion"></i>
                <span class="srOnly">Moins de portions</span>
              </button>
              <p class="recipe__portion">
                <span data-base="<?php echo $portion; ?>" id="portionValue"><?php echo $portion; ?></span>
                <span> portions</span>
              </p>
              <button class="btn btn--combined btn--s btn--portion" id="btnMorePortion">
                <i class="btn__icon icon--morePortion"></i>
                <span class="srOnly">Plus de portions</span>
              </button>
            </div>
          <?php endif;
          ?>
          <ul class="recipe__ingredientList">
            <?php foreach ($ingredients as $ingredient): ?>
              <li class="recipe__ingredient">
                <p>
                  <strong>
                    <?php echo esc_html($ingredient['name']); ?> 
                  </strong>
                  <?php if ($ingredient['quantity']): ?>
                    <strong> : </strong>
                    <span class="recipe__quantity" data-base="<?php echo esc_html(
                      $ingredient['quantity']
                    ); ?>">
                      <?php echo esc_html($ingredient['quantity']); ?>
                    </span>
                    <span class="recipe__unit">
                      <?php echo esc_html($ingredient['unit']); ?>
                    </span>
                  <?php endif; ?>
                </p>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif;
      ?>
    </div>
    <div class="recipe__section">
      <div>
        <h2 class="recipe__subtitle">Préparation</h2>
        <div class="recipe__description">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
