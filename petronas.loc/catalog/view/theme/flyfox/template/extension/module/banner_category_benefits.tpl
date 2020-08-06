<!-- Start benefits -->
<!-- Start benefits section -->
<section class="section benefits">
	<div class="container">
		<div class="row justify-content-center">
			<?php foreach ($banners as $banner): ?>
				<div class="col-12 col-md-6 col-lg-3">
					<div class="benefit-card">
						<div class="benefit-card__picture">
							<img src="<?php echo $banner['image']; ?>" alt="">
						</div>
						<div class="benefit-card__descr">
							<p><?php echo $banner['text']; ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- End benefits section -->            <!-- End benefits -->