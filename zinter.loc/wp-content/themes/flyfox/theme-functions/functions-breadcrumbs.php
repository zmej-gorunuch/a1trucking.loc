<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------

// Інші налаштування ---------------------------------------------------------------------------------------------------
/**
 * Головне меню сайту
 */
function display_menu_1() {
	$menu_name = 'menu-1';
	$locations = get_nav_menu_locations();
	
	if ( $locations ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		if ( $menu ) {
			$menu_items = wp_get_nav_menu_items( $menu->term_id, [ 'order' => 'DESC' ] );
			
			// Створення списку меню
			$menu_html = '<ul class="burger-menu hidden-on-tablet">';
			
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
						$menu_html .= '<li class="has-children">';
					} else {
						$menu_html .= '<li>';
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
					
					if ( ! empty( $menu_items[ $count + 1 ] ) ) {
						if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ) {
							$menu_html .= '</ul>';
							$submenu   = false;
						}
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
			
			echo $menu_html;
		} else {
			echo 'Не найдено ни одного меню!';
		}
		
	} else {
		echo 'Не найдено ни одного меню!';
	}
}

/**
 * Переключення мов сайту
 *
 * @param null $lang
 */
function display_menu_lang( $lang = null ) {
	$menu_html = '';
	if ( $lang ) {
		// Переключення мов
		$menu_html = '<ul class="header-link__lg hidden-on-tablet">';
		$language  = pll_the_languages( [ 'raw' => 1 ] );
		if ( $language ) {
			foreach ( $language as $lang ) {
				$lang_slug = $lang['slug'];
				$lang_url  = $lang['url'];
				$lang_name = $lang['name'];
				if ( ! $lang['current_lang'] ) {
					$menu_html .= '<li><a href="' . $lang_url . '">' . $lang_slug . '</a></li>';
				} else {
					$menu_html .= '<li><a class="active">' . $lang_slug . '</a></li>';
				}
			}
		}
		$menu_html .= '</ul>';
	}
	
	echo $menu_html;
}

function display_menu_mob_lang( $lang = null ) {
	$menu_html = '';
	if ( $lang ) {
		// Переключення мов
		$menu_html = '<ul class="header-link__lg hide-pc-flex">';
		$language  = pll_the_languages( [ 'raw' => 1 ] );
		if ( $language ) {
			foreach ( $language as $lang ) {
				$lang_slug = $lang['slug'];
				$lang_url  = $lang['url'];
				$lang_name = $lang['name'];
				if ( ! $lang['current_lang'] ) {
					$menu_html .= '<li><a href="' . $lang_url . '">' . $lang_slug . '</a></li>';
				} else {
					$menu_html .= '<li><a class="active">' . $lang_slug . '</a></li>';
				}
			}
		}
		$menu_html .= '</ul>';
	}
	
	echo $menu_html;
}

/**
 * Деревовидне меню
 *
 * @param $menu_name
 * @param $menu_name_2
 */
function custom_nav_menu( $menu_name = 'menu-2', $menu_name_2 = 'menu-1' ) {
	$locations = get_nav_menu_locations();
	if ( $locations ) {
		$menu  = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu2 = wp_get_nav_menu_object( $locations[ $menu_name_2 ] );
		if ( $menu ) {
			$menu_items  = wp_get_nav_menu_items( $menu->term_id, [ 'order' => 'DESC' ] );
			$menu_items2 = wp_get_nav_menu_items( $menu2->term_id, [ 'order' => 'DESC' ] );
			$items       = buildTree( $menu_items );
			foreach ( $items as $item ) {
				create_menu( $item );
			}
			foreach ( $menu_items2 as $item2 ) {
				create_menu_2( $item2 );
			}
		}
	}
}

function create_menu( $item, $submenu = false ) {
	$id    = $item->ID;
	$title = $item->title;
	$link  = $item->url;
	
	if ( property_exists( $item, 'child' ) ) {
		$children = $item->child;
		
		if ( ! $submenu ) {
			
			?>
			<li class="menu-item-has-children item-nav">
				<a href="<?php echo $link; ?>"><?php echo $title; ?></a>
				<ul class="dropdown-menu">
					<?php
					foreach ( $children as $child ) {
						if ( property_exists( $child, 'child' ) ) {
							create_menu( $child, true );
						} else {
							create_menu( $child );
						}
					}
					?>
				</ul>
			</li>
			<?php
		} else {
			?>
			<li>
				<a href="<?php echo $link; ?>"><?php echo $title; ?></a>
			</li>
			<ul class="dropdown-menu__sub">
				<?php
				foreach ( $children as $child ) {
					if ( property_exists( $child, 'child' ) ) {
						create_menu( $child, true );
					} else {
						create_menu( $child );
					}
				}
				?>
			</ul>
			<?php
		}
	} else {
		?>
		<li>
			<a href="<?php echo $link; ?>">
				<?php echo $title; ?>
			</a>
		</li>
		<?php
	}
}

function create_menu_2( $item ) {
	$id    = $item->ID;
	$title = $item->title;
	$link  = $item->url;
	?>
	<li class="hide-pc">
		<a href="<?php echo $link; ?>">
			<?php echo $title; ?>
		</a>
	</li>
	<?php
}

function buildTree( array &$elements, $parentId = 0 ) {
	$branch = [];
	foreach ( $elements as &$element ) {
		if ( $element->menu_item_parent == $parentId ) {
			$children = buildTree( $elements, $element->ID );
			if ( $children ) {
				$element->child = $children;
			}
			$element->has_children = 1;
			
			$branch[ $element->ID ] = $element;
			unset( $element );
		}
	}
	
	return $branch;
}