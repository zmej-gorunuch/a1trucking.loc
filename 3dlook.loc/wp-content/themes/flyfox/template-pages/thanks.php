<?php
/*
Template Name: About Us page (theme)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_text                 = ! empty( $block_1['text'] ) ? $block_1['text'] : null;
	$block_1_year_founded         = ! empty( $block_1['year_founded'] ) ? $block_1['year_founded'] : null;
	$block_1_team_members         = ! empty( $block_1['team_members'] ) ? $block_1['team_members'] : null;
	$block_1_phd_degrees          = ! empty( $block_1['phd_degrees'] ) ? $block_1['phd_degrees'] : null;
	$block_1_coffee_cups_everyday = ! empty( $block_1['coffee_cups_everyday'] ) ? $block_1['coffee_cups_everyday'] : null;
}
$block_2 = get_field( 'block_2' );
if ( $block_2 ) {
	$block_2_foto        = ! empty( $block_2['foto'] ) ? $block_2['foto'] : null;
	$block_2_name        = ! empty( $block_2['name'] ) ? $block_2['name'] : null;
	$block_2_position    = ! empty( $block_2['position'] ) ? $block_2['position'] : null;
	$block_2_title       = ! empty( $block_2['title'] ) ? $block_2['title'] : null;
	$block_2_description = ! empty( $block_2['description'] ) ? $block_2['description'] : null;
	$block_2_button      = ! empty( $block_2['button'] ) ? $block_2['button'] : null;
}
$block_3 = get_field( 'block_3' );
if ( $block_3 ) {
	$block_3_title       = ! empty( $block_3['title'] ) ? $block_3['title'] : null;
	$block_3_description = ! empty( $block_3['description'] ) ? $block_3['description'] : null;
	$block_3_button      = ! empty( $block_3['button'] ) ? $block_3['button'] : null;
	$block_3_our_product = ! empty( $block_3['our_product'] ) ? $block_3['our_product'] : null;
}
$block_4 = get_field( 'block_4' );
if ( $block_4 ) {
	$block_4_title = ! empty( $block_4['title'] ) ? $block_4['title'] : null;
}
$block_5 = get_field( 'block_5' );
if ( $block_5 ) {
//	$block_5_title   = ! empty( $block_5['title'] ) ? $block_5['title'] : null;
//	$block_5_content = ! empty( $block_5['content'] ) ? $block_5['content'] : null;
//	$block_5_button  = ! empty( $block_5['button'] ) ? $block_5['button'] : null;
}
$block_6 = get_field( 'block_6' );
if ( $block_6 ) {
	$block_6_title   = ! empty( $block_6['title'] ) ? $block_6['title'] : null;
	$block_6_text    = ! empty( $block_6['text'] ) ? $block_6['text'] : null;
	$block_6_offices = ! empty( $block_6['offices'] ) ? $block_6['offices'] : null;
}
$block_7 = get_field( 'block_7' );
if ( $block_7 ) {
	$block_7_text        = ! empty( $block_7['text'] ) ? $block_7['text'] : null;
	$block_7_title       = ! empty( $block_7['title'] ) ? $block_7['title'] : null;
	$block_7_description = ! empty( $block_7['description'] ) ? $block_7['description'] : null;
	$block_7_button      = ! empty( $block_7['button'] ) ? $block_7['button'] : null;
	$block_7_image       = ! empty( $block_7['image'] ) ? $block_7['image'] : null;
}

?>
<?php get_header(); ?>

    <h1><?php wp_title( "", true ); ?></h1>

<?php get_footer(); ?>