<?php get_header(); ?>
<?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
<article>
  <h5><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?></h5>
  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>
</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
