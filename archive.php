<?php
  get_header();
  wp_enqueue_script('imgs', get_template_directory_uri() . '/js/images-loaded.min.js');
  wp_enqueue_script('masonry', get_template_directory_uri() . '/js/masonry.min.js');
  wp_enqueue_script('infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.min.js', false, false, true);
?>

<article class="portfolio">
  <h1><?php single_cat_title(); ?></h1>
  <ul class="portfolio-grid">
    <li class="grid-sizer"></li>
  <?php
    if (have_posts()) {
      ?><noscript style="text-align: center;"><p>You need Javascript enabled to view the portfolio.<br>Consider upgrading your browser to one that supports Javascript.</p></noscript><?php
      $i = 0;
      while(have_posts()){
        the_post(); ?>
        <li class="portfolio-item">
          <img class="wow" src=<?php echo wp_get_attachment_image_src($post->ID, 'large')[0];?> />
          <a onclick="return loadNewLightbox('<?php echo wp_get_attachment_image_src($post->ID, 'large')[0];?>', <?php echo $i; ?>, '<?php echo addslashes(wp_get_attachment_caption($post->ID)); ?>')" href="<?php echo get_attachment_link($post->ID); ?>" class="cover"></a>
        </li>
        <?php
        $i++;
      }
    }
  ?>
  </ul>

  <noscript>
    <ul class="pagination">
      <li class="previous"><?php echo get_next_posts_link('Older work'); ?></li>
      <li class="next"><?php echo get_previous_posts_link('Newer work'); ?></li>
    </ul>
  </noscript>

</article>

<script>
document.addEventListener('DOMContentLoaded', function(){

  // Set up masonry
  var grid = document.querySelector('ul.portfolio-grid');
  var masonry = new Masonry( grid, {
    // options
    itemSelector: 'li.portfolio-item',
    columnWidth: '.grid-sizer',
    percentPosition: true,
    transitionDuration: '0.2s'
  });


  var offset = <?php echo $i; ?>;

  // Trigger a request and display of more images
  function loadMore(){
    var cat = <?php echo $wp_query->get_queried_object_id(); ?>;
    var siteUrl = "<?php echo site_url(); ?>";
    var perPage = <?php echo get_option('posts_per_page')?>;
    var taxonomy = "<?php echo get_theme_mod('portra_portfolio_taxonomy'); ?>";
    requestMoreImages(cat, offset, siteUrl, masonry, perPage, taxonomy, function(itemsAdded){
      // On successful load, run this code
      offset = offset + itemsAdded;
      document.addEventListener('scroll', handleScroll, {passive: true})
    });
  }

  // Listen to scroll events
  document.addEventListener('scroll', handleScroll, {passive: true})

  // Handle scroll events
  function handleScroll(){
    var viewportHeight = document.documentElement.clientHeight;
    var gridDistFromTop = grid.getBoundingClientRect().bottom;
    if (gridDistFromTop < viewportHeight) {
      // Trigger the function
      loadMore();
      // Remove the event listener once it fires
      document.removeEventListener('scroll', handleScroll)
    }
  };


});
</script>
<?php get_footer(); ?>
