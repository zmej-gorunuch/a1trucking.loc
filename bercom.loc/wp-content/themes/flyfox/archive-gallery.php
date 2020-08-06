<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */


/**
 * Posts
 */
global $wp_query;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args     = array(
	'posts_per_page' => 2,
	'paged' => $paged,
	'post_type'      => 'gallery',
);
$wp_query = new WP_Query( $args );

?>
<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

    <p>Archive (wp-content/themes/flyfox/archive-gallery.php)</p>

	<?php while ( have_posts() ): ?>
		<?php the_post(); ?>

		<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

	<?php endwhile; ?>
	<?php posts_nav_link() ?>
	<?php the_posts_pagination() ?>
	<?php pagination_theme_display() ?>
	<?php wp_reset_query() ?>

<?php else: ?>

	<?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>