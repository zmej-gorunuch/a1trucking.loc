<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

?>
<?php get_header(); ?>

<?php while ( have_posts() ): ?>

    <p>Page (wp-content/themes/flyfox/page.php)</p>

	<?php the_post(); ?>

	<?php get_template_part( 'template-parts/content', 'page' ); ?>

<?php endwhile; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>