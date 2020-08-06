<?php
/**
 * Template part for displaying taxonomies
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

$current_term = get_queried_object();

/**
 * Custom fields
 */
$seo_title = get_field( 'seo_title', $current_term );
$seo_text  = get_field( 'seo_text', $current_term );

/**
 * Список Батьківських таксономій
 */
$parent_terms = get_terms( [
	'taxonomy'               => [ $current_term->taxonomy ],
	'orderby'                => 'id',
	'order'                  => 'ASC',
	'hide_empty'             => false,
	'fields'                 => 'all',
	'hierarchical'           => false,
	'parent'                 => 0,
	'pad_counts'             => false,
	'update_term_meta_cache' => true, // метадані в кеш
] );

/**
 * Posts
 */
global $wp_query;
$args = [
	'paged'     => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
	'post_type' => 'post',
	'tax_query' => [
		[
			'taxonomy' => $current_term->taxonomy,
			'field'    => 'term_id',
			'terms'    => $current_term->term_id,
		],
	],
];

?>
<?php if ( have_posts() ) : ?>
	<section class="main-oval">
		<div class="bg">
			<div class="bg1"></div>
		</div>
		<div class="wrap">
			<h1>#<?php echo $current_term->name ?></h1>
			<p><?php debug( $current_term ); ?></p>
			<p><?php debug( term_description( $current_term->term_id, $current_term->taxonomy ) ); ?></p>
			<!-- <span class="mark">Get <span class="att">2 month for free if</span> billed yearly</span>
			<button type="button" class="btn red">Try it Now</button> -->
		</div>
	</section>
<?php else: ?>
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>
