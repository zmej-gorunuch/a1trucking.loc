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
 * Custom fields
 */

$seo_title = get_field( 'seo_title', $current_term );
$seo_text  = get_field( 'seo_text', $current_term );

/**
 * Taxonomy
 */
$terms = get_terms( array(
	'taxonomy'               => array( 'catalog_cat' ),
	'orderby'                => 'id',
	'order'                  => 'ASC',
	'hide_empty'             => false,
	'fields'                 => 'all',
	'hierarchical'           => false,
	'parent'                 => $current_term->parent ? $current_term->parent : $current_term->term_id,
	'pad_counts'             => false,
	'update_term_meta_cache' => true, // подгружать метаданные в кэш
) );

/**
 * Posts
 */
global $wp_query;
$args     = array(
	'paged'       => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
	'post_type'   => 'product',
	'tax_query' => array(
		array(
			'taxonomy' => 'catalog_cat',
			'field'    => 'term_id',
			'terms'    => $current_term->term_id,
		)
	),
);
$wp_query = new WP_Query( $args );

?>
<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

    <section class="catalog">
        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <li><a href="<?php the_page_link( 'catalog' ); ?>"><?php pll_e( 'Каталог' ); ?></a></li>
					<?php if ( $current_term->parent ): ?>
                        <li>
                            <a href="<?php echo get_term_link( $current_term->parent ); ?>"><?php echo get_term_field( 'name', $current_term->parent ); ?></a>
                        </li>
					<?php endif; ?>
                    <li><?php echo $current_term->name ?></li>
                </ul>
            </div>
            <div class="row m-row">
                <div class="column col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="d-flex align-justify align-middle category-wrap">
                        <div class="category-title heading-5 --medium"><?php echo $current_term->name ?></div>

                        <button class="js-filter-btn category-filter">
                            <img src="img/filtr.svg" alt="filter icon" class="m-auto">
                            <p class="--medium"><?php pll_e( 'Фільтр' ); ?></p>
                        </button>
                    </div>
                    <div class="filter-wrap js-filter-wrap">
                        <button class="btn btn-more filter-btn js-filter-btn"> <?php pll_e( 'Назад' ); ?></button>
                        <h3 class="filter-title heading-4 --medium"><?php echo $current_term->name ?></h3>
                        <ul class="filter">
							<?php foreach ( $terms as $term ): ?>
								<?php $term_link = get_term_link( $term ) ?>
                                <li class="filter-item d-flex align-justify <?php echo $current_term->term_id == $term->term_id ? 'current' : '' ?>">
                                    <a href="<?php echo get_term_link( $term ); ?>"
                                       class="filter-item__link"><?php echo $term->name ?></a>
                                    <div class="filter-item__count">(<?php echo $term->count; ?>)</div>
                                </li>
							<?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="column col-xl-9 col-lg-8 col-md-6 col-sm-12 col-xs-12">
                    <div class="row m-row">
						<?php while ( have_posts() ): ?>
							<?php the_post(); ?>

							<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

						<?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<?php if ( $seo_title ): ?>
        <section class="seo">
            <div class="container">
                <div class="row align-center">
                    <div class="col-md-10 col-xs-12 seo-component">

                        <div class="seo-component__title heading-3 --bold"><?php echo $seo_title; ?></div>
                        <div class="entry-content">
							<?php echo $seo_text; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	<?php endif; ?>

<?php else: ?>

	<?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>