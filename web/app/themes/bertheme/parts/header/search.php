<section class="searchSection">
  <h3 class="srOnly">Formulaire de recherche</h3>
  <input class="searchSection__input" type="text" tabindex="-1" placeholder="Ingrédient" name="s" id="searchInput" value="<?php the_search_query(); ?>">
  <button class="btn--icon searchSection__submit" tabindex="-1" type="submit">
    <i class="btn__icon icon--search icon--lightest"></i>
    <span class="srOnly">Recherche</span>
  </button>
</section>