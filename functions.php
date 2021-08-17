<?php
/**
 * frondendie functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package frondendie
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

if ( ! function_exists( 'frondendie_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function frondendie_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on frondendie, use a find and replace
		 * to change 'frondendie' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'frondendie', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'frondendie' ),
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
				'frondendie_custom_background_args',
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

		add_theme_support('woocommerce');

	}
endif;
add_action( 'after_setup_theme', 'frondendie_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function frondendie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'frondendie_content_width', 640 );
}
add_action( 'after_setup_theme', 'frondendie_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function frondendie_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'frondendie' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'frondendie' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'frondendie_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function frondendie_scripts() {
	wp_enqueue_style( 'frondendie-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'frondendie-style', 'rtl', 'replace' );

	// wp_style_add_data( 'galaxyr-style', 'rtl', 'replace' );
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'instagramFeed', get_template_directory_uri() . '/js/jquery.instagramFeed.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'modal', get_template_directory_uri() . '/js/modal.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'site-js', get_template_directory_uri() . '/js/function.js', array('jquery'), _S_VERSION, true );


	if (is_page(574)) {
		// wp_enqueue_script( 'wp-api' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'frondendie_scripts' );

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
 * Customizer additions.
 */
require get_template_directory() . '/woocommerce/wc-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_action( 'init', function () {
	SCF::add_options_page( 'Популярные категории', 'Популярные категории', 'manage_options', 'popular-cats', 'dashicons-megaphone', 21 );
	SCF::add_options_page( 'Наши видео', 'Наши видео', 'manage_options', 'ours-video', 'dashicons-video-alt3', 22 );
	SCF::add_options_page( 'О нас', 'О нас', 'manage_options', 'about-us', 'dashicons-format-status', 23 );
	SCF::add_options_page( 'Настройки сайта', 'Настройки сайта', 'manage_options', 'site-settings', '', 51 );
} );


/**
* Set video
*/
require get_template_directory() . '/inc/videoLine.php';


function true_breadcrumbs(){

	// получаем номер текущей страницы
	$page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$separator = ''; //  разделяем обычным слэшем, но можете чем угодно другим

	echo "<ul class='breadcrumb'>";

	// если главная страница сайта
	if( is_front_page() ){

		if( $page_num > 1 ) {
			echo '<a href="' . site_url() . '">Главная</a>' . $separator . $page_num . '-я страница';
		} else {
			echo '<li>Вы находитесь на главной странице</li>';
		}

	} else { // не главная

		echo '<li><a href="' . site_url() . '">Главная</a></li>' . $separator;


		if( is_single() ){ // записи

			the_category( ', ' ); echo $separator; the_title();

		} elseif ( is_page() ){ // страницы WordPress
			echo "<li>";
			the_title();
			echo "</li>";

		} elseif ( is_category() ) {

			echo "<li>";
			single_cat_title();
			echo "</li>";

		} elseif( is_tag() ) {

			echo "<li>";
			single_tag_title();
			echo "</li>";

		} elseif ( is_day() ) { // архивы (по дням)

			echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>' . $separator;
			echo '<li><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></li>' . $separator;
			echo "<li>";
			echo get_the_time('d');
			echo "</li>";

		} elseif ( is_month() ) { // архивы (по месяцам)

			echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>' . $separator;
			echo "<li>";
			echo get_the_time('F');
			echo "</li>";

		} elseif ( is_year() ) { // архивы (по годам)

			echo "<li>";
			echo get_the_time( 'Y' );
			echo "</li>";

		} elseif ( is_author() ) { // архивы по авторам

			global $author;
			$userdata = get_userdata( $author );
			echo "<li>";
			echo 'Опубликовал(а) ' . $userdata->display_name;
			echo "</li>";

		} elseif ( is_404() ) { // если страницы не существует

			echo "<li>";
			echo 'Ошибка 404';
			echo "</li>";

		}

		if ( $page_num > 1 ) { // номер текущей страницы
			echo "<li>";
			echo ' (' . $page_num . '-я страница)';
			echo "</li>";
		}

	}
	echo "</ul>";

}


if (is_admin()) {
	add_filter('post_type_labels_post', 'rename_posts_labels');
	function rename_posts_labels( $labels ){

		$new = array(
			'name'                  => 'Отзывы',
			'singular_name'         => 'Отзыв',
			'add_new'               => 'Добавить отзыв',
			'add_new_item'          => 'Добавить отзыв',
			'edit_item'             => 'Редактировать отзыв',
			'new_item'              => 'Новый отзыв',
			'view_item'             => 'Просмотреть отзыв',
			'search_items'          => 'Поиск отзывов',
			'not_found'             => 'Отзывов не найдено.',
			'not_found_in_trash'    => 'Отзывов в корзине не найдено.',
			'parent_item_colon'     => '',
			'all_items'             => 'Все отзывы',
			'archives'              => 'Архивы отзывов',
			'insert_into_item'      => 'Вставить в отзыв',
			'uploaded_to_this_item' => 'Загруженные для этой отзывы',
			'featured_image'        => 'Миниатюра отзывы',
			'filter_items_list'     => 'Фильтровать список отзывов',
			'items_list_navigation' => 'Навигация по списку отзывов',
			'items_list'            => 'Список отзывов',
			'menu_name'             => 'Отзывы',
			'name_admin_bar'        => 'Отзыв', // пункте "добавить"
		);

		return (object) array_merge( (array) $labels, $new );
	}

	add_action('admin_menu', 'remove_menus');
	function remove_menus(){
		global $menu;
		$restricted = array(
			// __('Dashboard'),
			// __('Posts'),
			// __('Media'),
			__('Links'),
			// __('Pages'),
			// __('Appearance'),
			__('Tools'),
			__('Users'),
			// __('Settings'),
			__('Comments'),
			__('BeRocket'),
			__('smart-custom-fields'),
			// __('Plugins')
		);
		end ($menu);
		while (prev($menu)){
			$value = explode(' ', $menu[key($menu)][0]);
			if( in_array( ($value[0] != NULL ? $value[0] : "") , $restricted ) ){
				unset($menu[key($menu)]);
			}
		}
	}


	// function wpse_custom_menu_order( $menu_ord ) {
    // if ( !$menu_ord ) return true;
	//
	//     return array(
	//         'index.php', // Dashboard
	//         'separator1', // First separator
	//         'link-manager.php', // Links
	//         'edit.php?post_type=page', // Pages
	//         'edit.php?post_type=product', // Product
	// 		'admin.php?page=popular-cats',
	// 		'admin.php?page=ours-video',
	// 		'admin.php?page=about-us',
	// 		'edit.php', // Posts
	// 		'separator2', // First separator
	// 		'upload.php', // Media
	// 		'admin.php?page=site-settings', // Settings
	// 		'admin.php?page=wc-admin', // Settings
	// 		'themes.php', // Appearance
	//         'options-general.php', // Settings
	// 		'users.php', // Users
	// 		'tools.php', // Tools
	// 		'plugins.php', // Plugins
	// 		'edit.php?post_type=smart-custom-fields', // Plugins
	// 		'admin.php?page=wpcf7', //
	// 		'separator-last', // Last separator
	//     );
	// }
	// add_filter( 'custom_menu_order', 'wpse_custom_menu_order', 10, 1 );
	// add_filter( 'menu_order', 'wpse_custom_menu_order', 10, 1 );
}

add_filter( 'excerpt_length', function(){
	return 300;
} );

add_filter('excerpt_more', function($more) {
	return '';
});
