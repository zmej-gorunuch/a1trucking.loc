<?php
/**
 * Template part for displaying gallery content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

/**
 * Custom fields
 */
$gallery = get_field( 'images' );

/**
 * Pagination gallery
 */
$images         = array();
$items_per_page = 16;
$total_items    = count( $gallery );
$total_pages    = ceil( $total_items / $items_per_page );

if ( get_query_var( 'paged' ) ) {
	$current_page = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$current_page = get_query_var( 'page' );
} else {
	$current_page = 1;
}
$starting_point = ( ( $current_page - 1 ) * $items_per_page );

if ( $gallery ) {
	$images = array_slice( $gallery, $starting_point, $items_per_page );
}

/**
 * Galleries
 */
$args         = array(
	'post_type'        => 'gallery',
	'numberposts'      => - 1,
	'suppress_filters' => true,
);
$posts        = get_posts( $args );
$current_post = get_the_ID();

?>
<?php if ( is_singular() ): ?>

    <section class="gallery">
        <div class="container">
			<?php if ( $posts ): ?>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="app-nav">
							<?php foreach ( $posts as $post ): ?>
                                <li class="app-nav__item text-center <?php echo $current_post == $post->ID ? 'current' : '' ?>">
                                    <a href="<?php echo get_the_permalink( $post ); ?>"><?php echo $post->post_title; ?></a>
                                </li>
							<?php endforeach; ?>
                        </ul>
                    </div>
                </div>
			<?php endif; ?>
            <div class="row m-row gallery-row">

				<?php if ( ! empty( $images ) ): ?>
					<?php foreach ( $images as $image ): ?>
                        <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
                            <a href="<?php echo $image['url']; ?>" data-title="Title 2" class="image">
                                <figure class="full-height">
                                    <div class="gallery-item__icon">
                                        <img class="" src="<?php echo $image['url']; ?>" alt="gallery icon">
                                    </div>
                                    <figcaption class="mask gallery-item__mask">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/zoom.svg"
                                             alt="hover icon" class="image mask__icon">
                                        <div hidden class="--medium works-item__title"><?php echo ( pll_current_language() == 'ru' && ! empty( $image['alt'] ) ) ? $image['alt'] : $image['title'] ?></div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
					<?php endforeach; ?>
				<?php endif; ?>

            </div>

            <div class="row align-center">
				<?php
				$big   = 999999999; // need an unlikely integer
				$pages = paginate_links( array(
					'base'      => str_replace( '/page/' . $big, '?page=%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'    => '?page=%#%',
					'current'   => $current_page,
					'total'     => $total_pages,
					'type'      => 'array',
					'prev_next' => true,
					'prev_text' => '<i class="icon-arrowLeft"></i>',
					'next_text' => '<i class="icon-arrowRight"></i>',
				) );

				if ( is_array( $pages ) ) {
					$paged = ( get_query_var( 'page' ) == 0 ) ? 1 : get_query_var( 'page' );

					echo '<nav class="pagination" role="navigation"><div class="nav-links d-flex">';
					foreach ( $pages as $key => $page ) {
						if ( $paged == strip_tags( $page ) ) {
							// Активна сторінка
							echo '<span aria-current="page" class="page-numbers current">' . strip_tags( $page ) . '</span>';
						} else {
							if ( $key == count( $pages ) - 1 ) {
								// Наступна сторінка
								echo '<a>' . str_replace( 'class="next page-numbers"', 'class="next page-numbers"', $page ) . '</a>';
							} elseif ( $paged != 1 && $key == 0 ) {
								// Попередня сторінка
								echo '<a>' . str_replace( 'class="prev page-numbers"', 'class="prev page-numbers"', $page ) . '</a>';
							} else {
								// Звичайна сторінка
								echo '<a>' . str_replace( 'class="page-numbers"', 'class="page-numbers"', $page ) . '</a>';
							}
						}
					}
					echo '</div></nav>';
				}
				?>
            </div>

        </div>
    </section>

<?php else: ?>

    <div class="column col-xl-3 col-lg-4 col-md-3 col-sm-6 col-xs-12 gallery-item">
		<?php if ( $images ): ?>
            <a href="<?php echo $images[0]['url']; ?>" class="image">
                <figure class="full-height">
                    <div class="gallery-item__icon">
                        <img class=""
                             src="<?php echo $images[0]['url']; ?>"
                             alt="gallery icon">
                    </div>
                    <figcaption class="mask gallery-item__mask">
                        <img src="<?php echo get_template_directory_uri() ?>/img/zoom.svg" alt="hover icon"
                             class="image mask__icon">
                    </figcaption>
                </figure>
            </a>
		<?php endif; ?>
    </div>

<?php endif; ?>
