<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

$terms = get_terms( array(
	'taxonomy'               => array( 'catalog_cat' ),
	'hide_empty'             => false,
	'orderby'                => 'id',
	'order'                  => 'ASC',
	'count'                  => false,
	'slug'                   => '',
	'parent'                 => 0,
	'hierarchical'           => true,
	'get'                    => 'all',
	'update_term_meta_cache' => true, // подгружать метаданные в кэш
) );

?>
<div class="row">
	<?php foreach ( $terms as $term ): ?>
		<?php $img = get_field( 'img', $term ) ?>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="catalog-item --relative ">
                <a href="<?php echo get_term_link( $term ); ?>"
                   class="d-flex align-content-justify catalog-item__link">
                    <h5 class="catalog-item__title heading-4 --demi overlap"><?php echo $term->name; ?></h5>
                    <figure class="catalog-item__icon default-icon">
						<?php if ( $img ): ?>
                            <img src="<?php echo $img; ?>" alt="<?php echo $term->name; ?>">
						<?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-img.jpg" alt="no-img">
						<?php endif; ?>
                    </figure>
                    <div class="overlap btn btn-primary"><?php pll_e( 'ДЕТАЛЬНІШЕ' ); ?> <i
                                class="icon-arRight"></i></div>
                </a>
            </div>
        </div>
	<?php endforeach; ?>
</div>