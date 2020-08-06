<?php
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
}

/**
 * Відключення пунктів меню
 */
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
	remove_menu_page( 'edit-comments.php' ); // Коментарі
//		remove_menu_page( 'edit.php?post_type=acf-field-group' ); // Додаткові поля
	// Підпункти меню
//		remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page'); // Додати нову сторінку
}

add_action( 'admin_menu', 'remove_admin_menu' );

/**
 * Відключення пунктів адмінбару
 */
function wph_new_toolbar() {
	global $wp_admin_bar;
	// Відключення верхнбого адмін бару
	show_admin_bar( false );

	// Відключення пунктів
	$wp_admin_bar->remove_menu( 'comments' ); //меню "коментарі"
	$wp_admin_bar->remove_menu( 'edit' ); //меню "редагувати запис"
	$wp_admin_bar->remove_menu( 'new-content' ); //меню "добавити"
	$wp_admin_bar->remove_menu( 'updates' ); //меню "оновлення"

	// Відключення логотипу WP
	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'about' );
	$wp_admin_bar->remove_menu( 'wporg' );
	$wp_admin_bar->remove_menu( 'documentation' );
	$wp_admin_bar->remove_menu( 'support-forums' );
	$wp_admin_bar->remove_menu( 'feedback' );
	$wp_admin_bar->remove_menu( 'view-site' );
}

add_action( 'wp_before_admin_bar_render', 'wph_new_toolbar' );

/**
 * Власний логотип в адмін панелі
 */
function change_admin_logo() {
	?>
    <style type="text/css">
        .login h1 a {
            background: url("<?php echo get_template_directory_uri(); ?>/img/logo.svg") center no-repeat !important;
            width: 205px !important;
            height: 65px !important;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'change_admin_logo' );

function change_admin_logo_url() {
	return home_url( '/' ); /* ссылка */
}

add_filter( 'login_headerurl', 'change_admin_logo_url' );

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
		if ( 'template-pages/home.php' == $page_template
		     || 'template-pages/contact.php' == $page_template
		     || 'template-pages/taxonomy.php' == $page_template
		     || 'template-pages/catalog.php' == $page_template
		     || 'template-pages/service.php' == $page_template
		     || 'template-pages/gallery.php' == $page_template
		     || 'template-pages/about.php' == $page_template
		     || 'template-pages/payment_delivery.php' == $page_template
		     || 'template-pages/thanks.php' == $page_template
		) {
			remove_post_type_support( 'page', 'thumbnail' ); // відкл. зображення сторінки
		}
		// Відключення редактора сторінки
		if ( 'template-pages/home.php' == $page_template
		     || 'template-pages/contact.php' == $page_template
		     || 'template-pages/taxonomy.php' == $page_template
		     || 'template-pages/catalog.php' == $page_template
		     || 'template-pages/gallery.php' == $page_template
		     || 'template-pages/about.php' == $page_template
		     || 'template-pages/payment_delivery.php' == $page_template
		     || 'template-pages/thanks.php' == $page_template
		) {
			remove_post_type_support( 'page', 'editor' ); // відкл. редактор
		}
	}
}

/**
 * Підключення скриптів в адмін панель
 */

function admin_style() {
	wp_enqueue_style( 'admin-fa-styles', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_enqueue_style( 'admin-styles', get_stylesheet_directory_uri() . '/css/admin-css/custom-admin.css' );
}

add_action( 'admin_enqueue_scripts', 'admin_style' );