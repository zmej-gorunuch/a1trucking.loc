<?php
/*
Template Name: Events page (theme)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_text   = ! empty( $block_1['text'] ) ? $block_1['text'] : null;
	$block_1_button = ! empty( $block_1['button'] ) ? $block_1['button'] : null;
}
$block_2 = get_field( 'block_2' );
if ( $block_2 ) {
	$block_2_title = ! empty( $block_2['title'] ) ? $block_2['title'] : null;
}
$block_3 = get_field( 'block_3' );
if ( $block_3 ) {
	$block_3_image  = ! empty( $block_3['image'] ) ? $block_3['image'] : null;
	$block_3_button = ! empty( $block_3['button'] ) ? $block_3['button'] : null;
}

/**
 * Events
 */
$arg    = [
	'post_type'        => 'event',
	'per_page'         => 5,
	'suppress_filters' => true,
];
$events = new WP_Query( $arg );

?>
<?php get_header(); ?>

<section class="main-oval blog main-events">
    <div class="bg">
        <div class="bg1"></div>
    </div>
    <div class="wrap">
        <h1><?php wp_title( "", true ); ?></h1>
        <p><?php echo $block_1_text ?></p>
        <a href="<?php echo $block_1_button['url'] ?>" target="<?php echo $block_1_button['target'] ?>" type="button"
           class="btn red"><?php echo $block_1_button['title'] ?></a>
    </div>
</section>

<?php if ( $events->have_posts() ): ?>
    <section class="events__container">

        <div class="events__title"><?php echo $block_2_title ?></div>

        <div class="grid events__grid">
			<?php while ( $events->have_posts() ): ?>
				<?php $events->the_post(); ?>
				<?php $event_data = get_field( 'events' ); ?>
				<?php $image = ! empty( $event_data['image'] ) ? $event_data['image'] : null; ?>
				<?php $location = ! empty( $event_data['location'] ) ? $event_data['location'] : null; ?>
				<?php $date = ! empty( $event_data['date'] ) ? $event_data['date'] : null; ?>
				<?php $link = ! empty( $event_data['link'] ) ? $event_data['link'] : null; ?>
                <a href="<?php echo $link['url'] ?>" class="g-elem g2">
                    <div class="g-img"
                         style="background-image: url('<?php echo $image['url'] ?>');"></div>
                    <div class="e_pos">
                        <div class="e_name"><?php the_title(); ?></div>
                        <div class="e_date"><?php echo $date ?></div>
                        <div class="e_location"><?php echo $location ?></div>
                    </div>
                </a>
			<?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>

<section class="wrapl events-form">

    <div class="events_form rd__container">

        <h2>Let’s meet!</h2>

        <form class="main_s minimal">
            <div class="formgrid">


                <div class="input_wrapper have_error">
                    <input type="text" class="form__field">
                    <label class="form__label">Your Name <b>*</b></label>
                    <div class="error_mess">Some error</div>
                </div>
                <div class="input_wrapper have_error">
                    <input type="text" class="form__field">
                    <label class="form__label">Your Email <b>*</b></label>
                    <div class="error_mess">Some error</div>
                </div>


                <div class="input_wrapper">
                    <label class="label_minimal">Select an event <b>*</b></label>
                    <select>
                        <option value="">PI Apparel</option>
                        <option value="-">---</option>
                        <option value="-">---</option>
                        <option value="-">---</option>
                        <option value="-">---</option>
                    </select>
                    </label>
                </div>
            </div>

            <div class="input_wrapper textarea_wrapper">
                <label class="label_minimal">Your Message</label>
                <textarea></textarea>
            </div>

            <input type="checkbox" id="checkbox_confirm1">
            <label class="checkbox_classic" for="checkbox_confirm1">I agree to the <a href="#">Terms and Conditions </a>
                and <a href="#">Privacy Policy*</a></label>

            <input type="checkbox" id="checkbox_confirm2">
            <label class="checkbox_classic" for="checkbox_confirm2">I confirm that I'm 16 yearsof age or older*</label>
            <p></p>

            <button class="btn black btn_classic">Send Message</button>

        </form>


    </div>

</section>

<?php if ( $block_3 ): ?>
    <section class="banner">
        <div class="wrapl">
            <div class="block">
                <img src="<?php echo $block_3_image['url'] ?>" alt="Banner">
                <a href="<?php echo $block_3_button['title'] ?>" target="<?php echo $block_3_button['target'] ?>"
                   class="btn red"><?php echo $block_3_button['title'] ?></a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
