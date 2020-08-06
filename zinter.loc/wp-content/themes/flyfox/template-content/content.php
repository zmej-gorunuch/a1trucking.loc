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

    <p>Single (wp-content/themes/flyfox/template-parts/content.php)</p>

<?php else: ?>

	<?php while ( have_posts() ): ?>

		<?php the_post(); ?>

        <p>List (wp-content/themes/flyfox/template-parts/content.php)</p>

	<?php endwhile; ?>

<?php endif; ?>