<?php
/*
Template Name: Services page (template)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_title = ! empty( $block_1['title'] ) ? $block_1['title'] : null;
	$block_1_text  = ! empty( $block_1['text'] ) ? $block_1['text'] : null;
}
$block_2 = get_field( 'block_2' );
if ( $block_2 ) {
	$block_2_title = ! empty( $block_2['title'] ) ? $block_2['title'] : null;
	$block_2_text  = ! empty( $block_2['text'] ) ? $block_2['text'] : null;
	$block_2_steps = ! empty( $block_2['steps'] ) ? $block_2['steps'] : null; // array key icon, title, text
}
$block_3 = get_field( 'block_3' );
if ( $block_3 ) {
	$block_3_services = ! empty( $block_3['services'] ) ? $block_3['services'] : null; // array key name, title, text, description, items, link
}

?>
<?php get_header(); ?>

    <div class="page-baner overlay"></div>
    </section>

    <section class="advantages services__advantages">
        <div class="container">
            <div class="advantages__header section__header services__advantages-header">
                <div class="title advantages__title section__title-width"><?php echo $block_1_title; ?></div>
                <div class="advantages__subtitle section__subtitle section__title-width"><?php echo $block_1_text; ?></div>
            </div>

			<?php get_template_part( 'template-blocks/advantages_block' ); ?>

        </div>
    </section>

    <section class="how-to-start">
        <div class="container">
            <div class="row">
                <div class="how-to-start__header">
                    <div class="how-to-start__title title"><?php echo $block_2_title; ?></div>
                    <div class="how-to-start__descr"><?php echo $block_2_text; ?></div>
                </div>

				<?php if ( $block_2_steps ): ?>
                    <div class="hot-to-start__blocks">
						<?php $i = 1; ?>
						<?php foreach ( $block_2_steps as $step ): ?>
                            <div class="how-to-start__block <?php echo $i % 2 ? 'how-to-start__block--odd' : 'how-to-start__block--even' ?>">
                                <div class="how-to-start__image">
                                    <img class="how-to-start__img" src="<?php echo $step['icon']; ?>"
                                         alt="<?php echo $step['title']; ?>">
                                </div>
                                <div class="how-to-start__text">
                                    <div class="step">Step <?php echo $i; ?></div>
                                    <div class="how-to-start__step-title"><?php echo $step['title']; ?></div>
                                    <div class="how-to-start__step-descr"><?php echo $step['text']; ?></div>
                                </div>
                            </div>
							<?php $i ++; ?>
						<?php endforeach; ?>
                    </div>
				<?php endif; ?>
            </div>
    </section>

<?php if ( $block_3_services ): ?>
    <section class="services__cards">
        <div class="container">
            <div class="row">
                <div class="services__cards-blocks">
					<?php foreach ( $block_3_services as $service ): ?>
                        <div class="services__cards-block">
                            <div class="card__header">
                                <div class="card__header-title"><?php echo $service['name']; ?></div>
                                <span class="card__header-interest"><?php echo $service['title']; ?></span>
                                <div class="card__header-descr"><?php echo $service['text']; ?></div>
                            </div>
                            <div class="card__info">
                                <div class="card__descr">
									<?php echo $service['description']; ?>
                                </div>
								<?php if ( $service['items'] ): ?>
									<?php $items_array = explode( ';', $service['items'] ) ?>
                                    <ul class="cards__list">
										<?php foreach ( $items_array as $item ): ?>
                                            <li class="card__list-item"><?php echo $item; ?></li>
										<?php endforeach; ?>
                                    </ul>
								<?php endif; ?>
                            </div>
                            <div class="card__button">
								<?php if ( $service['link'] ): ?>
                                    <a class="card__btn"
                                       href="<?php echo $service['link']['url']; ?>"
                                       target="<?php echo $service['link']['target']; ?>">
										<?php echo $service['link']['title']; ?>
                                    </a>
								<?php endif; ?>
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_template_part( 'template-blocks/in_numbers_block' ); ?>

<?php get_template_part( 'template-blocks/partners_block' ); ?>

<?php get_footer(); ?>