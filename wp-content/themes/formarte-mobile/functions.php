<?php
/**
 * Theme functions and definitions.
 *
 * @package Nightly
 * @since 1.0
 */

/************************************************************************************/
/* Declarations and Definitions */
/************************************************************************************/
/**
 * Define basic variables
 *
 * @since 1.0
 */
 
define("NIGHTLY_THEMEROOT", get_template_directory_uri());
define("NIGHTLY_IMAGEDIR", get_template_directory_uri() . '/assets/images');
define("NIGHTLY_JSDIR", get_template_directory_uri() . '/assets/js');
define("NIGHTLY_CSSDIR", get_template_directory_uri() . '/assets/css');
define("NIGHTLY_VERSION", "1.1" );

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 320; // pixels, at 1000px wide



/************************************************************************************/
/* Admin panel class */
/************************************************************************************/
/**
 * Class that includes theme options panel with customizations
 *
 * @since 1.0
 */
 
if ( ! class_exists( 'nightly_option_panel' ) ) {

	class nightly_option_panel {
		
		public function __construct() {
	
		}
	
		public static function init() {
			add_action( 'admin_menu', array( 'nightly_option_panel', 'remove_redux_menu' ), 12 );
			if ( is_admin() ) {
				add_action('admin_enqueue_scripts', array( 'nightly_option_panel', 'load_admin_styles' ) );
			}
		}
		
		public static function load_admin_styles() {
			wp_register_style('nightly-admin-style', NIGHTLY_CSSDIR . '/admin.css', array(), '1.0' );
			wp_enqueue_style('nightly-admin-style');
			wp_register_style('font-awesome-style-admin', NIGHTLY_CSSDIR . '/font-awesome.min.css', array(), '1.0' );
			wp_enqueue_style('font-awesome-style-admin');
		}
		
		public static function remove_redux_menu() {
		    remove_submenu_page('tools.php', 'redux-about');
		}
		
	}
}



/************************************************************************************/
/* Import redux framework files */
/************************************************************************************/
/**
 * Include necessary files for theme options panel and calls it
 *
 * @since 1.0
 * Appendix (not used anymore)
 */
 
$nightly_admin = get_template_directory() . '/admin/admin-init.php';
if ( is_readable( $nightly_admin ) ) {
	require_once( $nightly_admin );
	add_action( 'init', array( 'nightly_option_panel', 'init' ) );
}



/************************************************************************************/
/* After Setup Theme Actions */
/************************************************************************************/

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since 1.0
 */
function nightly_theme_setup() {

	// Make theme available for translation. Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'nightly', NIGHTLY_THEMEROOT . '/languages' );
	$locale = get_locale();
  $locale_file = NIGHTLY_THEMEROOT . '/languages/$locale.php';
  if ( is_readable( $locale_file ) ) require_once( $locale_file );

	// This theme uses wp_nav_menu() in two locations. This is one for sidebar navigations.
	register_nav_menu( 'nightly-main-navigation', esc_html__( 'Nightly Mobile navigation (sidebar)', 'nightly-mobile' ) );
	
	// This theme uses wp_nav_menu() in two locations. This is one for standalone page navigation.
	register_nav_menu( 'nightly-navigation-page', esc_html__( 'Nightly Mobile navigation (standalone page navigation)', 'nightly-mobile' ) );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme supports featured images
	add_theme_support( 'post-thumbnails' );
	
	// This theme supports title tag
	add_theme_support( 'title-tag' );
	
	// Add custom background option
	add_theme_support( "custom-background", array( 'default-color' => 'fff') );
	
	// Add custom header background
	add_theme_support( 'custom-header' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'video', 'audio', 'gallery' ) ); // array( 'aside', 'image', 'link', 'quote', 'video', 'audio', 'gallery' ) );

	// Add support for Jetpack's Featured Content
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'debut_featured_content',
	) );
	
	// Add support for WooCommerce
	add_theme_support( 'woocommerce' );
	
	if( get_option( 'nightly_header_theme' ) == '' ) update_option( 'nightly_header_theme', 'a' );
	if( get_option( 'nightly_left_sidebar_theme' ) == '' ) update_option( 'nightly_left_sidebar_theme', 'a' );
	if( get_option( 'nightly_right_sidebar_theme' ) == '' ) update_option( 'nightly_right_sidebar_theme', 'a' );
	if( get_option( 'nightly_theme' ) == '' ) update_option( 'nightly_theme', 'a' );
	
	add_image_size( 'category-thumb', 600, 9999 );
	
}
add_action( 'after_setup_theme', 'nightly_theme_setup' );





/************************************************************************************/
/* Register Widget Areas */
/************************************************************************************/
/**
 * Registers widget areas.
 *
 * @since 1.0
 * @return void
 */
function nightly_custom_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Nightly Mobile right sidebar', 'nightly-mobile' ),
		'id'            => 'nightly-right-sidebar',
		'description'   => esc_html__( 'Appears on the right side of the screen.', 'nightly-mobile' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="sidebar-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Nightly Mobile left sidebar', 'nightly-mobile' ),
		'id'            => 'nightly-left-sidebar',
		'description'   => esc_html__( 'Appears in the left sidebar beneath main navigation.', 'nightly-mobile' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="sidebar-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Nightly Mobile dropdown area', 'nightly-mobile' ),
		'id'            => 'nightly-dropdown-area',
		'description'   => esc_html__( 'Appears on the dropdown navigation. Activate in Nightly Mobile / Navigation.', 'nightly-mobile' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="sidebar-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'nightly_custom_widgets_init' );




/************************************************************************************/
/* Extend <body> class */
/************************************************************************************/
/**
 * Add editor stylesheet
 *
 * @since 1.0
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function nightly_add_editor_styles() {
    add_editor_style( NIGHTLY_CSSDIR . '/editor-style.css' );
}
add_action( 'admin_init', 'nightly_add_editor_styles' );




/************************************************************************************/
/* Extend <body> class */
/************************************************************************************/
/**
 * Extends the default WordPress body classes.
 *
 * @since 1.0
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function nightly_custom_body_class( $classes ) {
	global $nightly_mobile;

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	if ( is_single() || is_page() || is_404() || ! have_posts()  )
		$classes[] = 'single';
	else
		$classes[] = 'not-single';

	if ( is_page() )
		$classes[] = 'is-page';
		
	if ( is_page_template( 'page-navi-circles.php' ) || is_page_template( 'page-navi-boxes.php' ) )
		$classes[] = 'is-page-navi';
		
	if ( is_page_template( 'page-navi-circles.php' ) )
		$classes[] = 'is-page-navi-circles';
		
	if ( is_page_template( 'page-navi-boxes.php' ) )
		$classes[] = 'is-page-navi-boxes';

	if ( is_admin_bar_showing() )
		$classes[] = 'admin-bar-active';

	if ( ! is_active_widget( false, false, 'search' ) )
		$classes[] = 'no-search-widget';
		
	if ( $nightly_mobile['nightly_swipe_gestures'] == true )
		$classes[] = 'disableswipe';	
		
	if ( $nightly_mobile['nightly_show_header_info_bar'] == true )
		$classes[] = 'header-info-bar-active';
		
	if ( $nightly_mobile['nightly_show_footer_info_bar'] == true )
		$classes[] = 'footer-info-bar-active';
	
	if ( $nightly_mobile['nightly_footer_fixed'] == true )
		$classes[] = 'main-footer-fixed';	
	
	if ( $nightly_mobile['nightly_header_info_bar_fixed'] == true )
		$classes[] = 'header-info-bar-fixed';
			
	if ( $nightly_mobile['nightly_footer_info_bar_fixed'] == true )
		$classes[] = 'footer-info-bar-fixed';
		
	if ( $nightly_mobile['nightly_sidebar_style'] == 1 ):
		$classes[] = 'sidebar-style-nightly';
	elseif ( $nightly_mobile['nightly_sidebar_style'] == 2 ):
		$classes[] = 'sidebar-style-light';
	elseif ( $nightly_mobile['nightly_sidebar_style'] == 3 ):
		$classes[] = 'sidebar-style-banana';
	elseif ( $nightly_mobile['nightly_sidebar_style'] == 4 ):
		$classes[] = 'sidebar-style-deep-sea';
	elseif ( $nightly_mobile['nightly_sidebar_style'] == 5 ):
		$classes[] = 'sidebar-style-sky-blue';
	elseif ( $nightly_mobile['nightly_sidebar_style'] == 6 ):
		$classes[] = 'sidebar-style-breathe';
	elseif ( $nightly_mobile['nightly_sidebar_style'] == 7 ):
		$classes[] = 'sidebar-style-space-myst';
	else :
		$classes[] = 'sidebar-style-nightly';
	endif;
	
	if ( $nightly_mobile['nightly_header_thinline'] == true )
		$classes[] = 'header-thinline';
		
	if ( $nightly_mobile['nightly_header_thinline'] == false && $nightly_mobile['nightly_header_thinline_auto'] == true )
		$classes[] = 'header-thinline-auto';
		
	if ( $nightly_mobile['nightly_header_left_sidebar_hide_icon'] == true )
		$classes[] = 'header-hide-left-icon';
		
	if ( $nightly_mobile['nightly_header_right_sidebar_hide_icon'] == true )
		$classes[] = 'header-hide-right-icon';
	
	if ( $nightly_mobile['nightly_header_hide'] == true )
		$classes[] = 'header-hide';
		
	if ( $nightly_mobile['nightly_navigation_style'] == 'dropdown' )
		$classes[] = 'main-navigation-dropdown';
	
	if ( ! $nightly_mobile['nightly_shop_show_buy_now'] ) 
		$classes[] = 'shop-hide-buy-now';
		
	if ( ! $nightly_mobile['nightly_shop_show_rating'] ) 
		$classes[] = 'shop-hide-rating';
	
	return $classes;
}
add_filter( 'body_class', 'nightly_custom_body_class' );




/************************************************************************************/
/* Google font function */
/************************************************************************************/
/**
 * Creates enhanced google font link which will be later used in scripts enqueue.
 *
 * @since 1.0
 * @return void
 */
function nightly_fonts_url() {
    $fonts_url = '';
      
    /* Translators: If there are characters in your language that are not
    * supported by Source Sans Pro, translate this to 'off'. Do not translate
    * into your own language.
    */
     
    $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'nightly-mobile' );
    
    /* Translators: If there are characters in your language that are not
    * supported by Oswald, translate this to 'off'. Do not translate
    * into your own language.
    */
    
    $oswald = _x( 'on', 'Oswald font: on or off', 'nightly-mobile' );
    
    /* Translators: If there are characters in your language that are not
    * supported by Droid Serif, translate this to 'off'. Do not translate
    * into your own language.
    */
    
    $droid_serif = _x( 'on', 'Droid Serif font: on or off', 'nightly-mobile' );
    
    /* Translators: If there are characters in your language that are not
    * supported by Quicksand, translate this to 'off'. Do not translate
    * into your own language.
    */
    
    $quicksand = _x( 'on', 'Quicksand font: on or off', 'nightly-mobile' );
    
    /* Translators: If there are characters in your language that are not
    * supported by Roboto, translate this to 'off'. Do not translate
    * into your own language.
    */
    
    $roboto = _x( 'on', 'Roboto font: on or off', 'nightly-mobile' );
    
    /* Translators: If there are characters in your language that are not
    * supported by Muli, translate this to 'off'. Do not translate
    * into your own language.
    */
    
    $pacifico = _x( 'on', 'Pacifico font: on or off', 'nightly-mobile' );
    
    /* Translators: If there are characters in your language that are not
    * supported by Muli, translate this to 'off'. Do not translate
    * into your own language.
    */
    
    $muli = _x( 'on', 'Muli font: on or off', 'nightly-mobile' );
    
    if ( 'off' !== $source_sans_pro || 'off' !== $oswald || 'off' !== $droid_serif || 'off' !== $quicksand || 'off' !== $roboto || 'off' !== $muli || 'off' !== $pacifico ) {
    
	    $font_families = array();
     
	    if ( 'off' !== $source_sans_pro ) {
	    	$font_families[] = 'Source Sans Pro:300,400,400italic,600,700,700italic,900,600italic';
	    }
	    
	    if ( 'off' !== $oswald ) {
	    	$font_families[] = 'Oswald:400,700';
	    }
	    
	    if ( 'off' !== $droid_serif ) {
	    	$font_families[] = 'Droid Serif:400,700,700italic,400italic';
	    }
	    
	    if ( 'off' !== $quicksand ) {
	    	$font_families[] = 'Quicksand:400,700';
	    }
	    
	    if ( 'off' !== $roboto ) {
	    	$font_families[] = 'Roboto:400,300,300italic,400italic,700,700italic';
	    }
	   	
	   	if ( 'off' !== $muli ) {
	   		$font_families[] = 'Muli:400,300';
	   	}
	   	
	   	if ( 'off' !== $pacifico ) {
	   		$font_families[] = 'Pacifico';
	   	}
	    
	    $query_args = array( 
	    	'family' => urlencode( implode( '|', $font_families ) ),
	    	'subset' => urlencode( 'latin,latin-ext' ),
	    );
	     
	    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
    
    return esc_url_raw( $fonts_url );
}




/************************************************************************************/
/* Redux framework variables getter */
/************************************************************************************/
/**
 * Enqueues scripts and styles for front end.
 *
 * @since 1.0
 * @return void
 */
if ( !function_exists('nightly_global') ) {
    function nightly_global( $opt_1 ){
       global $nightly_mobile;
			 if ( isset( $nightly_mobile[$opt_1] ) ) {
       	return $nightly_mobile[$opt_1];
       } else {
       	return false;
       }
    }
}




/************************************************************************************/
/* Enqueue Scripts and Styles */
/************************************************************************************/
/**
 * Enqueues scripts and styles for front end.
 *
 * @since 1.0
 * @return void
 */
function nightly_register_scripts_styles() {

	// Enhanced Comment Display
	if ( is_singular() )
	wp_enqueue_script( "comment-reply" );
	
	// Loads Owl Carousel scripts
	wp_enqueue_script( 'owl-scripts', NIGHTLY_JSDIR . '/owl.carousel.min.js', array( 'jquery' ), '1.0', true );

	// Loads our main scripts file
	wp_enqueue_script( 'nightly-scripts', NIGHTLY_JSDIR . '/nightly.js', array( 'jquery' ), '1.0', true );
	
	// Loads jQuery Mobile
	wp_enqueue_script( 'jquery-mobile', NIGHTLY_JSDIR . '/jquery.mobile.min.js', array( 'jquery' ), '1.0', true );

	// Import Google fonts
	wp_enqueue_style( 'gfont', nightly_fonts_url(), array(), '1.0' );
	
	// Loads jQM styles
	wp_enqueue_style( 'jqm-theme-style', NIGHTLY_CSSDIR . '/jqeury.mobile.theme.min.css', array(), '1.0' );
	 
	// Loads jQM main style
	wp_enqueue_style( 'jqm-style', NIGHTLY_CSSDIR . '/jquery.mobile.min.css', array(), '1.0' );
	
	// Loads Font Awesome icons
	wp_enqueue_style( 'font-awesome-style', NIGHTLY_CSSDIR . '/font-awesome.min.css', array(), '1.0' );
	
	// Loads Owl Carousel CSS
	wp_enqueue_style( 'owl-style', NIGHTLY_CSSDIR . '/owl.carousel.css', array(), '1.0' );

	// Loads style.css
	wp_enqueue_style( 'main-style', get_stylesheet_uri(), array(), '1.0' );
	
	// Loads our main stylesheet
	wp_enqueue_style( 'nightly-style', NIGHTLY_CSSDIR . '/nightly.css', array(), '1.0' );
	
	// Loads schemes
	wp_enqueue_style( 'nightly-schemes', NIGHTLY_CSSDIR . '/nightly.color.schemes.css', array(), '1.0' );
	
}
add_action( 'wp_enqueue_scripts', 'nightly_register_scripts_styles', '20' );




/************************************************************************************/
/* Disable swipe */
/************************************************************************************/
/**
 * Disable swipe gestures according to theme options,
 *
 * @since 1.0
 * @return void
 */
function nightly_disable_swipe() {
    if( wp_script_is('jquery', 'done') ) {
    ?>
    <script type="text/javascript">
      jQuery( document ).on( "swipeleft swiperight", 'body', function ( e ) {
          e.stopPropagation();
          e.preventDefault();
      });
    </script>
    <?php
    }
}

if (get_option('data_swipe_gestures') == "false") {
	add_action( 'wp_footer', 'nightly_disable_swipe' );
}




if( !function_exists('nightly_content') ):
/************************************************************************************/
/* Custom excerpt length */
/************************************************************************************/
/**
 * Using this function you can define custom excerpt length
 *
 * @since 1.0
 * @return void
 */
function nightly_content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
endif;




if( !function_exists('nightly_content_format') ):
/************************************************************************************/
/* Custom excerpt length without images */
/************************************************************************************/
/**
 * Using this function you can define custom excerpt length, without images but with preservedHTML formating
 *
 * @since 1.0
 * @return HTML formatted content
 */
function nightly_content_format($excerpt = '') {
		if ($excerpt > 0) {
			$content = nightly_content($excerpt);
		} else {
			$content = get_the_content();
		}
		$content = apply_filters('the_content', $content);
		$content = strip_tags($content, '<p><a>');
		return $content;
}
endif;


/**
 * Custom excerpt length. This function applies on the_excerpt() function which is used only in content-excerpt.php
 *
 * @since Nightly 1.0
 */
function nightly_custom_the_excerpt_length( $length ) {
	global $nightly_mobile;
	if ( $nightly_mobile['nightly_blog_post_excerpt'] != "" ) {
		$nightly_post_excerpt = $nightly_mobile['nightly_blog_post_excerpt'];
	} else {
		 $nightly_post_excerpt = 8;
	}
  return $nightly_post_excerpt;
}
add_filter( 'excerpt_length', 'nightly_custom_the_excerpt_length', 999 );

function nightly_custom_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'nightly_custom_excerpt_more');




if ( ! function_exists( 'nightly_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Nightly 1.0
 */
function nightly_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'nightly-mobile' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'nightly-mobile' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'nightly-mobile' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;



if ( ! function_exists( 'nightly_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * @since Nightly 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function nightly_entry_date( $echo = true ) {

	$date = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'F jS, Y' ) )
	);

	if ( $echo )
		echo sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'F jS, Y' ) )
		);

	return $date;
}
endif;




if ( ! function_exists( 'nightly_entry_footer' ) ) :
/**
 * Print HTML with footer for current post.
 * @return Printed HTML of "Continue reading" button.
 *
 * @since Nightly 1.0
 */
function nightly_entry_footer() { ?>
  
  <?php if ( ! is_single() ) : ?>
	  <footer class="entry-footer">
	  	<a href="<?php echo esc_url( get_permalink() ); ?>"><button data-role="none" class="nightly-button blog-read-more-button" data-theme="d"><?php echo esc_html__( 'Continue reading', 'nightly-mobile'); ?></button></a>
	  </footer><!-- .entry-footer -->
  <?php endif; ?>
  
<?php }
endif;




if ( ! function_exists( 'nightly_header_searchform' ) ) :
/**
 * Print HTML with footer for current post.
 * @return Printed HTML of searchform
 *
 * @since Nightly 1.0
 * @updated Nightly 1.1
 */
function nightly_header_searchform() { ?>
	<form id="top-searchform" data-theme="a" role="search" action="<?php echo site_url('/'); ?>" method="get">
	    <input data-role="none" class="nightly-input" type="text" name="s" placeholder="<?php echo esc_attr_x( 'Search on website', 'placeholder', 'nightly-mobile' ); ?>" value="<?php echo get_search_query(); ?>" />
	    <input data-role="none" class="nightly-button" type="submit" name="submit" value="" />
	</form>
<?php }
endif;



/************************************************************************************/
/* Create Custom Function for Showing Post Date on excerpt posts */
/************************************************************************************/
if ( ! function_exists( 'nightly_excerpt_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * @since 1.0
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function nightly_excerpt_entry_date( $echo = true ) {

	$date = sprintf( '<span class="post-date"><span class="fa fa-clock-o"></span><time class="entry-date" datetime="%1$s">%2$s</time></span>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('F j, Y') )
	);
	
	if ( $echo )
		echo sprintf( '<span class="post-date"><span class="fa fa-clock-o"></span><time class="entry-date" datetime="%1$s">%2$s</time></span>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date('F j, Y') )
		);

	return $date;
}
endif;




/************************************************************************************/
/* Returns Author Posts Link for excerpts */
/************************************************************************************/
if ( ! function_exists( 'nightly_excerpt_author_posts_link' ) ) :
/**
 * Prints HTML with author posts link. Used in author-bio.php
 *
 * @since 1.0
 * @return string
 */
function nightly_excerpt_author_posts_link( $echo = false ) {

	$string = '<a class="author-link" href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">'.get_the_author().'</a>';
	if ( $echo == true )
		echo esc_attr($string);
	else return $string;

}
endif;




/************************************************************************************/
/* Nightly entry meta */
/************************************************************************************/
if ( ! function_exists( 'nightly_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * @since Nightly 1.0
 */
function nightly_entry_meta() {
	printf('<span class="blog-date">');
	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() ) {
		nightly_entry_date();
  }
  printf('</span>');
}
endif;





/************************************************************************************/
/* Optimize WooCommerce Scripts */
/************************************************************************************/

/**
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages
 *
 * @since 1.0
 */
 
if ( isset( $GLOBALS['woocommerce'] ) ) :
 
	function nightly_manage_woocommerce_styles() {
	 //remove generator meta tag
	 remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	
	 if ( function_exists( 'is_woocommerce' ) ) {
		 //dequeue scripts and styles
		 
		 if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
		 wp_dequeue_style( 'woocommerce_frontend_styles' );
		 wp_dequeue_style( 'woocommerce_fancybox_styles' );
		 wp_dequeue_style( 'woocommerce_chosen_styles' );
		 wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		 wp_dequeue_script( 'wc_price_slider' );
		 wp_dequeue_script( 'wc-single-product' );
		 wp_dequeue_script( 'wc-add-to-cart' );
		 wp_dequeue_script( 'wc-cart-fragments' );
		 wp_dequeue_script( 'wc-checkout' );
		 wp_dequeue_script( 'wc-add-to-cart-variation' );
		 wp_dequeue_script( 'wc-single-product' );
		 wp_dequeue_script( 'wc-cart' );
		 wp_dequeue_script( 'wc-chosen' );
		 wp_dequeue_script( 'woocommerce' );
		 wp_dequeue_script( 'prettyPhoto' );
		 wp_dequeue_script( 'prettyPhoto-init' );
		 wp_dequeue_script( 'jquery-blockui' );
		 wp_dequeue_script( 'jquery-placeholder' );
		 wp_dequeue_script( 'fancybox' );
		 wp_dequeue_script( 'jqueryui' );
		 }
	 }
	}
	add_action( 'wp_enqueue_scripts', 'nightly_manage_woocommerce_styles', 99 );
endif;	




if ( ! function_exists( 'nightly_header_info_bar' ) ) :
/**
 * Print HTML with header info bar.
 * Connected with theme options panel. If no variable is set returns false
 *
 * @since Nightly 1.0
 *
 * @return string The HTML-formatted header info bar.
 */
function nightly_header_info_bar() {

 global $nightly_mobile;
 
 $nightly_header_info_bar['fixed'] = html_entity_decode( $nightly_mobile['nightly_header_info_bar_fixed'] );
 $nightly_header_info_bar['phone'] = html_entity_decode( $nightly_mobile['nightly_header_info_bar_phone'] );
 $nightly_header_info_bar['sign'] = html_entity_decode( $nightly_mobile['nightly_header_info_bar_sign'] );
 $nightly_header_info_bar['desktop'] = html_entity_decode( $nightly_mobile['nightly_header_info_bar_desktop'] );
 $nightly_header_info_bar['facebook']['name'] = html_entity_decode( $nightly_mobile['nightly_header_info_bar_facebook_name'] );
 $nightly_header_info_bar['facebook']['link'] = html_entity_decode( $nightly_mobile['nightly_header_info_bar_facebook_link'] );
 $nightly_header_info_bar['twitter']['name'] = html_entity_decode( $nightly_mobile['nightly_header_info_bar_twitter_name'] );
 $nightly_header_info_bar['twitter']['link'] = html_entity_decode( $nightly_mobile['nightly_header_info_bar_twitter_link'] );
 
 if ( ( $nightly_header_info_bar['phone'] != "" ) ||
 ( $nightly_header_info_bar['sign'] != "" ) ||
 ( $nightly_header_info_bar['desktop'] != "" ) ||
 ( $nightly_header_info_bar['facebook']['link'] != "" ) ||
 ( $nightly_header_info_bar['twitter']['link'] != "" ) ) :
 
 ?>
	
			<div data-role="header"<?php if( $nightly_header_info_bar['fixed'] == true ) echo ' data-position="fixed"'; ?> data-border="false" class="header-info-bar" data-tap-toggle="false">
				 <div data-role="navbar">
			    	 <ul>
			    	        <?php
			    	        	if ( $nightly_header_info_bar['phone'] != "" ) {
			    	        		echo '<li><a href="tel:'.esc_html($nightly_header_info_bar['phone']).'"><i class="fa fa-phone fa-fw"></i><span>'.esc_html($nightly_header_info_bar['phone']).'</span></a></li>';
			    	        	}
			    	        	if ( $nightly_header_info_bar['sign'] == true ) {
			    	        		echo '<li><a href="'.esc_url(wp_login_url()).'"><i class="fa fa-user fa-fw"></i><span>'.esc_html__("Sign in", "nightly-mobile").'</span></a></li>';
			    	        	}
			    	        	if ( $nightly_header_info_bar['desktop'] != "" ) {
			    	        		echo '<li><a href="'.esc_url($nightly_header_info_bar['desktop']).'"><i class="fa fa-desktop fa-fw"></i><span>'.esc_html__("Desktop", "nightly-mobile").'</span></a></li>';
			    	        	}
			    	        	if ( $nightly_header_info_bar['facebook']['link'] != "" ) {
			    	        		echo '<li><a href="'.esc_url($nightly_header_info_bar['facebook']['link']).'"><i class="fa fa-facebook fa-fw"></i><span>'.esc_html($nightly_header_info_bar['facebook']['name']).'</span></a></li>';
			    	        	}
			    	        	if ( $nightly_header_info_bar['twitter']['link'] != "" ) {
			    	        		echo '<li><a href="'.esc_url($nightly_header_info_bar['twitter']['link']).'"><i class="fa fa-twitter fa-fw"></i><span>'.esc_html($nightly_header_info_bar['twitter']['name']).'</span></a></li>';
			    	        	}
			    	        ?>
			    	 </ul>
				 </div>
			</div>
	<?php
	endif;
	return false;
}
endif;




if ( ! function_exists( 'nightly_footer_info_bar' ) ) :
/**
 * Print HTML with footer info bar.
 * Connected with theme options panel. If no variable is set returns false
 *
 * @since Nightly 1.0
 *
 * @return string The HTML-formatted footer info bar.
 */
function nightly_footer_info_bar() {
	
	global $nightly_mobile;
	
	$nightly_footer_info_bar['fixed'] = html_entity_decode( $nightly_mobile['nightly_footer_info_bar_fixed'] );
	$nightly_footer_info_bar['phone'] = html_entity_decode( $nightly_mobile['nightly_footer_info_bar_phone'] );
	$nightly_footer_info_bar['map'] = html_entity_decode( $nightly_mobile['nightly_footer_info_bar_map'] );
	$nightly_footer_info_bar['email'] = html_entity_decode( $nightly_mobile['nightly_footer_info_bar_email'] );
	$nightly_footer_info_bar['facebook']['name'] = html_entity_decode( $nightly_mobile['nightly_footer_info_bar_facebook_name'] );
	$nightly_footer_info_bar['facebook']['link'] = html_entity_decode( $nightly_mobile['nightly_footer_info_bar_facebook_link'] );
	$nightly_footer_info_bar['twitter']['name'] = html_entity_decode( $nightly_mobile['nightly_footer_info_bar_twitter_name'] );
	$nightly_footer_info_bar['twitter']['link'] = html_entity_decode( $nightly_mobile['nightly_footer_info_bar_twitter_link'] );
	
	if ( ( $nightly_footer_info_bar['phone'] != "" ) ||
	( $nightly_footer_info_bar['map'] != "" ) ||
	( $nightly_footer_info_bar['email'] != "" ) ||
	( $nightly_footer_info_bar['facebook']['link'] != "" ) ||
	( $nightly_footer_info_bar['twitter']['link'] != "" ) ) :
	
	?>
	
		<div data-role="footer"<?php if( $nightly_footer_info_bar['fixed'] == true ) echo ' data-position="fixed"'; ?> data-border="false" data-tap-toggle="false" class="footer-info-bar">
		   <div data-role="navbar">
		       <ul>
		           <?php
		           	if ( $nightly_footer_info_bar['map'] != "" ) {
		           		echo '<li><a href="'.esc_url($nightly_footer_info_bar['map']).'"><i class="fa fa-map-marker fa-fw"></i><span>'.esc_html__("Map", "nightly-mobile").'</span></a></li>';
		           	}
		           	if ( $nightly_footer_info_bar['phone'] != "" ) {
		           		echo '<li><a href="tel:'.esc_url($nightly_footer_info_bar['phone']).'"><i class="fa fa-phone fa-fw"></i><span>'.esc_html__("Call", "nightly-mobile").'</span></a></li>';
		           	}
		           	if ( $nightly_footer_info_bar['email'] != "" ) {
		           		echo '<li><a href="mailto:'.esc_url($nightly_footer_info_bar['email']).'"><i class="fa fa-envelope fa-fw"></i><span>'.esc_html__("E-mail", "nightly-mobile").'</span></a></li>';
		           	}
		           	if ( $nightly_footer_info_bar['facebook']['link'] != "" ) {
		           		echo '<li><a href="'.esc_url($nightly_footer_info_bar['facebook']['link']).'"><i class="fa fa-facebook fa-fw"></i><span>'.esc_html($nightly_footer_info_bar['facebook']['name']).'</span></a></li>';
		           	}
		           	if ( $nightly_footer_info_bar['twitter']['link'] != "" ) {
		           		echo '<li><a href="'.esc_url($nightly_footer_info_bar['twitter']['link']).'"><i class="fa fa-twitter fa-fw"></i><span>'.esc_html($nightly_footer_info_bar['twitter']['name']).'</span></a></li>';
		           	}
		           ?>
		       </ul>
		   </div>
		</div>
	<?php
	endif;
	return false;
}
endif;




/**
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

function nightly_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 */
	$plugins = array(
	
		array(
			'name'               => 'Luke Shortcodes', // The plugin name.
			'slug'               => 'luke-shortcodes', // The plugin slug (typically the folder name).
			'source'             => esc_url( get_stylesheet_directory() . '/inc/plugins/luke-shortcodes.zip' ), // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		
		array(
			'name'               => 'Luke Slider', // The plugin name.
			'slug'               => 'luke-slider', // The plugin slug (typically the folder name).
			'source'             => esc_url( get_stylesheet_directory() . '/inc/plugins/luke-slider.zip' ), // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		)

	);

	/*
	 * Array of configuration settings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'nightly_register_required_plugins' );

?>