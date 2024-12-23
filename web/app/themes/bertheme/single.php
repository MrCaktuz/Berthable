<?php include BT_THEME_DIR . '/header.php'; ?>

<main class="page container">
  <div class="reciepe">
    <h1><?php the_title(); ?></h1>
    
    <div class="reciepe__categories">
      <?php
      $reciepe_categories = get_the_category();
      foreach ($reciepe_categories as $category): ?>
          <P>
            <a href="<?php echo esc_url(
              get_category_link($category->term_id)
            ); ?>">
              <?php echo esc_html($category->name); ?>
            </a>
          </P>
      <?php endforeach;
      ?>
    </div>
    <div class="reciepe__description"><?php the_content(); ?></div>
  </div>
</main>

<?php include BT_THEME_DIR . '/footer.php'; ?>
