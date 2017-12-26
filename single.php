<?php get_header(); ?>
<header>
  <div class="container">
    <?php
      if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
      }
    ?>
    <i class="fa fa-bars fa-2x"></i>
    <nav><?php wp_nav_menu('main') ?></nav>
  </div>
</header>


<?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
<article class="diary-entry">
  <h5><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?></h5>
  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>
</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
