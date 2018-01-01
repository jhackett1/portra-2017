<!doctype HTML>
<!--
 _   _ _____ _     _     ___  _
| | | | ____| |   | |   / _ \| |
| |_| |  _| | |   | |  | | | | |
|  _  | |___| |___| |__| |_| |_|
|_| |_|_____|_____|_____\___/(_)

Scrutinising the source, I see...

If you like what you see, perhaps you'd consider using me for your next web project?

Find out more at SMALLWINS.CO.UK or shoot an email to HELLO@SMALLWINS.CO.UK

- Joshua

 -->
<html>
  <head>
    <title><?php wp_title('|', true, 'right'); echo bloginfo('name')?> | <?php echo bloginfo('description'); ?></title>
    <meta name="viewport" content="width=device-width">
    <meta property="fb:app_id" content="1134129026651501" />
    <?php
    if (is_single()){
    $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'ogimg' );
    $feat = $feat[0];
    $description = get_post_field( 'post_content', $post->ID );
    $description = trim( wp_strip_all_tags( $description, true ) );
    $description = wp_trim_words( $description, 15 );
    ?>
      <meta property="og:url" content="<?php the_permalink() ?>"/>
      <meta property="og:title" content="<?php single_post_title(''); ?>" />
      <meta property="og:type" content="article" />
      <meta property="og:image" content="<?php echo $feat; ?>" />
      <meta property="og:description" content="<?php echo $description; ?>" />
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:site" content="@<?php echo get_theme_mod('portra_twitter_account'); ?>">
      <meta name="twitter:creator" content="@<?php echo get_theme_mod('portra_twitter_account'); ?>">
      <meta name="twitter:title" content="<?php the_title(); ?>">
      <meta name="twitter:description" content="<?php echo $description; ?>">
      <meta name="twitter:image" content="<?php echo $feat; ?>">
    <?php } else { ?>
      <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
      <meta property="og:description" content="<?php bloginfo('description'); ?>" />
      <meta property="og:type" content="website" />
      <meta property="og:image" content="<?php echo get_theme_mod('portra_default_social_share_image'); ?>" />
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:site" content="@<?php echo get_theme_mod('portra_twitter_account'); ?>">
      <meta name="twitter:creator" content="@<?php echo get_theme_mod('portra_twitter_account'); ?>">
      <meta name="twitter:title" content="<?php bloginfo('name'); ?>">
      <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
      <meta name="twitter:image" content="<?php echo get_theme_mod('portra_default_social_share_image'); ?>" >
    <?php
    }
    ?>
    <link href="https://fonts.googleapis.com/css?family=Cantata+One|Open+Sans:300,400,700" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class( 'frontend' ); ?>>
    <header <?php if (is_front_page()) { echo "class='homepage'"; }?>>
      <div class="container">
        <?php
          if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
          }
        ?>
        <i class="fas fa-bars fa-2x"></i>
        <?php if (is_home()) { ?>
          <!-- <nav class="menu-left"><?php wp_nav_menu(array( 'theme_location' => 'social' )); ?></nav> -->
        <?php } ?>
        <nav class="menu-right"><?php wp_nav_menu(array( 'theme_location' => 'main' )); ?></nav>
      </div>
    </header>

    <sidebar class="mobile-menu">
      <i class="fas fa-times fa-2x"></i>
      <nav><?php wp_nav_menu(array( 'theme_location' => 'main' )); ?></nav>
      <nav><?php wp_nav_menu(array( 'theme_location' => 'social' )); ?></nav>
    </sidebar>
