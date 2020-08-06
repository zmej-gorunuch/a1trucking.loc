<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------
/**
 * Підключення скриптів в адмін панель
 */
add_action( 'admin_enqueue_scripts', 'admin_style' );
function admin_style() {
	wp_enqueue_style( 'admin-styles', get_stylesheet_directory_uri() . '/css/admin-css/custom-admin.css' );
}

// Оптимізація ---------------------------------------------------------------------------------------------------------
/**
 * Якщо виключений Debug режим, підключається оптимізація
 */
if ( WP_DEBUG === false ) {
	// Оптимізація скриптів
	define( 'WP_POST_REVISIONS', 5 );
	define( 'WP_CACHE', true );
	define( 'COMPRESS_CSS', true );
	define( 'COMPRESS_SCRIPTS', true );
	define( 'CONCATENATE_SCRIPTS', true );
	define( 'ENFORCE_GZIP', true );
} else {
	function debug( $value, $exit = true ) {
		echo '<pre>';
		var_dump( $value );
		echo '</pre>';
		if ( $exit ) {
			exit();
		}
	}
}

/**
 * Відключення постійних перевірок на оновлення
 *
 * оновлення будуть працювати в фоновому режимі
 */
if ( is_admin() ) {
	// відключення перевірки при заході в адмінку
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );
	// відключення перевірки при заході на спец сторінку
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-themes.php', 'wp_update_themes' );
	// відключення перевірки оновлення браузера
	add_filter( 'pre_site_transient_browser_' . md5( $_SERVER['HTTP_USER_AGENT'] ), '__return_true' );
}

// Налаштування меню ---------------------------------------------------------------------------------------------------
/**
 * Відключення пунктів меню
 */
add_action( 'admin_menu', 'remove_admin_menu' );
function remove_admin_menu() {
	// Основні пункти меню
//		remove_menu_page( 'index.php' ); // Майстерня
//		remove_menu_page('options-general.php'); // Налаштування
//		remove_menu_page('tools.php'); // Інструменти
//		remove_menu_page('plugins.php'); // Плагіни
//		remove_menu_page('themes.php'); // Вигляд
//		remove_menu_page('wpcf7');   // Contact form 7
//		remove_menu_page('users.php'); // Користувачі
//		remove_menu_page('edit.php'); // Пости
//		remove_menu_page('upload.php'); // Медіафайли
//		remove_menu_page('edit.php?post_type=page'); // Сторінки
//		remove_menu_page('edit-comments.php'); // Коментарі
//		remove_menu_page( 'edit.php?post_type=acf-field-group' ); // Додаткові поля
	// Підпункти меню
//		remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page'); // Додати нову сторінку
}

/**
 * Винесення пункту меню
 */
add_action( 'admin_menu', 'new_nav_menu' );
function new_nav_menu() {
	global $menu;
	add_menu_page(
		esc_html__( 'Меню', 'flyfox' ),
		esc_html__( 'Меню', 'flyfox' ),
		'edit_themes',
		'nav-menus.php',
		'',
		'dashicons-networking',
		'59.2'
	);
	// Додаю розділювач
	$menu['59.9'] = array(
		0   =>  '',
		1   =>  'read',
		2   =>  'separator 59.9',
		3   =>  '',
		4   =>  'wp-menu-separator'
	);
}

// Налаштування адмінбару ----------------------------------------------------------------------------------------------
/**
 * Відключення пунктів адмінбару
 */
add_action( 'wp_before_admin_bar_render', 'wph_new_toolbar' );
function wph_new_toolbar() {
	global $wp_admin_bar;
	// Відключення верхнбого адмін бару
	show_admin_bar( false );

	// Відключення пунктів
	$wp_admin_bar->remove_menu( 'comments' ); // меню "коментарі"
	$wp_admin_bar->remove_menu( 'edit' ); // меню "редагувати запис"
	$wp_admin_bar->remove_menu( 'new-content' ); // меню "добавити"
	$wp_admin_bar->remove_menu( 'updates' ); // меню "оновлення"
	$wp_admin_bar->remove_menu( 'customize' ); // налаштування теми (customizer)
	$wp_admin_bar->remove_menu( 'dashboard' ); // майстерня
	$wp_admin_bar->remove_menu( 'themes' ); // налаштування теми
	$wp_admin_bar->remove_menu( 'widgets' ); // налаштування віджетів
	$wp_admin_bar->remove_menu( 'menus' ); // налаштування меню

	// Відключення логотипу WP
	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'about' );
	$wp_admin_bar->remove_menu( 'wporg' );
	$wp_admin_bar->remove_menu( 'documentation' );
	$wp_admin_bar->remove_menu( 'support-forums' );
	$wp_admin_bar->remove_menu( 'feedback' );
	$wp_admin_bar->remove_menu( 'view-site' );
}

/**
 * Власний логотип в адмін панелі
 */
if ( has_custom_logo() ) {
	add_action( 'login_enqueue_scripts', 'change_admin_logo' );
	function change_admin_logo() {
		if ( has_custom_logo() ) {
			$custom_logo__url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'medium' )[0];
		} ?>
		
		<style type="text/css">
			.login h1 a {
				background: url("<?php echo $custom_logo__url; ?>") center /contain no-repeat !important;
				width: 300px !important;
			}
		</style>
	<?php }
	
	add_filter( 'login_headerurl', 'change_admin_logo_url' );
	function change_admin_logo_url() {
		return home_url( '/' ); /* ссылка */
	}
}
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) || is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
	if ( ! empty( get_field( 'header', 'option' )['logo'] ) ) {
		add_action( 'login_enqueue_scripts', 'change_admin_logo' );
		function change_admin_logo() {
			if ( ! empty( get_field( 'header', 'option' )['logo'] ) ) {
				$custom_logo__url = get_field( 'header', 'option' )['logo'];
			} ?>
			
			<style type="text/css">
				.login h1 a {
					background: url("<?php echo $custom_logo__url; ?>") center /contain no-repeat !important;
					width: 300px !important;
				}
			</style>
		<?php }
		
		add_filter( 'login_headerurl', 'change_admin_logo_url' );
		function change_admin_logo_url() {
			return home_url( '/' ); /* ссылка */
		}
	}
}

// Налаштування головної сторінки (Майстерня) --------------------------------------------------------------------------
/**
 * Видалення віджетів на головній сторінці (Майстерня)
 */
add_action( 'wp_dashboard_setup', 'clear_dash', 99 );
function clear_dash() {
	$side   = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
	$normal = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];
	// die( print_r($GLOBALS['wp_meta_boxes']['dashboard']) ); // дивимось що є...

	$remove = [
		'dashboard_activity', // діяльність
		'dashboard_primary',  // Новини та заходи WordPress
		'dashboard_quick_press',  // Швидка чернетка
//		'dashboard_right_now',  // На виду
	];
	foreach ( $remove as $id ) {
		unset( $side[ $id ], $normal[ $id ] ); // или $side или $normal
	}

	// видалення welcome панелі
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
}

// Налаштування блоку таксономій на сторінці записів -------------------------------------------------------------------
/**
 * Видалення табів "Всі категорії" і "Популярні" з таксономій
 */
add_action( 'admin_print_footer_scripts', 'hide_tax_metabox_tabs_admin_styles', 99 );
function hide_tax_metabox_tabs_admin_styles() {
	$cs = get_current_screen();
	if ( $cs->base !== 'post' || empty( $cs->post_type ) ) {
		return;
	}
	?>
    <style>
        .postbox div.tabs-panel {
            max-height: 1200px;
            border: 0;
        }

        .category-tabs {
            display: none;
        }
    </style>
	<?php
}

/**
 * Зміна checkbox на radio в таксономіях
 *
 * дозволяє вибір тільки одної таксономії
 */
add_action( 'admin_print_footer_scripts', 'func_hook_admin_footer_scripts', 99 );
function func_hook_admin_footer_scripts() {
	if ( get_current_screen()->base !== 'post' ) {
		return;
	}
	?>
    <script>
        ['product_cat'].forEach(function (taxname) {
            jQuery('#' + taxname + 'div input[type="checkbox"]').prop('type', 'radio');
        })
    </script>
	<?php
}

/**
 * Відміна показу вибраної таксономії вверху списку
 */
add_filter( 'wp_terms_checklist_args', 'set_checked_ontop_default', 10 );
function set_checked_ontop_default( $args ) {
	if ( ! isset( $args['checked_ontop'] ) ) {
		$args['checked_ontop'] = false;
	}

	return $args;
}

/**
 * Фільтр для таксономій в метабоксі
 *
 * дозволяє шукати таксономії по назві
 */
add_action( 'admin_print_scripts', 'my_admin_term_filter', 99 );
function my_admin_term_filter() {
	$screen = get_current_screen();

	if ( 'post' !== $screen->base ) {
		return;
	} // тільки для сторінки редагування будь якого запису
	?>
    <script>
        jQuery(document).ready(function ($) {
            let $categoryDivs = $('.categorydiv');

            $categoryDivs.prepend('<input type="search" class="fc-search-field" style="position:relative;width:100%" /><span style="position:absolute;right:15px;top:5px" class="dashicons dashicons-search"></span>');

            $categoryDivs.on('keyup search', '.fc-search-field', function (event) {

                var searchTerm = event.target.value,
                    $listItems = $(this).parent().find('.categorychecklist li');

                if ($.trim(searchTerm)) {
                    $listItems.hide().filter(function () {
                        return $(this).text().toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
                    }).show();
                } else {
                    $listItems.show();
                }
            });
        });
    </script>
	<?php
}

// Допоміжні функції ---------------------------------------------------------------------------------------------------
/**
 * Відключення редактора блоків (Гутенберг)
 *
 * ВАЖЛИВО! коли вийдуть віджети для блоків або щось ще, цей рядок потрібно буде розкоментувати
 * remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' )
 */
if ( 'disable_gutenberg' ) {
	add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );

	remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );

	add_action( 'admin_init', function () {
		remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
		add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
	} );
}

/**
 * Відключити візуальний редактор та зображення з сторінок
 */
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
	if ( ! empty( $_GET['post'] ) ) {
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
		if ( ! isset( $post_id ) ) {
			return;
		}
		$page_title    = get_the_title( $post_id );
		$page_template = get_post_meta( $post_id, '_wp_page_template', true );
		// Відключення зображення сторінки
		if ( 'template-pages/home.php' == $page_template ) {
			remove_post_type_support( 'page', 'thumbnail' ); // відкл. зображення сторінки
		}
		// Відключення редактора сторінки
		if ( 'template-pages/gallery.php' == $page_template ) {
			remove_post_type_support( 'page', 'editor' ); // відкл. редактор
		}
	}
}