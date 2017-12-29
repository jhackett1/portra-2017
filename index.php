<?php get_header(); ?>

<?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
<article class="diary-entry">
  <h5><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?></h5>
  <h1><?php the_title(); ?></h1>
  <?php the_excerpt(); ?>
  <a href="<?php the_permalink(); ?>" class="button outline">Keep reading</a>
</article>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
