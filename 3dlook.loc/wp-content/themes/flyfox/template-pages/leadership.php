<?php
/*
Template Name: About Us page (theme)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_text                 = ! empty( $block_1['text'] ) ? $block_1['text'] : null;
	$block_1_year_founded         = ! empty( $block_1['year_founded'] ) ? $block_1['year_founded'] : null;
	$block_1_team_members         = ! empty( $block_1['team_members'] ) ? $block_1['team_members'] : null;
	$block_1_phd_degrees          = ! empty( $block_1['phd_degrees'] ) ? $block_1['phd_degrees'] : null;
	$block_1_coffee_cups_everyday = ! empty( $block_1['coffee_cups_everyday'] ) ? $block_1['coffee_cups_everyday'] : null;
}
$block_2 = get_field( 'block_2' );
if ( $block_2 ) {
	$block_2_foto        = ! empty( $block_2['foto'] ) ? $block_2['foto'] : null;
	$block_2_name        = ! empty( $block_2['name'] ) ? $block_2['name'] : null;
	$block_2_position    = ! empty( $block_2['position'] ) ? $block_2['position'] : null;
	$block_2_title       = ! empty( $block_2['title'] ) ? $block_2['title'] : null;
	$block_2_description = ! empty( $block_2['description'] ) ? $block_2['description'] : null;
	$block_2_button      = ! empty( $block_2['button'] ) ? $block_2['button'] : null;
}
$block_3 = get_field( 'block_3' );
if ( $block_3 ) {
	$block_3_title       = ! empty( $block_3['title'] ) ? $block_3['title'] : null;
	$block_3_description = ! empty( $block_3['description'] ) ? $block_3['description'] : null;
	$block_3_button      = ! empty( $block_3['button'] ) ? $block_3['button'] : null;
	$block_3_image       = ! empty( $block_3['image'] ) ? $block_3['image'] : null;
	$block_3_our_product = ! empty( $block_3['our_product'] ) ? $block_3['our_product'] : null;
}
$block_4 = get_field( 'block_4' );
if ( $block_4 ) {
	$block_4_title = ! empty( $block_4['title'] ) ? $block_4['title'] : null;
}
$block_5 = get_field( 'block_5' );
if ( $block_5 ) {
	$block_5_title      = ! empty( $block_5['title'] ) ? $block_5['title'] : null;
	$block_5_text       = ! empty( $block_5['text'] ) ? $block_5['text'] : null;
	$block_5_principles = ! empty( $block_5['principles'] ) ? $block_5['principles'] : null;
}
$block_6 = get_field( 'block_6' );
if ( $block_6 ) {
	$block_6_title   = ! empty( $block_6['title'] ) ? $block_6['title'] : null;
	$block_6_text    = ! empty( $block_6['text'] ) ? $block_6['text'] : null;
	$block_6_offices = ! empty( $block_6['offices'] ) ? $block_6['offices'] : null;
}
$block_7 = get_field( 'block_7' );
if ( $block_7 ) {
	$block_7_text        = ! empty( $block_7['text'] ) ? $block_7['text'] : null;
	$block_7_title       = ! empty( $block_7['title'] ) ? $block_7['title'] : null;
	$block_7_description = ! empty( $block_7['description'] ) ? $block_7['description'] : null;
	$block_7_button      = ! empty( $block_7['button'] ) ? $block_7['button'] : null;
	$block_7_image       = ! empty( $block_7['image'] ) ? $block_7['image'] : null;
}

?>
<?php get_header(); ?>
    <section class="main-oval main-about">
        <div class="bg">
            <div class="bg1"></div>
        </div>
        <div class="wrap">
            <h1><?php wp_title( "", true ); ?></h1>
            <p><?php echo $block_1_text ?></p>
            <!-- <span class="mark">Get <span class="att">2 month for free if</span> billed yearly</span>
			<button type="button" class="btn red">Try it Now</button> -->
            <div class="about__counters">
                <div class="about__counter">
                    <h3 class="ac_title"><?php echo $block_1_year_founded ?></h3>
                    <p class="p_short">Year Founded</p>
                </div>
                <div class="about__counter">
                    <h3 class="ac_title"><?php echo $block_1_team_members ?></h3>
                    <p class="p_short">Team Members</p>
                </div>
                <div class="about__counter">
                    <h3 class="ac_title"><?php echo $block_1_phd_degrees ?></h3>
                    <p class="p_short">Ph.D. Degrees</p>
                </div>
                <div class="about__counter">
                    <h3 class="ac_title"><?php echo $block_1_coffee_cups_everyday ?><span>+</span></h3>
                    <p class="p_short">Coffee Cups Everyday</p>
                </div>
            </div>
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
    <section class="about__do">
        <div class="wrapl">
            <div class="about__img">
                <img src="<?php echo $block_2_foto['url'] ?>" alt="<?php echo $block_2_name ?>">
                <div class="h4_left"><?php echo $block_2_name ?></div>
                <div class="p_about"><?php echo $block_2_position ?></div>
            </div>
            <div class="about__text apl">
                <h2 class="h2_about"><?php echo $block_2_title ?></h2>
                <p class="subtitle"><?php echo $block_2_description ?></p>
                <a href="<?php echo $block_2_button['url'] ?>" target="<?php echo $block_2_button['target'] ?>"
                   class="btn btn_orange"><?php echo $block_2_button['title'] ?></a>
            </div>

        </div>
    </section>

    <section class="about__do pth">
        <div class="wrapl">
            <div class="about__text apr">
                <h2 class="h2_about"><?php echo $block_3_title ?></h2>
                <p class="subtitle"><?php echo $block_3_description ?></p>
                <a href="<?php echo $block_3_button['url'] ?>" target="<?php echo $block_3_button['target'] ?>"
                   class="btn btn_orange"><?php echo $block_3_button['title'] ?></a>
            </div>
            <div class="about__img imgr">
                <img src="<?php echo $block_3_image['url'] ?>" alt="">
                <div class="h4_left">Our product</div>
                <div class="p_about"><?php echo $block_3_our_product ?></div>
            </div>
        </div>
    </section>

    <section class="about__timeline">
        <h2 class="about__timeline_title">
			<?php echo $block_4_title ?>
        </h2>

        <div class="about__years swiper-container">
            <div class="about__year_prev">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/about/next.png" alt="">
            </div>
            <div class="swiper-wrapper">
                <div class="swiper-slide about__year active">2019</div>
                <div class="swiper-slide about__year">2018</div>
                <div class="swiper-slide about__year">2017</div>
            </div>
            <div class="about__year_next">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/about/next.png" alt="">
            </div>
        </div>

        <div class="about__timeline_start">
            Today
        </div>
        <div class="timeline_boxes">
            <div class="timeline_box tbl">
                <div class="tbl">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/about/square-figure.png" alt="">
                    <h4 class="th4">TOP5 Mobile Startups at 4YFN</h4>
                    <p class="p_short">3DLOOK chosen as one of the five finalists in the 4YFN19 Awards among the best
                        retail focused startups in the world.</p>
                    <p class="p_date">August, 2019</p>
                </div>
            </div>
            <div class="timeline_box tbr btmt1">
                <div class="tbr">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/about/cover.png" alt="">
                    <h4 class="th4">SAIA PF for Shopify</h4>
                    <p class="p_short">Size-recommendation solution SAIA Perfect Fit officially launched on Shopify
                        e-commerce platform for the store owners selling apparel.</p>
                    <p class="p_date">April, 2019</p>
                </div>
            </div>

            <div class="timeline_box tbl nta btmt2">
                <div class="tbl">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/about/cover3.png" alt="">
                    <h4 class="th4">TOP10 000 Fastest Growing Companies</h4>
                    <p class="p_short">Listed in Growjo's top 10 000 Fastest Growing Companies for accomplishments in
                        the Tech Service sector.</p>
                    <p class="p_date">February, 2019 </p>
                </div>
            </div>
            <div class="timeline_box">
                <div class="start_year sy_b">2018</div>
            </div>

            <div class="timeline_box tbl nta">
                <div class="tbl">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/about/cover4.png" alt="">
                    <h4 class="th4">$1M Seed round</h4>
                    <p class="p_short">Closed on a $1 million investment Seed round from uVentures, 500 Startups and
                        several angel investors. </p>
                    <p class="p_date">January, 2019 </p>
                </div>
            </div>
            <div class="timeline_box tbr nta btmt2">
                <div class="tbr">
                    <h4 class="th4">LVMH Innovation Award</h4>
                    <p class="p_short">3DLOOK chosen as one of the five finalists in the 4YFN19 Awards among the best
                        retail focused startups in the world.</p>
                    <p class="p_date">September, 2019 </p>
                </div>
            </div>

            <div class="timeline_box">
            </div>
            <div class="timeline_box tbr nta btmt4">
                <div class="tbr">
                    <h4 class="th4">DT Innovation Grand Challenge</h4>
                    <p class="p_short">3DLOOK chosen as one of the five finalists in the 4YFN19 Awards among the best
                        retail focused startups in the world.</p>
                    <p class="p_date">June, 2019 </p>
                </div>
            </div>

        </div>
        <div class="about__timeline_more">
            More
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/about/drop-down.png" alt="">
        </div>

    </section>

    <section class="about__believe">
        <h2 class="h2_title"><?php echo $block_5_title ?></h2>
        <div class="subtitle"><?php echo $block_5_text ?></div>

		<?php if ( $block_5_principles ): ?>
            <div class="about__believe_container">
				<?php foreach ( $block_5_principles as $principle ): ?>
                    <div class="about__believe_item">
                        <img src="<?php echo $principle['image']['url'] ?>" alt="<?php echo $principle['label'] ?>">
                        <h4 class="h4_b"><?php echo $principle['label'] ?></h4>
                        <p class="p_short"><?php echo $principle['description'] ?></p>
                    </div>
				<?php endforeach; ?>
            </div>
		<?php endif; ?>

    </section>

    <section class="about__offices">
        <h2 class="h2_title"><?php echo $block_6_title ?></h2>
        <div class="subtitle"><?php echo $block_6_text ?></div>

		<?php if ( $block_6_offices ): ?>
            <div class="about__offices_cantainer">
				<?php foreach ( $block_6_offices as $office ): ?>
                    <div class="about__offices_item">
                        <img src="<?php echo $office['image']['url'] ?>" alt="<?php echo $office['name'] ?>">
                        <div>
                            <div class="ao_title_wrap">
                                <div class="ao_title">
									<?php echo $office['name'] ?>
                                </div>
                                <p class="p_location">
									<?php echo $office['location'] ?>
                                </p>
                            </div>
                            <p class="p_short">
								<?php echo $office['description'] ?>
                            </p>
                            <div class="ao_hover">
                                <a href="<?php echo $office['button']['url'] ?>"
                                   target="<?php echo $office['button']['target'] ?>"
                                   class="btn btn_orange"><?php echo $office['button']['title'] ?></a>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
		<?php endif; ?>

    </section>

    <section class="about__baner">

        <div class="about__baner_title">
			<?php echo $block_7_text ?>
        </div>

        <div class="about__baner_box">
            <img src="<?php echo $block_7_image['url'] ?>" alt="figure">
            <div class="about__baner_box_wrap">
                <div class="about__baner_box_title">
					<?php echo $block_7_title ?>
                </div>
                <p class="p_short">
					<?php echo $block_7_description ?>
                </p>
                <a href="<?php echo $block_7_button['url'] ?>" target="<?php echo $block_7_button['target'] ?>"
                   class="btn btn_orange"><?php echo $block_7_button['title'] ?></a>
            </div>
        </div>

    </section>

<?php get_footer(); ?>