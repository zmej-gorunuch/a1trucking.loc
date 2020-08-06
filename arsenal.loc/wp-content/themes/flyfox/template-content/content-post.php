<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

?>
<?php if ( is_singular() ): ?>

    <p>Post single (wp-content/themes/flyfox/template-parts/content-post.php)</p>

<?php else: ?>

	<?php while ( have_posts() ): ?>

		<?php the_post(); ?>

        <p>Post list (wp-content/themes/flyfox/template-parts/content-post.php)</p>

	<?php endwhile; ?>

<?php endif; ?>