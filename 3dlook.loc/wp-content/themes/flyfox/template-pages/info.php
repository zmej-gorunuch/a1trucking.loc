<?php
/*
Template Name: Thanks page (theme)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_description = ! empty( $block_1['description'] ) ? $block_1['description'] : null;
}
$block_2 = get_field( 'block_2' );
if ( $block_2 ) {
	$block_2_title             = ! empty( $block_2['title'] ) ? $block_2['title'] : null;
	$block_2_recent_blog_posts = ! empty( $block_2['recent_blog_posts'] ) ? $block_2['recent_blog_posts'] : null;
}
$block_3 = get_field( 'block_3' );
if ( $block_3 ) {
	$block_3_title  = ! empty( $block_3['title'] ) ? $block_3['title'] : null;
	$block_3_button = ! empty( $block_3['button'] ) ? $block_3['button'] : null;
}

?>
<?php get_header(); ?>
    <section class="main-oval thankspage">
        <div class="bg">
            <div class="bg1"></div>
        </div>
        <div class="wrap">
            <h1><?php wp_title( "", true ); ?></h1>
            <p><?php echo $block_1_description ?></p>
            <!-- <span class="mark">Get <span class="att">2 month for free if</span> billed yearly</span>
			<button type="button" class="btn red">Try it Now</button> -->
        </div>
    </section>
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!-- МАЄ БУТИ ІНШИЙ background-image -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <h2 class="thank__title"><?php echo $block_2_title ?></h2>

<?php if ( $block_2_recent_blog_posts ): ?>
    <section class="thanks-second">
        <div class="slider-arrows mob">
            <div class="slider-arrow icon-arr-r" id="ms-next"></div>
            <div class="slider-arrow icon-arr-l" id="ms-prev"></div>
        </div>
        <div class="tw-slider-hider">
            <div class="thank__wrap">
				<?php foreach ( array_slice( $block_2_recent_blog_posts, 0, 3 ) as $blog_post ): ?>
                    <div class="thank__post">
						<?php if ( has_post_thumbnail( $blog_post ) ): ?>
                            <img src="<?php echo get_the_post_thumbnail_url( $blog_post ); ?>"
                                 alt="<?php echo get_the_title( $blog_post->ID ); ?>">
						<?php endif; ?>
                        <div class="tw_pos">
							<?php $category = get_the_category( $blog_post->ID )[0]->cat_name ?>
                            <div class="tw_s"><?php echo ! empty( $category ) ? $category : null ?></div>
                            <div class="tw_title">
								<?php echo get_the_title( $blog_post->ID ); ?>
                            </div>
                            <a href="<?php echo get_permalink( $blog_post->ID ); ?>" class="icon-arr-r">Learn more</a>
                        </div>
                        <div class="tw_hover"></div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <div class="thank__title">
		<?php echo $block_3_title ?>
    </div>

    <section class="banner thank__baner">
        <div class="wrapl">
            <div class="block">
                <img src="./assets/img/thank/thank_baner_bg.svg" class="desc" alt="">
                <img src="" class="mob" alt="">
                <div class="block-text mob">
                    <span class="block-title">Subscribe to our Newsletter</span>
                    <span class="block-descr">Your source for the leading fashion tech industry tips, tricks and news delivered bi-weekly to your inbox</span>
                </div>
                <form id="thanks-banner-form">
                    <label>
                        <input type="text" placeholder="Email">
                    </label>
                    <button type="submit" class="btn red">SUBSCRIBE</button>
                </form>
            </div>
        </div>
    </section>


<?php get_footer(); ?>