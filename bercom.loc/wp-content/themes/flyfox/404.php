<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FlyFox
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
                    <div class="other-page__number --demi">404</div>
                    <div class="other-page__title heading-3 --bold"><?php pll_e( 'Сторінка не існує' ); ?></div>
                    <div class="other-page__description heading-5">
						<?php pll_e( 'Вибачте, цієї сторінки не існує, спробуйте повернутись на головну та повторити спробу ще раз' ); ?>
                    </div>
                    <a href="<?php echo pll_home_url(); ?>"
                       class="btn btn-primary --bold"> <?php pll_e( 'НА ГОЛОВНУ' ); ?><i
                                class="icon-arRight"></i> </a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>