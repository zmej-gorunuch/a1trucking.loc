<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------

// Інші налаштування ---------------------------------------------------------------------------------------------------
/**
 * Додати кнопки з шорткодами
 */
add_action( 'admin_head', 'add_mce_buttons' );
function add_mce_buttons() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	// Перевірка чи включений візуальний редактор
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'add_tinymce_script' );
		add_filter( 'mce_buttons', 'register_mce_buttons' );
	}
}

// Підключаю JavaScript-файл кнопок
function add_tinymce_script( $plugin_array ) {
	$plugin_array['mce_buttons'] = get_stylesheet_directory_uri() . '/js/tinymce.js';

	return $plugin_array;
}

// Реєструю кнопки в редакторі
function register_mce_buttons( $buttons ) {
	array_push( $buttons, 'mce_career_button' );

	return $buttons;
}

// Шорткоди ------------------------------------------------------------------------------------------------------------
/**
 * Список вакансій
 */
add_shortcode( 'careers_shortcode', 'careers_shortcode_func' );
function careers_shortcode_func( $atts ) {
	/**
	 * Vacancies
	 */
	$args      = [
		'post_type'        => 'vacancy',
		'post_status'      => 'publish',
		'numberposts'      => 5,
		'suppress_filters' => true,
	];
	$vacancies = get_posts( $args );
	$html      = '';

	if ( $vacancies ) {
		$html .= '<h4 class="h-4-1">Our vacancies</h4>';
		$html .= '<div class="blog_article__vacancies">';
		foreach ( $vacancies as $vacancy ) {
			$html              .= '<a href="' . get_permalink( $vacancy->ID ) . '" class="blog_article__vacancies_item">';
			$html              .= '<div class="ba_v_title">' . $vacancy->post_title . '</div>';
			$vacancy_workloads = wp_get_post_terms( $vacancy->ID, 'vacancy_workload', [ 'fields' => 'names' ] );
			if ( $vacancy_workloads ) {
				$html .= '<div class="ba_v_time">' . implode( ', ', $vacancy_workloads ) . '</div>';
			}
			$vacancy_cities = wp_get_post_terms( $vacancy->ID, 'vacancy_city', [ 'fields' => 'names' ] );
			if ( $vacancy_cities ) {
				$html .= '<div class="ba_v_address">' . implode( ' / ', $vacancy_cities ) . '</div>';
			}
			$html .= '<div class="ba_v_apply_now">Apply now</div>';
			$html .= '</a>';
		}
		$html .= '</div>';
	}

	return $html;
}