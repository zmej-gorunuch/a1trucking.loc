<?php
/*
Template Name: Каталог сторінка (шаблон)
*/

/**
 * Custom fields
 */
$seo_title = get_field( 'seo_title' );
$seo_text  = get_field( 'seo_text' );

?>
<?php get_header(); ?>

    <section class="catalog">
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

<?php if ( $seo_title || $seo_text ): ?>
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

<?php get_footer(); ?>