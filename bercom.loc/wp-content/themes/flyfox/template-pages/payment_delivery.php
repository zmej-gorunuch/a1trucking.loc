<?php
/*
Template Name: Оплата та Доставка сторінка (шаблон)
*/

/**
 * Custom fields
 */
$payment  = get_field( 'payment' );
$delivery = get_field( 'delivery' );


?>
<?php get_header(); ?>

    <section class="paymentDelivery tabs">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="app-screen__title heading-2 --bold text-center"><?php pll_e( 'Оплата та доставка' ); ?></h1>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <ul class="tabs-list tabs-ul d-flex align-center app-nav">
						<?php if ( $delivery ): ?>
                            <li class="tabs-list-item app-nav__item text-center current">
                                <a onclick="front.openTab(this, 'tab-0','.tabs')"
                                   class="tabs-list-item__link tab-links"><?php pll_e( 'Доставка' ); ?></a>
                            </li>
						<?php endif; ?>
						<?php if ( $payment ): ?>
                            <li class="tabs-list-item app-nav__item text-center">
                                <a onclick="front.openTab(this, 'tab-1','.tabs')"
                                   class="tabs-list-item__link tab-links"><?php pll_e( 'Оплата' ); ?></a>
                            </li>
						<?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="row align-center tabs-wrap">
                <div class="col-xl-8 col-lg-9 col-md-10 col-xs-12">
                    <div class="tab-content active" id="tab-0">
                        <div class="entry-content">
							<?php echo $delivery; ?>
                        </div>
                    </div>
                    <div class="tab-content" id="tab-1">
                        <div class="entry-content">
							<?php echo $payment; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>