<?php
// Загальні налаштування -----------------------------------------------------------------------------------------------
/**
 * Підключення Ajax скриптів до frontend
 */
add_action( 'wp_enqueue_scripts', 'ajax_script', 99 );
function ajax_script() {
	wp_localize_script( 'custom_script', 'ajax_script',
		[
			'url' => admin_url( 'admin-ajax.php' ),
		]
	);
}

// Ajax функції --------------------------------------------------------------------------------------------------------

// Блог ----------------------------------------------------------------------------------------------------------------
/**
 * Більше постів
 */
add_action( 'wp_ajax_more_posts', 'more_posts_function' );
add_action( 'wp_ajax_nopriv_more_posts', 'more_posts_function' );
function more_posts_function() {
	$paged    = $_POST['page'] + 1;
	$category = $_POST['category'];
	$tag      = $_POST['tag'];
	$args     = [
		'paged'            => $paged,
		'post_type'        => 'post',
		'suppress_filters' => true,
	];
	if ( ! empty( $tag ) ) {
		$args['tax_query'] = [
			[
				'taxonomy' => 'blog_tag',
				'field'    => 'slug',
				'terms'    => $tag,
			],
		];
	}
	$posts = new WP_Query( $args );
	?>
	<?php while ( $posts->have_posts() ): ?>
		<?php $posts->the_post(); ?>
		<?php $count = $posts->found_posts ?>
	<?php endwhile; ?>
	<?php
	wp_die();
}