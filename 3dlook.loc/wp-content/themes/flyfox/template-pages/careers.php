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
/**
 * Company event
 */
$years = get_terms( [
	'taxonomy'   => 'company_event_cat',
	'orderby'    => 'name',
	'order'      => 'DESC',
	'hide_empty' => false,
] );

$args          = [
	'post_type'        => 'company_event',
	'numberposts'      => - 1,
	'suppress_filters' => true,
];
$company_event = get_posts( $args );

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
        <div class="wrapl">

            <h2 class="about__timeline_title"><?php echo $block_4_title ?></h2>
			<?php if ( $years ): ?>
                <div class="tb-years-wrapper">
                    <button type="button" class="btnr black icon-arr-l hidden" id="yprev"></button>
                    <div class="tb-years-hider">
                        <div class="tb-years-window">
                            <div class="tb-years-elems">
								<?php foreach ( $years as $key => $year ): ?>
                                    <div class="tb-years-elem <?php echo ( $key == 0 ) ? 'active' : null ?>">
                                        <span><?php echo $year->name ?></span></div>
								<?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btnr black icon-arr-r" id="ynext"></button>
                </div>
			<?php endif; ?>
            <div class="tb-elems-hider">
                <div class="tb-elems-slider">
					<?php foreach ( $years as $key => $year ): ?>
                        <div class="tb-elems">
                            <h2><?php echo ( $key == 0 ) ? 'Today' : $year->name ?></h2>
                            <div class="tb-grid">
								<?php $args     = [
									'post_type'        => 'company_event',
									'numberposts'      => - 1,
									'tax_query'        => [
										[
											'taxonomy' => 'company_event_cat',
											'field'    => 'term_id',
											'terms'    => $year->term_id,
										],
									],
									'suppress_filters' => true,
								];
								$company_events = get_posts( $args ); ?>
								<?php foreach ( $company_events as $company_event ): ?>
									<?php $company_event_data = get_field( 'company_events', $company_event );
									$name                     = ! empty( $company_event->post_title ) ? $company_event->post_title : null;
									$image                    = ! empty( $company_event_data['image'] ) ? $company_event_data['image'] : null;
									$text                     = ! empty( $company_event_data['text'] ) ? $company_event_data['text'] : null;
									$data                     = ! empty( $company_event_data['data'] ) ? $company_event_data['data'] : null;
									?>
                                    <div class="tb-elem <?php echo ! empty( $image ) ? 'tb-withimg' : 'tb-noimg' ?>">
                                        <div class="tb-decor"></div>
										<?php if ( ! empty( $image ) ): ?>
                                            <img src="<?php echo $image['url'] ?>" alt="<?php echo $name ?>">
										<?php endif; ?>
                                        <h4><?php echo $name ?></h4>
                                        <p><?php echo $text ?></p>
                                        <span class="tb-date"><?php echo $data ?></span>
                                    </div>
								<?php endforeach; ?>
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
            <button class="btnr black icon-arr-b" type="button" id="cp-load-more">More</button>
        </div>
    </section>

    <section class="about__believe mob-sect-bg">
        <div class="bg">
            <div class="bg1"></div>
        </div>
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

    <section class="banner">
        <div class="about__baner_title"><?php echo $block_7_text ?></div>
        <div class="wrapl">
            <div class="block">
                <img src="<?php echo $block_7_image['url'] ?>" alt="banner">
                <a href="<?php echo $block_7_button['url'] ?>" target="<?php echo $block_7_button['target'] ?>"
                   class="btn red"><?php echo $block_7_button['title'] ?></a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>