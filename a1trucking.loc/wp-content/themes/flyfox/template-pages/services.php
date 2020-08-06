<?php
/*
Template Name: Services page (template)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_title  = ! empty( $block_1['title'] ) ? $block_1['title'] : null;
	$block_1_text   = ! empty( $block_1['text'] ) ? $block_1['text'] : null;
	$block_1_button = ! empty( $block_1['button'] ) ? $block_1['button'] : null;
}
$block_2 = get_field( 'block_2' );
if ( $block_2 ) {
	$block_2_title        = ! empty( $block_2['title'] ) ? $block_2['title'] : null;
	$block_2_text         = ! empty( $block_2['text'] ) ? $block_2['text'] : null;
	$block_2_button       = ! empty( $block_2['button'] ) ? $block_2['button'] : null;
	$block_2_our_services = ! empty( $block_2['our_services'] ) ? $block_2['our_services'] : null; // array key icon, name, description
}
$block_3 = get_field( 'block_3' );
if ( $block_3 ) {
	$block_3_title          = ! empty( $block_3['title'] ) ? $block_3['title'] : null;
	$block_3_text           = ! empty( $block_3['text'] ) ? $block_3['text'] : null;
	$block_3_our_advantages = ! empty( $block_3['our_advantages'] ) ? $block_3['our_advantages'] : null; // array key icon, name, description
}
$block_4 = get_field( 'block_4' );
if ( $block_4 ) {
	$block_4_title        = ! empty( $block_4['title'] ) ? $block_4['title'] : null;
	$block_4_text         = ! empty( $block_4['text'] ) ? $block_4['text'] : null;
	$block_4_our_freights = ! empty( $block_4['our_freights'] ) ? $block_4['our_freights'] : null; // array key icon, name, description
}
$block_5 = get_field( 'block_5' );
if ( $block_5 ) {
	$block_5_title            = ! empty( $block_5['title'] ) ? $block_5['title'] : null;
	$block_5_text             = ! empty( $block_5['text'] ) ? $block_5['text'] : null;
	$block_5_article_title    = ! empty( $block_5['article_title'] ) ? $block_5['article_title'] : null;
	$block_5_article_text     = ! empty( $block_5['article_text'] ) ? $block_5['article_text'] : null;
	$block_5_loads            = ! empty( $block_5['loads'] ) ? $block_5['loads'] : null;
	$block_5_happy_clients    = ! empty( $block_5['happy_clients'] ) ? $block_5['happy_clients'] : null;
	$block_5_working_with_us  = ! empty( $block_5['working_with_us'] ) ? $block_5['working_with_us'] : null;
	$block_5_miles_with_cargo = ! empty( $block_5['miles_with_cargo'] ) ? $block_5['miles_with_cargo'] : null;
}
$block_6 = get_field( 'block_6' );
if ( $block_6 ) {
	$block_6_title        = ! empty( $block_6['title'] ) ? $block_6['title'] : null;
	$block_6_text         = ! empty( $block_6['text'] ) ? $block_6['text'] : null;
	$block_6_our_partners = ! empty( $block_6['our_partners'] ) ? $block_6['our_partners'] : null; // array key group, logotypes
}
$contacts = get_field( 'contacts', 'option' );
if ( $contacts ) {
	$phone = ! empty( $contacts['phone'] ) ? $contacts['phone'] : null;
}
$header = get_field( 'header', 'option' );
if ( $header ) {
	$header_button = ! empty( $header['button'] ) ? $header['button'] : null;
}

?>
<?php get_header(); ?>

<?php get_footer(); ?>