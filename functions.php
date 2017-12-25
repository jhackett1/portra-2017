<?php
// Enqueue scripts and styles
wp_enqueue_style('main', get_stylesheet_uri());
wp_enqueue_style('font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

// Add support for a site logo and featured images
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');

// Register two menus
register_nav_menu('main', 'Main');
register_nav_menu('social', 'Social');

// Do not auto-P images
function filter_ptags_on_images($content){
  return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

// Allow the customizer to control the theme header image
function portra_hero_customiser($wp_customize){
  // Settings
  $wp_customize->add_setting('portra_hero_image_url', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_logo_image_url', array(
    'transport' => 'refresh',
  ));
  // Section
  $wp_customize->add_section('portra_header', array(
    'title' => __('Site Header', 'Portra 2017'),
    'priority' => 30
  ));
  // Controls
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'logo_image_url', array(
    'label' => __('Logo image'),
    'settings' => 'portra_logo_image_url',
    'section' => 'portra_header'
  )));
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'hero_image_url', array(
    'label' => __('Background image'),
    'settings' => 'portra_hero_image_url',
    'section' => 'portra_header'
  )));
};
add_action('customize_register', 'portra_hero_customiser');

// Output custom CSS based on the options given
function portra_custom_css(){
  ?>
    <style type="text/css">
      .hero{
        background-image: <?php echo get_theme_mod('portra_hero_image_url'); ?>
      }
    </style>
  <?php
};
add_action('wp_head', 'portra_custom_css');
