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
        <div class="recipe__infoContainer">
          <?php if (is_post_vege(get_the_ID())): ?>
            <div class="recipe__info recipe__vege">
              <i class="icon icon--vege icon--secondary"></i>
            </div>
          <?php else: ?>
            <div></div>
          <?php endif; ?>
          <?php
          $duration = get_post_meta(get_the_ID(), '_recipe_duration', true);
          if ($duration): ?>
            <div class="recipe__info recipe__duration">
              <?php echo $duration; ?>
              <i class="icon icon--timer icon--2 icon--primary"></i>
            </div>
          <?php else: ?>
            <div></div>
          <?php endif;
          ?>
        </div>
        <img class="recipe__img" src="<?php echo get_the_post_thumbnail_url(); ?>" />
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
              <button class="btn btn--light btn--combined btn--s btn--portion" id="btnLessPortion">
                <i class="btn__icon icon--lessPortion icon--darkest"></i>
                <span class="srOnly">Moins de portions</span>
              </button>
              <p class="recipe__portion">
                <span data-base="<?php echo $portion; ?>" id="portionValue"><?php echo $portion; ?></span>
                <span> portions</span>
              </p>
              <button class="btn btn--light btn--combined btn--s btn--portion" id="btnMorePortion">
                <i class="btn__icon icon--morePortion icon--darkest"></i>
                <span class="srOnly">Plus de portions</span>
              </button>
            </div>
          <?php endif;
          ?>
          <ul>
            <?php foreach ($ingredients as $ingredient): ?>
              <li class="recipe__ingredient">
                <p>
                  <strong>
                    <?php echo esc_html($ingredient['name']); ?> : 
                  </strong>
                  <span class="recipe__quantity" data-base="<?php echo esc_html(
                    $ingredient['quantity']
                  ); ?>">
                    <?php echo esc_html($ingredient['quantity']); ?>
                  </span>
                  <span class="recipe__unit">
                    <?php echo esc_html($ingredient['unit']); ?>
                  </span>
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
        <div class="recipe__description"><?php the_content(); ?></div>
      </div>
    </div>
  </div>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
