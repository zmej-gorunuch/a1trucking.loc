<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

/**
 * Events
 */
$args   = [
	'post_type'        => 'event',
	'numberposts'        => -1,
	'suppress_filters' => true,
];
$events = get_posts( $args );

?>

<?php if ( $events ): ?>

    <div class="ms-slider-wrap">
        <div class="slider-dots-num" id="ms-dots"></div>
        <div class="slider-arrows">
            <div class="slider-arrow icon-arr-r" id="ms-next"></div>
            <div class="slider-arrow icon-arr-l" id="ms-prev"></div>
        </div>
        <div class="ms-slider-hider">
            <div class="ms-slider">
				<?php foreach ( $events as $event ): ?>
					<?php
					$event_data = get_field( 'events', $event );
					$name       = ! empty( $event->post_title ) ? $event->post_title : null;
					$date       = ! empty( $event_data['date'] ) ? $event_data['date'] : null;
					$location   = ! empty( $event_data['location'] ) ? $event_data['location'] : null;
					$image      = ! empty( $event_data['image'] ) ? $event_data['image'] : null;
					$link       = ! empty( $event_data['link'] ) ? $event_data['link'] : null;
					?>
                    <div class="d-elem">
                        <a class="d-elem-circle">
                            <div class="d-elem-link-text icon-arr-r">Learn-more</div>
                        </a>
                        <div class="d-elem-shop-text">
                            <div class="d-elem-shop-title"><?php echo $name; ?></div>
                            <div class="d-elem-shop-date"><?php echo $date; ?></div>
                            <div class="d-elem-shop-location"><?php echo $location; ?></div>
                        </div>
                        <div class="d-elem-shop-img">
							<?php if ( $image ): ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $name; ?> event">
							<?php endif; ?>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
    </div>

<?php endif; ?>
