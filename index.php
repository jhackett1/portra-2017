<?php get_header(); ?>


<?php
  if (get_theme_mod('portra_logo_image_url')) {
    echo "<img src='" . get_theme_mod('portra_logo_image_url') . "' />";
  }
?>
<h5><?php echo bloginfo('description'); ?></h5>

<?php get_footer(); ?>
