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

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no"/>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145083633-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-145083633-2');
    </script>

	<?php wp_head(); ?>
</head>
<body>

<?php if ( is_front_page() || is_page_template( 'template-pages/contact.php' ) ): ?>
	<?php null ?>
<?php else: ?>
    <div class="body-padding"></div>
<?php endif; ?>

<header id="masthead" class="header">
    <div class="header-primary">
        <div class="container --relative">
            <div class="row align-middle align-justify ">
                <div class="header__column">
                    <div class="logo-wrap d-flex align-middle">
                        <a href="<?php echo pll_home_url() ?>" class="logo-wrap__link default-icon" rel="home">
                            <img src="<?php echo get_template_directory_uri() ?>/img/logo.svg" class="logo-wrap__icon"
                                 alt="logo berkom">
                        </a>
                    </div>
                </div>

                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="navbar">
					<?php menu_theme_display( pll_current_language() ); ?>
                </div>
            </div>
        </div>
    </div>
</header>
