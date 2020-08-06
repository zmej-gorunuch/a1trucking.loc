<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
    <meta charset="UTF-8"/>
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>"/>
	<?php if ( $description ) { ?>
        <meta name="description" content="<?php echo $description; ?>"/>
	<?php } ?>
	<?php if ( $keywords ) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>"/>
	<?php } ?>
    <!-- SEO meta tags -->
    <meta property="og:url" content="<?php echo $og_url; ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?php echo $title; ?>"/>
	<?php if ( $description ) { ?>
        <meta property="og:description" content="<?php echo $description; ?>"/>
	<?php } ?>
	<?php if ( $og_image ) { ?>
        <meta property="og:image" content="<?php echo $og_image; ?>"/>
	<?php } else { ?>
        <meta property="og:image" content="<?php echo $logo; ?>"/>
	<?php } ?>
    <meta property="og:site_name" content="<?php echo $name; ?>"/>
    <meta name="twitter:card" content=summary/>
	<?php if ( $description ) { ?>
        <meta name="twitter:description" content="<?php echo $description; ?>"/>
	<?php } ?>
    <meta name="twitter:title" content="<?php echo $title; ?>"/>
    <!--End SEO meta tags -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!-- Template Basic Images Start -->
    <link rel="icon" href="catalog/view/theme/flyfox/img/favicon.ico"/>
    <link rel="favicon" sizes="130x170" href="catalog/view/theme/flyfox/img/favicon130x170.png"/>
    <!-- Template Basic Images End -->

	<?php foreach ( $styles as $style ) { ?>
        <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>"
              media="<?php echo $style['media']; ?>"/>
	<?php } ?>
	<?php foreach ( $links as $link ) { ?>
        <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>"/>
	<?php } ?>
	<?php foreach ( $scripts as $script ) { ?>
        <script src="<?php echo $script; ?>" type="text/javascript"></script>
	<?php } ?>
	<?php foreach ( $analytics as $analytic ) { ?>
		<?php echo $analytic; ?>
	<?php } ?>

    <!-- Custom Browsers Color Start -->
    <meta name="theme-color" content="#000"/>
    <!-- Custom Browsers Color End -->

    <style>
        body {
            opacity: 0;
        }

        .modal {
            opacity: 0;
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
        }

        .select__list {
            visibility: hidden;
            opacity: 0;
        }

        .aside-tab {
            transform: translate(-100%, -50%);
        }

        .aside-tab--right {
            transform: translate(100%, -50%);
        }

        @media screen and (max-width: 991px) {
            .header nav {
                transform: translate3d(100%, 0, 0);
                visibility: hidden;
            }

            /*header mega menu */
            .header.header-mega-menu nav {
                transform: translate3d(100%, 0, 0);
                visibility: hidden;
            }
        }
    </style>
    <link href="catalog/view/theme/flyfox/main.css" rel="stylesheet">
</head>
<body class="fixed-header">
<!-- Start site wrapper -->
<div class="site-wrapper dark-theme">

    <!-- Start header -->
    <header class="header ">
        <div class="container">
            <div class="header__row">
                <a href="sitemap.html" class="logo">
                    <img src="catalog/view/theme/flyfox/img/logo.svg" alt="Petronas logo">
                </a>
                <menu>
                    <!-- Nav for wordpress start -->
                    <nav data-default_back_btn_text="Menu">
                        <ul>
                            <li class="menu-item-has-children">
                                <span> Про нас </span>
                                <div class="dropdown-menu-wrap">
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Про Ойл-груп</a></li>
                                        <li><a href="##">Історія</a></li>
                                        <li><a href="###">Про бренд</a></li>
                                        <li><a href="###">Технології</a></li>
                                        <li><a href="###">Спонсорство</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item-has-children">
                                <span> Продукція </span>
                                <div class="dropdown-menu-wrap">
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Test 1</a></li>
                                        <li><a href="##">Test 2</a></li>
                                        <li><a href="###">Test 3</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="about.html">Магазин</a>
                            </li>
                            <li class="menu-item-has-children">
                                <span> Знайти локацію</span>
                                <div class="dropdown-menu-wrap">
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Test 12</a></li>
                                        <li><a href="##">Test 22</a></li>
                                        <li><a href="###">Test 33</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="contact.html">Інформаційний центр</a>
                            </li>
                            <li>
                                <a href="contact.html">Контакти</a>
                            </li>
                        </ul>
                        <div class="header-cab">
                            <a href="#">
                                <svg width="17" height="20" viewBox="0 0 17 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.2779 4.95839C13.2779 7.48969 11.2258 9.54161 8.69447 9.54161C6.16318 9.54161 4.11108 7.48969 4.11108 4.95839C4.11108 2.42709 6.16318 0.375 8.69447 0.375C11.2258 0.375 13.2779 2.42709 13.2779 4.95839Z"
                                          fill="#029C99"/>
                                    <path d="M12.5902 11.375H4.79845C2.39774 11.375 0.444336 13.3284 0.444336 15.7291V18.9375C0.444336 19.317 0.752335 19.625 1.13184 19.625H16.2568C16.6363 19.625 16.9443 19.317 16.9443 18.9375V15.7291C16.9443 13.3284 14.9909 11.375 12.5902 11.375Z"
                                          fill="#029C99"/>
                                </svg>
                                <p>
                                    Особистий кабінет
                                </p>
                            </a>
                        </div>
                        <div class="header-select">
							<?php debug( $lang ) ?>
                            <div class="select-lg menu-item-has-children js-select-lg">
                                <span>UA</span>
                                <div class="dropdown-menu-wrap">
                                    <ul class="dropdown-menu select-lg__list">
                                        <li class="select__option"><a href="##">EN</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!-- Nav for wordpress end -->
                    <div class="burger hidden-on-desktop">
                        <span>&nbsp;</span>
                        <span>&nbsp;</span>
                        <span>&nbsp;</span>
                    </div>
                </menu>
            </div>
        </div>
    </header>    <!-- End header -->


	<?php if ( $categories ) { ?>
        <div class="container">
            <nav id="menu" class="navbar">
                <div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
                    <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
						<?php foreach ( $categories as $category ) { ?>
							<?php if ( $category['children'] ) { ?>
                                <li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle"
                                                        data-toggle="dropdown"><?php echo $category['name']; ?></a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-inner">
											<?php foreach ( array_chunk( $category['children'], ceil( count( $category['children'] ) / $category['column'] ) ) as $children ) { ?>
                                                <ul class="list-unstyled">
													<?php foreach ( $children as $child ) { ?>
                                                        <li>
                                                            <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
                                                        </li>
													<?php } ?>
                                                </ul>
											<?php } ?>
                                        </div>
                                        <a href="<?php echo $category['href']; ?>"
                                           class="see-all"><?php echo $text_all; ?><?php echo $category['name']; ?></a>
                                    </div>
                                </li>
							<?php } else { ?>
                                <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
							<?php } ?>
						<?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
	<?php } ?>
