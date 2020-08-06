<?php
/*
Template Name: Home page (theme)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_title   = $block_1['title'];
	$block_1_content = $block_1['content'];
	$block_1_video   = $block_1['video'];
	$block_1_button  = $block_1['button'];
}
$block_2 = get_field( 'block_2' );
if ( $block_2 ) {
	$block_2_title   = $block_2['title'];
	$block_2_content = $block_2['content'];
	$block_2_video   = $block_2['image'];
	$block_2_button  = $block_2['button'];
}
$block_3 = get_field( 'block_3' );
if ( $block_3 ) {
	$block_3_title   = $block_3['title'];
	$block_3_content = $block_3['content'];
}
$block_4 = get_field( 'block_4' );
if ( $block_4 ) {
	$block_4_title    = $block_4['title'];
	$block_4_benefits = $block_4['benefits'];
}
$block_5 = get_field( 'block_5' );
if ( $block_5 ) {
	$block_5_title   = $block_5['title'];
	$block_5_content = $block_5['content'];
	$block_5_button  = $block_5['button'];
}
$block_6 = get_field( 'block_6' );
if ( $block_6 ) {
	$block_6_responses_title = $block_6['responses_title'];
	$block_6_title           = $block_6['title'];
	$block_6_content         = $block_6['content'];
}
$block_7 = get_field( 'block_7' );
if ( $block_7 ) {
	$block_7_title = $block_7['title'];
}
?>
<?php get_header(); ?>
    <section class="main">
        <div class="bg">
            <div class="bg1"></div>
        </div>
        <div class="wrap">
            <div class="col">
				<?php if ( ! empty( $block_1_title ) ): ?>
                    <h1><?php echo $block_1_title; ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $block_1_content ) ): ?>
                    <p><?php echo $block_1_content; ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $block_1_button ) ): ?>
                    <a href="<?php echo $block_1_button['url']; ?>" target="<?php echo $block_1_button['target']; ?>"
                       class="btn red" type="button"><?php echo $block_1_button['title']; ?></a>
				<?php endif; ?>
            </div>
            <div class="col">
                <div class="video">
					<?php if ( ! empty( $block_1_video ) ): ?>
                        <iframe src="<?php echo $block_1_video; ?>" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="bdp">
        <div class="bg">
            <div class="bg1"></div>
            <div class="bg2"></div>
        </div>
        <div class="wrap">
            <div class="col">
				<?php if ( ! empty( $block_2_title ) ): ?>
                    <h2><?php echo $block_2_title; ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $block_2_content ) ): ?>
                    <p><?php echo $block_2_content; ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $block_2_button ) ): ?>
                    <a href="<?php echo $block_2_button['url']; ?>" target="<?php echo $block_2_button['target']; ?>"
                       class="btn black"><?php echo $block_2_button['title']; ?></a>
				<?php endif; ?>
            </div>
        </div>
    </section>

    <section class="fip">
        <div class="center">
			<?php if ( ! empty( $block_3_title ) ): ?>
                <h2><?php echo $block_3_title; ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $block_3_content ) ): ?>
                <p><?php echo $block_3_content; ?></p>
			<?php endif; ?>
        </div>
        <div id="fip-switch" class="">
            <div id="fip-switch-bg"></div>
            <div id="fip-switch-slider-wrap">
                <div id="fip-switch-slider">
                    <div id="fip-left">
                        <div class="fip-bg"></div>
                    </div>
                    <div id="fip-right">
                        <div class="fip-bg"></div>
                    </div>
                </div>
            </div>
            <div id="fip-center">
                <div class="fip-bg fip-bg1"></div>
                <div class="fip-bg fip-bg2"></div>
                <div id="fip-title">Skinny Jeans</div>
                <div id="fip-phone">
                    <div id="fip-phone-bg"></div>
                    <div id="fip-phone-title">Your recommended size</div>
                    <div id="fip-phone-sizes">
                        <div id="fip-phone-slider">

                            <div class="fip-phone-size">23</div>
                            <div class="fip-phone-size active">24</div>
                            <div class="fip-phone-size">25</div>
                            <div class="fip-phone-size">26</div>
                            <div class="fip-phone-size">27</div>

                        </div>
                    </div>
                    <div id="fip-phone-img"></div>
                    <div class="btn black">Select this size</div>
                </div>
                <div id="fip-tag">
                    <div id="fip-tag-text">Purchased size</div>
                    <div id="fip-tag-bg">
                        <div id="fip-tag-nums">
                            <div id="fip-tag-slider">

                                <div class="fip-tag-num">23</div>
                                <div class="fip-tag-num">24</div>
                                <div class="fip-tag-num">25</div>
                                <div class="fip-tag-num">26</div>
                                <div class="fip-tag-num">27</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="fip-controls">
                <div id="fip-arr-l" class="btnr icon-arr-l"></div>
                <div id="fip-dots">
                    <div class="fip-dot"></div>
                    <div class="fip-dot"></div>
                </div>
                <div id="fip-arr-r" class="btnr icon-arr-r"></div>
            </div>
        </div>
    </section>

    <section class="wcb">
        <div class="bg">
            <div class="bg1"></div>
        </div>
        <div class="center">
			<?php if ( ! empty( $block_4_title ) ): ?>
                <h2><?php echo $block_4_title; ?></h2>
			<?php endif; ?>
        </div>
		<?php if ( ! empty( $block_4_benefits ) ): ?>
            <div class="grid-slider">
                <div class="grid" id="wcb-slider">
					<?php $i = 1; ?>
					<?php foreach ( $block_4_benefits as $benefit ): ?>
                        <div class="g-elem <?php echo 5 == $i ? 'g4' : 'g2' ?>">
                            <div class="g-img">
								<?php if ( $benefit['image'] ): ?>
                                    <img src="<?php echo $benefit['image']['url']; ?>"
                                         alt="<?php echo $benefit['title']; ?> event">
								<?php endif; ?>
                            </div>
                            <div class="g-text"
                                 data-t="<?php echo $benefit['title']; ?>"><?php echo $benefit['title']; ?></div>
                        </div>
						<?php $i ++; ?>
					<?php endforeach; ?>
                </div>
            </div>
		<?php endif; ?>
        <div class="slider-dots wcb-dots">
            <div class="slider-dot wcb-dot"></div>
            <div class="slider-dot wcb-dot"></div>
            <div class="slider-dot wcb-dot"></div>
            <div class="slider-dot wcb-dot"></div>
            <div class="slider-dot wcb-dot"></div>
        </div>
    </section>

    <section class="onestep">
        <div class="bg">
            <div class="bg1"></div>
            <div class="bg2"></div>
        </div>
        <div class="wrap">
            <div class="col">
				<?php if ( ! empty( $block_5_title ) ): ?>
                    <h2><?php echo $block_5_title; ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $block_5_content ) ): ?>
                    <p><?php echo $block_5_content; ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $block_5_button ) ): ?>
                    <a href="<?php echo $block_5_button['url']; ?>" target="<?php echo $block_5_button['target']; ?>"
                       class="btn black"><?php echo $block_5_button['title']; ?></a>
				<?php endif; ?>
            </div>
        </div>
    </section>

    <section class="ocp">
        <div class="wrapl">
			<?php if ( ! empty( $block_6_responses_title ) ): ?>
                <h2><?php echo $block_6_responses_title; ?></h2>
			<?php endif; ?>

			<?php get_template_part( 'template-blocks/reviews_block' ); ?>

        </div>
    </section>

    <section class="fitno">
        <div class="wrapl">
            <div class="block">
				<?php if ( ! empty( $block_6_title ) ): ?>
                    <div class="block-title"><?php echo $block_6_title; ?></div>
				<?php endif; ?>
				<?php if ( ! empty( $block_6_content ) ): ?>
                    <div class="block-descr"><?php echo $block_6_content; ?></div>
				<?php endif; ?>
            </div>
        </div>
    </section>

    <section class="ms">
        <div class="wrapl">
			<?php if ( ! empty( $block_7_title ) ): ?>
                <h2><?php echo $block_7_title; ?></h2>
			<?php endif; ?>

			<?php get_template_part( 'template-blocks/events_block' ); ?>

        </div>
    </section>

<?php get_footer(); ?>