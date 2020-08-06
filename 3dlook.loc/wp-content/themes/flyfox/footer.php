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

/**
 * Custom fields
 */
$footer = get_field( 'footer', 'option' );
if ( $footer ) {
	$footer_address    = $footer['address'];
	$footer_email      = $footer['email'];
	$footer_button     = $footer['button'];
	$footer_text_block = $footer['text_block'];
}
// Social links
$socials = get_field( 'social_links', 'option' );

?>
<footer>
    <div id="footer-msg">
        <div class="btnr blue icon-intercom" id="f-msg"></div>
        <div class="btnr black icon-arr-t" id="f-arr"></div>
    </div>
    <div class="wrap">
        <div class="col" id="footer-1">
			<?php if ( get_custom_logo() ): ?>
                <a class="logo" href="<?php echo home_url(); ?>">
                    <img src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'medium' )[0] ?>"
                         alt="3dLook logo" width="137" height="20">
                </a>
			<?php endif; ?>
            <div class="address">
                <label>Office:</label>
				<?php if ( ! empty( $footer_address ) ): ?>
                    <address><?php echo $footer_address; ?></address>
				<?php endif; ?>
            </div>
            <div class="address">
                <label>Email:</label>
				<?php if ( ! empty( $footer_email ) ): ?>
                    <a href="mailto:<?php echo $footer_email; ?>"><?php echo $footer_email; ?></a>
				<?php endif; ?>
            </div>
			<?php if ( ! empty( $footer_button ) ): ?>
                <a href="<?php echo $footer_button['url']; ?>" target="<?php echo $footer_button['target']; ?>"
                   class="btn transparent red" type="button"><?php echo $footer_button['title']; ?></a>
			<?php endif; ?>
        </div>
        <div id="copyright">© 2019 3DLOOK.ME<span>, design by <a href="https://deco.agency/uk/">deco.agency</a></span>
        </div>
        <div class="col" id="footer-2">
            <div class="footer-rlnks">
                <div class="grid">
					<?php display_menu(); ?>
                </div>
            </div>
			<?php if ( $socials ): ?>
                <div class="socials">
					<?php foreach ( $socials as $social ): ?>
                        <a class="social <?php echo $social['icon'] ?>" href="<?php echo $social['link'] ?>"
                           target="_blank"></a>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
        </div>
        <div id="footer-pptc">
            <a href="">Privacy</a>
            <a href="">Terms and conditions</a>
        </div>
        <div class="col" id="footer-3">
            <div class="footer-title">Blog Posts</div>
            <div class="footer-blog">
                <div class="footer-blog-title">Reuters</div>
                <div class="footer-blog-text">The Technology 202: This venture capitalist is warning Congress not to
                    hurt startups in its antirust crusade
                </div>
            </div>
            <div class="footer-blog">
                <div class="footer-blog-title">Reuters</div>
                <div class="footer-blog-text">The Technology 202: This venture capitalist is warning Congress not to
                    hurt startups in
                </div>
            </div>
            <div class="footer-blog">
                <div class="footer-blog-title">Reuters</div>
                <div class="footer-blog-text">The Technology 202: This venture capitalist is warning Congress not to
                    hurt startups in
                </div>
            </div>
        </div>
        <div class="col" id="footer-4">
            <div class="footer-title">Newsletter</div>
            <form>
                <div class="input">
                    <input type="text" name="email" placeholder="E-mail">
                </div>
                <button class="btn red" type="submit">SUBSCRIBE</button>
            </form>
			<?php if ( ! empty( $footer_text_block ) ): ?>
				<?php echo $footer_text_block; ?>
			<?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
