<?php get_header(); ?>
<?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
<article class="diary-entry">
  <h1 class="title"><?php the_title(); ?></h1>
  <?php the_content(); ?>
</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
