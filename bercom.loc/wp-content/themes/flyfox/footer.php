<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FlyFox
 */

$contact_page_id = pll_get_post( '80' );

/**
 * Custom fields
 */
$phones    = get_field( 'site_phones', $contact_page_id );
$emails    = get_field( 'site_emails', $contact_page_id );
$addresses = get_field( 'site_addresses', $contact_page_id );
$latitude  = get_field( 'latitude', $contact_page_id );
$longitude  = get_field( 'longitude', $contact_page_id );

?>
<footer class="footer">
    <div class="container">
        <div class="row align-center">
            <div class="logo-wrap default-icon">
                <a href="#" class="logo-wrap__link overlap" rel="home">
                    <img width="168" height="22" src="<?php echo get_template_directory_uri() ?>/img/logo.svg"
                         class="logo-wrap__icon" alt="meToo"/>
                </a>
            </div>
        </div>
        <div class="row align-center">
            <div class="footer-column col-xl-12 col-lg-12 col-md-12 col-xs-12">
				<?php menu_footer_theme_display( pll_current_language() ); ?>
            </div>
        </div>
        <div class="row align-center footer-contacts mb-16">
            <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12 text-center">
				<?php if ( $phones ): ?>
                    <ul class="contacts-list --phone mb-16">
						<?php while ( has_sub_field( 'site_phones', $contact_page_id ) ): ?>
                            <li>
                                <a href="<?php the_call_phone( get_sub_field( 'site_phone', $contact_page_id ) ); ?>"><?php the_sub_field( 'site_phone', $contact_page_id ); ?></a>
                            </li>
						<?php endwhile; ?>
                    </ul>
				<?php endif; ?>
				<?php if ( $emails ): ?>
                    <ul class="contacts-list --email mb-16">
						<?php while ( has_sub_field( 'site_emails', $contact_page_id ) ): ?>
                            <li>
                                <a href="mailto:info@berkom@gmail.com"><?php the_sub_field( 'site_email', $contact_page_id ); ?></a>
                            </li>
						<?php endwhile; ?>
                    </ul>
				<?php endif; ?>
				<?php if ( $addresses ): ?>
                    <ul class="contacts-list --location">
						<?php while ( has_sub_field( 'site_addresses', $contact_page_id ) ): ?>
                            <li><?php the_sub_field( 'site_address', $contact_page_id ); ?></li>
						<?php endwhile; ?>
                    </ul>
				<?php endif; ?>
            </div>
        </div>
        <div class="row align-center copyright mb-16">
            <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
                <div class="copyright-text text-center">© Берком, 2019</div>
            </div>
        </div>
        <div class="row align-center developed">
            <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12 text-center">
                <a href="https://letarget.com.ua/" class="developed__link"><?php pll_e( 'Дизайн та розробка сайту' ); ?>
                    —
                    <b>LeTarget</b></a>
            </div>
        </div>
    </div>
</footer>

<div class="modal" id="contact-modal">
    <div class="modal-body">
        <div class="modal-content">
            <div class="modal-content__close icon-close default-icon"><img
                        src="<?php echo get_template_directory_uri() ?>/img/close.svg" alt="close icon"></div>
            <h3 class="modal-content__title heading-3 text-center"><?php pll_e( 'Залиште ваші контактні дані' ); ?></h3>
			<?php if ( pll_current_language() == 'ru' ): ?>
				<?php echo do_shortcode( '[contact-form-7 id="538" title="Залишити заявку (ru)"]' ) ?>
			<?php else: ?>
				<?php echo do_shortcode( '[contact-form-7 id="539" title="Залишити заявку (ua)"]' ) ?>
			<?php endif; ?>
        </div>
    </div>
</div>

<div data-modal="#contact-modal" class="modalTrigger pulse-box">
    <div class="pulse-box__content d-flex align-middle align-center"><p><?php pll_e( 'Залишити заявку' ); ?></p><img
                src="<?php echo get_template_directory_uri() ?>/img/phone.svg"
                alt="phone icon"></div>
</div>

<?php wp_footer(); ?>

<script>
    $(function ($) {
        let url = window.location.href;
        $('.gallery-nav li a').each(function () {
            if (this.href === url) {
                $('.gallery-nav li').removeClass('current');
                $(this).closest('li').addClass('current');
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function (event) {

        let childrenItem = document.querySelectorAll('.menu-item-has-children > a');

        for (let i = 0; i < childrenItem.length; i++) {
            //console.log(childrenItem[i]);
            var btn = document.createElement("BUTTON");   // Create a <button> element
            btn.className = "nav-btn";                    // add class
            btn.innerHTML = `<i class="icon-arrowRight"></i>`;
            childrenItem[i].appendChild(btn);
        }
    });
    $(document).on('click', '.nav-btn', function (e) {
        e.preventDefault();
        var navTitle = document.createElement("p");   // Create a <button> element
        navTitle.className = "nav-title";                    // add class
        navTitle.innerHTML = '<i class="icon-arrowLeft"></i>' + $(this).parent().text();


        $(this).parent().next('.sub-menu').prepend(navTitle);

        if (!$(this).parent().next('.sub-menu').hasClass('open')) {
            $(this).parent().next('.sub-menu').addClass('open');

        } else {
            $(this).parent().next('.sub-menu').removeClass("open");
        }
    });
    $(document).on('click', '.nav-title', function (e) {
        e.preventDefault();
        if ($(this).parent().hasClass('open')) {
            $(this).parent().removeClass("open");
            $(this).remove();
        }
    });
</script>

<?php if ( is_page_template( 'template-pages/contact.php' ) ): ?>
    <script>
        $(window).on("load", function () {
            initialize(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
        })
    </script>
<?php endif; ?>

</body>
</html>