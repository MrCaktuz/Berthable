<?php
$recipes = new WP_Query([
  'post_type' => 'post', // Get posts from the 'post' post type
  'posts_per_page' => 10, // Number of posts to display
]); ?>

<?php if (have_posts()): ?>
  <div class="card__list">
    <?php while (have_posts()):
      the_post(); ?>
    <?php $duration = get_post_meta(get_the_ID(), '_recipe_duration', true); ?>
    <a class="card" href="<?php the_permalink(); ?>" >
      <h2 class="card__title"><?php the_title(); ?></h2>
      <div class="card__content">
        <p class="card__info"></p>
        <img class="card__img" src="<?php echo get_the_post_thumbnail_url(); ?>" />
        <p class="card__info <?php if ($duration) {
          echo 'timer';
        } ?>">
          <?php echo $duration; ?>
        </p>
      </div>
    </a>
    <?php
    endwhile; ?>

    <!-- <?php foreach ($posts as $post):
      $duration = get_post_meta($post->ID, '_recipe_duration', true); ?>
      <a class="card" href="<?php the_permalink(); ?>">
        <h2 class="card__title"><?php echo $post->post_title; ?></h2>
        <div class="card__content">
          <p class="card__info"></p>
          <img class="card__img" src="<?php echo get_the_post_thumbnail_url(
            $post
          ); ?>" />
          <p class="card__info <?php if ($duration) {
            echo 'timer';
          } ?>"><?php echo $duration; ?></p>
        </div>
      </a>
    <?php
    endforeach; ?> -->
  </div>
<?php endif; ?>
