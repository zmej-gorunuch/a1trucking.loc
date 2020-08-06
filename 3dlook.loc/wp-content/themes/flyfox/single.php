<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FlyFox
 */

?>
<?php get_header(); ?>

<?php while ( have_posts() ): ?>

    <p>Single (wp-content/themes/flyfox/single.php)</p>

	<?php the_post(); ?>

	<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

	<?php if ( comments_open() || get_comments_number() ): ?>
		<?php comments_template(); ?>
	<?php endif; ?>

<?php endwhile; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>