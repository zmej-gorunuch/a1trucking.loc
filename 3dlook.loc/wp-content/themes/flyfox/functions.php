<?php
// Стилі та скрипти ----------------------------------------------------------------------------------------------------
/**
 * Підключення стилів та скриптів
 */
add_action( 'wp_enqueue_scripts', 'flyfox_scripts' );
function flyfox_scripts() {
	// Підключення JQuery
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js', false, null, true );
	wp_enqueue_script( 'jquery' );

	// Підключення стилів
	wp_enqueue_style( 'Roboto_font_style', 'https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap', [] );
	wp_enqueue_style( 'Mark_font_style', get_template_directory_uri() . '/assets/fonts/Mark/font.css', [] );
	wp_enqueue_style( 'HelveticaNeue_font_style', get_template_directory_uri() . '/assets/fonts/HelveticaNeue/font.css', [] );
	wp_enqueue_style( 'fontello_style', get_template_directory_uri() . '/assets/icons/fontello/style.css', [] );
	wp_enqueue_style( 'slick_style', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', [] );
	wp_enqueue_style( 'main_style', get_template_directory_uri() . '/assets/styles/style.css', [] );
	wp_enqueue_style( 'custom_main_style', get_template_directory_uri() . '/style.css', [] );
	wp_enqueue_style( 'desc_style', get_template_directory_uri() . '/assets/styles/desc.css', [] );
	wp_enqueue_style( 'media_style', get_template_directory_uri() . '/assets/styles/media.css', [] );

	// Підключення скриптів
	wp_enqueue_script( 'jquery_migrate_script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.1.0/jquery-migrate.min.js', [], false, true );
	wp_enqueue_script( 'slick_script', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', [], false, true );
	wp_enqueue_script( 'main_script', get_template_directory_uri() . '/assets/scripts/script.js', [], false, true );
	wp_enqueue_script( 'custom_script', get_template_directory_uri() . '/js/custom-theme.js', [], false, true );
}

// Налаштування теми ---------------------------------------------------------------------------------------------------
/**
 * FlyFox functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FlyFox
 */
if ( ! function_exists( 'flyfox_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	add_action( 'after_setup_theme', 'flyfox_setup' );
	function flyfox_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FlyFox, use a find and replace
		 * to change 'flyfox' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'flyfox', get_template_directory() . '/languages' );
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
		register_nav_menus( [
			'menu-1' => esc_html__( 'Головне меню', 'flyfox' ),
		] );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		] );

		add_theme_support( 'custom-logo' );
	}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action( 'widgets_init', 'flyfox_widgets_init' );
function flyfox_widgets_init() {
	register_sidebar( [
		'name'          => esc_html__( 'Сайдбар', 'flyfox' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Додайте сюди віджети.', 'flyfox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );
}

// Підключення функцій теми --------------------------------------------------------------------------------------------
/**
 * Підключення файлу налаштувань адміністративної частини
 */
require get_template_directory() . '/theme-functions/functions-admin.php';

/**
 * Підключення файлу налаштувань меню
 */
require get_template_directory() . '/theme-functions/functions-menu.php';

/**
 * Підключення файлу налаштувань пагінації
 */
require get_template_directory() . '/theme-functions/functions-pagination.php';

/**
 * Підключення файлу перекладу PolyLang
 */
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'polylang/polylang.php' ) ) {
	require get_template_directory() . '/theme-functions/functions-polylang.php';
}

/**
 * Підключення файлу налаштувань Advanced Custom Fields
 */
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) || is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
	require get_template_directory() . '/theme-functions/functions-acf.php';
}

/**
 * Підключення файлу налаштувань Contact Form 7
 */
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) || is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
	require get_template_directory() . '/theme-functions/functions-contact-form-7.php';
}

// Допоміжні функції ---------------------------------------------------------------------------------------------------
/**
 * Заповнення атрибуту alt заголовком запису
 *
 * @param array $response
 *
 * @return array
 */
add_filter( 'wp_prepare_attachment_for_js', 'change_empty_alt_to_title' );
function change_empty_alt_to_title( $response ) {
	if ( ! $response['alt'] ) {
		$response['alt'] = sanitize_text_field( $response['uploadedToTitle'] );
	}

	return $response;
}

// Створення нових типів записів та таксономій -------------------------------------------------------------------------
/**
 * Вакансії ------------------------------------------------------------------------------------------------------------
 */
add_action( 'init', 'vacancy_type_init' );
function vacancy_type_init() {
	register_post_type( 'vacancy', [
		'labels'             => [
			'name'               => __( 'Vacancies', 'flyfox' ), // Основна назва типу запису
			'singular_name'      => __( 'Vacancy', 'flyfox' ), // Назва одного запису
			'add_new_item'       => __( 'Додати новий запис', 'flyfox' ),
			'edit_item'          => __( 'Редагувати запис', 'flyfox' ),
			'new_item'           => __( 'Новий запис', 'flyfox' ),
			'view_item'          => __( 'Переглянути запис', 'flyfox' ),
			'search_items'       => __( 'Знайти запис', 'flyfox' ),
			'not_found'          => __( 'Записів не знайдено', 'flyfox' ),
			'not_found_in_trash' => __( 'В корзині записів не знайдено', 'flyfox' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Vacancies', 'flyfox' ),
			'all_items'          => __( 'Всі записи', 'flyfox' ),
			'add_new'            => __( 'Додати', 'flyfox' ),

		],
		'public'             => true,
		'publicly_queryable' => true, // false - можливість додавати шаблон
		'show_ui'            => true,
		'show_in_menu'       => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => 6,
		'supports'           => [ 'title', 'editor', 'revisions' ],
		// title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions, page-attributes
		'menu_icon'          => 'dashicons-megaphone',
		'taxonomies'         => [ 'vacancy_city' ],
		// category, post_tag
	] );
}

add_action( 'init', 'create_vacancy_taxonomies' );
function create_vacancy_taxonomies() {
	register_taxonomy( 'vacancy_city', [ 'vacancy' ], [
		'hierarchical' => true,
		'labels'       => [
			'name'          => _x( 'Vacancies City', 'taxonomy general name' ),
			'singular_name' => _x( 'Vacancies City', 'taxonomy singular name' ),
			'menu_name'     => __( 'City' ),
		],
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => [ 'slug' => 'city', 'hierarchical' => true ], // свій слаг в URL
	] );
	register_taxonomy( 'vacancy_workload', [ 'vacancy' ], [
		'hierarchical' => false,
		'labels'       => [
			'name'          => _x( 'Vacancies Workload', 'taxonomy general name' ),
			'singular_name' => _x( 'Vacancies Workload', 'taxonomy singular name' ),
			'menu_name'     => __( 'Workload' ),
		],
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => [ 'slug' => 'workload', 'hierarchical' => true ], // свій слаг в URL
	] );
}

/**
 * Події ---------------------------------------------------------------------------------------------------------------
 */
add_action( 'init', 'event_type_init' );
function event_type_init() {
	register_post_type( 'event', [
		'labels'             => [
			'name'               => __( 'Events', 'flyfox' ), // Основна назва типу запису
			'singular_name'      => __( 'Event', 'flyfox' ), // Назва одного запису
			'add_new_item'       => __( 'Додати новий запис', 'flyfox' ),
			'edit_item'          => __( 'Редагувати запис', 'flyfox' ),
			'new_item'           => __( 'Новий запис', 'flyfox' ),
			'view_item'          => __( 'Переглянути запис', 'flyfox' ),
			'search_items'       => __( 'Знайти запис', 'flyfox' ),
			'not_found'          => __( 'Записів не знайдено', 'flyfox' ),
			'not_found_in_trash' => __( 'В корзині записів не знайдено', 'flyfox' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Events', 'flyfox' ),
			'all_items'          => __( 'Всі записи', 'flyfox' ),
			'add_new'            => __( 'Додати', 'flyfox' ),

		],
		'public'             => true,
		'publicly_queryable' => true, // false - можливість додавати шаблон
		'show_ui'            => true,
		'show_in_menu'       => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => 6,
		'supports'           => [ 'title', 'revisions' ],
		// title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions, page-attributes
		'menu_icon'          => 'dashicons-tickets-alt',
		'taxonomies'         => [],
		// category, post_tag
	] );
}

/**
 * Відгуки -------------------------------------------------------------------------------------------------------------
 */
add_action( 'init', 'review_type_init' );
function review_type_init() {
	register_post_type( 'review', [
		'labels'             => [
			'name'               => __( 'Reviews', 'flyfox' ), // Основна назва типу запису
			'singular_name'      => __( 'Review', 'flyfox' ), // Назва одного запису
			'add_new_item'       => __( 'Додати новий запис', 'flyfox' ),
			'edit_item'          => __( 'Редагувати запис', 'flyfox' ),
			'new_item'           => __( 'Новий запис', 'flyfox' ),
			'view_item'          => __( 'Переглянути запис', 'flyfox' ),
			'search_items'       => __( 'Знайти запис', 'flyfox' ),
			'not_found'          => __( 'Записів не знайдено', 'flyfox' ),
			'not_found_in_trash' => __( 'В корзині записів не знайдено', 'flyfox' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Reviews', 'flyfox' ),
			'all_items'          => __( 'Всі записи', 'flyfox' ),
			'add_new'            => __( 'Додати', 'flyfox' ),

		],
		'public'             => true,
		'publicly_queryable' => true, // false - можливість додавати шаблон
		'show_ui'            => true,
		'show_in_menu'       => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => 6,
		'supports'           => [ 'title', 'revisions' ],
		// title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions, page-attributes
		'menu_icon'          => 'dashicons-format-status',
		'taxonomies'         => [],
		// category, post_tag
	] );
}

/**
 * Команда ------------------------------------------------------------------------------------------------------------
 */
add_action( 'init', 'team_type_init' );
function team_type_init() {
	register_post_type( 'team', [
		'labels'             => [
			'name'               => __( 'Teams', 'flyfox' ), // Основна назва типу запису
			'singular_name'      => __( 'Team', 'flyfox' ), // Назва одного запису
			'add_new_item'       => __( 'Додати новий запис', 'flyfox' ),
			'edit_item'          => __( 'Редагувати запис', 'flyfox' ),
			'new_item'           => __( 'Новий запис', 'flyfox' ),
			'view_item'          => __( 'Переглянути запис', 'flyfox' ),
			'search_items'       => __( 'Знайти запис', 'flyfox' ),
			'not_found'          => __( 'Записів не знайдено', 'flyfox' ),
			'not_found_in_trash' => __( 'В корзині записів не знайдено', 'flyfox' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Teams', 'flyfox' ),
			'all_items'          => __( 'Всі записи', 'flyfox' ),
			'add_new'            => __( 'Додати', 'flyfox' ),

		],
		'public'             => true,
		'publicly_queryable' => true, // false - можливість додавати шаблон
		'show_ui'            => true,
		'show_in_menu'       => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => 6,
		'supports'           => [ 'title', 'revisions' ],
		// title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions, page-attributes
		'menu_icon'          => 'dashicons-groups',
		'taxonomies'         => [ 'team_cat' ],
		// category, post_tag
	] );
}

add_action( 'init', 'create_team_taxonomies' );
function create_team_taxonomies() {
	register_taxonomy( 'team_cat', [ 'team' ], [
		'hierarchical' => true,
		'labels'       => [
			'name'          => _x( 'Team category', 'taxonomy general name' ),
			'singular_name' => _x( 'Team category', 'taxonomy singular name' ),
			'menu_name'     => __( 'Category' ),
		],
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => [ 'slug' => 'team_cat', 'hierarchical' => true ], // свій слаг в URL
	] );
}