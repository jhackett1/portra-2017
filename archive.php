<?php
  get_header();
  wp_enqueue_script('masonry', get_template_directory_uri() . '/js/masonry.js');
?>

<article class="portfolio">
  <h1><?php single_cat_title(); ?></h1>
  <ul class="portfolio-grid">
    <li class="grid-sizer"></li>
  <?php
    if (have_posts()) {
      $i = 0;
      while(have_posts()){
        the_post(); ?>
        <li class="portfolio-item">
          <img class="wow" src=<?php echo wp_get_attachment_image_src($post->ID, 'large')[0];?> />
          <a onclick="return loadNewLightbox('<?php echo wp_get_attachment_image_src($post->ID, 'large')[0];?>', <?php echo $i; ?>, '<?php echo wp_get_attachment_caption($post->ID); ?>')" href="<?php echo get_attachment_link($post->ID); ?>" class="cover"></a>
        </li>
        <?php
        $i++;
      }

    }
  ?>
  </ul>

  <ul class="pagination">
    <li class="previous"><?php echo get_previous_posts_link('Newer work'); ?></li>
    <li class="next"><?php echo get_next_posts_link('Older work'); ?></li>
  </ul>

</article>

<script>
document.addEventListener('DOMContentLoaded', function(){

  var grid = document.querySelector('ul.portfolio-grid');
  var masonry = new Masonry( grid, {
    // options
    itemSelector: 'li.portfolio-item',
    columnWidth: '.grid-sizer',
    percentPosition: true
  });
});
</script>

<?php get_footer(); ?>
