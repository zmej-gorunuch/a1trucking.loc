<?php
/*
Template Name: Подяка сторінка (шаблон)
*/

/**
 * Custom fields
 */

?>
<?php get_header(); ?>

    <section class="other-page --relative">
        <figure class="other-page__icon default-icon">
            <img src="<?php echo get_template_directory_uri() ?>/img/404_bg.jpg"
                 alt="banner icon"/>
        </figure>
        <div class="container full-height">
            <div class="row align-center align-middle full-height">
                <div class="col-xl-6 col-lg-7 col-md-8 col-xs-12 text-center overlap">
                    <div class="other-page__title heading-3 --bold"><?php pll_e( 'Дякуємо!' ); ?></div>
                    <div class="other-page__description heading-5">
	                    <?php pll_e( 'Ми отримали вашу заявку! Наш менеджер відповість вам у найкоротші строки' ); ?>
                    </div>
                    <a href="<?php echo pll_home_url(); ?>"
                       class="btn btn-primary --bold"> <?php pll_e( 'НА ГОЛОВНУ' ); ?><i
                                class="icon-arRight"></i> </a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>