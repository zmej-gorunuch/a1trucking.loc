<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------

// Інші налаштування ---------------------------------------------------------------------------------------------------
/**
 * Хлібні крихти
 *
 * @param bool $taxonomy_name
 */
function the_breadcrumb( $taxonomy_name = false ) {
	$pageNum   = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$separator = ' / ';
	
	if ( ! is_front_page() ) {
		echo '<span><a href="' . site_url() . '">' . __( 'Главная' ) . '</a></span>' . $separator;
		
		if ( is_single() ) { // Записи
			if ( is_singular() ) { // Кастомні записи
				global $post;
				$post_terms = get_the_terms( $post->ID, $taxonomy_name );
				
				if ( ! empty( $post_terms[0]->term_id ) ) {
					echo get_term_parents_list( $post_terms[0]->term_id, $taxonomy_name, [ 'separator' => $separator ] );
				}
				the_title();
			} else {
				the_category( ', ' );
				echo $separator;
				the_title();
			}
		} elseif ( is_page() ) { // Сторінки
			the_title();
		} elseif ( is_category() ) { // Категорії
			single_cat_title();
		} elseif ( is_tag() ) { // Теги
			single_tag_title();
		} elseif ( is_day() ) { // Архіви (по днях)
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
			echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $separator;
			echo get_the_time( 'd' );
		} elseif ( is_month() ) { // Архіви (по місяцях)
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
			echo get_the_time( 'F' );
		} elseif ( is_year() ) { // Архіви (по роках)
			echo get_the_time( 'Y' );
		} elseif ( is_author() ) { // Архіви (по авторах)
			
			global $author;
			$user_data = get_userdata( $author );
			echo __( 'Опубликовал(а) ' ) . $user_data->display_name;
		} elseif ( is_404() ) { // Сторінка не існує
			echo __( 'Ошибка 404' );
		}
		
		if ( $pageNum > 1 ) { // номер сторінки
			echo ' (' . $pageNum . __( '-я страница)' );
		}
		
		if ( is_tax() ) { // Таксономії
			$current_term  = get_queried_object();
			$taxonomy_name = $current_term->taxonomy;
			
			if ( $current_term->parent ) {
				echo get_term_parents_list( $current_term->parent, $taxonomy_name, [ 'separator' => $separator ] );
			}
			single_term_title();
		}
	}
}