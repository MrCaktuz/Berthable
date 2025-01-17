<?php

function custom_recipe_meta_box()
{
  add_meta_box(
    'recipe_meta_box', // Unique ID
    'Informations complémentaires', // Box Title
    'render_recipe_meta_box', // Callback Function
    'post', // Post Type
    'advanced', // Context
    'high' // Priority
  );
}
add_action('add_meta_boxes', 'custom_recipe_meta_box');

function render_recipe_meta_box($post)
{
  // Retrieve existing values
  $duration = get_post_meta($post->ID, '_recipe_duration', true);
  $portion = get_post_meta($post->ID, '_recipe_portion', true);
  $ingredients = get_post_meta($post->ID, '_ingredients', true) ?: [];
  wp_nonce_field('save_ingredients', 'ingredients_nonce');
  ?>
    <div class="recipeInfo">
      <div class="recipeInfo__section">
        <h3 class="recipeInfo__title">Préparation</h3>
        <div class="recipeInfo__row">
          <fieldset class="recipeInfo__fieldset">
              <label class="recipeInfo__label" for="recipe_duration">Temps de préparation</label>
              <input type="text" id="recipe_duration" name="recipe_duration" value="<?php echo esc_attr(
                $duration
              ); ?>" />
          </fieldset>
          <fieldset class="recipeInfo__fieldset">
              <label class="recipeInfo__label" for="recipe_portion">Portion (nbr de personnes)</label>
              <input type="number" id="recipe_portion" name="recipe_portion" value="<?php echo esc_attr(
                $portion
              ); ?>" min="1" />
          </fieldset>
        </div>
      </div>
      <div class="recipeInfo__section">
        <h3 class="recipeInfo__title">Ingredients</h3>
        <div id="ingredientList">
          <?php foreach ($ingredients as $index => $ingredient): ?>
          <div class="recipeInfo__ingredientFields">
            <div class="recipeInfo__row--ingredientName">
              <fieldset class="recipeInfo__fieldset">
                <label class="recipeInfo__label" for="ingredients[<?php echo $index; ?>][name]">Nom</label>
                <input
                  type="text"
                  id="ingredients[<?php echo $index; ?>][name]"
                  name="ingredients[<?php echo $index; ?>][name]"
                  value="<?php echo esc_attr($ingredient['name']); ?>">
              </fieldset>
              <button class="recipeInfo__deleteBtn" type="button">Supprimer</button>
            </div>
            <div class="recipeInfo__row">
              <fieldset class="recipeInfo__fieldset">
                <label class="recipeInfo__label" for="ingredients[<?php echo $index; ?>][quantity]">Quantité</label>
                <input
                  type="number"
                  id="ingredients[<?php echo $index; ?>][quantity]"
                  name="ingredients[<?php echo $index; ?>][quantity]"
                  step="0.01"
                  value="<?php echo esc_attr($ingredient['quantity']); ?>">
              </fieldset>
              
              <fieldset class="recipeInfo__fieldset">
                <label class="recipeInfo__label" for="ingredients[<?php echo $index; ?>][unit]">Unité</label>
                <input
                  type="text"
                  id="ingredients[<?php echo $index; ?>][unit]"
                  name="ingredients[<?php echo $index; ?>][unit]"
                  value="<?php echo esc_attr($ingredient['unit']); ?>">
              </fieldset>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <button type="button" class="button button-primary button-large" id="ingredientAddBtn">Ajouter un ingrédient</button>
      </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ingredientList = document.getElementById('ingredientList');
            const addButton = document.getElementById('ingredientAddBtn');

            addButton.addEventListener('click', function () {
                const index = ingredientList.children.length;
                const group = document.createElement('div');
                group.classList.add('recipeInfo__ingredientFields');
                group.innerHTML = `
                  <div class="recipeInfo__row--ingredientName">
                    <fieldset class="recipeInfo__fieldset">
                      <label class="recipeInfo__label" for="ingredients[${index}][name]">Nom</label>
                      <input
                        type="text"
                        id="ingredients[${index}][name]"
                        name="ingredients[${index}][name]">
                    </fieldset>
                    <button class="recipeInfo__deleteBtn" type="button">Supprimer</button>
                  </div>
                  <div class="recipeInfo__row">
                    <fieldset class="recipeInfo__fieldset">
                      <label class="recipeInfo__label" for="ingredients[${index}][quantity]">Quantité</label>
                      <input
                        type="number"
                        id="ingredients[${index}][quantity]"
                        step="0.01"
                        name="ingredients[${index}][quantity]">
                    </fieldset>
                    
                    <fieldset class="recipeInfo__fieldset">
                      <label class="recipeInfo__label" for="ingredients[${index}][unit]">Unité</label>
                      <input
                        type="text"
                        id="ingredients[${index}][unit]"
                        name="ingredients[${index}][unit]">
                    </fieldset>
                  </div>
                `;
                ingredientList.appendChild(group);
            });

            ingredientList.addEventListener('click', function (e) {
                if (e.target.classList.contains('recipeInfo__deleteBtn')) {
                    e.target.closest('.recipeInfo__ingredientFields').remove();
                }
            });
        });
    </script>
    <?php
}

function save_recipe_meta_box($post_id)
{
  // Check for autosave or user capability
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Save recipe duration
  if (array_key_exists('recipe_duration', $_POST)) {
    update_post_meta($post_id, '_recipe_duration', $_POST['recipe_duration']);
  }

  // Save recipe portion
  if (array_key_exists('recipe_portion', $_POST)) {
    update_post_meta(
      $post_id,
      '_recipe_portion',
      intval($_POST['recipe_portion'])
    );
  }

  // Check nonce
  if (
    !isset($_POST['ingredients_nonce']) ||
    !wp_verify_nonce($_POST['ingredients_nonce'], 'save_ingredients')
  ) {
    return;
  }

  // Save ingredients
  if (isset($_POST['ingredients']) && is_array($_POST['ingredients'])) {
    $sanitized_ingredients = array_map(function ($ingredient) {
      return [
        'name' => sanitize_text_field($ingredient['name']),
        'quantity' => intval($ingredient['quantity']),
        'unit' => sanitize_text_field($ingredient['unit']),
      ];
    }, $_POST['ingredients']);

    update_post_meta($post_id, '_ingredients', $sanitized_ingredients);
  } else {
    delete_post_meta($post_id, '_ingredients');
  }
}
add_action('save_post', 'save_recipe_meta_box');
