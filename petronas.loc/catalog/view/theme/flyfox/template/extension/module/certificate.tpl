<?php echo $header; ?>
	<div class="container">
		<ul class="breadcrumb">
			<?php foreach ( $breadcrumbs as $breadcrumb ) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
		</ul>
		<div class="row">
			<?php echo $column_left; ?>
			
			<?php if ( $column_left && $column_right ) { ?>
				<?php $class = 'col-sm-6'; ?>
			<?php } elseif ( $column_left || $column_right ) { ?>
				<?php $class = 'col-sm-9'; ?>
			<?php } else { ?>
				<?php $class = 'col-sm-12'; ?>
			<?php } ?>
			
			<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
				<h1><?php echo $heading_title; ?></h1>
				
				<?php if ( $certificates ): ?>
					<?php foreach ( $certificates as $cat_certificate ): ?>
						<?php if ( $cat_certificate['category_id'] ): ?>
							<h3 class="page-header"><?= htmlspecialchars( $cat_certificate['category'] ); ?></h3>
							<?php foreach ( $certificates as $certificate ): ?>
								<?php if ($certificate['category_id'] == $cat_certificate['category_id']): ?>
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="heading<?= $certificate['id'] ?>">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion"
												   href="#collapse<?= $certificate['id'] ?>" aria-expanded="true"
												   aria-controls="collapseOne" class="link-collapse">
													<i class="fa fa-plus"></i> <?= htmlspecialchars( $certificate['title'] ) ?>
												</a>
											</h4>
										</div>
									</div><br>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					
					
					<!--					--><?php //if ($certificates): ?>
					<!--						<hr>-->
					<!--						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">-->
					<!--							--><?php //foreach ($certificates as $certificate): ?>
					<!--								-->
					<!--								--><?php //var_dump($certificate); ?>
					<!--								<div class="panel panel-default">-->
					<!--									<div class="panel-heading" role="tab" id="heading--><? //=$certificate['id']?><!--">-->
					<!--										<h4 class="panel-title">-->
					<!--											<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse--><? //=$certificate['id']?><!--" aria-expanded="true" aria-controls="collapseOne" class="link-collapse">-->
					<!--												<i class="fa fa-plus"></i> --><? //=$certificate['title']?>
					<!--											</a>-->
					<!--										</h4>-->
					<!--									</div>-->
					<!--									<div id="collapse--><? //=$certificate['id']?><!--" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading--><? //=$certificate['id']?><!--">-->
					<!--										<div class="panel-body">-->
					<!--											--><?php //if ($certificate['filename']): ?>
					<!--												<a href="--><?php //echo $certificate['href']?><!--">--><? //=html_entity_decode($certificate['title'])?><!--</a>-->
					<!--											--><?php //else: ?>
					<!--												--><? //=$certificate_empty?>
					<!--											--><?php //endif; ?>
					<!--										</div>-->
					<!--									</div>-->
					<!--								</div><br>-->
					<!--							--><?php //endforeach; ?>
					<!--						</div>-->
					<!--					--><?php //endif; ?>
				
				<?php else: ?>
					<p><?php echo $certificates_empty; ?></p>
				<?php endif; ?>
				
				<?php echo $content_bottom; ?>
			</div>
			
			<?php echo $column_right; ?>
		</div>
	</div>
<?php echo $footer; ?>