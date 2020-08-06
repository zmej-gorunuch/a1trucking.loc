<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

/**
 * Reviews
 */
$args    = [
	'post_type'        => 'review',
	'numberposts'        => -1,
	'suppress_filters' => true,
];
$reviews = get_posts( $args );

?>
<?php if ( $reviews ): ?>
    <div class="cp-reviews-wrap">

        <div class="cp-reviews-row">
			<?php foreach ( array_slice( $reviews, 0, 2 ) as $key => $review ): ?>
				<?php
				$review_data = get_field( 'reviews', $review );
				$name        = ! empty( $review->post_title ) ? $review->post_title : null;
				$avatar      = ! empty( $review_data['avatar'] ) ? $review_data['avatar'] : null;
				$position    = ! empty( $review_data['position'] ) ? $review_data['position'] : null;
				$logo        = ! empty( $review_data['logo'] ) ? $review_data['logo'] : null;
				$company     = ! empty( $review_data['company'] ) ? $review_data['company'] : null;
				$description = ! empty( $review_data['description'] ) ? $review_data['description'] : null;
				$response    = ! empty( $review_data['response'] ) ? $review_data['response'] : null;
				?>
                <div class="cp-elem <?php echo $key == 0 ? 'active' : null ?>">
                    <div class="cp-img">
						<?php if ( $logo ): ?>
                            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $company; ?> logo">
						<?php endif; ?>
                    </div>
                    <div class="cp-text">
                        <span class="cp-title"><?php echo $company; ?></span>
                        <span class="cp-descr"><?php echo $description; ?></span>
                    </div>
                    <a class="cp-link">Learn more</a>
                </div>
			<?php endforeach; ?>
            <div class="cp-details">
				<?php foreach ( array_slice( $reviews, 0, 2 ) as $key => $review ): ?>
					<?php
					$review_data = get_field( 'reviews', $review );
					$name        = ! empty( $review->post_title ) ? $review->post_title : null;
					$avatar      = ! empty( $review_data['avatar'] ) ? $review_data['avatar'] : null;
					$position    = ! empty( $review_data['position'] ) ? $review_data['position'] : null;
					$logo        = ! empty( $review_data['logo'] ) ? $review_data['logo'] : null;
					$company     = ! empty( $review_data['company'] ) ? $review_data['company'] : null;
					$description = ! empty( $review_data['description'] ) ? $review_data['description'] : null;
					$response    = ! empty( $review_data['response'] ) ? $review_data['response'] : null;
					?>
                    <div class="cp-detail">
                        <div class="cp-detail-img">
							<?php if ( $avatar ): ?>
                                <img src="<?php echo $avatar['url']; ?>" alt="<?php echo $name; ?> avatar">
							<?php endif; ?>
                        </div>
                        <div class="cp-detail-descr">
                            “<?php echo $response; ?>“
                        </div>
                        <div class="cp-name"><?php echo $name; ?></div>
                        <div class="cp-pos"><?php echo $position; ?></div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>



    </div>

	<?php if ( count( $reviews ) > 4 ): ?>
        <button class="btnr black icon-arr-b" type="button" id="cp-load-more">More</button>
	<?php endif; ?>
<?php endif; ?>