<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

$args  = array(
	'post_type'        => 'post',
	'numberposts'      => 8,
	'suppress_filters' => true,
);
$posts = get_posts( $args );

?>
<?php if ( $posts ): ?>
    <section class="home-news">
        <div class="container">
            <div class="row align-center mb-36">
                <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12 --relative">
                    <div class="--relative app-screen__wrap text-center">
                        <h3 class="app-screen__title heading-2 --bold --line"><?php pll_e( 'Наші новини' ); ?></h3>
                        <div class="app-screen__subtitle"><?php pll_e( 'Новини' ); ?></div>
                    </div>
                    <div class="d-flex align-middle recommended-post__nav">
                        <a href="<?php echo get_page_link( pll_get_post( 149 ) ) ?>" class="link-more">
                            <div class="icon-more d-flex align-justify align-content-justify">
                                <span class="icon-more__item"></span>
                                <span class="icon-more__item"></span>
                                <span class="icon-more__item"></span>
                                <span class="icon-more__item"></span>
                            </div>
							<?php pll_e( 'Усі новини' ); ?>
                        </a>

                        <div class="app-carousel-nav d-flex align-left">
                            <button class="app-carousel-nav__arrow post-carousel__arrow --prev d-flex align-middle align-center">
                                <i class="icon-arrowLeft"></i>
                            </button>
                            <button class="app-carousel-nav__arrow post-carousel__arrow --next d-flex align-middle align-center">
                                <i class="icon-arrowRight"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="post-carousel carousel">
				<?php foreach ( $posts as $post ): ?>
                    <div class="post-carousel__item">
                        <div class="post-item">
                            <a href="<?php echo get_permalink( $post ); ?>" class="post-item__link d-flex align-end">
                                <figure class="default-icon post-item__icon">
									<?php if ( has_post_thumbnail( $post ) ): ?>
                                        <img src="<?php echo get_the_post_thumbnail_url( $post ); ?>"
                                             alt="<?php echo get_the_title( $post ); ?>">
									<?php else: ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/no-img.jpg"
                                             alt="no-img">
									<?php endif; ?>
                                </figure>
                                <div>
                                    <time class="post-date align-middle">
                                        <div class="post-date__number --demi">
											<?php echo get_the_time( 'd', $post ); ?>
                                        </div>
                                        <div>
                                            <div class="post-date__month --medium"><?php echo get_the_time( 'F', $post ); ?></div>
                                            <div class="post-date__year --medium"><?php echo get_the_time( 'Y', $post ); ?></div>
                                        </div>
                                    </time>
                                    <h3 class="heading-4 --medium post-item__title"><?php echo get_the_title( $post ); ?></h3>
                                    <div class="app__description post-item__description">
										<?php echo custom_excerpt( array(
											'maxchar' => 130,
											'text'    => get_the_excerpt( $post )
										) ) ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
