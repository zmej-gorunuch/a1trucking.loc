<?php
/**
 * Template part for displaying product content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

/**
 * Breadcrumb
 */
$term_id        = array_shift( get_the_terms( $post->ID, 'catalog_cat' ) )->term_id;
$term_parent_id = array_shift( get_the_terms( $post->ID, 'catalog_cat' ) )->parent;

/**
 * Custom fields
 */
$img       = get_field( 'img' );
$seo_title = esc_attr( get_field( 'seo_title' ) );
$seo_text  = get_field( 'seo_text' );

?>
<?php if ( is_singular() ): ?>
    <section class="single-product">
        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <li><a href="<?php the_page_link( 'catalog' ); ?>"><?php pll_e( 'Каталог' ); ?></a></li>
					<?php if ($term_parent_id): ?>
                        <li>
                            <a href="<?php echo get_term_link( $term_parent_id ) ?>"><?php echo get_term_field( 'name', $term_parent_id ) ?></a>
                        </li>
					<?php endif; ?>
                    <li>
                        <a href="<?php echo get_term_link( $term_id ) ?>"><?php echo get_term_field( 'name', $term_id ) ?></a>
                    </li>
                    <li><?php the_title(); ?> (товар)</li>
                </ul>
            </div>
            <div class="row m-row">
                <div class="column col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <figure class="product-icon default-icon sticky-icon">
						<?php if ( $img ): ?>
                            <img src="<?php echo $img[0]['url']; ?>" alt="<?php the_title(); ?>">
						<?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-img.jpg" alt="no-img">
						<?php endif; ?>
                    </figure>
                </div>
                <div class="column col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h5 class="product-title heading-3 --demi"><?php the_title(); ?></h5>
					<?php if ( get_the_content() ): ?>
                        <div class="product-description app__description">
							<?php the_content(); ?>
                        </div>
					<?php endif; ?>
					<?php if ( have_rows( 'parameters' ) ): ?>
                        <div class="product-characteristic">
                            <table>
                                <thead>
                                <tr>
                                    <th class="--medium"><?php pll_e( 'Характеристика' ); ?></th>
                                    <th class="--medium"><?php pll_e( 'Значення' ); ?></th>
                                </tr>
                                </thead>
                                <tbody>
								<?php while ( have_rows( 'parameters' ) ): the_row(); ?>
									<?php if ( get_row_layout() == 'Characteristics' ): ?>
                                        <tr>
                                            <td><?php the_sub_field( 'name' ); ?></td>
                                            <td class="--medium"><?php the_sub_field( 'value' ); ?></td>
                                        </tr>
									<?php endif; ?>
								<?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
					<?php endif; ?>
                    <button data-modal="#contact-modal" class="overlap btn btn-primary modalTrigger"><?php pll_e( 'ЗАМОВИТИ КОНСУЛЬТАЦІЮ' ); ?><i
                                class="icon-arRight"></i></button>
                </div>
            </div>
        </div>
    </section>

	<?php if ( $seo_title || $seo_text ): ?>
        <section class="seo">
            <div class="container">
                <div class="row align-center">
                    <div class="col-md-10 col-xs-12 seo-component">
						<?php if ( $seo_title ): ?>
                            <div class="seo-component__title heading-3 --bold"><?php echo $seo_title; ?></div>
						<?php endif; ?>

						<?php if ( $seo_text ): ?>
                            <div class="entry-content">
								<?php echo $seo_text; ?>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
	<?php endif; ?>

<?php else: ?>

    <div class="column col-xl-4 col-lg-6 col-md-12 col-sm-6 col-xs-12">
        <div class="product-item">
            <a href="<?php the_permalink(); ?>"
               class="d-flex align-content-justify product-item__link text-center">
                <figure class="product-item__icon default-icon">
					<?php if ( $img ): ?>
                        <img src="<?php echo $img[0]['url']; ?>" alt="product icon">
					<?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/no-img.jpg" alt="no-img">
					<?php endif; ?>
                </figure>
                <div class="product-item__content">
                    <h5 class="product-item__title heading-5 --medium"><?php the_title() ?></h5>
                    <div class="product-item__description app__description">
						<?php echo custom_excerpt( array( 'maxchar' => 100 ) ) ?>
                    </div>
                </div>
                <div class="product-item__btn btn btn-more"><?php pll_e( 'ДЕТАЛЬНІШЕ' ); ?></div>
            </a>
        </div>
    </div>

<?php endif; ?>