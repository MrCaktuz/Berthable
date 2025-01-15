<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <div class="recipe">
    <h1><?php the_title(); ?></h1>
    
    <div class="recipe__categories">
      <?php
      $recipe_categories = get_the_category();
      foreach ($recipe_categories as $category): ?>
          <p>
            <a href="<?php echo esc_url(
              get_category_link($category->term_id)
            ); ?>">
              <?php echo esc_html($category->name); ?>
            </a>
          </p>
      <?php endforeach;
      ?>
    </div>

    <?php
    $ingredients = get_post_meta(get_the_ID(), '_ingredients', true);
    if ($ingredients): ?>
        <h3>Ingredients</h3><ul>
        </ul>
          <?php foreach ($ingredients as $ingredient): ?>
            <li>
              <?php echo esc_html(
                $ingredient['quantity']
              ); ?> <?php echo esc_html(
   $ingredient['unit']
 ); ?> of <?php echo esc_html($ingredient['name']); ?>
            </li>
          <?php endforeach; ?>
        </ul>
    <?php endif;
    ?>

    <div class="recipe__illustration">
      <img class="recipe__image" src="<?php echo get_the_post_thumbnail_url(); ?>" />
    </div>
    <div class="recipe__description"><?php the_content(); ?></div>
  </div>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
