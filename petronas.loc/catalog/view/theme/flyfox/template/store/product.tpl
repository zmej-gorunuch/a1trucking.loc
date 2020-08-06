<?php echo $header; ?>
<!--Start page-->
<div class="page-wrapper page-product-single">

	<!-- Start breadcrumbs -->
	<div class="breadcrumbs breadcrumbs--white">
		<div class="container">

			<ul>
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>            <!-- End breadcrumbs -->

	<!-- Start descr -->
	<!-- Start name section -->
	<section class="section descr descr--small" id="descr">
		<div class="container">
			<div class="row">
				<div class="col-12 d-flex justify-content-center">
					<h2 class="title title--desh">
						<?php echo $heading_title; ?>
					</h2>
				</div>
			</div>

			<div class="row">
				<div class="col-xl-3 descr-img">
					<?php if ($thumb): ?>
						<img data-src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>">
					<?php endif; ?>
				</div>
				<div class="col-12 col-xl-9 no-padding-r">

					<div class="tab-content" id="myTabContent">

						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="descr__slider">
								<div class="d-title-prev">&nbsp;</div>
								<div class="d-title-next">&nbsp;</div>
								<div class="d-slider">

									<div class="d-slider__item">

										<div class="ds-descr">
											<h3 class="title">ЯКІСТЬ</h3>
											<p>Деталей двигуна відстабільність властивостей мастил</p>
										</div>

										<div class="ds-picture">
											<img src="/catalog/view/theme/flyfox/img/s-1.png" alt="">
										</div>

									</div>

									<div class="d-slider__item">

										<div class="ds-descr">
											<h3 class="title">ЗАХИСТ</h3>
											<p>Деталей двигуна від зношування & висока надійність, а також стабільність
												властивостей мастил</p>
										</div>

										<div class="ds-picture">
											<img src="/catalog/view/theme/flyfox/img/s-1.png" alt="">
										</div>

									</div>
									<div class="d-slider__item">

										<div class="ds-descr">
											<h3 class="title">ЧИСТОТА</h3>
											<p>Деталей двигуна від зношування & висока надійність, а також стабільність
												властивостей мастил</p>
										</div>

										<div class="ds-picture">
											<img src="/catalog/view/theme/flyfox/img/s-1.png" alt="">
										</div>

									</div>
									<div class="d-slider__item">

										<div class="ds-descr">
											<h3 class="title">ЧИСТОТА</h3>
											<p>Деталей двигуна від зношування & висока надійність, а також стабільність
												властивостей мастил</p>
										</div>

										<div class="ds-picture">
											<img src="/catalog/view/theme/flyfox/img/s-1.png" alt="">
										</div>

									</div>
									<div class="d-slider__item">

										<div class="ds-descr">
											<h3 class="title">ЧИСТОТА</h3>
											<p>Деталей двигуна від зношування & висока надійність, а також стабільність
												властивостей мастил</p>
										</div>

										<div class="ds-picture">
											<img src="/catalog/view/theme/flyfox/img/s-1.png" alt="">
										</div>

									</div>

								</div>

								<div class="controls">
									<button class="controls__prev">
									</button>
									<button class="controls__next">
									</button>
								</div>


							</div>
						</div>


					</div>

				</div>
			</div>
		</div>

	</section>
	<!-- End name section -->            <!-- End descr -->

	<!-- Start product-single -->
	<!-- Start product-single section -->
	<section class="section product-single text"
	         style="background-image: url(/catalog/view/theme/flyfox/img/product-single-logo.png);">
		<div class="container">
			<?php if ($attribute_groups): ?>
				<?php foreach ($attribute_groups as $attribute_group): ?>
					<h3><?php echo $attribute_group['name']; ?></h3>
					<table>
						<tbody>
						<tr>
							<td><?php echo $text_model; ?></td>
							<td><?php echo $model; ?></td>
						</tr>
						<?php foreach ($attribute_group['attribute'] as $attribute): ?>
							<tr>
								<td><?php echo $attribute['name']; ?></td>
								<td><?php echo $attribute['text']; ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php echo $description; ?>

			<?php if ($downloads): ?>
				<?php foreach ($downloads as $download): ?>
					<div class="product-single__download">
						<h3 class="title"><?php echo $text_download_product_parameters; ?></h3>
						<a href="<?php echo $download['href']; ?>"><?php echo $download['name']; ?></a>
						<span><?php echo $download['size']; ?></span>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>

	</section>
	<!-- End product-single section -->            <!-- End product-single -->

	<!-- Start cta -->
	<!-- Start cta section -->
	<section class="section cta ">
		<div class="container">
			<div class="cta-inner">
				<h3 class="title title--section">
					PETRONAS ПРОПОНУЄ ШИРОКИЙ ВИБІР МАСТИЛ ДЛЯ ВАШОГО АВТО
				</h3>

				<a href="#" class="btn btn--border-white">В МАГАЗИН</a>
			</div>
		</div>
	</section>
	<!-- End name section -->            <!-- End cta -->

</div>
<!--End page-->

<?php echo $footer; ?>
