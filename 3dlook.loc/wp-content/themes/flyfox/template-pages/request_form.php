<?php
/*
Template Name: Info page (theme)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_image  = ! empty( $block_1['image'] ) ? $block_1['image'] : null;
	$block_1_title  = ! empty( $block_1['title'] ) ? $block_1['title'] : null;
	$block_1_text   = ! empty( $block_1['text'] ) ? $block_1['text'] : null;
	$block_1_button = ! empty( $block_1['button'] ) ? $block_1['button'] : null;
}

?>
<?php get_header(); ?>

    <section class="main-oval info__pp_main_bg">
        <div class="bg">
            <div class="bg_info__pp"></div>
        </div>
        <div class="wrap">
            <h1>#<?php wp_title( "", true ); ?></h1>
            <div class="info__pp_updated">
                <div>Last updated:</div>
                <div><?php the_modified_date( 'F d, Y' ) ?></div>
            </div>
            <!-- <p>We are result-oriented enthusiasts who work tirelessly to build technology which has the potential to transform the fashion industry and how we shop online</p> -->
            <!-- <span class="mark">Get <span class="att">2 month for free if</span> billed yearly</span>
			<button type="button" class="btn red">Try it Now</button> -->
        </div>
    </section>

    <section class="info_pp__content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; endif; ?>
    </section>

    <section class="banner">
        <div class="wrapl">
            <div class="block">
                <img src="<?php echo $block_1_image['url'] ?>" alt="Banner" class="desc">
                <img src="<?php echo $block_1_image['url'] ?>" alt="Banner" class="mob">
                <a href="<?php echo $block_1_button['url'] ?>" target="<?php echo $block_1_button['target'] ?>"
                   class="btn red"><?php echo $block_1_button['title'] ?></a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>