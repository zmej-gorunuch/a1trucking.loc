<?php
/*
Template Name: Галерея сторінка (шаблон)
*/

/**
 * Custom fields
 */
$phones    = get_field( 'site_phones' );
$emails    = get_field( 'site_emails' );
$addresses = get_field( 'site_addresses' );

?>
<?php get_header(); ?>

    <section class="gallery">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="app-nav">
                        <li class="app-nav__item text-center current">
                            <a href="worksCompleted.html">Виконані роботи</a>
                        </li>
                        <li class="app-nav__item text-center">
                            <a href="enterprise.html">Підприємство</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row m-row gallery-row">
                <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
                    <a href="https://www.youtube.com/embed/UY9P0QSxlnI" class="video">
                        <figure class="full-height">
                            <div class="gallery-item__icon">
                                <img class="" src="img/gallery1.png" alt="gallery icon">
                            </div>
                            <figcaption class="mask gallery-item__mask">
                                <img src="img/zoom.svg" alt="hover icon" class="image mask__icon">
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
                    <a href="img/gallery1.png" class="image">
                        <figure class="full-height">
                            <div class="gallery-item__icon">
                                <img class=""
                                     src="img/gallery1.png"
                                     alt="gallery icon">
                            </div>
                            <figcaption class="mask gallery-item__mask">
                                <img src="img/zoom.svg" alt="hover icon" class="image mask__icon">
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
                    <a href="img/gallery2.png" class="image">
                        <figure class="full-height">
                            <div class="gallery-item__icon">
                                <img class=""
                                     src="img/gallery2.png"
                                     alt="gallery icon">
                            </div>
                            <figcaption class="mask gallery-item__mask">
                                <img src="img/zoom.svg" alt="hover icon" class="image mask__icon">
                            </figcaption>
                        </figure>

                    </a>
                </div>
                <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
                    <a href="img/gallery3.png" class="image">
                        <figure class="full-height">
                            <div class="gallery-item__icon">
                                <img class="" src="img/gallery3.png" alt="gallery icon">
                            </div>
                            <figcaption class="mask gallery-item__mask">
                                <img src="img/zoom.svg" alt="hover icon" class="image mask__icon">
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
                    <a href="img/gallery4.png" class="image">
                        <figure class="full-height">
                            <div class="gallery-item__icon">
                                <img class="" src="img/gallery4.png" alt="gallery icon">
                            </div>
                            <figcaption class="mask gallery-item__mask">
                                <img src="img/zoom.svg" alt="hover icon" class="image mask__icon">
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
                    <a href="img/gallery5.png" class="image">
                        <figure class="full-height">
                            <div class="gallery-item__icon">
                                <img class="" src="img/gallery5.png" alt="gallery icon">
                            </div>
                            <figcaption class="mask gallery-item__mask">
                                <img src="img/zoom.svg" alt="hover icon" class="image mask__icon">
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
                    <a href="img/gallery6.png" class="image">
                        <figure class="full-height">
                            <div class="gallery-item__icon">
                                <img class=""
                                     src="img/gallery6.png"
                                     alt="gallery icon">
                            </div>
                            <figcaption class="mask gallery-item__mask">
                                <img src="img/zoom.svg" alt="hover icon" class="image mask__icon">
                            </figcaption>
                        </figure>

                    </a>
                </div>
            </div>

            <div class="row align-center">
                <nav class="pagination" role="navigation">
                    <div class="nav-links d-flex">
                        <a class="prev page-numbers" href="#"><i class="icon-arrowLeft"></i></a>
                        <a class="page-numbers" href="#">1</a>
                        <span aria-current="page" class="page-numbers current">2</span>
                        <a class="page-numbers" href="#">3</a>
                        <span class="page-numbers dots">…</span>
                        <a class="page-numbers" href="#">5</a>
                        <a class="next page-numbers" href="#"><i class="icon-arrowRight"></i> </a>
                    </div>
                </nav>
            </div>
        </div>
    </section>

<?php get_footer(); ?>