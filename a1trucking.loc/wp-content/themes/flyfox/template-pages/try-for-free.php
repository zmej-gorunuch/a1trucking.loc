<?php
/*
Template Name: Contacts page (template)
*/

/**
 * Custom fields
 */
$block_1 = get_field( 'block_1' );
if ( $block_1 ) {
	$block_1_title      = ! empty( $block_1['title'] ) ? $block_1['title'] : null;
	$block_1_map        = ! empty( $block_1['map'] ) ? $block_1['map'] : null;
	$block_1_qr_text    = ! empty( $block_1['qr_text'] ) ? $block_1['qr_text'] : null;
	$block_1_qr_code    = ! empty( $block_1['qr_code'] ) ? $block_1['qr_code'] : null;
	$block_1_form_title = ! empty( $block_1['form_title'] ) ? $block_1['form_title'] : null;
	$block_1_form_text  = ! empty( $block_1['form_text'] ) ? $block_1['form_text'] : null;
}
$contacts = get_field( 'contacts', 'option' );
if ( $contacts ) {
	$address = ! empty( $contacts['address'] ) ? $contacts['address'] : null;
	$email   = ! empty( $contacts['email'] ) ? $contacts['email'] : null;
	$phone   = ! empty( $contacts['phone'] ) ? $contacts['phone'] : null;
}
$social_links = get_field( 'social_links', 'option' );
if ( $social_links ) {
	$twitter   = ! empty( $social_links['twitter'] ) ? $social_links['twitter'] : null;
	$facebook  = ! empty( $social_links['facebook'] ) ? $social_links['facebook'] : null;
	$instagram = ! empty( $social_links['instagram'] ) ? $social_links['instagram'] : null;
	$linkedin  = ! empty( $social_links['linkedin'] ) ? $social_links['linkedin'] : null;
}

?>
<?php get_header(); ?>

    <section class="contacts">

        <div id="sticker" class="contacts__map-block">
            <img class="contacts__map-img" src="<?php echo $block_1_map; ?>" alt="map-img">
        </div>

        <div class="contacts__right-block">

            <div class="contacts__info-block">
                <h1 class="contacts__title"><?php echo $block_1_title; ?></h1>
                <div class="contacts__location">
                    <img class="contacts__icon location-svg"
                         src="<?php echo get_template_directory_uri(); ?>/images/icons/location.svg" alt="location"><a
                            href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                </div>
                <div class="contacts__phone">
                    <img class="contacts__icon phone-svg"
                         src="<?php echo get_template_directory_uri(); ?>/images/icons/phone.svg" alt="phone"><a
                            href="<?php the_call_phone( $phone ); ?>"><?php echo $phone; ?></a>
                </div>
                <div class="contacts__address">
                    <img class="contacts__icon address-svg"
                         src="<?php echo get_template_directory_uri(); ?>/images/icons/home.svg" alt="home">
					<?php echo $address; ?>
                </div>
                <div class="contacts__qr-code">
                    <div class="qr-code__title"><?php echo $block_1_qr_text; ?></div>
					<?php pll_e( 'Use your phone camera:' ); ?>
                    <img class="qr-code__img" src="<?php echo $block_1_qr_code; ?>" alt="qr-code">
                </div>
                <div class="contacts__soc-net">
                    <div class="social-item social-item__twitter">
                        <a href="<?php echo $twitter; ?>">
                            <div class="social-item__inner">
                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 2.039C15.405 2.3 14.771 2.473 14.11 2.557C14.79 2.151 15.309 1.513 15.553 0.744C14.919 1.122 14.219 1.389 13.473 1.538C12.871 0.897 12.013 0.5 11.077 0.5C9.261 0.5 7.799 1.974 7.799 3.781C7.799 4.041 7.821 4.291 7.875 4.529C5.148 4.396 2.735 3.089 1.114 1.098C0.831 1.589 0.665 2.151 0.665 2.756C0.665 3.892 1.25 4.899 2.122 5.482C1.595 5.472 1.078 5.319 0.64 5.078C0.64 5.088 0.64 5.101 0.64 5.114C0.64 6.708 1.777 8.032 3.268 8.337C3.001 8.41 2.71 8.445 2.408 8.445C2.198 8.445 1.986 8.433 1.787 8.389C2.212 9.688 3.418 10.643 4.852 10.674C3.736 11.547 2.319 12.073 0.785 12.073C0.516 12.073 0.258 12.061 0 12.028C1.453 12.965 3.175 13.5 5.032 13.5C11.068 13.5 14.368 8.5 14.368 4.166C14.368 4.021 14.363 3.881 14.356 3.742C15.007 3.28 15.554 2.703 16 2.039Z"
                                          fill="#03A9F4"/>
                                </svg>
                            </div>
                        </a>
                    </div>

                    <div class="social-item social-item__facebook">
                        <a href="<?php echo $facebook; ?>">
                            <div class="social-item__inner">
                                <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.99938 0.00332907L6.92456 0C4.59358 0 3.08719 1.54552 3.08719 3.93762V5.75313H1.00105C0.820783 5.75313 0.674805 5.89927 0.674805 6.07954V8.71001C0.674805 8.89028 0.820949 9.03625 1.00105 9.03625H3.08719V15.6738C3.08719 15.854 3.23317 16 3.41343 16H6.13525C6.31552 16 6.46149 15.8539 6.46149 15.6738V9.03625H8.90068C9.08095 9.03625 9.22692 8.89028 9.22692 8.71001L9.22792 6.07954C9.22792 5.99299 9.19347 5.91009 9.13238 5.84884C9.07129 5.78758 8.98806 5.75313 8.90151 5.75313H6.46149V4.2141C6.46149 3.47438 6.63777 3.09886 7.60136 3.09886L8.99905 3.09836C9.17915 3.09836 9.32513 2.95222 9.32513 2.77211V0.329578C9.32513 0.149642 9.17932 0.00366197 8.99938 0.00332907Z"
                                          fill="#3A559F"/>
                                </svg>
                            </div>
                        </a>
                    </div>

                    <div class="social-item social-item__instagram">
                        <a href="<?php echo $instagram; ?>">
                            <div class="social-item__inner">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path class="test-path"
                                          d="M11 0H5C2.239 0 0 2.239 0 5V11C0 13.761 2.239 16 5 16H11C13.761 16 16 13.761 16 11V5C16 2.239 13.761 0 11 0ZM14.5 11C14.5 12.93 12.93 14.5 11 14.5H5C3.07 14.5 1.5 12.93 1.5 11V5C1.5 3.07 3.07 1.5 5 1.5H11C12.93 1.5 14.5 3.07 14.5 5V11Z"
                                          fill="url(#paint0_linear)"/>
                                    <path d="M8 4C5.791 4 4 5.791 4 8C4 10.209 5.791 12 8 12C10.209 12 12 10.209 12 8C12 5.791 10.209 4 8 4ZM8 10.5C6.622 10.5 5.5 9.378 5.5 8C5.5 6.621 6.622 5.5 8 5.5C9.378 5.5 10.5 6.621 10.5 8C10.5 9.378 9.378 10.5 8 10.5Z"
                                          fill="url(#paint1_linear)"/>
                                    <path d="M12.3001 4.23274C12.5945 4.23274 12.8331 3.99411 12.8331 3.69974C12.8331 3.40538 12.5945 3.16675 12.3001 3.16675C12.0057 3.16675 11.7671 3.40538 11.7671 3.69974C11.7671 3.99411 12.0057 4.23274 12.3001 4.23274Z"
                                          fill="url(#paint2_linear)"/>
                                    <defs>
                                        <linearGradient id="paint0_linear" x1="1.46465" y1="14.5355" x2="14.5353"
                                                        y2="1.46455" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFC107"/>
                                            <stop offset="0.507" stop-color="#F44336"/>
                                            <stop offset="0.99" stop-color="#9C27B0"/>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear" x1="5.17165" y1="10.8283" x2="10.8283"
                                                        y2="5.17165" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFC107"/>
                                            <stop offset="0.507" stop-color="#F44336"/>
                                            <stop offset="0.99" stop-color="#9C27B0"/>
                                        </linearGradient>
                                        <linearGradient id="paint2_linear" x1="11.9232" y1="4.07669" x2="12.6769"
                                                        y2="3.32289" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFC107"/>
                                            <stop offset="0.507" stop-color="#F44336"/>
                                            <stop offset="0.99" stop-color="#9C27B0"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                        </a>
                    </div>

                    <div class="social-item social-item__linkedin">
                        <a href="<?php echo $linkedin; ?>">
                            <div class="social-item__inner">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path d="M3.578 4.99976H0V15.9998H3.578V4.99976Z" fill="#1976D2"/>
                                        <path d="M12.902 5.12924C12.864 5.11724 12.828 5.10424 12.788 5.09324C12.74 5.08224 12.692 5.07324 12.643 5.06524C12.453 5.02724 12.245 5.00024 12.001 5.00024C9.915 5.00024 8.592 6.51724 8.156 7.10324V5.00024H4.578V16.0002H8.156V10.0002C8.156 10.0002 10.86 6.23424 12.001 9.00024C12.001 11.4692 12.001 16.0002 12.001 16.0002H15.578V8.57724C15.578 6.91524 14.439 5.53024 12.902 5.12924Z"
                                              fill="#1976D2"/>
                                        <path d="M1.75 2.99976C2.7165 2.99976 3.5 2.21625 3.5 1.24976C3.5 0.283258 2.7165 -0.500244 1.75 -0.500244C0.783502 -0.500244 0 0.283258 0 1.24976C0 2.21625 0.783502 2.99976 1.75 2.99976Z"
                                              fill="#1976D2"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="contacts__form-block">
                <div class="form__title"><?php echo $block_1_form_title; ?></span></div>

				<?php echo do_shortcode( '[contact-form-7 id="220" title="Contact page form (EN)" html_class="form contacts__form"]' ) ?>

				<?php echo $block_1_form_text; ?>
            </div>

        </div>
    </section>

<?php get_footer(); ?>