<?php if ($show_downloads) { ?>
<div class="pd-content" data-request-url="<?php echo $request_url; ?>" data-mid="<?php echo $mid; ?>">
	<?php if ($show_login_required) { ?>
	<div class="alert alert-info"><?php echo $text_login_required; ?></div>
	<?php } ?>
	<?php if ($show_search_bar) { ?>
	<div class="col-sm-12 col-md-offset-6 col-md-6 pd-ov">
		<form action="<?php echo $search_url; ?>" method="post" enctype="multipart/form-data" id="pd-search-form-<?php echo $mid; ?>" class="form-horizontal pd-search-form" role="search">
			<input type="hidden" name="redirect" value="1" />
			<input type="hidden" name="mid" value="<?php echo $mid; ?>" />
			<div class="form-group">
				<div class="input-group">
					<input type="text" name="dsearch" id="pd-search-<?php echo $mid; ?>" class="form-control pd-search" value="<?php echo $search; ?>" placeholder="<?php echo $text_search_downloads; ?>" title="<?php echo $text_search_downloads; ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default pd-search-btn" id="pd-search-btn-<?php echo $mid; ?>" data-toggle="tooltip" title="<?php echo $text_search; ?>" data-container="body"><i class="fa fa-search"></i></button>
						<button type="button" class="btn btn-default pd-clear-btn" id="pd-clear-btn-<?php echo $mid; ?>" data-toggle="tooltip" title="<?php echo $text_clear_search; ?>" data-container="body"><i class="fa fa-times"></i></button>
					</span>
				</div>
			</div>
		</form>
	</div>
	<?php } ?>
	<div id="pd-search-results-<?php echo $mid; ?>" class="pd-container pd-search-results" data-mid="<?php echo $mid; ?>">
		<div class="pd-overlay fade">
			<div class="pd-overlay-progress"><i class="fa fa-refresh fa-spin fa-5x text-muted"></i></div>
		</div>
		<div class="pd-downloads pd-ll"><?php echo $downloads_filter_data; ?></div>
	</div>
</div>
<?php } else { ?>
	<?php if ($show_login_required) { ?>
<div class="pd-content alert alert-info"><?php echo $text_login_required; ?></div>
	<?php } else { ?>
<p><?php echo $text_no_downloads; ?></p>
	<?php } ?>
<?php } ?>
