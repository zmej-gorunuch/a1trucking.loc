<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-dashboard_downloads" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-dashboard" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
						<div class="col-sm-10">
							<select name="dashboard_downloads_status" id="input-status" class="form-control">
								<option value="1"<?php echo ($dashboard_downloads_status) ? ' selected="selected"' : '' ?>><?php echo $text_enabled; ?></option>
								<option value="0"<?php echo (!$dashboard_downloads_status) ? ' selected="selected"' : '' ?>><?php echo $text_disabled; ?></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
						<div class="col-sm-10">
							<select name="dashboard_downloads_width" id="input-width" class="form-control">
								<?php foreach ($columns as $column) { ?>
								<option value="<?php echo $column; ?>"<?php echo ($column == $dashboard_downloads_width) ? ' selected="selected"' : '' ?>><?php echo $column; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>  
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
						<div class="col-sm-10">
							<input type="text" name="dashboard_downloads_sort_order" value="<?php echo $dashboard_downloads_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-download-count"><?php echo $entry_download_count; ?></label>
						<div class="col-sm-10">
							<select name="dashboard_downloads_download_count" id="input-download-count" class="form-control">
								<option value="1"<?php echo ($dashboard_downloads_download_count == '1') ? ' selected="selected"' : '' ?>><?php echo $text_today; ?></option>
								<option value="7"<?php echo ($dashboard_downloads_download_count == '7') ? ' selected="selected"' : '' ?>><?php echo $text_last_7_days; ?></option>
								<option value="30"<?php echo ($dashboard_downloads_download_count == '30') ? ' selected="selected"' : '' ?>><?php echo $text_last_30_days; ?></option>
								<option value="180"<?php echo ($dashboard_downloads_download_count == '180') ? ' selected="selected"' : '' ?>><?php echo $text_last_180_days; ?></option>
								<option value="360"<?php echo ($dashboard_downloads_download_count == '360') ? ' selected="selected"' : '' ?>><?php echo $text_last_360_days; ?></option>
							</select>
						</div>
					</div>  
				</form>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>