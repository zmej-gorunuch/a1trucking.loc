<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

/**
 * Custom fields
 */
$quote            = get_field( 'quote' );
$text             = get_field( 'text' );
$related_articles = get_field( 'related_articles' );

?>
<?php if ( is_singular() ): ?>

    <section class="single-post">
        <div class="container">
            <div class="row align-center">
                <div class="col-xl-8 col-lg-8 col-md-8 col-xs-12">

                    <div class="single-post__info text-center">
                        <h1 class="heading-2 --demi app-section__title mb-16"><?php the_title() ?></h1>
                        <time datetime="<?php the_time( 'd.m.y' ); ?>22.04.2019"
                              class="app__description single-post__date mb-16">
							<?php the_time( 'd F Y' ); ?>
                        </time>
                        <div class="default-icon single-post__icon mb-16">
							<?php if ( has_post_thumbnail() ): ?>
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							<?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/no-img.jpg" alt="no-img">
							<?php endif; ?>
                        </div>
                    </div>

                    <div class="entry-content">
                        <p>
							<?php echo get_the_content(); ?>
                        </p>
						<?php if ( $quote ): ?>
                            <blockquote>
                                <p><?php echo $quote; ?></p>
                            </blockquote>
						<?php endif; ?>
						<?php if ( $text ): ?>
                            <p>
								<?php echo $text; ?>
                            </p>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<?php if ( $related_articles ): ?>
        <section class="recommended-post">
            <div class="container">
                <div class="row align-center mb-36">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12 --relative">
                        <h3 class="text-center heading-3 app-screen__title --bold"><?php pll_e( 'Вам може сподобатись' ); ?></h3>
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
					<?php foreach ( $related_articles as $article ): ?>
                        <div class="post-carousel__item">
                            <div class="post-item">
                                <a href="<?php echo get_permalink( $article ); ?>"
                                   class="post-item__link d-flex align-end">
                                    <figure class="default-icon post-item__icon">
										<?php if ( has_post_thumbnail( $article ) ): ?>
                                            <img src="<?php echo get_the_post_thumbnail_url( $article ); ?>"
                                                 alt="<?php echo get_the_title( $article ); ?>">
										<?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/no-img.jpg"
                                                 alt="no-img">
										<?php endif; ?>
                                    </figure>
                                    <div>
                                        <time class="post-date align-middle">
                                            <div class="post-date__number --demi">
												<?php echo get_the_time( 'd', $article ); ?>
                                            </div>
                                            <div>
                                                <div class="post-date__month --medium"><?php echo get_the_time( 'F', $article ); ?></div>
                                                <div class="post-date__year --medium"><?php echo get_the_time( 'Y', $article ); ?></div>
                                            </div>
                                        </time>
                                        <h3 class="heading-4 --medium post-item__title"><?php echo get_the_title( $article ); ?></h3>
                                        <div class="app__description post-item__description">
											<?php echo custom_excerpt( array(
												'maxchar' => 130,
												'text'    => get_the_excerpt( $article )
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

<?php else: ?>

    <div class="post-item">
        <a href="<?php the_permalink(); ?>" class="post-item__link d-flex align-end">
            <figure class="default-icon post-item__icon">
				<?php if ( has_post_thumbnail() ): ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
				<?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/no-img.jpg" alt="no-img">
				<?php endif; ?>
            </figure>
            <div>
                <time class="post-date align-middle">
                    <div class="post-date__number --demi">
						<?php the_time( 'd' ); ?>
                    </div>
                    <div>
                        <div class="post-date__month --medium"><?php the_time( 'F' ); ?></div>
                        <div class="post-date__year --medium"><?php the_time( 'Y' ); ?></div>
                    </div>
                </time>
                <h3 class="heading-4 --medium post-item__title"><?php the_title(); ?></h3>
                <div class="app__description post-item__description">
					<?php echo custom_excerpt( array( 'maxchar' => 130 ) ) ?>
                </div>
            </div>
        </a>
    </div>

<?php endif; ?>