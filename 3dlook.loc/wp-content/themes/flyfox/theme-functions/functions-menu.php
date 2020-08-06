<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------

// Інші налаштування ---------------------------------------------------------------------------------------------------
/**
 * Головне меню сайту
 *
 * @param null $lang
 */
function display_menu( $lang = null ) {
	switch ( $lang ) {
		case 'en':
			$menu_name = 'menu-en';
			break;
		case 'ru':
			$menu_name = 'menu-ru';
			break;
		default:
			$menu_name = 'menu-1';
	}

	$locations = get_nav_menu_locations();
	if ( $locations ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		if ( $menu ) {
			$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

			// Створення списку меню
			$menu_html = '';

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

					$menu_html .= '<a href="' . $link . '">' . $title . '</a>';
				}

				if ( $parent_id == $item->menu_item_parent ) {
					echo '<span style="color: red">There can be no subcategories in the menu!</span>';
				}
			}

			if ( $lang ) {
				// Переключення мов
				$menu_html .= '<nav class="languages-navigation">';

				$menu_html .= '<span>' . $lang . ' <i class="icon-arrowRight"></i> </span>';

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
				$menu_html .= '</nav>';
			}

			echo $menu_html;
		} else {
			echo 'Виникла помилка. Не знайдено жодного меню!';
		}

	} else {
		echo 'Не додано жодного меню!';
	}
}