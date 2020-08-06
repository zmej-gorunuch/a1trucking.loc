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
$recommended_articles = get_field( 'recommended_articles' );

?>
<?php if ( is_singular() ): ?>
    <main>
        <div class="container-fluid article-container p-zero">
			<?php if ( has_post_thumbnail() ): ?>
                <div class="article-fullwidth-img">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                </div>
			<?php endif; ?>

        </div>
        <div class="articles-info container">
            <div class="row align-center">
                <div class="articles-info col-xl-10 col-lg-10 ">
                    <div class="articles-data text-center">
                        <h6 class="articles-data-post"><?php echo get_the_time( 'd F Y рік' ); ?></h6>
                        <h2 class="articles-name-post --semibold"><?php echo get_the_title(); ?></h2>
                    </div>
                    <div class="row articles-text align-center">
                        <div class="article-text col-xl-9 col-lg-8 entry-content">
							<?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php if ( $recommended_articles ): ?>
            <div class="container">
                <div class="m-row">
                    <div class="articls">
                        <h2 class="heading-5 --semibold text-center">Вам може сподобатись</h2>
                        <div class="articl-slider">
							<?php foreach ( $recommended_articles as $article ): ?>
                                <div class="articl">
									<?php if ( has_post_thumbnail( $article ) ): ?>
						<a href="<?php echo get_permalink( $article ); ?>">
                                        <div class="articl-img">
                                            <img src="<?php echo get_the_post_thumbnail_url( $article ); ?>"
                                                 alt="<?php echo get_the_title( $article ); ?>">
                                        </div>
									<?php endif; ?>
                                    <div class="articl-over">
                                        <div class="articl-info">
                                            <span class="--bold"><?php echo get_the_title( $article ); ?></span>
                                            <p>Дізнатися більше</p>
                                        </div>
                                    </div>
						</a>
                                </div>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif; ?>
    </main>
<?php else: ?>
    <main>
        <div class="main container page-articles">
            <h2 class="page_title --semibold">Статті</h2>
            <div class="row align-center">
                <div class="articles-container">
                    <div class="articles col-xl-12 col-lg-12">
						<?php while ( have_posts() ): ?>

							<?php the_post(); ?>

                            <div class="articl col-lg-4">
								<?php if ( has_post_thumbnail() ): ?>
					<a href="<?php echo get_permalink(); ?>">
                                    <div class="articl-img">
                                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                    </div>
								<?php endif; ?>
                                <div class="articl-over">
                                    <div class="articl-info">
                                        <span class="--bold"><?php the_title(); ?></span>
                                        <p>Дізнатися більше</p>
                                    </div>
                                </div>
					</a>
                            </div>

						<?php endwhile; ?>
                    </div>
                </div>
                <section id="pagination" class="d-flex">
                    <div class="container">
                        <div class="row">
							<?php pagination_theme_display() ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
<?php endif; ?>