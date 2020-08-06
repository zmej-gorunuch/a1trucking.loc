<?php
/*
Template Name: Контакти сторінка (шаблон)
*/

/**
 * Custom fields
 */
$phones    = get_field( 'site_phones' );
$emails    = get_field( 'site_emails' );
$addresses = get_field( 'site_addresses' );

?>
<?php get_header(); ?>

    <section class="contacts --relative full-height">
        <div class="container full-height">
            <div class="row full-height align-middle align-justify">
                <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
                    <h1 class="contacts__title heading-2 --demi"><?php pll_e( 'Контакти' ); ?></h1>
                    <div class="contacts-list__wrap overlap">
						<?php if ( $phones ): ?>
                            <ul class="contacts-list">
								<?php while ( has_sub_field( 'site_phones' ) ): ?>
                                    <li>
                                        <a href="<?php the_call_phone( get_sub_field( 'site_phone' ) ); ?>"><?php the_sub_field( 'site_phone' ); ?></a>
                                    </li>
								<?php endwhile; ?>
                            </ul>
						<?php endif; ?>
						<?php if ( $emails ): ?>
                            <ul class="contacts-list --email">
								<?php while ( has_sub_field( 'site_emails' ) ): ?>
                                    <li>
                                        <a href="mailto:info@berkom@gmail.com"><?php the_sub_field( 'site_email' ); ?></a>
                                    </li>
								<?php endwhile; ?>
                            </ul>
						<?php endif; ?>
						<?php if ( $addresses ): ?>
                            <ul class="contacts-list --location">
								<?php while ( has_sub_field( 'site_addresses' ) ): ?>
                                    <li><?php the_sub_field( 'site_address' ); ?></li>
								<?php endwhile; ?>
                            </ul>
						<?php endif; ?>
                    </div>
					<?php if ( pll_current_language() == 'ru' ): ?>
						<?php echo do_shortcode( '[contact-form-7 id="537" title="Форма связи (страница контакты) ru"]' ) ?>
					<?php else: ?>
						<?php echo do_shortcode( '[contact-form-7 id="536" title="Форма зв\'язку (сторінка контакти) ua"]' ) ?>
					<?php endif; ?>
                </div>
                <div class=" full-height col-xl-7 col-lg-7 col-md-6 col-xs-12 map-wrap">
                    <div class="map" id="mapContacts"></div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>