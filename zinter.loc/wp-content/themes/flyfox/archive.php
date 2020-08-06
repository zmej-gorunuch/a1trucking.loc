<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

?>
<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php get_template_part( 'template-content/content', get_post_type() ); ?>

<?php else: ?>

	<?php get_template_part( 'template-content/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>