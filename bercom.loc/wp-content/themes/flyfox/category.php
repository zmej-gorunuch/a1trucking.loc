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

    <p>Category (wp-content/themes/flyfox/category.php)</p>

	<?php while ( have_posts() ): ?>
		<?php the_post(); ?>

		<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

	<?php endwhile; ?>

<?php else: ?>

	<?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>