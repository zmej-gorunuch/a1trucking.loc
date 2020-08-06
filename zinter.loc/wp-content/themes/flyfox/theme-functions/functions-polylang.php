<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------
/**
 * Заборона видалення плагіну
 */
add_filter( 'plugin_action_links', 'disable_plugin_deactivation_pll', 10, 2 );
function disable_plugin_deactivation_pll( $actions, $plugin_file ) {
	unset( $actions['edit'] );

	// Видаляє дію "Деактивувати" у потрібних для роботи сайту плагінів
	$important_plugins = array(
		'polylang/polylang.php',
	);

	if ( in_array( $plugin_file, $important_plugins ) ) {
		unset( $actions['deactivate'] );
		$actions['info'] = '<b class="musthave_js">Обов\'язковий для роботи сайту</b>';
	}

	return $actions;
}

// Видаляємо групові дії: деактивувати і видалити
add_filter( 'admin_print_footer_scripts-plugins.php', 'disable_plugin_deactivation_hide_checkbox_pll' );
function disable_plugin_deactivation_hide_checkbox_pll( $actions ) {
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
 * Плагін Polylang
 *
 * Переклад для статичного тексту
 * Вивід перекладу на сторінці pll_e( 'Текст перекладу' )
 */
// Home page -----------------------------------------------------------------------------------------------------------
pll_register_string( 'Translate text', 'Text', 'Home' );