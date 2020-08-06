<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package FlyFox
 */

?>
<?php get_header(); ?>

<?php if ( have_posts() ): ?>

    <p>Search (wp-content/themes/flyfox/search.php)</p>

	<?php while ( have_posts() ): ?>
		<?php the_post(); ?>

		<?php get_template_part( 'template-content/content', 'search' ); ?>

	<?php endwhile; ?>

<?php else: ?>

	<?php get_template_part( 'template-content/content', 'none' ); ?>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>