<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FlyFox
 */

/**
 * Custom fields
 */
$header = get_field( 'header', 'option' );
if ( $header ) {
	$header_button = $header['button'];
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, maximum-scale=1">

    <!-- Open Graph -->
    <meta name="og:type" content="website">
    <meta name="og:title" content="3DLook">
    <meta name="og:description" content="">
    <meta name="og:url" content="">
    <meta name="og:site_name" content="3DLook">
    <meta name="og:locale" content="uk_UA">
    <!-- <meta name="og:image" content="url"> -->
    <!-- Open Graph -->

	<?php wp_head(); ?>

    <script>var onLoaded=[],onResize=[];</script>
</head>
<body>
<!-- mobile top menu -->
<div id="mob-top" class="">
    <button type="button" class="cross" id="close-mob-top"></button>
    <span id="mob-top-title">Homescreen</span>
    <nav id="mob-top-nav">
        <div class="mob-top-link hidden">
            <div class="hider-row">
                <a class="mt-link" href="">Solutions</a>
                <div class="icon-arr-t"></div>
            </div>
            <ul class="hider">
                <li><a class="mt-sublink" href="">Human Body Measuring</a></li>
                <li><a class="mt-sublink" href="">Size and Fit Recommendations</a></li>
                <li><a class="mt-sublink" href="">3d Model Generation</a></li>
            </ul>
        </div>
        <div class="mob-top-link hidden">
            <div class="hider-row">
                <a class="mt-link" href="">Technology</a>
                <div class="icon-arr-t"></div>
            </div>
            <ul class="hider">
                <li><a class="mt-sublink" href="">1Human Body Measuring</a></li>
                <li><a class="mt-sublink" href="">1Size and Fit Recommendations</a></li>
                <li><a class="mt-sublink" href="">13d Model Generation</a></li>
            </ul>
        </div>
        <div class="mob-top-link hidden">
            <div class="hider-row">
                <a class="mt-link" href="">Resources</a>
                <div class="icon-arr-t"></div>
            </div>
            <ul class="hider">
                <li><a class="mt-sublink" href="">2Human Body Measuring</a></li>
                <li><a class="mt-sublink" href="">2Size and Fit Recommendations</a></li>
                <li><a class="mt-sublink" href="">33d Model Generation</a></li>
            </ul>
        </div>
        <div class="mob-top-link hidden">
            <div class="hider-row">
                <a class="mt-link" href="">Careers</a>
                <div class="icon-arr-t"></div>
            </div>
            <ul class="hider">
                <li><a class="mt-sublink" href="">3Human Body Measuring</a></li>
                <li><a class="mt-sublink" href="">3Size and Fit Recommendations</a></li>
                <li><a class="mt-sublink" href="">33d Model Generation</a></li>
            </ul>
        </div>
        <div class="mob-top-link hidden">
            <div class="hider-row">
                <a class="mt-link" href="">About</a>
                <div class="icon-arr-t"></div>
            </div>
            <ul class="hider">
                <li><a class="mt-sublink" href="">4Human Body Measuring</a></li>
                <li><a class="mt-sublink" href="">4Size and Fit Recommendations</a></li>
                <li><a class="mt-sublink" href="">43d Model Generation</a></li>
            </ul>
        </div>
    </nav>
    <button type="button" class="btn red">Request a Demo</button>
</div>

<!-- eclipse -->
<div id="eclipse"></div>

<!-- search-result -->
<div id="search-result" class="">
    <span id="search-result-title">Search results: <span>11</span></span>
    <button type="button" class="btn black icon-arr-t">View more</button>
</div>

<!-- body -->
<header>
    <div class="wrap">
	    <?php if ( get_custom_logo() ): ?>
            <a class="logo" href="<?php echo home_url(); ?>">
                <img src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'medium' )[0] ?>"
                     alt="3dLook logo" width="137" height="20">
            </a>
	    <?php endif; ?>
        <div id="top-center">
            <nav id="top-nav">
	            <?php display_menu() ?>
            </nav>
            <div id="search-wrap" class="">
                <form>
                    <input id="search-input" type="text" placeholder="Search..." name="search">
                    <button id="search" class="icon-search" type="submit"></button>
                    <button id="search-clean" class="close" type="button"></button>
                </form>
            </div>
        </div>
        <div id="header-mob">
            <a class="icon-googleplay" href=""></a>
            <a class="icon-appstore" href=""></a>
            <button type="button" class="burger" id="open-mob-top">
                <span class="burger-el bel1"></span>
                <span class="burger-el bel2"></span>
                <span class="burger-el bel3"></span>
            </button>
        </div>
	    <?php if ( ! empty( $header_button ) ): ?>
            <a href="<?php echo $header_button['url']; ?>" target="<?php echo $header_button['target']; ?>"
               class="btn transparent red" type="button" id="h-req-quote"><?php echo $header_button['title']; ?></a>
	    <?php endif; ?>
    </div>
</header>