<?php
/*
Template Name: Home page (template)
*/

/**
 * Custom fields
 */
$header = get_field( 'header', 'option' );
if ( $header ) {
	$header_logo   = ! empty( $header['logo'] ) ? $header['logo'] : null;
	$header_button = ! empty( $header['button'] ) ? $header['button'] : null;
}
$contacts = get_field( 'contacts', 'option' );
if ( $contacts ) {
	$phone = ! empty( $contacts['phone'] ) ? $contacts['phone'] : null;
}

?>
<?php get_header(); ?>
        <div class="main-baner overlay">
            <div class="container">
                <div class="row">
                    <div class="main-baner__block">
                        <h1 class="title main-baner__title">American number one solutions for your trucking
                            business</h1>
                        <div class="main-baner__subtitle">Looking for a reliable and experienced international
                            carrier?
                        </div>

                        <div class="main-baner__buttons">
                            <button class="button__login">
                                <div class="button__block-arrow">
                                    <svg class="button__arrow-right" width="13" height="8" viewBox="0 0 13 8"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button__arrow-right--path"
                                              d="M12.9938 3.99947L12.9995 3.99311L9.54335 0L8.50073 1.20442L10.184 3.14867H0V4.85134H10.184L8.50073 6.79584L9.54335 8L13 4.00662L12.9938 3.99947Z"
                                              fill="white"/>
                                    </svg>
                                    <svg class="svg__sircle">
                                        <circle class="circle__btn-login" cx="0.521vw" cy="0.521vw"
                                                r="0.469vw"></circle>
                                    </svg>
                                </div>
                                Login
                            </button>
							<?php if ( $header_button ): ?>
                                <a href="<?php echo $header_button['url'] ?>"
                                   target="<?php echo $header_button['target'] ?>">
                                    <button class="button__tff">
                                        <div class="tff__block">
                                            <div class="tff__svg-block">
                                                <svg class="svg-ttf">
                                                    <circle class="circle__btn-ttf" cx="0.521vw" cy="0.521vw"
                                                            r="0.469vw">
                                                </svg>
                                            </div>
											<?php echo $header_button['title'] ?>
                                        </div>
                                    </button>
                                </a>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a class="tryforfree-link" href="tryforfree.html">
        <button class="button__tff--pulse home-button__tff--pulse">
            <div class="button__tff--pulse-inner"></div>
            <div class="button__tff--pulse-inner"></div>
            <div class="tff-pulse__svg-block">
                <svg class="svg__ttf-pulse">
                    <circle class="circle-btn__ttf-pulse" cx="1.563vw" cy="1.563vw" r="1.458vw">
                </svg>
            </div>
            Try for free
        </button>
    </a>

    <section class="adapt">
        <div class="container">

            <div class="adapt__header section__header">
                <div class="title adapt__title section__title-width">We adapt <span
                            class="title--blue">our services</span> to the needs of <span class="title--blue">our clients</span>
                </div>
                <div class="adapt__subtitle section__subtitle section__title-width">We specialize in dispatching only
                    trucks with 48' & 53' semi-trailers (Dry Van, Reefer, Flatbed)
                </div>
            </div>

            <div class="adapt__image">
                <img class="adapt__img" src="images/icons/adapt-image.svg" alt="">
            </div>

            <div class="row">
                <div>
                    <div class="adapt__advantages">
                        <div class="adapt__advantages-icon">
                            <img class="adapt__advantages-img" src="images/icons/dispatch.svg" alt="">
                        </div>
                        <div class="adapt__advantages-content">
                            <div class="adapt-content__title">Dispatch</div>
                            Personal professional experienced dispatcher (dispatcher will be dedicated to you; all our
                            dispatchers have at least 2 years of experience), plus logistics manager (you will have not
                            only a dispatcher but our team working for you). All company, including the owner, is
                            available 24/7.
                        </div>
                    </div>
                    <div class="adapt__advantages">
                        <div class="adapt__advantages-icon">
                            <img class="adapt__advantages-img" src="images/icons/back-office.svg" alt="">
                        </div>
                        <div class="adapt__advantages-content">
                            <div class="adapt-content__title">Back office</div>
                            All loads under your MC (brokers pay 100% directly to you). We send actual confirmations,
                            have gotten from the brokers.
                        </div>
                    </div>
                    <div class="adapt__advantages">
                        <div class="adapt__advantages-icon">
                            <img class="adapt__advantages-img" src="images/icons/solution.svg" alt="">
                        </div>
                        <div class="adapt__advantages-content">
                            <div class="adapt-content__title">Solutions</div>
                            One dispatcher take care of a maximum 4 drivers (you will definitely recognize the
                            difference from your previous experience, when dispatchers have a lot of drivers, and no
                            time for you to look for best loads).
                        </div>
                    </div>
                    <a href="services.html">
                        <button class="button__view-services">
                            <div class="btn-block__view-services">
                                View all services
                                <svg class="svg__view-services" width="25" height="16" viewBox="0 0 25 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24.7071 8.70711C25.0976 8.31658 25.0976 7.68342 24.7071 7.29289L18.3431 0.928932C17.9526 0.538408 17.3195 0.538408 16.9289 0.928932C16.5384 1.31946 16.5384 1.95262 16.9289 2.34315L22.5858 8L16.9289 13.6569C16.5384 14.0474 16.5384 14.6805 16.9289 15.0711C17.3195 15.4616 17.9526 15.4616 18.3431 15.0711L24.7071 8.70711ZM0 9H24V7H0V9Z"
                                          fill="white"/>
                                </svg>
                            </div>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="advantages">
        <div class="container">

            <div class="advantages__header section__header">
                <div class="title advantages__title section__title-width">Advantages of <span class="title--blue">our company</span>
                </div>
                <div class="advantages__subtitle section__subtitle section__title-width">We specialize in dispatching
                    only trucks with 48' & 53' semi-trailers (Dry Van, Reefer, Flatbed)
                </div>
            </div>

            <div class="row advantages__row">
                <div class="advantages__image">
                    <img class="advantages__img" src="images/icons/advantages-image.svg" alt="">
                </div>
                <div class="col-xl-7 offset-xl-5 col-md-8 offset-md-4">
                    <div class="advantages__blocks">
                        <div class="advantages__block">
                            <a class="advantages__block-link" href="#">
                                <img class="advantages__block-img" src="images/icons/search.svg" alt="">
                                <div class="advantages__block-title">Full Transparancy</div>
                                <span class="advantages__block-descr">One dispatcher take care of a maximum 4 drivers (you will definitely recognize the difference from your previous experience, when dispatchers have a lot of drivers, and no time for you to</span>
                            </a>
                        </div>
                        <div class="advantages__block">
                            <a class="advantages__block-link" href="#">
                                <img class="advantages__block-img" src="images/icons/confidence.svg" alt="">
                                <div class="advantages__block-title">One Dispatch Manager</div>
                                <span class="advantages__block-descr">One dispatcher take care of a maximum 4 drivers (you will definitely recognize the difference from your previous experience, when dispatchers have a lot of drivers, and no time for you to</span>
                            </a>
                        </div>
                        <div class="advantages__block">
                            <a class="advantages__block-link" href="#">
                                <img class="advantages__block-img" src="images/icons/security.svg" alt="">
                                <div class="advantages__block-title">Full check</div>
                                <span class="advantages__block-descr">One dispatcher take care of a maximum 4 drivers (you will definitely recognize the difference from your previous experience, when dispatchers have a lot of drivers, and no time for you to</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-7 offset-xl-5 col-lg-8 offset-lg-4 col-md-8 offset-md-4">
                    <div class="advantages__blocks">
                        <div class="advantages__block">
                            <a href="#" class="advantages__block-link">
                                <img class="advantages__block-img" src="images/icons/money.svg" alt="">
                                <div class="advantages__block-title">100% pay</div>
                                <span class="advantages__block-descr">One dispatcher take care of a maximum 4 drivers (you will definitely recognize the difference from your previous experience, when dispatchers have a lot of drivers, and no time for you to</span>
                            </a>
                        </div>
                        <div class="advantages__block">
                            <a href="#" class="advantages__block-link">
                                <img class="advantages__block-img" src="images/icons/dispatch.svg" alt="">
                                <div class="advantages__block-title">Dedicated dispatch</div>
                                <span class="advantages__block-descr">One dispatcher take care of a maximum 4 drivers (you will definitely recognize the difference from your previous experience, when dispatchers have a lot of drivers, and no time for you to</span>
                            </a>
                        </div>
                        <div class="advantages__block">
                            <a href="#" class="advantages__block-link">
                                <img class="advantages__block-img" src="images/icons/goal.svg" alt="">
                                <div class="advantages__block-title">Expertice</div>
                                <span class="advantages__block-descr">One dispatcher take care of a maximum 4 drivers (you will definitely recognize the difference from your previous experience, when dispatchers have a lot of drivers, and no time for you to</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="freight">
        <div class="container">
            <div class="freight__header section__header">
                <div class="title freight__title section__title-width">We provide <span
                            class="title--blue">freight</span> for
                </div>
                <div class="freight__subtitle section__subtitle section__title-width">We specialize in dispatching only
                    trucks with 48' & 53' semi-trailers (Dry Van, Reefer, Flatbed)
                </div>
            </div>
            <div class="row freight__row">
                <div class="freight__blocks">
                    <div class="freight__block">
                        <div class="freight__block-title">Dry Van 53'</div>
                        <div class="freight__block-descr">We specialize in dispatching only trucks with 48' & 53'
                            semi-trailers (Dry Van, Reefer, Flatbed)
                        </div>
                        <img class="freight__block-img" src="images/icons/dry-van-53.svg" alt="">
                    </div>
                    <div class="freight__block">
                        <div class="freight__block-title">Reefer 53’</div>
                        <div class="freight__block-descr">We specialize in dispatching only trucks with 48' & 53'
                            semi-trailers (Dry Van, Reefer, Flatbed)
                        </div>
                        <img class="freight__block-img" src="images/icons/reefer-53.svg" alt="">
                    </div>
                    <div class="freight__block">
                        <div class="freight__block-title">Flatbed 48’-53’</div>
                        <div class="freight__block-descr">We specialize in dispatching only trucks with 48' & 53'
                            semi-trailers (Dry Van, Reefer, Flatbed)
                        </div>
                        <img class="freight__block-img" src="images/icons/flatbed-48-53.svg" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="freight__blocks">
                    <div class="freight__block">
                        <div class="freight__block-title">Car Hauler</div>
                        <div class="freight__block-descr">We specialize in dispatching only trucks with 48' & 53'
                            semi-trailers (Dry Van, Reefer, Flatbed)
                        </div>
                        <img class="freight__block-img" src="images/icons/car-hauler.svg" alt="">
                    </div>
                    <div class="freight__block">
                        <div class="freight__block-title">Power Only</div>
                        <div class="freight__block-descr">We specialize in dispatching only trucks with 48' & 53'
                            semi-trailers (Dry Van, Reefer, Flatbed)
                        </div>
                        <img class="freight__block-img" src="images/icons/power-only.svg" alt="">
                    </div>
                    <div class="freight__block">
                        <div class="freight__block-title">Steepdeck 48’-53’</div>
                        <div class="freight__block-descr">We specialize in dispatching only trucks with 48' & 53'
                            semi-trailers (Dry Van, Reefer, Flatbed)
                        </div>
                        <img class="freight__block-img" src="images/icons/steepdeck-48-53.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="numbers">
        <div class="container">
            <div class="numbers__header section__header">
                <div class="title numbers__title section__title-width">We are in <span
                            class="title--blue">numbers</span></div>
                <div class="numbers__subtitle section__subtitle section__title-width">We specialize in dispatching only
                    trucks with 48' & 53' semi-trailers (Dry Van, Reefer, Flatbed)
                </div>
            </div>
            <div class="row">
                <div class="col-xl-5 col-md-6">
                    <div class="numbers__text">
                        <div class="numbers__text-title">Better than any Cargo company</div>
                        <p>Personal professional experienced dispatcher (dispatcher will be dedicated to you; all our
                            dispatchers have at least 2 years of experience), plus logistics manager (you will have not
                            only a dispatcher but our team working for you). All company, including the owner, is
                            available 24/7.</p>
                        <p>Personal professional experienced dispatcher (dispatcher will be dedicated to you; all our
                            dispatchers have at least 2 years of experience), plus logistics manager (you will have not
                            only a dispatcher but our team working for you). All company, including the owner, is
                            available 24/7.</p>

                        <a href="tryforfree.html">
                            <button class="button__tff button__tff-numbers">
                                <div class="tff__block">
                                    <div class="tff__svg-block">
                                        <svg class="svg-ttf">
                                            <circle class="circle__btn-ttf" cx="0.521vw" cy="0.521vw" r="0.469vw">
                                        </svg>
                                    </div>
                                    Try for free
                                </div>
                            </button>
                        </a>


                    </div>
                </div>
                <div class="col-xl-6 offset-xl-1 col-md-6">
                    <div class="numbers__blocks">
                        <div class="row">
                            <div class="numbers__block">
                                <div class="numbers__figures">+25 082</div>
                                <div class="numbers__descr">Loads</div>
                            </div>
                            <div class="numbers__block">
                                <div class="numbers__figures">+79</div>
                                <div class="numbers__descr">Happy clients</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="numbers__block">
                                <div class="numbers__figures">+23%</div>
                                <div class="numbers__descr">Clients net income
                                    while working with us
                                </div>
                            </div>
                            <div class="numbers__block">
                                <div class="numbers__figures">+15 726 920</div>
                                <div class="numbers__descr">Miles with cargo</div>
                            </div>
                        </div>
                    </div>
                    <div class="numbers__map">
                        <img class="numbers__map-img" src="images/icons/map.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="partners">
        <div class="container">
            <div class="partners__header section__header">
                <div class="title partners__title section__title-width">Our <span class="title--blue">partners</span>
                </div>
                <div class="partners__subtitle section__subtitle section__title-width">Our solutions for trucking
                    business is quite unique therefore our partnership will be the most profitable experince practice
                    that you ever had
                </div>
            </div>
            <div class="row">
                <div class="partners__tabs">
                    <div class="partners__tabs-item partners__tabs-item--active">
                        Brookerage
                    </div>
                    <div class="partners__tabs-item">
                        Tech
                    </div>
                    <div class="partners__tabs-item">
                        Insurance
                    </div>
                    <div class="partners__tabs-item">
                        Factoring
                    </div>
                </div>
                <div class="partners__slider">
                    <!-- Slider main container -->
                    <div class="swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image25.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image26.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image27.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image47.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image48.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image49.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image25.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image26.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image27.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image47.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image48.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img class="partners__slider-img" src="images/dest/image49.png" alt="">
                            </div>
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
        </div>
    </section>

<?php get_footer(); ?>