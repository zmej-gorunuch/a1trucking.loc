<?php
/**
 * Template part for displaying taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

$current_term = get_queried_object();

/**
 * Taxonomy
 */
$terms = get_terms( array(
	'taxonomy'               => array( $current_term->taxonomy ),
	'orderby'                => 'id',
	'order'                  => 'ASC',
	'hide_empty'             => false,
	'fields'                 => 'all',
	'hierarchical'           => false,
	'parent'                 => $current_term->parent ? $current_term->parent : $current_term->term_id,
	'pad_counts'             => false,
	'update_term_meta_cache' => true, // метадані в кеш
) );

/**
 * Posts
 */
global $wp_query;
$args     = array(
	'paged'     => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
	'post_type' => 'product',
	'tax_query' => array(
		array(
			'taxonomy' => $current_term->taxonomy,
			'field'    => 'term_id',
			'terms'    => $current_term->term_id,
		)
	),
);
$wp_query = new WP_Query( $args );

?>
<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ): ?>
		<?php the_post(); ?>
		<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
	<?php endwhile; ?>

<?php else: ?>
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>