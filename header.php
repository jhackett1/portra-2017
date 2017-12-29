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
