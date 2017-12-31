<?php get_header(); ?>
<?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
<article class="diary-entry">
  <h5 class="date"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?></h5>
  <h1 class="title"><?php the_title(); ?></h1>
  <?php the_content(); ?>
</article>
<ul class="pagination portfolio">
  <li class="previous"><?php echo previous_post_link('%link', 'Previous entry'); ?></li>
  <li class="next"><?php echo next_post_link('%link', 'Next entry'); ?></li>
</ul>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
