<?php
/**
 * Головне меню сайту
 *
 * @param null $current_language
 */
function menu_theme_display( $current_language = null ) {
	switch ( $current_language ) {
		case 'en':
			$menu_name = 'menu-en';
			break;
		case 'ru':
			$menu_name = 'menu-ru';
			break;
		default:
			$menu_name = 'menu-ua';
	}

	$menu       = wp_get_nav_menu_object( $menu_name );
	$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

	// Створення списку меню
	$menu_html = '<nav class="primary-navigation">';
	$menu_html .= '<ul class="primary-menu">';

	$count   = 0;
	$submenu = false;

	foreach ( $menu_items as $item ) {
		// set up title and url
		$title = $item->title;
		$link  = $item->url;

		// item does not have a parent so menu_item_parent equals 0 (false)
		if ( ! $item->menu_item_parent ) {

			// save this id for later comparison with sub-menu items
			$parent_id = $item->ID;

			if ( ! empty( $menu_items[ $count + 1 ]->menu_item_parent ) ) {
				$menu_html .= '<li class="menu-item menu-item-has-children">';
			} else {
				$menu_html .= '<li class="menu-item">';
			}

			$menu_html .= '<a href="' . $link . '">' . $title . '</a>';
		}

		if ( $parent_id == $item->menu_item_parent ) {
			if ( ! $submenu ) {
				$submenu   = true;
				$menu_html .= '<ul class="sub-menu">';
			}
			$menu_html .= '<li>';
			$menu_html .= '<a href="' . $link . '">' . $title . '</a>';
			$menu_html .= '</li>';

			if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ) {
				$menu_html .= '</ul>';
				$submenu   = false;
			}
		}
		if ( ! empty( $menu_items[ $count + 1 ]->menu_item_parent ) ) {
			if ( $parent_id != $menu_items[ $count + 1 ]->menu_item_parent ) {
				$menu_html .= '</li>';
				$submenu   = false;
			}
		}
		$count ++;
	}
	$menu_html .= '</ul>';
	$menu_html .= '</nav>';

	// Переключення мов
	$menu_html .= '<nav class="languages-navigation">';

	$menu_html .= '<span>' . $current_language . ' <i class="icon-arrowRight"></i> </span>';

	$menu_html .= '<ul class="languages-menu">';
	$language  = pll_the_languages( array( 'raw' => 1 ) );
	$language  = wp_list_sort( $language, 'current_lang', 'DESC' );
	if ( $language ) {
		foreach ( $language as $lang ) {
			$lang_slug = $lang['slug'];
			$lang_url  = $lang['url'];
			$lang_name = $lang['name'];
			if ( ! $lang['current_lang'] ) {
				$menu_html .= '<li class="languages-menu-item"><a href="' . $lang_url . '">' . $lang_slug . '</a></li>';
			}
		}
	}
	$menu_html .= '</ul>';
	$menu_html .= '</nav>';

	echo $menu_html;
}

/**
 * Footer меню сайту
 *
 * @param null $current_language
 */
function menu_footer_theme_display( $current_language = null ) {
	switch ( $current_language ) {
		case 'en':
			$menu_name = 'menu-footer-en';
			break;
		case 'ru':
			$menu_name = 'menu-footer-ru';
			break;
		default:
			$menu_name = 'menu-footer-ua';
	}

	$menu       = wp_get_nav_menu_object( $menu_name );
	$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

	// Створення списку меню
	$menu_html = '<nav class="footer-navigation text-center">';
	$menu_html .= '<ul class="menu">';

	foreach ( $menu_items as $item ) {
		// set up title and url
		$title = $item->title;
		$link  = $item->url;

		$menu_html .= '<li class="menu-item">';
		$menu_html .= '<a href="' . $link . '">' . $title . '</a>';
	}
	$menu_html .= '</ul>';
	$menu_html .= '</nav>';

	echo $menu_html;
}