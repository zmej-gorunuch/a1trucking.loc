<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FlyFox
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

    <p>Sidebar (wp-content/themes/flyfox/sidebar.php)</p>

<?php dynamic_sidebar( 'sidebar-1' ); ?>