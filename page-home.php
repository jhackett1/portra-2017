<?php get_header();
/* Template Name: Home Page */
?>
<section class="portra-homepage-hero">
  <!-- Logo in here -->
  <?php
    if (get_theme_mod('portra_logo_image_url')) {
      echo "<img class='masthead' src='" . get_theme_mod('portra_logo_image_url') . "' />";
    }

  ?>
    <h5 class="show" id="please-scroll">Please scroll</h5>
</section>

<?php
function homepage_portfolio($cat, $index){
  if (get_theme_mod('portra_homepage_category_'.$index.'_image')) { ?>
    <section class="portra-homepage-split portra-homepage-category">
      <aside class="portra-homepage-category image wow" style="background-image: url(<?php echo get_theme_mod('portra_homepage_category_'.$index.'_image'); ?>)">
        <a href="<?php echo get_term_link(get_term_by('id', $cat, 'media_category')); ?>" class="cover"></a>
      </aside>
      <aside class="portra-homepage-category text">
        <h2><?php echo get_term_by('id', $cat, 'media_category')->name; ?></h2>
        <p><?php echo get_term_by('id', $cat, 'media_category')->description; ?></p>
        <a class="button outline" href="<?php echo get_term_link(get_term_by('id', $cat, 'media_category')); ?>">See all</a>
      </aside>
    </section>
  <?php }
}
homepage_portfolio(get_theme_mod('portra_homepage_category_1'), 1);
homepage_portfolio(get_theme_mod('portra_homepage_category_2'), 2);
?>

<?php
$query = new WP_Query( array(
  'post_type' => 'post',
  'posts_per_page' => 1
  )
);
if ($query->have_posts()) { ?>
  <section class="portra-homepage-split portra-homepage-diary">
  <?php while ($query->have_posts()) {
    $query->the_post(); ?>
    <aside class="portra-homepage-about image wow" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?>)"></aside>
    <aside class="portra-homepage-about text">
      <h2>Diary</h2>
      <h3 class="diary-teaser-headline"><?php the_title(); ?></h3>
      <p class="diary-teaser-excerpt"><?php the_excerpt(); ?></p>
      <a class="button outline" href="<?php the_permalink(); ?>">Read more</a>
    </aside>
  <?php } ?>
  </section>
  <?php wp_reset_postdata();
} ?>

<?php if (get_theme_mod('portra_homepage_shop_image') && get_theme_mod('portra_homepage_shop_copy')) { ?>
  <section class="portra-homepage-split portra-homepage-shop">
    <aside class="portra-homepage-about image wow" style="background-image: url(<?php echo get_theme_mod('portra_homepage_shop_image'); ?>)"></aside>
    <aside class="portra-homepage-about text">
      <h2>Shop</h2>
      <p class="diary-teaser-excerpt"><?php echo get_theme_mod('portra_homepage_shop_copy'); ?></p>
      <a class="button outline" href="/shop">Explore</a>
    </aside>
  </section>
<?php } ?>

<?php if (get_theme_mod('portra_homepage_about_image') && get_theme_mod('portra_homepage_about_copy')) { ?>
  <section class="portra-homepage-split portra-homepage-about">
    <aside class="portra-homepage-about image wow" style="background-image: url(<?php echo get_theme_mod('portra_homepage_about_image'); ?>)"></aside>
    <aside class="portra-homepage-about text">
      <h2>About Ellen</h2>
      <p><?php echo get_theme_mod('portra_homepage_about_copy'); ?></p>
      <a class="button" href="/contact">Contact me</a>
    </aside>
  </section>
<?php } ?>

<?php get_footer(); ?>
