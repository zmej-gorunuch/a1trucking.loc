<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------
/**
 * Підключення скриптів тільки на сторінках де є шорткод форм
 */
add_action( 'wpcf7_init', 'wpcf7_remove_assets' );
function wpcf7_remove_assets() {
    add_filter( 'wpcf7_load_js', '__return_false' );
    add_filter( 'wpcf7_load_css', '__return_false' );
}

add_filter( 'shortcode_atts_wpcf7', 'wpcf7_add_assets' );
function wpcf7_add_assets( $atts ) {
    wpcf7_enqueue_styles();

    return $atts;
}

/**
 * Заборона видалення обов'язкових плагінів
 */
add_filter( 'plugin_action_links', 'disable_plugin_deactivation_cf7', 10, 2 );
function disable_plugin_deactivation_cf7( $actions, $plugin_file ) {
	unset( $actions['edit'] );

	// Видаляє дію "Деактивувати" у потрібних для роботи сайту плагінів
	$important_plugins = array(
		'contact-form-7/wp-contact-form-7.php',
	);

	if ( in_array( $plugin_file, $important_plugins ) ) {
		unset( $actions['deactivate'] );
		$actions['info'] = '<b class="musthave_js">Обов\'язковий для роботи сайту</b>';
	}

	return $actions;
}

// Видаляємо групові дії: деактивувати і видалити
add_filter( 'admin_print_footer_scripts-plugins.php', 'disable_plugin_deactivation_hide_checkbox_cf7' );
function disable_plugin_deactivation_hide_checkbox_cf7( $actions ) {
	?>
	<script>
        jQuery(function ($) {
            $('.musthave_js').closest('tr').find('input[type="checkbox"]').remove();
        });
	</script>
	<?php
}

// Інші налаштування ---------------------------------------------------------------------------------------------------
/**
 * Перенаправлення на сторінку подяки
 */
//add_action( 'wp_footer', 'cf7_footer_script', 30 );
function cf7_footer_script() { ?>
    <script>
        $(document).on('wpcf7mailsent', function (event) {
            location = '<?php echo the_page_link('thanks'); ?>';
        });
    </script>
<?php }

/**
 * Антиспам checkbox
 *
 * в форму додати поле [acceptance mail-check class:mail-check default:on invert]
 */
//add_action( 'wp_footer', 'cf7_spam_checkbox_script', 30 );
function cf7_spam_checkbox_script() { ?>
    <script>
        $('.mail-check').prop('checked', false);
    </script>
<?php }

// Приховую checkbox від спаму
//add_action( 'wp_head', 'head_mail_check_style', 99 );
function head_mail_check_style() {
	?>
    <style>
        .mail-check {
            display: none
        }
    </style>
	<?php
}