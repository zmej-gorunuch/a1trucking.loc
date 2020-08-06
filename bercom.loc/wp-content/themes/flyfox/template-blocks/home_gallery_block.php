<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

$args  = array(
	'post_type'        => 'gallery',
	'include'          => pll_get_post( '880' ),
	'suppress_filters' => true,
);
$posts = get_posts( $args );

?>
<?php if ( $posts ): ?>
    <section class="home-works">
        <div class="container-fluid p-0 app-carousel__wrap --home --relative">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="--relative app-screen__wrap text-center">
                        <h3 class="app-screen__title heading-2 --bold --line"><?php pll_e( 'Виконані роботи' ); ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="carousel-caption --relative">
                        <div class="carousel-caption__content d-flex align-middle align-left">
                            <div class="overlap">
                                <h3 class="app-carousel-nav__title heading-2 --demi"><?php pll_e( 'Виконані роботи' ); ?></h3>
                                <div class="app-carousel-nav d-flex align-left">
                                    <button class="app-carousel-nav__arrow partners-carousel__arrow --prev d-flex align-middle align-center">
                                        <i class="icon-arrowLeft"></i>
                                    </button>
                                    <button class="app-carousel-nav__arrow partners-carousel__arrow --next d-flex align-middle align-center">
                                        <i class="icon-arrowRight"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-carousel carousel ">
						<?php foreach ( $posts as $post ): ?>
							<?php $photos = get_field( 'images', $post ) ?>
							<?php foreach ( $photos as $photo ): ?>
                                <div class="app-carousel__item --relative">
                                    <a href="<?php echo $photo['url'] ?>"
                                       class="works-item --relative">
                                        <figure>
                                            <div class="works-item__icon default-icon">
                                                <img src="<?php echo $photo['url'] ?>"
                                                     alt="<?php echo ( pll_current_language() == 'ru' && ! empty( $photo['alt'] ) ) ? $photo['alt'] : $photo['title'] ?>">
                                                <i class="icon-zoom"></i>
                                            </div>
                                            <figcaption>
                                                <div class="--medium works-item__title"><?php echo ( pll_current_language() == 'ru' && ! empty( $photo['alt'] ) ) ? $photo['alt'] : $photo['title'] ?></div>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>
							<?php endforeach; ?>
						<?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>