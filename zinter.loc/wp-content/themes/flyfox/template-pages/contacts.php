<?php
/*
Template Name: Головна сторінка (шаблон)
*/

/**
 * Custom fields
 */
$sliders_block = get_field( 'block_2' );
if ( $sliders_block ) {
	$slides_images      = ! empty( $sliders_block['imgs'] ) ? $sliders_block['imgs'] : null;
	$slides_title       = ! empty( $sliders_block['title'] ) ? $sliders_block['title'] : null;
	$slides_description = ! empty( $sliders_block['description'] ) ? $sliders_block['description'] : null;
	$slides_button      = ! empty( $sliders_block['button'] ) ? $sliders_block['button'] : null;
}
$about_block = get_field( 'block_3' );
if ( $about_block ) {
	$about_title_block    = ! empty( $about_block['title_block'] ) ? $about_block['title_block'] : null;
	$about_subtitle_block = ! empty( $about_block['subtitle_block'] ) ? $about_block['subtitle_block'] : null;
	$about_image          = ! empty( $about_block['img'] ) ? $about_block['img'] : null;
	$about_title          = ! empty( $about_block['title'] ) ? $about_block['title'] : null;
	$about_subtitle       = ! empty( $about_block['subtitle'] ) ? $about_block['subtitle'] : null;
	$about_text           = ! empty( $about_block['text'] ) ? $about_block['text'] : null;
	$about_button         = ! empty( $about_block['button'] ) ? $about_block['button'] : null;
}
$partners_block = get_field( 'block_1' );
if ( $partners_block ) {
	$partners_title = ! empty( $partners_block['title'] ) ? $partners_block['title'] : null;
	$partners_text  = ! empty( $partners_block['text'] ) ? $partners_block['text'] : null;
	$partners       = ! empty( $partners_block['partners'] ) ? $partners_block['partners'] : null; //array key logo, link
}

?>
<?php get_header(); ?>
	
	<!--Start page-->
	<div class="page-wrapper page-home">
		
		<?php if ( $sliders_block ): ?>
			<!-- Start introduction -->
			<!-- Start introduction section -->
			<section id="introduction" class="section introduction ">
				<div class="container">
					<div class="introduction__slider">
						<div class="i-slider">
							<?php foreach ( $slides_images as $slide_img ): ?>
								<div class="i-slider__item">
									<img src="<?php echo $slide_img['url']; ?>" alt="Slider image">
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					
					<div class="introduction__content fadeInLeft animated">
						<h1 class="title"><?php echo $slides_title; ?></h1>
						<div class="descr-wrap">
							<p><?php echo $slides_description; ?></p>
							<?php if ( $slides_button['url'] ): ?>
								<a href="<?php echo $slides_button['url']; ?>"
								   target="<?php echo $slides_button['target']; ?>"
								   class="btn btn--transparent-black">
									<?php echo $slides_button['title']; ?>
								</a>
							<?php endif; ?>
							<div class="slider-dots">
								<?php foreach ( $slides_images as $item ): ?>
									<button></button>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End introduction section -->      <!-- End introduction -->
		<?php endif; ?>
		
		<!-- Start slider-main -->
		<!-- Start slider-main section -->
		<section class="section slider-main " id="slider-main">
			<div class="container set-position">
				<div class="slider-category">
					
					<a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								1
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">ДИРЕКТОРСКИЕ КРЕСЛА</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a> <a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								2
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">Письменные столы</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a> <a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								3
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">Корпусная офисная мебель </h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a> <a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								4
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">книжные шкафы</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a> <a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								5
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">тумбы-регистраторы</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a>
					<a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								6
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">тумбы-регистраторы</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a> <a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								7
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">книжные шкафы</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a> <a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								8
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">тумбы-регистраторы</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a> <a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								9
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">книжные шкафы</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a> <a href="#" class="slider-category__item">
						<div class="item-num-wrap">
							<div class="item-num">
								10
							</div>
						</div>
						<div class="item-descr">
							<h3 class="item-title">книжные шкафы</h3>
							<p>
								Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
							</p>
						</div>
						
						<div class="item-picture">
							<img src="img/test.png" alt="">
						</div>
					</a></div>
			</div>
		</section>
		<!-- End slider-main section -->      <!-- End slider-main -->
		
		<!-- Start novelty -->
		<!-- Start name section -->
		<section class="section section--default novelty " id="novelty">
			<div class="container">
				
				<div class="section__head">
					<h2 class="title fadeInDown animated">
						новинки производста
					</h2>
					<h5 class="title-sub fadeInRight animated">
						новинки
					</h5>
				</div>
				
				<div class="novelty__slider n-slider">
					<div class="n-slider__item">
						<a href="#" class="novelty-card">
							<div class="novelty-card__descr">
								
								<div class="title-wrap">
									<h4 class="title">
										<b>КРЕСЛО-СТАНЦИЯ</b>
										<br>
										ДЛЯ АЙТИШНИКОВ
									</h4>
								</div>
								
								<p>С пропеллером и прочими фишками
								</p>
							</div>
							<div class="novelty-card__picture">
								<img src="../img/novelty1.png" data-src="img/novelty1.png" alt="">
							</div>
						</a>
					</div>
					<div class="n-slider__item">
						<a href="#" class="novelty-card">
							<div class="novelty-card__descr">
								
								<div class="title-wrap">
									<h4 class="title">
										<b>СКЛАДНЫЕ</b>
										<br>
										КАРКАСЫ
									</h4>
								</div>
								
								<p>На подшибниковых шарнирах
								</p>
							</div>
							<div class="novelty-card__picture">
								<img src="../img/novelty2.png" data-src="img/novelty2.png" alt="">
							</div>
						</a>
					</div>
					<div class="n-slider__item">
						<a href="#" class="novelty-card">
							<div class="novelty-card__descr">
								
								<div class="title-wrap">
									<h4 class="title">
										<b>КАРКАС</b>
										<br>
										ИЗ ТРЕУГОЛЬНЫХ ТРУБ
									</h4>
								</div>
								
								<p>Сварные, разборные и цельнолитые
								</p>
							</div>
							<div class="novelty-card__picture">
								<img src="../img/novelty3.png" data-src="img/novelty3.png" alt="">
							</div>
						</a>
					</div>
					<div class="n-slider__item">
						<a href="#" class="novelty-card">
							<div class="novelty-card__descr">
								
								<div class="title-wrap">
									<h4 class="title">
										<b>КАРКАС</b>
										<br>
										ИЗ ТРЕУГОЛЬНЫХ ТРУБ
									</h4>
								</div>
								
								<p>Сварные, разборные и цельнолитые
								</p>
							</div>
							<div class="novelty-card__picture">
								<img src="../img/novelty3.png" data-src="img/novelty3.png" alt="">
							</div>
						</a>
					</div>
				</div>
			
			</div>
		</section>
		<!-- End name section -->      <!-- End novelty -->
		
		<?php if ( $about_block ): ?>
			<!-- Start about -->
			<!-- Start name about -->
			<section class="section section--default about " id="about">
				<div class="container">
					
					<div class="section__head">
						<h2 class="title fadeInDown animated">
							<?php echo $about_subtitle_block; ?>
						</h2>
						<h5 class="title-sub">
							<?php echo $about_title_block; ?>
						</h5>
					</div>
					
					<div class="about-inner">
						<div class="about-picture">
							<img src="<?php echo $about_image; ?>" data-src="<?php echo $about_image; ?>"
								 alt="About picture">
						</div>
						
						<div class="about-descr">
							
							<h4 class="about-descr__title">
								<?php echo $about_title; ?>
							</h4>
							
							<div class="about-descr__sub">
								<?php echo $about_subtitle; ?>
							</div>
							<p>
								<?php echo $about_text; ?>
							</p>
							
							<?php if ( $about_button['url'] ): ?>
								<a href="<?php echo $about_button['url']; ?>"
								   target="<?php echo $about_button['target']; ?>" class="btn btn--transparent-black">
									<?php echo $about_button['title']; ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				
				</div>
			</section>
			<!-- End name about -->      <!-- End about -->
		<?php endif; ?>
		
		<!-- Start publication -->
		<!-- Start name publications -->
		<section class="section section--default publications " id="publications">
			<div class="container">
				
				<div class="section__head">
					<h2 class="title fadeInDown animated">
						наши публикации
					</h2>
					<h5 class="title-sub fadeInRight animated">
						КОМПАНИЯ
					</h5>
				</div>
				
				<div class="publications-inner">
					<a href="#" class="publication">
						<h4 class="publication__title">
							adipiscing diam nonummy
						</h4>
						
						<div class="publication__date">
							25/04/2020
						</div>
						
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
							tincidunt ut laoreet
							dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
							ullamcorper
							suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor
							in hendrerit in ...
						</p>
					
					</a>
					<a href="#" class="publication">
						<h4 class="publication__title">
							adipiscing diam nonummy
						</h4>
						
						<div class="publication__date">
							25/04/2020
						</div>
						
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
							tincidunt ut laoreet
							dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
							ullamcorper
							suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor
							in hendrerit in ...
						</p>
					
					</a>
				</div>
				
				<a href="#" class="btn btn--transparent-black">
					All news
				</a>
			
			</div>
		</section>
		<!-- End name publications -->      <!-- End publication -->
		
		<?php if ( $partners ): ?>
			<!-- Start partners -->
			<!-- Start name partners -->
			<section class="section section--default partners " id="partners">
				<div class="container">
					
					<div class="section__head">
						<h2 class="title fadeInDown animated">
							<?php echo $partners_text; ?>
						</h2>
						<h5 class="title-sub fadeInRight animated">
							<?php echo $partners_title; ?>
						</h5>
					</div>
					
					<div class="partners-inner">
						<?php $i = 1; ?>
						<?php foreach ( $partners as $partner ): ?>
							<div class="partners__icon">
								<a href="<?php echo $partner['link']; ?>">
									<img src="<?php echo $partner['logo']; ?>" alt="Partner-<?php echo $i; ?>">
								</a>
							</div>
							<?php $i ++; ?>
						<?php endforeach; ?>
					</div>
				
				</div>
			</section>
			<!-- End name partners -->      <!-- End partners -->
		<?php endif; ?>
	</div>
	<!--End page-->

<?php get_footer(); ?>