<?php
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
		'prev_text' => '<i class="icon-arrowLeft"></i>',
		'next_text' => '<i class="icon-arrowRight"></i>',
	) );

	if ( is_array( $pages ) ) {
		$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );

		echo '<nav class="pagination" role="navigation"><div class="nav-links d-flex">';
		foreach ( $pages as $key => $page ) {
			if ( $paged == strip_tags( $page ) ) {
				// Активна сторінка
				echo '<span aria-current="page" class="page-numbers current">' . strip_tags( $page ) . '</span>';
			} else {
				if ( $key == count( $pages ) - 1 ) {
					// Наступна сторінка
					echo '<a>' . str_replace( 'class="next page-numbers"', 'class="next page-numbers"', $page ) . '</a>';
				} elseif ( $paged != 1 && $key == 0 ) {
					// Попередня сторінка
					echo '<a>' . str_replace( 'class="prev page-numbers"', 'class="prev page-numbers"', $page ) . '</a>';
				} else {
					// Звичайна сторінка
					echo '<a>' . str_replace( 'class="page-numbers"', 'class="page-numbers"', $page ) . '</a>';
				}
			}
		}
		echo '</div></nav>';
	}
}

/**
 * Кількість постів в списку таксономії
 *
 * @param $query
 *
 * @return mixed
 */
function tax_posts_per_page( $query ) {
	if ( is_tax( 'gallery_cat' ) ) {
		$query->set( 'posts_per_page', 16 ); //кількість постів
	}
	if ( is_tax( 'catalog_cat' ) ) {
		$query->set( 'posts_per_page', 12 ); //кількість постів
	}
	return $query;
}

add_filter( 'pre_get_posts', 'tax_posts_per_page' );