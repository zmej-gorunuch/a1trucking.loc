<?php
// Стилі та скрипти ----------------------------------------------------------------------------------------------------
/**
 * Підключення стилів та скриптів
 */
function flyfox_scripts() {
	// Підключення стилів
	wp_enqueue_style( 'magnific-popup_style', get_template_directory_uri() . '/css/magnific-popup.css', array() );
	wp_enqueue_style( 'main_style', get_template_directory_uri() . '/css/main.css', array() );
	wp_enqueue_style( 'custom_main_style', get_template_directory_uri() . '/style.css', array() );

	// Підключення скриптів
	wp_enqueue_script( 'jquery_script', get_template_directory_uri() . '/js/libs/jquery-3.4.1.js', array(), false, true );
	wp_enqueue_script( 'flickity.pkgd_script', get_template_directory_uri() . '/js/libs/flickity.pkgd.min.js', array(), false, true );
	wp_enqueue_script( 'jquery.magnific-popup_script', get_template_directory_uri() . '/js/libs/jquery.magnific-popup.min.js', array(), false, true );
	wp_enqueue_script( 'magnific-popup_script', get_template_directory_uri() . '/js/magnific-popup.min.js', array(), false, true );
	wp_enqueue_script( 'sliders_script', get_template_directory_uri() . '/js/sliders.min.js', array(), false, true );
	wp_enqueue_script( 'js_berkom_script', get_template_directory_uri() . '/js/js_berkom.min.js', array(), false, true );
	wp_enqueue_script( 'custom_script', get_template_directory_uri() . '/js/custom-theme.js', array(), false, true );
	if ( is_page_template( 'template-pages/contact.php' ) ) {
		wp_enqueue_script( 'map_script', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCozA4Diei7ysgybvm_i1ZONMegqd6mhhI', array(), false, true );
		wp_enqueue_script( 'googleMaps_script', get_template_directory_uri() . '/js/googleMaps.min.js', array(), false, true );
	}
}

add_action( 'wp_enqueue_scripts', 'flyfox_scripts' );

// Допоміжні функції ---------------------------------------------------------------------------------------------------
/**
 * Форматування номера телефону
 *
 * @param $phone
 */
function the_call_phone( $phone ) {
	if ( ! empty( $phone ) ) {
		echo 'tel:+' . preg_replace( '![^0-9]+!', '', $phone );
	}
}

/**
 * Отримання посилання на сторінку з певним шаблоном
 *
 * Шаблони розташовані в папці template-pages
 *
 * @param $template_name
 */
function the_page_link( $template_name ) {
	$page = get_pages( array(
		'meta_key'     => '_wp_page_template',
		'meta_value'   => 'template-pages/' . $template_name . '.php',
		'hierarchical' => 0
	) );
	if ( ! empty( $page ) ) {
		echo get_permalink( $page[0]->ID );
	}
}

/**
 * Обрізка тексту (excerpt). Мінімальне значення maxchar може бути 22
 *
 * @param string/array $args Параметри.
 *
 * @return string HTML
 */
function custom_excerpt( $args = '' ) {
	global $post;

	if ( is_string( $args ) ) {
		parse_str( $args, $args );
	}

	$rg = (object) array_merge( array(
		'maxchar'   => 350,   // Макс. кількість символів
		'text'      => '',    // Який текст обрізати (по замовчуванню post_excerpt, якщо немає post_content.
		// якщо в тексті є `<!--more-->`, то `maxchar` ігнорується і береться все до <!--more--> разом з HTML.
		'autop'     => true,  // Замінити переноси рядків на <p> і <br>
		'save_tags' => '',    // Теги, які потрібно залишити в тексті, наприклад '<strong><b><a>'.
		'more_text' => 'Читати далі...', // Текст посилання `Читати далі`.
	), $args );

	$rg = apply_filters( 'custom_excerpt_args', $rg );

	if ( ! $rg->text ) {
		$rg->text = $post->post_excerpt ?: $post->post_content;
	}

	$text = $rg->text;
	$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text ); // забираємо шорткоди: [foo]some data[/foo]. Враховує markdown
	$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text ); // забираємо шоткоди: [singlepic id=3]. Враховує markdown
	$text = trim( $text );

	// <!--more-->
	if ( strpos( $text, '<!--more-->' ) ) {
		preg_match( '/(.*)<!--more-->/s', $text, $mm );
		$text        = trim( $mm[1] );
		$text_append = ' <a href="' . get_permalink( $post ) . '#more-' . $post->ID . '">' . $rg->more_text . '</a>';
	} // text, excerpt, content
	else {
		$text = trim( strip_tags( $text, $rg->save_tags ) );

		// Обрізаємо
		if ( mb_strlen( $text ) > $rg->maxchar ) {
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // забираємо останнє слово
		}
	}

	// Зберігаємо переноси рядків
	if ( $rg->autop ) {
		$text = preg_replace(
			array( "/\r/", "/\n{2,}/", "/\n/", '~</p><br ?/?>~' ),
			array( '', '</p><p>', '<br />', '</p>' ),
			$text
		);
	}

	$text = apply_filters( 'custom_excerpt', $text, $rg );

	if ( isset( $text_append ) ) {
		$text .= $text_append;
	}

	return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
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
		register_nav_menus( array(
			'menu-ua'        => esc_html__( 'Primary', 'flyfox' ),
			'menu-footer-ua' => esc_html__( 'Footer', 'flyfox' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'flyfox_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flyfox_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'flyfox' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'flyfox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'flyfox_widgets_init' );

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
 * Підключення файлу налаштувань ACF
 */
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) || is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
	require get_template_directory() . '/theme-functions/functions-acf.php';
}

// Зміна стандартних записів -------------------------------------------------------------------------------------------
/**
 * Відкріплення міток від записів та відключення коментарів
 */
add_action( 'init', 'prefix_unregister_tags', 99 );
function prefix_unregister_tags() {
	unregister_taxonomy_for_object_type( 'post_tag', 'post' );
	unregister_taxonomy_for_object_type( 'category', 'post' );
	remove_post_type_support( 'post', 'comments' );
}

/**
 * Зміна назви та інших параметрів post
 *
 * @param $args
 * @param $post_type
 *
 * @return mixed
 */
function filter_register_post_type_args( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['labels']        = array(
			'name'               => __( 'Статті', 'flyfox' ),
			'singular_name'      => __( 'Стаття', 'flyfox' ),
			'add_new_item'       => __( 'Додати новий запис', 'flyfox' ),
			'edit_item'          => __( 'Редагувати запис', 'flyfox' ),
			'new_item'           => __( 'Новий запис', 'flyfox' ),
			'view_item'          => __( 'Переглянути запис', 'flyfox' ),
			'search_items'       => __( 'Знайти запис', 'flyfox' ),
			'not_found'          => __( 'Записів не знайдено', 'flyfox' ),
			'not_found_in_trash' => __( 'В корзині записів не знайдено', 'flyfox' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Блог', 'flyfox' ),
			'all_items'          => __( 'Всі записи', 'flyfox' ),
			'add_new'            => __( 'Додати', 'flyfox' ),
		);
		$args['menu_icon']     = 'dashicons-welcome-write-blog';
		$args['menu_position'] = 9;
	}

	return $args;
}

add_filter( 'register_post_type_args', 'filter_register_post_type_args', 10, 2 );

// Створення нового типу записів ---------------------------------------------------------------------------------------
/**
 * Товари --------------------------------------------------------------------------------------------------------------
 */
function product_type_init() {
	register_post_type( 'product', array(
		'labels'             => array(
			'name'               => __( 'Товари', 'flyfox' ), // Основна назва типу запису
			'singular_name'      => __( 'Товар', 'flyfox' ), // Назва одного запису
			'add_new_item'       => __( 'Додати новий запис', 'flyfox' ),
			'edit_item'          => __( 'Редагувати запис', 'flyfox' ),
			'new_item'           => __( 'Новий запис', 'flyfox' ),
			'view_item'          => __( 'Переглянути запис', 'flyfox' ),
			'search_items'       => __( 'Знайти запис', 'flyfox' ),
			'not_found'          => __( 'Записів не знайдено', 'flyfox' ),
			'not_found_in_trash' => __( 'В корзині записів не знайдено', 'flyfox' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Товари', 'flyfox' ),
			'all_items'          => __( 'Всі записи', 'flyfox' ),
			'add_new'            => __( 'Додати', 'flyfox' ),

		),
		'public'             => true,
		'publicly_queryable' => true, // false - можливість додавати шаблон
		'show_ui'            => true,
		'show_in_menu'       => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'revisions' ),
		// title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions, page-attributes
		'menu_icon'          => 'dashicons-archive',
		'taxonomies'         => array( 'catalog_cat' ),
		// category, post_tag
	) );
}

add_action( 'init', 'product_type_init' );

function create_product_taxonomies() {
	register_taxonomy( 'catalog_cat', array( 'product' ), array(
		'hierarchical' => true,
		'labels'       => array(
			'name'              => _x( 'Категорії продуктів', 'taxonomy general name' ),
			'singular_name'     => _x( 'Категорія', 'taxonomy singular name' ),
			'search_items'      => __( 'Пошук категорії' ),
			'all_items'         => __( 'Всі категорії' ),
			'parent_item'       => __( 'Батьківська категорія' ),
			'parent_item_colon' => __( 'Parent category:' ),
			'edit_item'         => __( 'Редагувати категорію' ),
			'update_item'       => __( 'Оновити категорію' ),
			'add_new_item'      => __( 'Додати категорію' ),
			'new_item_name'     => __( 'New category name' ),
			'menu_name'         => __( 'Категорії' ),
		),
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'catalog', 'hierarchical' => true ), // свій слаг в URL
	) );
}

add_action( 'init', 'create_product_taxonomies' );

/**
 * Сортування постів по категорії
 */
function product_taxonomy_filter() {
	global $typenow; // тип поста
	if ( $typenow == 'product' ) { // для яких типів постів відображати
		$taxes = array( 'catalog_cat' ); // таксономії через кому
		foreach ( $taxes as $tax ) {
			$current_tax = isset( $_GET[ $tax ] ) ? $_GET[ $tax ] : '';
			$tax_obj     = get_taxonomy( $tax );
			$tax_name    = mb_strtolower( $tax_obj->labels->name );
			$terms       = get_terms( $tax );
			if ( count( $terms ) > 0 ) {
				echo "<select name='$tax' id='$tax' class='postform'>";
				echo "<option value=''>Всі $tax_name</option>";
				foreach ( $terms as $term ) {
					echo '<option value=' . $term->slug, $current_tax == $term->slug ? ' selected="selected"' : '', '>' . $term->name . '</option>';
				}
				echo "</select>";
			}
		}
	}
}

add_action( 'restrict_manage_posts', 'product_taxonomy_filter' );

/**
 * Галерея -------------------------------------------------------------------------------------------------------------
 */
function gallery_type_init() {
	register_post_type( 'gallery', array(
		'labels'              => array(
			'name'               => __( 'Галереї', 'flyfox' ), // Основна назва типу запису
			'singular_name'      => __( 'Галерея', 'flyfox' ), // Назва одного запису
			'add_new_item'       => __( 'Додати новий запис', 'flyfox' ),
			'edit_item'          => __( 'Редагувати запис', 'flyfox' ),
			'new_item'           => __( 'Новий запис', 'flyfox' ),
			'view_item'          => __( 'Переглянути запис', 'flyfox' ),
			'search_items'       => __( 'Знайти запис', 'flyfox' ),
			'not_found'          => __( 'Записів не знайдено', 'flyfox' ),
			'not_found_in_trash' => __( 'В корзині записів не знайдено', 'flyfox' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Галерея', 'flyfox' ),
			'all_items'          => __( 'Всі записи', 'flyfox' ),
			'add_new'            => __( 'Додати', 'flyfox' ),

		),
		'public'              => true,
		'publicly_queryable'  => true, // false - можливість додавати шаблон
		'show_ui'             => true,
		'show_in_menu'        => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'has_archive'         => true,
		'hierarchical'        => true,
		'menu_position'       => 6,
		'exclude_from_search' => false,
		'supports'            => array( 'title', 'revisions', 'page-attributes' ),
		// title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions, page-attributes
		'menu_icon'           => 'dashicons-format-gallery',
		'taxonomies'          => array(),
		// category, post_tag
	) );
}

add_action( 'init', 'gallery_type_init' );

/**
 * Послуги -------------------------------------------------------------------------------------------------------------
 */
function service_type_init() {
	register_post_type( 'service', array(
		'labels'              => array(
			'name'               => __( 'Послуги', 'flyfox' ), // Основна назва типу запису
			'singular_name'      => __( 'Послуга', 'flyfox' ), // Назва одного запису
			'add_new_item'       => __( 'Додати новий запис', 'flyfox' ),
			'edit_item'          => __( 'Редагувати запис', 'flyfox' ),
			'new_item'           => __( 'Новий запис', 'flyfox' ),
			'view_item'          => __( 'Переглянути запис', 'flyfox' ),
			'search_items'       => __( 'Знайти запис', 'flyfox' ),
			'not_found'          => __( 'Записів не знайдено', 'flyfox' ),
			'not_found_in_trash' => __( 'В корзині записів не знайдено', 'flyfox' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Послуги', 'flyfox' ),
			'all_items'          => __( 'Всі записи', 'flyfox' ),
			'add_new'            => __( 'Додати', 'flyfox' ),

		),
		'public'              => true,
		'publicly_queryable'  => true, // false - можливість додавати шаблон
		'show_ui'             => true,
		'show_in_menu'        => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => true,
		'menu_position'       => 6,
		'exclude_from_search' => false,
		'supports'            => array( 'title', 'editor', 'revisions' ),
		// title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions, page-attributes
		'menu_icon'           => 'dashicons-admin-tools',
		'taxonomies'          => array(),
		// category, post_tag
	) );
}

add_action( 'init', 'service_type_init' );

/**
 * Видалення типу поста з url
 *
 * @param $post_link
 * @param $post
 * @param $leavename
 *
 * @return string|string[]
 */
function games_remove_slug( $post_link, $post, $leavename ) {
	if ( 'service' != $post->post_type || 'publish' != $post->post_status ) {
		return $post_link;
	}
	$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

	return $post_link;
}

add_filter( 'post_type_link', 'games_remove_slug', 10, 3 );

function games_parse_request( $query ) {
	if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
		return;
	}
	if ( ! empty( $query->query['name'] ) ) {
		$query->set( 'post_type', array( 'post', 'service', 'page' ) );
	}
}

add_action( 'pre_get_posts', 'games_parse_request' );

/**
 * Перенаправлення на сторінку подяки
 */
function cf7_footer_script() { ?>

    <script>
        $(document).on('wpcf7mailsent', function (event) {
            location = '<?php echo get_the_permalink( pll_get_post( 668 ) ); ?>';
        });
    </script>
<?php }

add_action( 'wp_footer', 'cf7_footer_script', 30 );