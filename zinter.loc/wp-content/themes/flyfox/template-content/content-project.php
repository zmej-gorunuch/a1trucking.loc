<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlyFox
 */

?>
<?php if ( is_singular() ): ?>
	
	<!--Start page-->
	<div class="page-wrapper ">
		<div class="container">
			<div class="section__head">
				<h2 class="title title--section">
					<span> <a href="<?php echo home_url(); ?>"><?php pll_e( 'ГОЛОВНА' ); ?></a></span>/
					<span> <a href="<?php echo get_post_type_archive_link( 'post' ); ?>"><?php pll_e( 'БЛОГ' ); ?></a></span>/
					<?php echo mb_strtoupper( str_replace( '  ', '', wp_title( '', false ) ) ); ?>
				</h2>
			</div>
			<div class="text">
				<?php the_content(); ?>
			</div>
		</div>
	
	
	</div>
	<!--End page-->

<?php else: ?>
	<!--Start page-->
	<div class="page-wrapper">
		
		<!-- Start header -->
		<!-- Start blog section -->
		<section class="section section--default blog " id="">
			<div class="container">
				<div class="section__head">
					<h2 class="title title--section fadeInDown animated">
						<span><a href="<?php echo home_url(); ?>"><?php pll_e( 'ГОЛОВНА' ); ?></a></span>/
						<?php echo mb_strtoupper( str_replace( '  ', '', wp_title( '', false ) ) ); ?>
					</h2>
				</div>
				<div class="row row--blog">
					
					<?php while ( have_posts() ): ?>
						
						<?php the_post(); ?>
						
						<div class="col-12 col-md-6  col--blog animated">
							<a href="<?php the_permalink(); ?>" class="blog-card">
								<?php if ( has_post_thumbnail() ): ?>
									<div class="blog-card__picture">
										<img data-src="<?php echo get_the_post_thumbnail_url(); ?>"
											 alt="<?php the_title(); ?>">
									</div>
								<?php endif; ?>
								
								<div class="blog-card__title">
									<h4><?php the_title(); ?></h4>
								</div>
								
								<div class="blog-card__date">
									<?php the_time( 'd/ m / y' ); ?>
								</div>
								
								<p>
									<?php the_excerpt(); ?>
								</p>
							</a>
						</div>
					
					<?php endwhile; ?>
				
				</div>
				
				<!-- Start pagination -->
				<?php pagination_theme_display(); ?>
				<!-- End pagination -->
			</div>
		</section>
		<!-- End blog section -->    <!-- End header -->
	</div>
	<!--End page-->

<?php endif; ?>