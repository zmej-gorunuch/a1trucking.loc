<?php
/*
Template Name: Про нас сторінка (шаблон)
*/

/**
 * Custom fields
 */
$title              = esc_attr( get_field( 'title' ) );
$img                = get_field( 'img' );
$activities         = explode( ';', get_field( 'activity' ) );
$description_top    = get_field( 'description_top' );
$description_bottom = get_field( 'description_bottom' );

?>
<?php get_header(); ?>

    <section class="about">
        <div class="container">
            <div class="row align-center ">
                <div class="col-xl-10 col-lg-10 col-md-10 col-xs-12">
					<?php if ( $title ): ?>
                        <h1 class="about-title --bold text-center">
							<?php echo $title; ?>
                        </h1>
					<?php endif; ?>
					<?php if ( $img ): ?>
                        <figure class="about-icon">
                            <img src="<?php echo $img; ?>" alt="about icon">
                        </figure>
					<?php endif; ?>
                </div>
            </div>

			<?php if ( $activities ): ?>
                <div class="row align-center ">
                    <div class="col-xl-8 col-lg-8 col-md-10 col-xs-12">
                        <div class="entry-content">
                            <h3><?php pll_e( 'Напрямки діяльності фірми:' ); ?></h3>
                            <ul>
								<?php foreach ( $activities as $activity ): ?>
                                    <li><?php echo $activity; ?></li>
								<?php endforeach; ?>
                            </ul>

							<?php if ( $description_top ): ?>
								<?php echo $description_top; ?>
							<?php endif; ?>

                        </div>
                    </div>
                </div>
			<?php endif; ?>

            <div class="row align-center ">
                <div class="col-xl-10 col-lg-10 col-md-10 col-xs-12">
                    <div class="about-catalog">
                        <div class="about-catalog__title --medium"><?php pll_e( 'Пропонуємо продукцію власного виробництва:' ); ?></div>

						<?php get_template_part( 'template-blocks/catalog_block' ); ?>

                    </div>
                </div>
            </div>

			<?php if ( $description_bottom ): ?>
                <div class="row align-center">
                    <div class="col-xl-8 col-lg-10 col-md-10 col-xs-12">
                        <div class="entry-content">
							<?php echo $description_bottom; ?>
                        </div>
                    </div>
                </div>
			<?php endif; ?>

        </div>
    </section>

<?php get_footer(); ?>