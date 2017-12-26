<?php get_header(); ?>

<section id="hero">
  <aside class="hero-image">
  </aside>
  <i class="fa fa-bars fa-2x"></i>
  <nav><?php wp_nav_menu('main') ?></nav>
  <section class="site-masthead">
    <?php
      if (get_theme_mod('portra_logo_image_url')) {
        echo "<img src='" . get_theme_mod('portra_logo_image_url') . "' />";
      }
    ?>
    <h5><?php echo get_theme_mod('portra_hero_strapline'); ?></h5>
  </section>
</section>

<?php
function homepage_portfolio($cat){ ?>
  <section class="homepage-portfolio-section">
    <div class="text">
      <h2><?php echo get_term_by('id', $cat, 'media_category')->name; ?></h2>
      <p><?php echo get_term_by('id', $cat, 'media_category')->description; ?></p>
      <a class="button outline" href="<?php echo get_term_link(get_term_by('id', $cat, 'media_category')); ?>">See all</a>
    </div>
    <section class="portfolio-grid-small">
      <aside>
      <?php
        $query = new WP_Query( array(
          'post_type' => 'attachment',
          'post_status' => 'any',
          'posts_per_page' => 4,
          'tax_query' => array(
        		array(
        			'taxonomy' => 'media_category',
        			'field'    => 'term_id',
        			'terms'    => $cat,
        		),
        	),
        ) );
        if ($query->have_posts()) {
          $i = 0;
          while($query->have_posts()){
            $query->the_post();
            if($i == 2){ ?>
              </aside><aside>
            <?php } ?>
              <div class="grid-item" style="background-image: url(<?php echo wp_get_attachment_image_src($post->ID, 'large')[0]; ?>)">
                <a href="<?php echo get_attachment_link($post->ID)?>" class="cover">
                </a>
                <?php if($i == 1){ ?>
                  <div class="desktop-text">
                    <h2><?php echo get_term_by('id', $cat, 'media_category')->name; ?></h2>
                    <p><?php echo get_term_by('id', $cat, 'media_category')->description; ?></p>
                    <a class="button outline" href="<?php echo get_term_link(get_term_by('id', $cat, 'media_category')); ?>">See all</a>
                  </div>
                <?php } ?>
              </div>
            <?php
            $i++;
          }
          wp_reset_postdata();
        }
      ?>
      </aside>
    </section>
  </section>
<?php }
homepage_portfolio(get_theme_mod('portra_homepage_category_1'));
homepage_portfolio(get_theme_mod('portra_homepage_category_2'));
?>

<section class="homepage-diary-entries">
  <h2>Diary</h2>
  <ul>
  <?php
  $query = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 2
    )
  );
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post(); ?>
      <li class="diary-entry-teaser">
        <h3 class="diary-entry-teaser-headline"><?php the_title(); ?></h3>
        <p class="diary-entry-teaser-excerpt"><?php the_excerpt(); ?></p>
        <a class="button outline" href="<?php the_permalink(); ?>">Read more</a>
      </li>
    <?php }
    wp_reset_postdata();
  } ?>
  </ul>
</section>

<section class="homepage-about">
  <div class="homepage-about-image" style="background-image: url(<?php echo get_theme_mod('portra_homepage_about_image'); ?>)"></div>
  <div class="text">
    <h2>About Ellen</h2>
    <p>Whether you’re just looking for something to play over your days-off in the coming weeks or desperate to escape back.</p>
    <a class="button" href="#">Hire me</a>
  </div>
</section>

<?php get_footer(); ?>
