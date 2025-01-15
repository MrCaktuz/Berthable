<section class="filters">
  <div class="filters__wrapper">
    <div class="filters__content">
      <h2 class="srOnly">Filtres disponibles</h2>
      <div class="container">
        <form class="filterForm" role="search" method="get" id="filterForm" action="<?php echo home_url(
          '/'
        ); ?>">
          <?php include BT_THEME_DIR . '/parts/header/search.php'; ?>
    
          <!-- <?php
          $categories = get_categories();
          if ($categories): ?>
            <section class="filters__section">
              <h3>Catégories</h3>
              <ul class="">
                <li class="">
                  
                  <a class="" href="./">
                    Toutes
                  </a>
                </li>
                <?php foreach ($categories as $category): ?>
                  <li class="">
                    <a class="" href="./?cat=<?php echo esc_attr(
                      $category->term_id
                    ); ?>">
                      <?php echo esc_html($category->name); ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </section>
          <?php endif;
          ?> -->
        </form>
      </div>
    </div>
  </div>
</section>