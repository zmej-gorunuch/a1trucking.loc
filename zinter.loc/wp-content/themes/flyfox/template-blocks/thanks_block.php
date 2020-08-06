<?php
/**
 * Template part for displaying code block
 *
 * @package FlyFox
 */

if ( ! empty( $_COOKIE['reviewed_products'] ) ) {
	$reviewed_products_array = $_COOKIE['reviewed_products'];
} else {
	$reviewed_products_array = null;
}

?>

<?php if ( isset( $reviewed_products_array ) ): ?>
	<!-- Start reviewed-goods -->
	<!-- Start reviewed-goods section -->
	<section class="section section--default reviewed-goods " id="reviewed-goods">
		<div class="container">
			<div class="section__head">
				<h2 class="title fadeInDown animated">
					<?php pll_e( 'Просмотренный вами товар' ); ?>
				</h2>
				<h5 class="title-sub fadeInRight animated">
					<?php pll_e( 'Ваш выбор' ); ?>
				</h5>
			</div>
			
			<div class="products">
				<?php foreach ( $reviewed_products_array as $id => $val ): ?>
					<?php $post = get_post( $id ); ?>
					<?php $link = get_permalink( $post ); ?>
					<?php $title = get_the_title( $post ); ?>
					<?php $img = get_field( 'block_1', $post )['gallery'][0]['url']; ?>
					<?php $article = get_field( 'block_1', $post )['article']; ?>
					<div class="product-card-wrap  product-card--reviewed">
						<a href="<?php echo $link; ?>" class="product-card">
							<?php if ( $img ): ?>
								<div class="product-card__picture">
									<img src="<?php echo $img; ?>" data-src="<?php echo $img; ?>"
										 alt="<?php echo $title; ?>">
								</div>
							<?php endif; ?>
							<div class="product-card__descr">
								<h5 class="p-descr__title"><?php echo $title; ?></h5>
								<?php if ( $article ): ?>
									<div class="product-card__code">
										<p><?php echo $article; ?></p>
									</div>
								<?php endif; ?>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		
		</div>
	</section>
<?php endif; ?>
<!-- End reviewed-goods section -->      <!-- End reviewed-goods -->