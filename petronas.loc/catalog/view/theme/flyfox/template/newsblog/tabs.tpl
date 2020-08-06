<div class="tab-content" id="myTabContent">
	<?php $i = 0; ?>
	<?php foreach ($categories as $category) { ?>
		<div class="tab-pane fade<?php echo $page_category_id == $category['category_id'] ? ' active show' : null; ?>"
		     id="tab-<?php echo $category['category_id']; ?>"
		     role="tabpanel" aria-labelledby="tab-<?php echo $category['category_id']; ?>">
			<div class="col-12 d-flex flex-wrap">
				<?php if ($articles) { ?>
					<?php foreach ($articles as $article) { ?>
						<?php if (in_array($category['category_id'], $article['category'])) { ?>
							<div class="news-card">
								<?php if ($article['thumb']) { ?>
									<img src="
									<?php echo $article['thumb']; ?>" class="news-card__img"
									     alt="
									<?php echo $article['name']; ?>">
								<?php } ?>

								<div class="news-card__descr">
																					<span class="news-date">
									<?php echo $article['date']; ?></span>
									<h6 class="news-title">
										<?php echo $article['name']; ?></h6>
									<p>
										<?php echo $article['preview']; ?>
									</p>
									<a class="nested-links__first"
									   href="
									<?php echo $article['href']; ?>"></a>
									<a class="nested-links__second" href="
									<?php echo $article['href']; ?>"><?php echo $text_more; ?>
										<svg width="8" height="16" viewBox="0 0 8 16" fill="none"
										     xmlns="http://www.w3.org/2000/svg">
											<path d="M5.87499 7.89165L1 13.1495V14.3629L7 7.89165L1 1.42041V2.63376L5.87499 7.89165Z"
											      fill="#029C99" stroke="#029C99"
											      stroke-width="0.929"/>
										</svg>
									</a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } else {
					echo $text_empty;
				} ?>

			</div>

			<div class="col-12 d-flex justify-content-center">
				<!-- Start pagination -->
				<?php echo $pagination; ?>
				<!-- End pagination -->
			</div>
		</div>
		<?php $i++; ?>
	<?php } ?>
</div>