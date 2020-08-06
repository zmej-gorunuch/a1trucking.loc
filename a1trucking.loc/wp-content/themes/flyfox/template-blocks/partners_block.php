<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

/**
 * Custom fields
 */
$block_6 = get_field( 'block_6', get_page_by_path( 'home' ) );
if ( $block_6 ) {
	$block_6_title        = ! empty( $block_6['title'] ) ? $block_6['title'] : null;
	$block_6_text         = ! empty( $block_6['text'] ) ? $block_6['text'] : null;
	$block_6_our_partners = ! empty( $block_6['our_partners'] ) ? $block_6['our_partners'] : null; // array key group, logotypes
}

?>
<section class="partners">
    <div class="container">
        <div class="partners__header section__header">
            <div class="title partners__title section__title-width"><?php echo $block_6_title; ?></div>
            <div class="partners__subtitle section__subtitle section__title-width"><?php echo $block_6_text; ?></div>
        </div>
		<?php if ( $block_6_our_partners ): ?>
            <div class="row">
                <div class="partners__tabs">
					<?php $i = 1; ?>
					<?php foreach ( $block_6_our_partners as $partner ): ?>
                        <div class="partners__tabs-item <?php echo $i == 1 ? 'partners__tabs-item--active' : null ?>">
							<?php echo $partner['group']; ?>
                        </div>
						<?php $i ++; ?>
					<?php endforeach; ?>
                </div>
                <div class="partners__slider">
                    <!-- Slider main container -->
                    <div class="swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
							<?php foreach ( $block_6_our_partners as $partner ): ?>
								<?php foreach ( $partner['logotypes'] as $logotype ): ?>
                                    <div class="swiper-slide">
                                        <img class="partners__slider-img"
                                             src="<?php echo $logotype['url'] ?>"
                                             alt="<?php echo $logotype['title'] ?>">
                                    </div>
								<?php endforeach; ?>
							<?php endforeach; ?>
                        </div>
                    </div>


                    <div class="swiper-container-arrows">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"></div>
                            <div class="swiper-slide"></div>
                            <div class="swiper-slide"></div>
                            <div class="swiper-slide"></div>
                            <div class="swiper-slide"></div>
                            <div class="swiper-slide"></div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                </div>
            </div>
		<?php endif; ?>
    </div>
</section>