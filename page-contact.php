<?php
/* Template Name: Contact */
get_header(); ?>
<?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
<article class="contact diary-entry">
  <main>
    <h1 class="title"><?php the_title(); ?></h1>
    <?php the_content(); ?>
  </main>

</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
