<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

?>
<? get_header(); ?>

<?php if ( have_posts() ): ?>

    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="app-screen__title heading-2 --demi text-center"><?php pll_e( 'Блог' ); ?></h3>
                </div>
            </div>
            <div class="galleryrow">

				<?php while ( have_posts() ): ?>

					<?php the_post(); ?>

					<?php get_template_part( 'template-parts/content', get_post_type() ); ?>

				<?php endwhile; ?>

            </div>
            <div class="row align-center">
                <?php pagination_theme_display() ?>
            </div>
        </div>
    </section>

<?php else: ?>

	<?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>