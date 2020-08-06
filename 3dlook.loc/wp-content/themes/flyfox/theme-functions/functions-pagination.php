<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------

// Інші налаштування ---------------------------------------------------------------------------------------------------
/**
 * Шаблон пагінації
 */
function pagination_theme_display() {

	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$big = 999999999; // need an unlikely integer

	$pages = paginate_links( array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $wp_query->max_num_pages,
		'type'      => 'array',
		'prev_next' => true,
		'prev_text' => 'Попередня',
		'next_text' => 'Наступна',
	) );

	if ( is_array( $pages ) ) {
		$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );

		echo '<div class="pagination-block"><ul>';
		foreach ( $pages as $key => $page ) {
			if ( $paged == strip_tags( $page ) ) {
				// Активна сторінка
				echo '<li><a class="active" href="#">' . strip_tags( $page ) . '</a></li>';
			} else {
				if ( $key == count( $pages ) - 1 ) {
					// Наступна сторінка
					echo '<li>' . str_replace( 'class="next page-numbers"', 'class="pagnext"', $page ) . '</li>';
				} elseif ( $paged != 1 && $key == 0 ) {
					// Попередня сторінка
					echo '<li>' . str_replace( 'class="prev page-numbers"', 'class="pagprev"', $page ) . '</li>';
				} else {
					// Звичайна сторінка
					echo '<li>' . str_replace( 'class="page-numbers"', '', $page ) . '</li>';
				}
			}
		}
		echo '</ul></div>';
	}
}