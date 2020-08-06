<?php
// Стилі та скрипти ----------------------------------------------------------------------------------------------------
/**
 * Підключення стилів та скриптів
 */
add_action('wp_enqueue_scripts', 'flyfox_scripts');
function flyfox_scripts()
{

    // Підключення JQuery
//    wp_deregister_script('jquery');
//    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, null,
//        true);
//    wp_enqueue_script('jquery');

    // Підключення стилів
    wp_enqueue_style('custom_main_style', get_template_directory_uri() . '/style.css', []);

    // Підключення скриптів
    wp_enqueue_script('custom_script', get_template_directory_uri() . '/js/custom-theme.js', [], false, true);
}

// Налаштування теми ---------------------------------------------------------------------------------------------------
/**
 * FlyFox functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FlyFox
 */
if (!function_exists('flyfox_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    add_action('after_setup_theme', 'flyfox_setup');
    function flyfox_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on FlyFox, use a find and replace
         * to change 'flyfox' to the name of your theme in all the template files.
         */
        load_theme_textdomain('flyfox', get_template_directory() . '/languages');
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /**
         * Enable support custom-logo on customizer.
         */
        add_theme_support('custom-logo');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'menu-1' => esc_html__('Головне меню', 'flyfox'),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);
    }
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action('widgets_init', 'flyfox_widgets_init');
function flyfox_widgets_init()
{
    register_sidebar([
        'name' => esc_html__('Сайдбар', 'flyfox'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Додайте сюди віджети.', 'flyfox'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ]);
}

// Підключення функцій теми --------------------------------------------------------------------------------------------
/**
 * Підключення файлу налаштувань адміністративної частини
 */
require get_template_directory() . '/theme-functions/functions-admin.php';

/**
 * Підключення файлу з Ajax функціями
 */
require get_template_directory() . '/theme-functions/functions-ajax.php';

/**
 * Підключення файлу налаштувань меню
 */
require get_template_directory() . '/theme-functions/functions-menu.php';

/**
 * Підключення файлу налаштувань пагінації
 */
require get_template_directory() . '/theme-functions/functions-pagination.php';

/**
 * Підключення файлу налаштувань редактора
 */
require get_template_directory() . '/theme-functions/functions-editor.php';

/**
 * Підключення файлу перекладу PolyLang
 */
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('polylang/polylang.php')) {
    require get_template_directory() . '/theme-functions/functions-polylang.php';
}

/**
 * Підключення файлу налаштувань Advanced Custom Fields
 */
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('advanced-custom-fields-pro/acf.php') || is_plugin_active('advanced-custom-fields/acf.php')) {
    require get_template_directory() . '/theme-functions/functions-acf.php';
}

/**
 * Підключення файлу налаштувань Contact Form 7
 */
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('contact-form-7/wp-contact-form-7.php') || is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
    require get_template_directory() . '/theme-functions/functions-contact-form-7.php';
}

// Допоміжні функції ---------------------------------------------------------------------------------------------------
/**
 * Отримання ID сторінку з певним шаблоном
 *
 * Шаблони розташовані в папці template-pages
 *
 * @param $template_name
 *
 * @return false|string
 */
function page_id_by_template($template_name)
{
    $page = get_pages([
        'meta_key' => '_wp_page_template',
        'meta_value' => 'template-pages/' . $template_name . '.php',
        'hierarchical' => 0,
    ]);
    if (!empty($page)) {
        return $page[0]->ID;
    }

    return false;
}

/**
 * Отримання посилання на сторінку з певним шаблоном
 *
 * Шаблони розташовані в папці template-pages
 *
 * @param $template_name
 *
 * @return false|string
 */
function the_page_link($template_name)
{
    $page = get_pages([
        'meta_key' => '_wp_page_template',
        'meta_value' => 'template-pages/' . $template_name . '.php',
        'hierarchical' => 0,
    ]);
    if (!empty($page)) {
        return get_permalink($page[0]->ID);
    }

    return null;
}

/**
 * Форматування номера телефону
 *
 * @param $phone
 */
function the_call_phone($phone)
{
    if (!empty($phone)) {
        echo 'tel:+' . preg_replace('![^0-9]+!', '', $phone);
    }
}

/**
 * Заповнення атрибуту alt заголовком запису
 *
 * @param array $response
 *
 * @return array
 */
add_filter('wp_prepare_attachment_for_js', 'change_empty_alt_to_title');
function change_empty_alt_to_title($response)
{
    if (!$response['alt']) {
        $response['alt'] = sanitize_text_field($response['uploadedToTitle']);
    }

    return $response;
}