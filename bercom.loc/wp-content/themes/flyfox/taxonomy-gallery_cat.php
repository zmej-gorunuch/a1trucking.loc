<?php
/**
 * The template for displaying archive pages
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
	'taxonomy'               => array( 'gallery_cat' ),
	'orderby'                => 'id',
	'order'                  => 'ASC',
	'hide_empty'             => false,
	'fields'                 => 'all',
	'hierarchical'           => false,
	'pad_counts'             => false,
	'update_term_meta_cache' => true, // подгружать метаданные в кэш
) );

/**
 * Posts
 */
global $wp_query;
$args     = array(
	'paged'       => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
	'post_type'   => 'gallery',
	'tax_query' => array(
		array(
			'taxonomy' => 'gallery_cat',
			'field'    => 'term_id',
			'terms'    => $current_term->term_id,
		)
	),
);
$wp_query = new WP_Query( $args );

?>
<?php get_header(); ?>
<?php if ( have_posts() ) : ?>

    <section class="gallery">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="app-nav">
						<?php foreach ( $terms as $term ): ?>
							<?php $term_link = get_term_link( $term ) ?>
                            <li class="app-nav__item text-center <?php echo $current_term->term_id == $term->term_id ? 'current' : '' ?>">
                                <a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="row m-row gallery-row">
				<?php while ( have_posts() ): ?>

					<?php the_post(); ?>

					<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

				<?php endwhile; ?>
            </div>

            <div class="row align-center">

				<?php pagination_theme_display() ?>

				<?php wp_reset_query() ?>

            </div>
        </div>
    </section>

<?php else: ?>

	<?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>