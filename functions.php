<?php
// Enqueue scripts and styles
wp_enqueue_style('main', get_stylesheet_uri());
wp_enqueue_style('font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

// Add support for a site logo and featured images
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');

// Register two menus
register_nav_menus( array(
  'main' => 'Main',
  'social' => 'Social'
));

// Prettify excerpts
function smoke_excerpt_length( $length ) {
	return 20;
}
function smoke_excerpt_more($more) {
  global $post;
	return '...';
}
add_filter( 'excerpt_length', 'smoke_excerpt_length', 999 );
add_filter('excerpt_more', 'smoke_excerpt_more');

// Do not auto-P images
function filter_ptags_on_images($content){
  return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

// Create a custom dropdown controls
if (class_exists('WP_Customize_Control')){
  class Category_Dropdown_Custom_Control extends WP_Customize_Control {
    private $cats = false;
    public function __construct($manager, $id, $args = array(), $options = array()){
      $this->cats = get_terms( array(
    'taxonomy' => 'media_category',
    'hide_empty' => false,
) );
      parent::__construct( $manager, $id, $args );
    }
    // Render the control out
    public function render_content(){
      if(!empty($this->cats)){ ?>
        <label>
          <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
          <select <?php $this->link(); ?>>
            <?php foreach ( $this->cats as $cat ){
              printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
            } ?>
          </select>
        </label>
      <?php }
    }
  }
}

// Add customisation to theme
function portra_hero_customiser($wp_customize){
  // HOMEPAGE HEADER
  // Section
  $wp_customize->add_section('portra_header', array(
    'title' => __('Homepage Header', 'Portra 2017'),
    'priority' => 30
  ));
  // Settings
  $wp_customize->add_setting('portra_hero_image_url', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_hero_strapline', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_logo_image_url', array(
    'transport' => 'refresh',
  ));
  // Controls
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'logo_image_url', array(
    'label' => __('Masthead image'),
    'settings' => 'portra_logo_image_url',
    'section' => 'portra_header'
  )));
  $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'hero_strapline', array(
    'label' => __('Strapline'),
    'settings' => 'portra_hero_strapline',
    'section' => 'portra_header'
  )));
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'hero_image_url', array(
    'label' => __('Background image'),
    'settings' => 'portra_hero_image_url',
    'section' => 'portra_header'
  )));

  // HOMEPAGE CONTENT SECTIONS
  // Section
  $wp_customize->add_section('portra_homepage_sections', array(
    'title' => __('Homepage Content', 'Portra 2017'),
    'priority' => 30
  ));
  // Settings
  $wp_customize->add_setting('portra_homepage_category_1', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_homepage_category_2', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_homepage_about_image', array(
    'transport' => 'refresh',
  ));
  // Controls
  $wp_customize->add_control(new Category_Dropdown_Custom_Control( $wp_customize, 'portra_homepage_category_1', array(
    'label' => __('First section category'),
    'settings' => 'portra_homepage_category_1',
    'section' => 'portra_homepage_sections'
  )));
  $wp_customize->add_control(new Category_Dropdown_Custom_Control( $wp_customize, 'portra_homepage_category_2', array(
    'label' => __('Second section category'),
    'settings' => 'portra_homepage_category_2',
    'section' => 'portra_homepage_sections'
  )));
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'portra_homepage_about_image', array(
    'label' => __('About me image'),
    'settings' => 'portra_homepage_about_image',
    'section' => 'portra_homepage_sections'
  )));

};
add_action('customize_register', 'portra_hero_customiser');

// Output custom CSS based on the options given
function portra_custom_css(){
  ?>
    <style type="text/css">
      .hero-image{
        background-image: url(<?php echo get_theme_mod('portra_hero_image_url'); ?>);
      }
    </style>
  <?php
};
add_action('wp_head', 'portra_custom_css');
