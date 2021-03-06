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
    <!--<link rel="icon" href="<?php echo get_template_directory_uri() ?>/favicon.svg" type="image/svg+xml"/>-->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body>

<p>Header (wp-content/themes/flyfox/header.php)</p>