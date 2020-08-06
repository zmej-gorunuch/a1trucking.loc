<?php
/**
 * The template for displaying taxonomy pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

$current_term = get_queried_object();

?>
<?php get_header(); ?>

<?php get_template_part( 'template-taxonomies/taxonomy', $current_term->taxonomy ); ?>

<?php get_footer(); ?>