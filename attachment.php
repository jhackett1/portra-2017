<?php get_header(); ?>

<article class="portfolio-detail">
  <img class="portfolio-image" src=<?php echo wp_get_attachment_image_src($post->ID, 'large')[0];?> />
  <p><?php echo wp_get_attachment_caption($post->ID); ?></p>
</article>
<?php get_footer(); ?>
