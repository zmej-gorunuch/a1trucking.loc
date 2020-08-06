<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

/**
 * Custom fields
 */
// Single post ---------------------------------------------------------------------------------------------------------
$portfolio_block = get_field( 'block_1' );
if ( $portfolio_block ) {
	$portfolio_images = ! empty( $portfolio_block['gallery'] ) ? $portfolio_block['gallery'] : null;
}

?>
<?php if ( is_singular() ): ?>
	
	<!--Start page-->
	<div class="page-wrapper">
		
		<?php get_template_part( 'template-blocks/catalog_block' ) ?>
		
		<!-- Start portfolio -->
		<!-- Start name portfolio-main -->
		<section class="section bg-gray portfolio-main " id="portfolio-main">
			<div class="container">
				
				<div class="section__head">
					<h2 class="title title--section fadeInDown animated">
						<span> <a href="<?php echo home_url(); ?>"><?php pll_e( 'Главная' ); ?></a></span>/
						<span> <a href="<?php echo get_post_type_archive_link( 'project' ); ?>"><?php pll_e( 'Портфолио' ); ?></a></span>/
						<?php echo mb_strtoupper( str_replace( '  ', '', wp_title( '', false ) ) ); ?>
					</h2>
				</div>
				
				<div class="portfolio-view">
					<div class="portfolio-view__big">
						<?php $i = 1; ?>
						<?php foreach ( $portfolio_images as $image ): ?>
							<a href="<?php echo $image['url']; ?>"
							   data-id="<?php echo $i; ?>" <?php echo $i == 1 ? 'class="active"' : null ?>>
								<img data-src="<?php echo $image['url']; ?>"
									 alt="<?php the_title(); ?>-<?php echo $i; ?>">
							</a>
							<?php $i ++; ?>
						<?php endforeach; ?>
					</div>
					
					<div class="portfolio-view__slider">
						<div class="p-slider">
							<?php $i = 1; ?>
							<?php foreach ( $portfolio_images as $image ): ?>
								<div class="p-slider__item">
									<div class="img-wrap">
										<img src="<?php echo $image['url']; ?>" data-img="<?php echo $image['url']; ?>"
											 data-id="<?php echo $i; ?>"
											 alt="">
									</div>
								</div>
								<?php $i ++; ?>
							<?php endforeach; ?>
						</div>
					</div>
				
				</div>
				
				
				<div class="row">
				</div>
			
			</div>
		</section>
		<!-- End name portfolio-main -->      <!-- End portfolio -->
		
		<?php get_template_part( 'template-blocks/reviewed_products_block' ); ?>
	
	</div>
	<!--End page-->

<?php else: ?>
	
	<!--Start page-->
	<div class="page-wrapper">
		
		<?php get_template_part( 'template-blocks/catalog_block' ) ?>
		
		<!-- Start portfolio -->
		<!-- Start name portfolio -->
		<section class="section section--default portfolio " id="portfolio">
			<div class="container">
				
				<div class="section__head">
					<h2 class="title title--section fadeInDown animated">
						<span><a href="<?php echo home_url(); ?>"><?php pll_e( 'Главная' ); ?></a></span>/
						<?php echo mb_strtoupper( str_replace( '  ', '', wp_title( '', false ) ) ); ?>
					</h2>
				</div>
				
				<div class="row">
					<?php while ( have_posts() ): ?>
						<?php the_post(); ?>
						<?php $image = get_field( 'block_1', $post->ID )['gallery'][0]['url']; ?>
						<div class="col-12 col-md-6 ">
							<a href="<?php the_permalink(); ?>" class="portfolio-card  fadeInLeft animated">
								<?php if ( $image ): ?>
									<div class="portfolio-card__picture">
										<img src="<?php echo $image; ?>"
											 data-src="<?php echo $image; ?>"
											 alt="<?php the_title(); ?>">
									</div>
								<?php endif; ?>
								<h5 class="portfolio-card__descr"><?php the_title(); ?></h5>
							</a>
						</div>
					<?php endwhile; ?>
				</div>
				
				<!-- Start pagination -->
				<?php pagination_theme_display(); ?>
				<!-- End pagination -->
			
			</div>
		</section>
		<!-- End name portfolio -->      <!-- End portfolio -->
		
		<?php get_template_part( 'template-blocks/reviewed_products_block' ); ?>
	
	</div>
	<!--End page-->

<?php endif; ?>