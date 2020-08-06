<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

/**
 * Service list
 */
$services = get_posts( array(
	'post_type'        => 'service',
	'suppress_filters' => true,
	'orderby'     => 'date',
	'order'       => 'ASC',
) );

/**
 * Custom fields
 */
$images    = get_field( 'images' );
$seo_title = esc_attr( get_field( 'seo_title' ) );
$seo_text  = get_field( 'seo_text' );

?>
<?php if ( is_singular() ): ?>

    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-5 col-xs-12">
                    <ul class="filter">
						<?php foreach ( $services as $service ): ?>
                            <li class="filter-item d-flex align-justify <?php echo $service->ID == $post->ID ? 'current' : '' ?>">
                                <a href="<?php the_permalink( $service->ID ); ?>"
                                   class="filter-item__link"><?php echo get_the_title( $service->ID ); ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-7 col-xs-12">
                    <div class="services-name heading-3 --bold"><?php the_title() ?></div>
                    <div class="services-description app__description">
						<?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<?php if ( $images ): ?>
        <section class="services-gallery">
            <div class="container-fluid p-0 app-carousel__wrap">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                        <div class="app-carousel carousel ">
							<?php foreach ( $images as $image ): ?>
                                <div class="app-carousel__item">
                                    <figure class="app-carousel__icon default-icon">
                                        <img src="<?php echo $image['url']; ?>"
                                             alt="img">
                                    </figure>
                                </div>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	<?php endif; ?>

	<?php if ( $seo_text || $seo_title ): ?>
        <section class="seo">
            <div class="container">
                <div class="row align-center">
                    <div class="col-md-10 col-xs-12 seo-component">
						<?php if ( $seo_title ): ?>
                            <div class="seo-component__title heading-3 --bold"><?php echo $seo_title; ?></div>
						<?php endif; ?>
						<?php if ( $seo_text ): ?>
                            <div class="entry-content">
								<?php echo $seo_text ?>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
	<?php endif; ?>

<?php else: ?>

    <p>List (wp-content/themes/flyfox/template-parts/content-service.php)</p>

<?php endif; ?>