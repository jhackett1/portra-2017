<?php
// Enqueue scripts and styles
function portra_enqueuer(){
  wp_enqueue_style('main', get_stylesheet_uri());
  wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
  wp_enqueue_style('font-awesome', get_template_directory_uri() . '/font-awesome/css/fontawesome-all.min.css');
  wp_enqueue_style('stroke-icons', get_template_directory_uri() . '/stroke-icons/css/pe-icon-7-stroke.css');
  wp_enqueue_style('stroke-icons', get_template_directory_uri() . '/stroke-icons/css/helper.css');
  wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.js');
  wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js');
}
add_action('wp_enqueue_scripts', 'portra_enqueuer');

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

// Remove unneeded Wordpress widgets and menus for a cleaner client experience
function portra_disable_dashboard_widgets() {
    remove_menu_page( 'about.php' );
    remove_meta_box('dashboard_primary', 'dashboard', 'core');// Remove WordPress Events and News
}
add_action('admin_menu', 'portra_disable_dashboard_widgets');

add_action( 'wp_before_admin_bar_render', function() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
}, 7 );

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
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
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
  $wp_customize->add_setting('portra_logo_image_url', array(
    'transport' => 'refresh',
  ));
  // Controls
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'logo_image_url', array(
    'label' => __('Masthead image'),
    'settings' => 'portra_logo_image_url',
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
  $wp_customize->add_setting('portra_homepage_category_1_image', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_homepage_category_2_image', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_homepage_shop_image', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_homepage_shop_copy', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_homepage_about_image', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_homepage_about_copy', array(
    'transport' => 'refresh',
  ));
  // Controls
  $wp_customize->add_control(new Category_Dropdown_Custom_Control( $wp_customize, 'portra_homepage_category_1', array(
    'label' => __('First section category'),
    'settings' => 'portra_homepage_category_1',
    'section' => 'portra_homepage_sections'
  )));
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'portra_homepage_category_1_image', array(
    'label' => __('First section image'),
    'settings' => 'portra_homepage_category_1_image',
    'section' => 'portra_homepage_sections'
  )));
  $wp_customize->add_control(new Category_Dropdown_Custom_Control( $wp_customize, 'portra_homepage_category_2', array(
    'label' => __('Second section category'),
    'settings' => 'portra_homepage_category_2',
    'section' => 'portra_homepage_sections'
  )));
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'portra_homepage_category_2_image', array(
    'label' => __('Second section image'),
    'settings' => 'portra_homepage_category_2_image',
    'section' => 'portra_homepage_sections'
  )));
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'portra_homepage_shop_image', array(
    'label' => __('Shop section image'),
    'settings' => 'portra_homepage_shop_image',
    'section' => 'portra_homepage_sections'
  )));
  $wp_customize->add_control(
    'portra_homepage_shop_copy',
    array(
        'label' => 'Shop section text',
        'section' => 'portra_homepage_sections',
        'type' => 'text',
    )
  );
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'portra_homepage_about_image', array(
    'label' => __('About me image'),
    'settings' => 'portra_homepage_about_image',
    'section' => 'portra_homepage_sections'
  )));
  $wp_customize->add_control(
    'portra_homepage_about_copy',
    array(
        'label' => 'About section text',
        'section' => 'portra_homepage_sections',
        'type' => 'text',
    )
  );


  // SOCIAL SHARING
  // Section
  $wp_customize->add_section('portra_sharing', array(
    'title' => __('Social Sharing', 'Portra 2017'),
    'priority' => 30
  ));
  // Settings
  $wp_customize->add_setting('portra_default_social_share_image', array(
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('portra_twitter_account', array(
    'transport' => 'refresh',
  ));
  // Controls
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'portra_default_social_share_image', array(
    'label' => __('Default social share image'),
    'settings' => 'portra_default_social_share_image',
    'section' => 'portra_sharing'
  )));
  $wp_customize->add_control(
    'portra_twitter_account',
    array(
        'label' => 'Associated Twitter username (without @ symbol)',
        'section' => 'portra_sharing',
        'type' => 'text',
    )
  );
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
// ...and customise the login screen too
function portra_custom_login(){
  ?>
    <style type="text/css">
      .login h1 a{
        background-image: none, url(<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'medium' )[0]; ?>);
        background-size: contain;
      }
    </style>
  <?php
};
add_action('login_head', 'portra_custom_login');
