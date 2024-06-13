<?php
/**
 * altwood functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package altwood
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function altwood_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on altwood, use a find and replace
		* to change 'altwood' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'altwood', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'altwood' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'altwood_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'altwood_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function altwood_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'altwood_content_width', 640 );
}
add_action( 'after_setup_theme', 'altwood_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function altwood_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'altwood' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'altwood' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'altwood_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function altwood_scripts() {
	wp_enqueue_style( 'altwood-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'altwood-style', 'rtl', 'replace' );

	wp_enqueue_script( 'altwood-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'altwood_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action( 'wp_enqueue_scripts', 'bodymindacademy_enqueue_styles' );
function bodymindacademy_enqueue_styles() {
	// Css added
    wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() . '/custom.css', false );

	// Js added
	wp_enqueue_script( 'jquery-min-js', get_stylesheet_directory_uri() . '/js/jquery-3.5.1.min.js', false );
	wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', false );

}


// add options for header & footer
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
	 'page_title' 	=> 'Theme General Settings',
	 'menu_title'	=> 'Theme Settings',
	 'menu_slug' 	=> 'theme-general-settings',
	 'capability'	=> 'edit_posts',
	 'redirect'		=> false
   ));
  }			
  
  
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'altwood' ),
				'footer'  => esc_html__( 'Footer menu', 'altwood' ),
				'header' => esc_html__('Header menu', 'altwood'),
				'main-menu' => esc_html__( 'Main menu', 'altwood' ),
				'second-menu' => esc_html__( 'Second menu', 'altwood' ),
				
			)
		);

// category filter  projecten
add_action( 'wp_ajax_cat_fliter', 'cat_fliter' );
add_action( 'wp_ajax_nopriv_cat_fliter', 'cat_fliter' );

function cat_fliter(){

	$cat_val = $_POST['cat'];
  	$posttype =  $_POST['post_type'];
  	$taxonomy = $_POST['taxonomy'];

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 2,
		'cat'         => $cat_val,
	);
  	$insight_query = new WP_Query($args);
  ?>
  <?php if($insight_query->have_posts()):?>
    <?php while($insight_query->have_posts()) : $insight_query->the_post();
		$post_cat = get_the_terms($insight_query->ID, $taxonomy );
		?>
		<div class="post_box">
			<a href="<?php echo get_the_permalink();?>"><?php echo get_the_post_thumbnail( $post_id, 'large' );?></a>  
			<a href="<?php echo get_the_permalink(); ?>" class="post_title"><?php echo get_the_title();?></a>
			<p class="post_content"><?php echo the_excerpt();?></p>
		</div>
	<?php 
	endwhile;
	wp_reset_postdata();
  endif;
 die();
}



/* Load More post Define */
wp_register_script( 'core-js', get_template_directory_uri() . '/assets/js/core.js');
wp_enqueue_script( 'core-js' );

wp_localize_script( 'core-js', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'noposts' => __('No older posts found', 'twentyfifteen'),
));


/* wp-admin logo change */
function my_login_logo() { ?>

    <style type="text/css">
        #login h1 a, .login h1 a {
         background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Altwood_logo_tagline_RGB.svg);
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


//changing the url on the logo to redirect them
function mb_login_url() {
	return home_url();
}
add_filter('login_headerurl', 'mb_login_url');



// Thank you page redirect 
add_action( 'wp_footer', 'mycustom_wp_footer' );
function mycustom_wp_footer() {
?>
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = 'https://altwood.be/bedankt/';
}, false );
</script>
<?php
}

add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );


add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

function more_post_ajax(){

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 2;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 1;

    header("Content-Type: text/html");

	$args = array (
		'post_type' => 'post',
		'posts_per_page' => $ppp,
		'post_status' => 'publish',
		'paged'    => $page,
	);
	$loop = new WP_Query($args);
	$out = '';

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
        $post_tags = get_the_tags( $loop->ID );
        $out .= '<div class="post_box">
					<a href="'.get_the_permalink().'">'.get_the_post_thumbnail( $post_id, 'large' ).'</a>
					<a href="'.get_the_permalink().'" class="post_title">'.get_the_title().'</a>
					<p class="post_content">'.get_the_excerpt().'</p>
				</div>';
    endwhile;
    else:
      $out .= '<div class="post_box"></div><style>#load-more{display:none !important}</style>';
    endif;
    wp_reset_postdata();
    die($out);
}

