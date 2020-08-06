<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------
/**
 * Відключення повідомлення про оновлення
 */
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
function filter_plugin_updates( $value ) {
	if ( is_object( $value ) ) {
		unset( $value->response['advanced-custom-fields-pro/acf.php'] );
	}

	return $value;
}

/**
 * Заборона видалення обов'язкових плагінів
 */
add_filter( 'plugin_action_links', 'disable_plugin_deactivation_acf', 10, 2 );
function disable_plugin_deactivation_acf( $actions, $plugin_file ) {
	unset( $actions['edit'] );

	// Видаляє дію "Деактивувати" у потрібних для роботи сайту плагінів
	$important_plugins = [
		'advanced-custom-fields-pro/acf.php',
	];

	if ( in_array( $plugin_file, $important_plugins ) ) {
		unset( $actions['deactivate'] );
		$actions['info'] = '<b class="musthave_js">Обов\'язковий для роботи сайту</b>';
	}

	return $actions;
}

// Видаляємо групові дії: деактивувати і видалити
add_filter( 'admin_print_footer_scripts-plugins.php', 'disable_plugin_deactivation_hide_checkbox_acf' );
function disable_plugin_deactivation_hide_checkbox_acf( $actions ) {
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
 * Додати пункт меню загальних налаштувань теми
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( [
		'page_title' => esc_html__( 'Загальні налаштування теми', 'flyfox' ),
		'menu_title' => esc_html__( 'Тема', 'flyfox' ),
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'icon_url'   => 'dashicons-align-left',
		'position'   => '59.3',
		'redirect'   => true,
	] );
}