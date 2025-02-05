<section class="filters">
  <div class="filters__wrapper">
    <div class="filters__content">
      <div class="filters__allRecipes container">
        <?php include BT_THEME_DIR . '/parts/btnAllRecipes.php'; ?>
      </div>
      <h2 class="srOnly">Filtres disponibles</h2>
      <div class="container">
        <form class="filters__form" role="search" method="get" id="filterForm" action="<?php echo home_url(
          '/'
        ); ?>">
          <?php include BT_THEME_DIR . '/parts/header/searchForm.php'; ?>
    
          <section class="filters__section">
            <h3 class="filters__title">Catégories</h3>
            <div class="filters__group">
              <?php
              // Récupérer les catégories
              $categories = get_categories(['hide_empty' => true]);
              foreach ($categories as $category): ?>
                <label class="checkbox">
                  <div class="checkbox__icons">
                    <i class="checkbox__icon icon--unchecked icon--primary"></i>
                    <i class="checkbox__icon icon--checked icon--secondary"></i>
                  </div>
                  <input class="checkbox__input" type="checkbox" name="category[]" value="<?php echo $category->term_id; ?>"
                  <?php if (
                    isset($_GET['category']) &&
                    in_array($category->term_id, $_GET['category'])
                  ) {
                    echo 'checked';
                  } ?>>
                  <?php echo esc_html($category->name); ?>
                </label>
              <?php endforeach;
              ?>
            </div>
          </section>

          <section class="filters__section">
            <h3 class="filters__title">Auteurs</h3>
            <div class="filters__group">
              <?php
              $authors = get_users_with_posts();
              foreach ($authors as $author): ?>
                <label class="checkbox">
                  <div class="checkbox__icons">
                    <i class="checkbox__icon icon--unchecked icon--primary"></i>
                    <i class="checkbox__icon icon--checked icon--secondary"></i>
                  </div>
                  <input class="checkbox__input"  type="checkbox" name="author[]" value="<?php echo $author->ID; ?>"
                  <?php if (
                    isset($_GET['author']) &&
                    in_array($author->ID, $_GET['author'])
                  ) {
                    echo 'checked';
                  } ?>>
                  <?php echo esc_html($author->display_name); ?>
                </label>
              <?php endforeach;
              ?>
            </div>
          </section>

          <div class="filters__footer" >
            <a class="btn" href="/?s=">Réinitialiser</a>
            <button class="btn" type="submit">Appliquer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>