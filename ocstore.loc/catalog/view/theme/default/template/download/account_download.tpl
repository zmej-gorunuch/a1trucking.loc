<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	</ul>
	<div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
			<h2><?php echo $heading_title; ?></h2>
			<?php if ($downloads || $search) { ?>
			<div class="row">
				<div class="col-sm-12 col-md-offset-6 col-md-6">
					<form action="<?php echo $search_url; ?>" method="post" enctype="multipart/form-data" id="account-downloads-search" role="form">
						<input type="hidden" name="redirect" value="1" />
						<div class="form-group">
							<div class="input-group">
								<input type="search" name="download_search" class="form-control" placeholder="<?php echo $text_search_downloads; ?>" value="<?php echo $search; ?>">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit" data-toggle="tooltip" title="<?php echo $button_search; ?>"><i class="fa fa-search"></i></button>
									<?php if ($search) { ?><button class="btn btn-default" type="button" id="clear-search" data-toggle="tooltip" title="<?php echo $button_clear; ?>"><i class="fa fa-times"></i></button><?php } ?>
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-vcenter">
					<thead>
						<tr>
							<th class="text-right hidden-xs"><a href="<?php echo $sort_order_id; ?>"><?php echo $column_order_id; ?><?php echo ($sort == 'order_id') ? ' <i class="fa fa-sort-' . strtolower($order) . '"></i>' : ''; ?></a></th>
							<th class="text-left"><a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?><?php echo ($sort == 'name') ? ' <i class="fa fa-sort-' . strtolower($order) . '"></i>' : ''; ?></a></th>
							<th class="text-left hidden-xs hidden-sm"><a href="<?php echo $sort_file_size; ?>"><?php echo $column_size; ?><?php echo ($sort == 'file_size') ? ' <i class="fa fa-sort-' . strtolower($order) . '"></i>' : ''; ?></a></th>
							<th class="text-left"><?php echo $column_active; ?></th>
							<th class="text-left hidden-xs hidden-sm"><a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?><?php echo ($sort == 'date_added') ? ' <i class="fa fa-sort-' . strtolower($order) . '"></i>' : ''; ?></a></th>
							<th class="text-left hidden-xs hidden-sm hidden-md"><a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?><?php echo ($sort == 'date_modified') ? ' <i class="fa fa-sort-' . strtolower($order) . '"></i>' : ''; ?></a></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php if ($downloads) { ?>
						<?php foreach ($downloads as $download) { ?>
						<tr>
							<td class="text-right hidden-xs"><?php echo $download['order_id']; ?></td>
							<td class="text-left"><?php if ($show_icons && !empty($download['icon'])) { if ($use_fa_icons) { ?><i class="fa <?php echo $download['icon']; ?>"></i><?php } else { ?><img src="<?php echo $download['icon']; ?>" class="dl_ico" /><?php } ?> <?php } ?><?php echo $download['name']; ?></td>
							<td class="text-left hidden-xs hidden-sm"><?php echo $download['size']; ?></td>
							<td class="text-left"><span class="text-<?php echo ((int)$download['expired']) ? 'danger' : 'success'; ?>"><?php echo $download['remaining']; ?></span></td>
							<td class="text-left hidden-xs hidden-sm"><?php echo $download['date_added']; ?></td>
							<td class="text-left hidden-xs hidden-sm hidden-md"><?php echo $download['date_modified']; ?></td>
							<td><a href="<?php echo $download['href']; ?>" data-toggle="tooltip" title="<?php echo $button_download; ?>" class="btn btn-primary"><i class="fa fa-cloud-download"></i></a></td>
						</tr>
						<?php } ?>
						<?php } else if ($search) { ?>
						<tr><td class="text-center" colspan="7"><?php echo $text_no_downloads; ?></td></tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-sm-12 col-lg-push-6 col-lg-6 text-right"><?php echo $results; ?></div>
				<div class="col-sm-12 col-lg-pull-6 col-lg-6 text-left"><?php echo $pagination; ?></div>
			</div>
			<?php } else { ?>
			<p><?php echo $text_no_downloads; ?></p>
			<?php } ?>
			<div class="buttons clearfix">
				<div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
			</div>
			<?php echo $content_bottom; ?></div>
		<?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
(function( bull5i, $, undefined ) {
	$(function() {
		$("body").on("click", "#clear-search", function(e) {
			e.preventDefault();
			$("input[name='download_search']").val("");
			this.form.submit();
		})
		moment.locale('<?php echo $locale; ?>');
		$(".iso8601").each(function(){
			$(this).html(moment($(this).html()).format('lll'));
		})
	})
}( window.bull5i = window.bull5i || {}, jQuery ));
//--></script>
<?php echo $footer; ?>
