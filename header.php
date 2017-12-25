<!doctype HTML>
<html>
  <head>
    <title><?php echo bloginfo('name')?> | <?php echo bloginfo('description'); ?></title>
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class( 'frontend' ); ?>>

  <header>
    <div class="container">
      <?php
        if ( function_exists( 'the_custom_logo' ) ) {
          the_custom_logo();
        }
      ?>
      <i class="fa fa-bars fa-2x"></i>
      <nav><?php wp_nav_menu('main') ?></nav>
    </div>
  </header>
