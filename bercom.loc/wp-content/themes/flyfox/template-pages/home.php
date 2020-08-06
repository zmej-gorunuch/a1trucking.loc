<?php
/*
Template Name: Головна сторінка (шаблон)
*/

/**
 * Custom fields
 */
$sliders              = get_field( 'slide' );
$about_img            = get_field( 'about_img' );
$about_img_background = get_field( 'about_img_background' );
$about_description    = esc_attr( get_field( 'about_description' ) );
$partners             = get_field( 'partners_imgs' );

?>
<?php get_header(); ?>

<?php if ( $sliders ): ?>
	<?php foreach ( $sliders as $slide ): ?>
        <section class="primary-screen">
            <div class="container full-height --relative">
                <div class="row full-height align-center">
                    <div class="col-xl-10 col-sm-12 col-xs-12 d-flex align-middle primary-screen__content text-center">
                        <div class="overlap ">
							<?php if ( $slide['title'] ): ?>
                                <h1 class="primary-screen__title --uppercase heading-1 mb-30">
									<?php echo $slide['title']; ?>
                                </h1>
							<?php endif; ?>
							<?php if ( $slide['description'] ): ?>
                                <div class="primary-screen__description mb-30">
									<?php echo $slide['description']; ?>
                                </div>
							<?php endif; ?>
							<?php if ( $slide['link'] ): ?>
                                <div class="overlap btn btn-primary__long">
                                    <a href="<?php echo $slide['link']['url']; ?>" <?php echo ! empty( $slide['link']['target'] ) ? 'target="' . $slide['link']['target'] . '"' : null; ?>>
                                <span>
                                    <?php echo $slide['link']['title']; ?> <i class="icon-arRight"></i>
                                </span>
                                    </a>
                                </div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <figure class="primary-screen__icon default-icon">
				<?php if ( $slide['image'] ): ?>
                    <img src="<?php echo $slide['image']; ?>" alt="banner icon"/>
				<?php else: ?>
                    <img src="<?php echo get_template_directory_uri() ?>/img/no-img.jpg" alt="no-img"/>
				<?php endif; ?>
            </figure>
        </section>
	<?php endforeach; ?>
<?php endif; ?>

<section class="home-catalog">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="--relative app-screen__wrap text-center">
                    <h3 class="app-screen__title heading-2 --bold --line"><?php pll_e( 'Каталог' ); ?></h3>
                    <div class="app-screen__subtitle"><?php pll_e( 'Каталог' ); ?></div>
                </div>
            </div>
        </div>
		<?php get_template_part( 'template-blocks/catalog_block' ); ?>
    </div>
</section>

<?php get_template_part( 'template-blocks/home_gallery_block' ); ?>

<?php get_template_part( 'template-blocks/home_blog_block' ); ?>

<section class="home-partners">
    <div class="container-fluid p-0 app-carousel__wrap --home --relative">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="--relative app-screen__wrap text-center">
                    <h3 class="app-screen__title heading-2 --bold --line"><?php pll_e( 'Наші Партнери' ); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="carousel-caption --relative">
                    <div class="carousel-caption__content d-flex align-middle align-left">
                        <div class="overlap">
                            <h3 class="app-carousel-nav__title heading-2 --demi"><?php pll_e( 'Наші' ); ?>
                                <br><?php pll_e( 'Партнери' ); ?></h3>
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
					<?php if ( $partners ): ?>
						<?php foreach ( $partners as $image ): ?>
                            <div class="app-carousel__item">
                                <figure class="home-partners__icon d-flex align-center align-middle">
                                    <img src="<?php echo esc_url( $image['url'] ); ?>"
                                         alt="<?php echo esc_attr( $image['title'] ) ?>">
                                </figure>
                            </div>
						<?php endforeach; ?>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-about">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex align-right align-middle --relative">
                <figure class="home-about__bg default-icon">
					<?php if ( $about_img_background ): ?>
                        <img src="<?php echo $about_img_background; ?>" alt="banner icon"/>
					<?php else: ?>
                        <img src="<?php echo get_template_directory_uri() ?>/img/no-img.jpg" alt="no-img"/>
					<?php endif; ?>
                </figure>
                <div class="home-about__content">
                    <h4 class="home-about__title heading-3 --demi"><?php pll_e( 'Про нас' ); ?></h4>
                    <div class="home-about__description heading-5">
						<?php echo $about_description; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <figure class="home-about__icon default-icon">
					<?php if ( $about_img ): ?>
                        <img src="<?php echo $about_img ?>" alt="banner icon"/>
					<?php else: ?>
                        <img src="<?php echo get_template_directory_uri() ?>/img/no-img.jpg" alt="no-img"/>
					<?php endif; ?>
                </figure>
            </div>
        </div>
    </div>

</section>

<?php get_footer(); ?>
