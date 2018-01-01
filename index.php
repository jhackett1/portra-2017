<?php get_header(); ?>

<?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
<article class="diary-entry">
  <h5 class="date"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?></h5>
  <h1 class="title"><?php the_title(); ?></h1>
  <?php the_excerpt(); ?>
  <a href="<?php the_permalink(); ?>" class="button">Keep reading</a>
</article>
<?php endwhile; endif; ?>
<ul class="pagination">
  <li class="previous"><?php echo get_next_posts_link('Older entries'); ?></li>
  <li class="next"><?php echo get_previous_posts_link('Newer entries'); ?></li>
</ul>

<?php get_footer(); ?>
