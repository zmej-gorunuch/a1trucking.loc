<?php echo $header; ?>
<!-- confirm deletion -->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="confirmDeleteLabel"><?php echo $text_confirm_delete; ?></h4>
			</div>
			<div class="modal-body">
				<p><?php echo $text_are_you_sure; ?></p>
				<div class="checkbox">
					<label class="text-danger"><input type="checkbox" name="force_delete" value="1" id="force-delete" /> <?php echo $text_force_delete; ?></label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> <?php echo $button_cancel; ?></button>
				<button type="button" class="btn btn-danger delete"><i class="fa fa-trash-o"></i> <?php echo $button_delete; ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<ul class="breadcrumb bull5i-breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li<?php echo ($breadcrumb['active']) ? ' class="active"' : ''; ?>><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>

			<div class="navbar-placeholder">
				<nav class="navbar navbar-bull5i" role="navigation" id="bull5i-navbar">
					<div class="nav-container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bull5i-navbar-collapse">
								<span class="sr-only"><?php echo $text_toggle_navigation; ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<h1 class="bull5i-navbar-brand"><i class="fa fa-download fa-fw ext-icon"></i> <?php echo $heading_title; ?></h1>
						</div>
						<div class="collapse navbar-collapse" id="bull5i-navbar-collapse">
							<div class="nav navbar-nav navbar-btn btn-group navbar-right">
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_apply; ?>" data-url="<?php echo $save; ?>" id="btn-apply" data-form="#pd-form" data-context="#content" data-overlay="#page-overlay" data-vm="DVM" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"><i class="fa fa-check"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_apply; ?></span></button>
								<button type="button" class="btn btn-primary" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_save; ?>" data-url="<?php echo $save; ?>" id="btn-save" data-form="#pd-form" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"><i class="fa fa-save"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_save; ?></span></button>
								<a href="<?php echo $cancel; ?>" class="btn btn-default" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_cancel; ?>" id="btn-cancel" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_canceling; ?></span>"><i class="fa fa-ban"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_cancel; ?></span></a>
								<?php if ($edit && $delete) { ?><a href="<?php echo $delete; ?>" class="btn btn-danger btn-delete" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_delete; ?>" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_deleting; ?></span>"><i class="fa fa-trash-o"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_delete; ?></span></a><?php } ?>
							</div>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>

	<div class="alerts">
		<div class="container-fluid" id="alerts">
			<?php foreach ($alerts as $type => $_alerts) { ?>
				<?php foreach ((array)$_alerts as $alert) { ?>
					<?php if ($alert) { ?>
			<div class="alert alert-<?php echo ($type == "error") ? "danger" : $type; ?> fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa <?php echo $alert_icon($type); ?>"></i><?php echo $alert; ?>
			</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>

	<div class="container-fluid bull5i-content bull5i-container">
		<div id="page-overlay" class="bull5i-overlay fade in">
			<div class="page-overlay-progress"><i class="fa fa-refresh fa-spin fa-5x text-muted"></i></div>
		</div>

		<div class="panel panel-default panel-relative" id="fileupload">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
			</div>
			<div id="dropzone" class="dropzone fade">
				<div class="dz-tbl">
					<div class="dz-row">
						<div class="dz-cell"><i class="fa fa-upload"></i> <?php echo $text_drop_files_here; ?></div>
					</div>
				</div>
			</div>
			<div class="panel-body">

				<form action="<?php echo $save; ?>" method="post" enctype="multipart/form-data" id="pd-form" class="form-horizontal" role="form">
					<div class="row">
						<div class="col-sm-12">
							<fieldset>
								<div class="alert alert-info alert-dismissable fade in">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php echo $help_upload; ?>
								</div>
								<div class="form-group">
									<div class="col-sm-12 col-md-7 col-lg-6 fileupload-buttonbar">
										<span class="btn btn-success fileinput-button" data-bind="css: {'disabled': !allow_input()}, tooltip: {container:'body'}" data-original-title="<?php echo ($edit) ? $button_choose_file : $button_add_files; ?>">
											<i class="fa fa-plus"></i>
											<span class="visible-lg-inline visible-md-inline"><?php echo ($edit) ? $button_choose_file : $button_add_files; ?></span>
											<input type="file" name="files[]"<?php echo ($edit) ? '' : ' multiple'; ?> data-bind="attr: {'disabled': !allow_input()}">
										</span>
										<button type="button" class="btn btn-primary global start" data-bind="disable: uploadable_files() == 0, buttonState: {state: 'uploading', active: uploading()}, tooltip: {container:'body'}" data-original-title="<?php echo $button_start_upload; ?>" data-uploading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-md-inline'><?php echo $button_start_upload; ?></span>"><i class="fa fa-upload"></i> <span class="visible-lg-inline visible-md-inline"><?php echo $button_start_upload; ?></span></button>
										<button type="button" class="btn btn-warning global cancel" data-bind="disable: cancellable_files() == 0, buttonState: {state: 'canceling', active: canceling()}, tooltip: {container:'body'}" data-original-title="<?php echo $button_cancel_upload; ?>" data-canceling-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-md-inline'><?php echo $button_cancel_upload; ?></span>"><i class="fa fa-ban"></i> <span class="visible-lg-inline visible-md-inline"><?php echo $button_cancel_upload; ?></span></button>
									</div>
									<div class="col-sm-12 col-md-5 col-lg-6 fileupload-progress fade" data-bind="css: {'in': uploading()}">
										<div class="progress progress-striped active">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%;" data-bind="attr: {'aria-valuenow': progress()}, style: {width: progress() + '%'}"></div>
										</div>
										<div class="progress-extended" data-bind="html: extended_progress() ? extended_progress() : '&nbsp;'"></div>
									</div>
								</div>
								<!-- ko if: files().length == 0 -->
								<div class="form-group">
									<div class="col-sm-12">
										<div class="alert alert-warning"><?php echo $text_choose_file; ?></div>
									</div>
								</div>
								<!-- /ko -->
								<!-- ko if: download_id -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="inputID"><?php echo $entry_id; ?></label>
									<div class="col-sm-2 col-md-1">
										<p class="form-control-static" data-bind="text: download_id" id="inputID"></p>
										<input type="hidden" name="download_id" data-bind="value: download_id">
									</div>
								</div>
								<!-- /ko -->
								<ul class="list-group files">
								<!-- ko foreach: files -->
									<li class="list-group-item file" data-bind="css: {'list-group-item-danger': hasError()}">
										<div class="form-group" data-bind="css: {'has-error': filename.hasError}">
											<label class="col-sm-3 col-md-2 control-label required" data-bind="attr: {for: 'file_' + $index() + '_filename'}, css: {'has-error': filename.hasError}"><?php echo $entry_filename; ?></label>
											<div class="col-sm-9 col-md-9 col-lg-7">
												<input type="hidden" data-bind="attr: {name: 'files[' + $index() + '][type]'}, value: type">
												<input type="hidden" data-bind="attr: {name: 'files[' + $index() + '][size]'}, value: size">
												<!-- ko if: !uploaded() || delete_url() -->
												<div class="input-group">
													<input data-bind="attr: {name: 'files[' + $index() + '][filename]', id: 'file_' + $index() + '_filename'}, value: filename" class="form-control">
													<!-- ko if: !checking() -->
													<span class="input-group-btn">
														<!-- ko if: uploadable() && !uploaded() && filename() -->
														<button type="button" class="btn btn-primary start" data-bind="disable: uploading(), buttonState: {state: 'uploading', active: uploading()}, tooltip: {container:'body'}" data-original-title="<?php echo $button_upload; ?>" data-uploading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-md-inline'><?php echo $button_upload; ?></span>"><i class="fa fa-upload"></i> <span class="visible-lg-inline visible-md-inline"><?php echo $button_upload; ?></span></button>
														<!-- /ko -->
														<!-- ko if: !uploaded() -->
														<button type="button" class="btn btn-warning cancel" data-bind="disable: processing(), buttonState: {state: 'canceling', active: processing() && canceling()}, tooltip: {container:'body'}" data-original-title="<?php echo $button_cancel; ?>" data-canceling-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-md-inline'><?php echo $button_cancel; ?></span>"><i class="fa fa-ban"></i> <span class="visible-lg-inline visible-md-inline"><?php echo $button_cancel; ?></span></button>
														<!-- /ko -->
														<!-- ko if: uploaded() && delete_url() -->
														<button type="button" class="btn btn-danger delete" data-bind="disable: processing(), buttonState: {state: 'deleting', active: processing() && deleting()}, tooltip: {container:'body'}" data-original-title="<?php echo $button_delete; ?>" data-deleting-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-md-inline'><?php echo $button_delete; ?></span>"><i class="fa fa-trash-o"></i> <span class="visible-lg-inline visible-md-inline"><?php echo $button_delete; ?></span></button>
														<!-- /ko -->
													</span>
													<!-- /ko -->
													<!-- ko if: checking() -->
													<span class="input-group-addon"><i class="fa fa-refresh fa-spin"></i></span>
													<!-- /ko -->
												</div>
												<!-- /ko -->
												<!-- ko ifnot: !uploaded() || delete_url() -->
												<input data-bind="attr: {name: 'files[' + $index() + '][filename]', id: 'file_' + $index() + '_filename'}, value: filename" class="form-control">
												<!-- /ko -->
											</div>
											<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: filename.hasError && filename.errorMsg">
												<span class="help-block error-text" data-bind="text: filename.errorMsg"></span>
											</div>
										</div>
										<div class="form-group" data-bind="fadeVisible: (!uploaded() && uploadable()) || type() || formatted_size()">
											<div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-6 col-lg-5">
												<span class="file-info type" data-bind="fadeVisible: !!type()"><strong><?php echo $entry_type; ?></strong> <!-- ko text: type --><!-- /ko --></span>
												<span class="file-info size" data-bind="fadeVisible: !!formatted_size()"><strong><?php echo $entry_size; ?></strong> <!-- ko text: formatted_size --><!-- /ko --></span>
											</div>
											<div class="col-sm-3 col-md-3 col-lg-2" data-bind="fadeVisible: !uploaded() && uploadable() && !filename.hasError()">
												<div class="progress progress-striped active">
													<div class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%;" data-bind="attr: {'aria-valuenow': progress()}, style: {width: progress() + '%'}"></div>
												</div>
											</div>
										</div>
										<div class="form-group" data-bind="css: {'has-error': mask.hasError}">
											<label class="col-sm-3 col-md-2 control-label required" data-bind="attr: {for: 'file_' + $index() + '_mask'}, css: {'has-error': mask.hasError}"><?php echo $entry_mask; ?></label>
											<div class="col-sm-8 col-md-6 col-lg-5">
												<input data-bind="attr: {name: 'files[' + $index() + '][mask]', id: 'file_' + $index() + '_mask'}, value: mask" class="form-control">
											</div>
											<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: mask.hasError && mask.errorMsg">
												<span class="help-block error-text" data-bind="text: mask.errorMsg"></span>
											</div>
											<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
												<span class="help-block help-text"><?php echo $help_mask; ?></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 col-md-2 control-label required" data-bind="attr: {for: 'file_' + $index() + '_name<?php echo $default_language; ?>'}, css: {'has-error': description.hasError}"><?php echo $entry_name; ?></label>
											<div class="col-sm-6 col-md-5 col-lg-4">
												<!-- ko foreach: description -->
												<div data-bind="css: {'multi-row': $index() != 0, 'has-error': name.hasError}">
													<div class="input-group">
														<span class="input-group-addon" data-bind="attr: {title: $root.languages[language_id()].name}, tooltip: {container:'body'}"><img data-bind="attr: {src: $root.languages[language_id()].flag, title: $root.languages[language_id()].name}" /></span>
														<input data-bind="attr: {name: 'files[' + $parentContext.$index() + '][description][' + language_id() + '][name]', id: 'file_' + $parentContext.$index() + '_name' + language_id()}, value: name" class="form-control">
													</div>
												</div>
												<div class="has-error" data-bind="visible: name.hasError">
													<span class="help-block" data-bind="text: name.errorMsg"></span>
												</div>
												<!-- /ko -->
											</div>
										</div>
									</li>
								<!-- /ko -->
								</ul>
								<?php if ($edit) { ?>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="update_previous_orders0"><?php echo $entry_update_previous_orders; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="update_previous_orders" id="update_previous_orders1" value="1" data-bind="checked: update_previous_orders"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="update_previous_orders" id="update_previous_orders0" value="0" data-bind="checked: update_previous_orders"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_update_previous_orders; ?></span>
									</div>
								</div>
								<?php } ?>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="add_to_previous_orders0"><?php echo $entry_add_to_previous_orders; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="add_to_previous_orders" id="add_to_previous_orders1" value="1" data-bind="checked: add_to_previous_orders"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="add_to_previous_orders" id="add_to_previous_orders0" value="0" data-bind="checked: add_to_previous_orders"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_add_to_previous_orders; ?></span>
									</div>
								</div>
								<div class="form-group" data-bind="fadeVisible: add_to_previous_orders() == '1' || update_previous_orders() == '1'">
									<label class="col-sm-3 col-md-2 control-label" for="notify_customers0"><?php echo $entry_notify_customers; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="notify_customers" id="notify_customers1" value="1" data-bind="checked: notify_customers"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="notify_customers" id="notify_customers0" value="0" data-bind="checked: notify_customers"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_notify_customers; ?></span>
									</div>
								</div>
								<div class="form-group" data-bind="css: {'has-error': tags.hasError}">
									<label class="col-sm-3 col-md-2 control-label" for="tags"><?php echo $entry_tags; ?></label>
									<div class="col-sm-9 col-md-7 col-lg-6">
										<input type="hidden" name="tags" id="tags" data-bind="value: tags, select2: { minimumInputLength: 2, multiple: true, allowClear: true, placeholder: '<?php echo $text_add_tag; ?>' }, select2Params: bull5i.select2Tags" class="form-control">
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: tags.hasError && tags.errorMsg">
										<span class="help-block error-text" data-bind="text: tags.errorMsg"></span>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_tags; ?></span>
									</div>
								</div>
								<div class="form-group" data-bind="css: {'has-error': sort_order.hasError}">
									<label class="col-sm-3 col-md-2 control-label" for="sort_order"><?php echo $entry_sort_order; ?></label>
									<div class="col-sm-2 col-md-2 col-lg-1">
										<input type="text" name="sort_order" id="sort_order" data-bind="value: sort_order" class="form-control text-right">
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: sort_order.hasError && sort_order.errorMsg">
										<span class="help-block error-text" data-bind="text: sort_order.errorMsg"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="constraint"><?php echo $entry_constraint; ?></label>
									<div class="col-sm-4 fc-auto-width">
										<select name="constraint" id="constraint" data-bind="value: constraint" class="form-control">
											<option value="0"><?php echo $text_no_constraints; ?></option>
											<option value="1"><?php echo $text_quantitative; ?></option>
											<option value="2"><?php echo $text_temporal; ?></option>
											<option value="3"><?php echo $text_both; ?></option>
										</select>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: constraint() == '1'">
										<span class="help-block help-text"><?php echo $help_quantitative; ?></span>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: constraint() == '2'">
										<span class="help-block help-text"><?php echo $help_temporal; ?></span>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: constraint() == '3'">
										<span class="help-block help-text"><?php echo $help_limit_both; ?></span>
									</div>
								</div>
								<div class="form-group has-feedback" data-bind="css: {'has-error': total_downloads.hasError}, visible: constraint() == '1' || constraint() == '3'">
									<label class="col-sm-3 col-md-2 control-label required" for="total_downloads"><?php echo $entry_total_downloads; ?></label>
									<div class="col-sm-2 col-md-2 col-lg-1">
										<input type="text" name="total_downloads" id="total_downloads" data-bind="value: total_downloads" class="form-control">
										<!-- ko if: total_downloads.hasError -->
										<span class="fa fa-times form-control-feedback"></span>
										<!-- /ko -->
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: total_downloads.hasError && total_downloads.errorMsg">
										<span class="help-block error-text" data-bind="text: total_downloads.errorMsg"></span>
									</div>
								</div>
								<div class="form-group has-feedback" data-bind="css: {'has-error': duration.hasError}, visible: constraint() == '2' || constraint() == '3'">
									<label class="col-sm-3 col-md-2 control-label required" for="duration"><?php echo $entry_duration; ?></label>
									<div class="col-sm-2 col-md-1">
										<input type="text" name="duration" id="duration" data-bind="value: duration" class="form-control">
										<!-- ko if: duration.hasError -->
										<span class="fa fa-times form-control-feedback"></span>
										<!-- /ko -->
										<input type="hidden" name="duration_in_seconds" data-bind="value: duration_in_seconds" class="form-control">
									</div>
									<div class="col-sm-3 col-md-2">
										<select name="duration_unit" id="duration_unit" data-bind="value: duration_unit" class="form-control">
											<option value="60"><?php echo $text_minutes; ?></option>
											<option value="3600"><?php echo $text_hours; ?></option>
											<option value="86400"><?php echo $text_days; ?></option>
											<option value="604800"><?php echo $text_weeks; ?></option>
											<option value="2629746"><?php echo $text_months; ?></option>
											<option value="31556952"><?php echo $text_years; ?></option>
										</select>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: duration.hasError && duration.errorMsg">
										<span class="help-block error-text" data-bind="text: duration.errorMsg"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="download_type0"><?php echo $entry_download_type; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="download_type" id="download_type1" value="1" data-bind="checked: download_type"> <?php echo $text_free; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="download_type" id="download_type0" value="0" data-bind="checked: download_type"> <?php echo $text_regular; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_free_download; ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="login0"><?php echo $entry_login; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="login" id="login1" value="1" data-bind="checked: login"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="login" id="login0" value="0" data-bind="checked: login"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_download_require_login; ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="status"><?php echo $entry_status; ?></label>
									<div class="col-sm-2 fc-auto-width">
										<select name="status" id="status" data-bind="value: status" class="form-control">
											<option value="1"><?php echo $text_enabled; ?></option>
											<option value="0"><?php echo $text_disabled; ?></option>
										</select>
									</div>
								</div>
								<!-- ko if: differentiate_customers == 1 -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_customer_group; ?></label>
									<div class="col-sm-9 col-md-7 col-lg-5 multi-row">
										<div class="well well-sm well-scroll-box form-control">
											<!-- ko foreach: customer_groups() -->
											<div class="checkbox">
												<label><input type="checkbox" name="download_customer_groups[]" data-bind="attr: {value: id}, checked: $root.selected_customer_groups" /> <!-- ko text: name --><!-- /ko --></label>
											</div>
											<!-- /ko -->
											<!-- ko if: selected_customer_groups().length == 0 -->
											<input type="hidden" name="download_customer_groups[]" value="0" />
											<!-- /ko -->
										</div>
									</div>
								</div>
								<!-- /ko -->
								<!-- ko if: differentiate_customers != 1 -->
								<input type="hidden" name="download_customer_groups[]" value="0" />
								<!-- /ko -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="selected_products"><?php echo $entry_related_products; ?></label>
									<div class="col-sm-9 col-md-10">
										<div class="radio">
											<label>
												<input type="radio" value="" name="link_to" id="no_products" data-bind="checked: link_to"> <?php echo $text_no_products; ?>
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" value="0" name="link_to" id="all_products" data-bind="checked: link_to"> <?php echo $text_all_products; ?>
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" value="1" name="link_to" id="all_category_products" data-bind="checked: link_to"> <?php echo $text_all_category_products; ?>
											</label>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<select name="category" data-bind="disable: link_to() != '1', value: category" class="form-control fc-auto-width">
													<?php foreach ($categories as $cat) { ?>
													<option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="radio">
											<label>
												<input type="radio" value="2" name="link_to" id="all_manufacturer_products" data-bind="checked: link_to"> <?php echo $text_all_manufacturer_products; ?>
											</label>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<select name="manufacturer" data-bind="disable: link_to() != '2', value: manufacturer" class="form-control fc-auto-width">
													<?php foreach ($manufacturers as $manuf) { ?>
													<option value="<?php echo $manuf['manufacturer_id']; ?>"><?php echo $manuf['name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="radio">
											<label>
												<input type="radio" value="3" name="link_to" id="selected_products" data-bind="checked: link_to"> <?php echo $text_selected_products; ?>
											</label>
										</div>
										<div class="row">
											<div class="col-sm-6 col-md-5 col-lg-4">
												<input class="form-control typeahead products" placeholder="<?php echo $text_autocomplete; ?>" autocomplete="off" data-method="addRelatedProduct">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-8 col-lg-6 multi-row">
												<div class="well well-sm well-scroll-box form-control" data-bind="css: {disabled: link_to() != '3'}">
												<!-- ko foreach: related_products -->
													<div>
														<button type="button" data-bind="click: $parent.removeRelatedProduct, tooltip: {container:'body'}" class="btn btn-link btn-xs" data-original-title="<?php echo $text_remove; ?>"><i class="fa fa-minus-circle text-danger"></i></button>
														<!-- ko text: name --><!-- /ko --> <small class="text-muted">(<!-- ko text: model --><!-- /ko -->)</small>
														<input type="hidden" data-bind="attr: {name: 'related_products[' + $index() + '][product_id]'}, value: id" />
														<input type="hidden" data-bind="attr: {name: 'related_products[' + $index() + '][name]'}, value: name" />
														<input type="hidden" data-bind="attr: {name: 'related_products[' + $index() + '][model]'}, value: model" />
													</div>
												<!-- /ko -->
												</div>
											</div>
										</div>
									</div>
								</div>
							<fieldset>
							<?php if ($edit) { ?>
							<fieldset>
								<legend><?php echo $text_download_stats; ?></legend>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="downloaded"><?php echo $entry_downloaded; ?></label>
									<div class="col-sm-2 col-md-1">
										<p class="form-control-static" data-bind="text: downloaded" id="downloaded"></p>
									</div>
									<div class="col-sm-7 col-md-9">
										<button type="button" class="btn btn-warning" data-toggle="tooltip" data-container="body" title="<?php echo $button_reset; ?>" data-url="<?php echo $reset; ?>" id="btn-reset" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_resetting; ?></span>"><i class="fa fa-times"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_reset; ?></span></button>
									</div>
								</div>
							</fieldset>
							<?php } ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
!function(e,t,o){var r,a=<?php echo json_encode($errors); ?>,s=<?php echo json_encode($files); ?>,i=<?php echo json_encode($related_products); ?>,n=<?php echo json_encode($customer_groups); ?>,l=<?php echo json_encode($languages); ?>,h=<?php echo json_encode(is_array($download_customer_groups) ? $download_customer_groups : array()); ?>;e.texts=t.extend({},e.texts,{upload_in_progress:"<?php echo addslashes($text_upload_in_progress); ?>",error_ajax_request:"<?php echo addslashes($error_ajax_request); ?>",error_positive_integer:"<?php echo addslashes($error_positive_integer); ?>",error_integer:"<?php echo addslashes($error_integer); ?>",error_name:"<?php echo addslashes($error_name); ?>",error_mask:"<?php echo addslashes($error_mask); ?>",error_filename:"<?php echo addslashes($error_filename); ?>",error_missing_file:"<?php echo addslashes($error_missing_file); ?>"}),e.select2Tags={tokenSeparators:[","],separator:",",initSelection:function(e,o){var r=[];t(e.val().split(",")).each(function(){r.push({id:this,text:this})}),o(r)},<?php if ($download_tags) { ?>tags:<?php echo $download_tags; ?>,<?php } else { ?>tags:[],ajax:{type:"GET",url:"<?php echo $autocomplete; ?>",dataType:"json",cache:!1,quietMillis:150,data:function(e){return{query:e,type:"tag",token:"<?php echo $token; ?>",create:!0}},results:function(e){var o=[];return t.each(e,function(e,t){o.push({id:t.value,text:t.value})}),{results:o}}}<?php } ?>};var d=new Bloodhound({<?php if (isset($typeahead['products']['prefetch'])) { ?>prefetch:"<?php echo $typeahead['products']['prefetch']; ?>",<?php }; if (isset($typeahead['products']['remote'])) { ?>remote:"<?php echo $typeahead['products']['remote']; ?>",<?php } ?>datumTokenizer:Bloodhound.tokenizers.obj.whitespace("value"),queryTokenizer:Bloodhound.tokenizers.whitespace,dupDetector:function(e,t){return e.id&&t.id&&e.id==t.id},limit:10});d.initialize();var c=function(e){return"number"!=typeof e?"":e>=1073741824?(e/1073741824).toFixed(2)+" GiB":e>=1048576?(e/1048576).toFixed(2)+" MiB":(e/1024).toFixed(2)+" KiB"},p=function(e){this.hasOwnProperty("minLength")&&e.length<this.minLength||this.hasOwnProperty("maxLength")&&e.length>this.maxLength?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(""))},u=function(e){isNaN(parseInt(e))||this.hasOwnProperty("minValue")&&parseInt(e)<this.minValue||this.hasOwnProperty("maxValue")&&minValue>this.maxValue?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(""))},m=function(e){"1"!=this.context.constraint()&&"3"!=this.context.constraint()||!(isNaN(parseInt(e))||this.hasOwnProperty("minValue")&&parseInt(e)<this.minValue||this.hasOwnProperty("maxValue")&&minValue>this.maxValue)?(this.target.hasError(!1),this.target.errorMsg("")):(this.target.hasError(!0),this.target.errorMsg(this.message))},f=function(e,t,o){this.id=e,this.name=t,this.model=o},g=function(e,t,o){this.id=e,this.name=t,this.flag=o},_=function(t,o){var r=this;this.language_id=ko.observable(t),this.name=ko.observable(o).extend({validate:{method:p,minLength:3,maxLength:128,message:e.texts.error_name,context:r}}),this.hasError=ko.computed(this.hasError,this)};_.prototype=new e.observable_object_methods;var v=function(o,r,a,s,i,n,l){var h=this,d={};t.each(l.languages,function(e,t){d[t.id]=o.hasOwnProperty(t.id)?o[t.id]:{name:a||r}}),this.description=ko.observableArray(t.map(d,function(e,t){return new _(t,e.hasOwnProperty("name")?e.name:"",l)})).withIndex("language_id").extend({hasError:{check:!0,context:h},applyErrors:{context:h},updateValues:{context:h}}),this.filename=ko.observable(r).extend({validate:{method:p,minLength:3,maxLength:128,message:e.texts.error_filename,context:h}}),this.mask=ko.observable(a).extend({validate:{method:p,minLength:3,maxLength:128,message:e.texts.error_mask,context:h}}),this.type=ko.observable(s),this.size=ko.observable(i),this.formatted_size=ko.computed(function(){return h.size()?c(parseInt(h.size())):""}),this.uploadable=ko.observable(n),this.uploaded=ko.observable(!1),this.uploading=ko.observable(!1),this.delete_url=ko.observable(""),this.progress=ko.observable(0),this.checking=ko.observable(!1),this.processing=ko.observable(!1),this.canceling=ko.observable(!1),this.deleting=ko.observable(!1),this.checkFile=function(){if(h.filename()){h.checking(!0);var o=t("#fileupload")[0];t.getJSON("<?php echo $upload; ?>&file="+this.filename(),function(r){r&&r.file?t(o).fileupload("option","done").call(o,t.Event("done"),{files:[r.file],context:[h]}):(file={},file.error=h.filename.hasError()?h.filename.errorMsg():e.texts.error_missing_file,t(o).fileupload("option","done").call(o,t.Event("done"),{files:[file],context:[h]})),h.checking(!1)})}else h.checking(!1)},this.filename.subscribe(function(){h.uploadable()&&h.uploadable(!1),h.checkFile()}),this.hasError=ko.computed(this.hasError,this)};v.prototype=new e.observable_object_methods;var b=function(e,t){this.id=e,this.name=t},k=function(){var o=this;this.languages={},t.each(l,function(e,t){o.languages[e]=new g(t.language_id,t.name,(t.hasOwnProperty("image")&&t.image)?"view/image/flags/"+t.image:"language/"+t.code+"/"+t.code+".png")}),this.default_language="<?php echo $default_language; ?>",this.download_id=ko.observable("<?php echo $download_id; ?>"),this.differentiate_customers=parseInt("<?php echo $differentiate_customers; ?>"),this.files=ko.observableArray(t.map(s,function(e){return new v(e.hasOwnProperty("description")?e.description:{},e.hasOwnProperty("filename")?e.filename:"",e.hasOwnProperty("mask")?e.mask:"",e.hasOwnProperty("type")?e.type:"",e.hasOwnProperty("size")?e.size:"",!1,o)})).extend({hasError:{check:!0,context:o},applyErrors:{context:o},updateValues:{context:o}}),this.tags=ko.observable("<?php echo $tags; ?>").extend({validate:{context:o},notify:"always"}),this.sort_order=ko.observable("<?php echo $sort_order; ?>").extend({numeric:{precision:0,context:o}}),this.constraint=ko.observable("<?php echo $constraint; ?>"),this.duration=ko.observable("<?php echo $duration; ?>").extend({numeric:{precision:0,context:o},validate:{method:u,minValue:0,message:e.texts.error_positive_integer,context:o}}),this.duration_unit=ko.observable("<?php echo $duration_unit; ?>"),this.duration_in_seconds=ko.computed(function(){return o.duration.hasError()?"0":parseInt(o.duration())*parseInt(o.duration_unit())}),this.total_downloads=ko.observable("<?php echo $total_downloads; ?>").extend({numeric:{precision:0,context:o},validate:{method:m,minValue:1,message:e.texts.error_integer,context:o}}),this.download_type=ko.observable("<?php echo $download_type; ?>"),this.login=ko.observable("<?php echo $login; ?>"),this.status=ko.observable("<?php echo $status; ?>"),this.downloaded=ko.observable("<?php echo (int)$downloaded; ?>"),this.update_previous_orders=ko.observable("<?php echo (int)$update_previous_orders; ?>"),this.add_to_previous_orders=ko.observable("<?php echo (int)$add_to_previous_orders; ?>"),this.notify_customers=ko.observable("<?php echo (int)$notify_customers; ?>"),this.customer_groups=ko.observableArray(t.map(n,function(e){return new b(e.customer_group_id,e.name)})),this.selected_customer_groups=ko.observableArray(h),this.link_to=ko.observable("<?php echo $link_to; ?>"),this.category=ko.observable("<?php echo $category; ?>"),this.manufacturer=ko.observable("<?php echo $manufacturer; ?>"),this.related_products=ko.observableArray(t.map(i,function(e){return new f(e.product_id,e.name,e.model)})),this.uploading=ko.computed(function(){return uploading=!1,o.files().forEach(function(e){uploading|=e.uploading()}),uploading}),this.canceling=ko.computed(function(){return canceling=!1,o.files().forEach(function(e){canceling|=e.canceling()}),canceling}),this.progress=ko.observable(0),this.extended_progress=ko.observable(""),this.allow_input=ko.observable(!0),this.uploadable_files=ko.computed(function(){var e=0;return t.each(o.files(),function(t,o){e+=1*(o.uploadable()&&!o.uploading()&&!o.uploaded())}),e}),this.cancellable_files=ko.computed(function(){var e=0;return t.each(o.files(),function(t,o){e+=1*(!o.processing()&&!o.uploaded())}),e}),this.constraint.subscribe(function(){o.total_downloads.validate(o.total_downloads())}),this.removeRelatedProduct=function(e){o.related_products.remove(e)},this.addRelatedProduct=function(e,r,a){if("3"==o.link_to()){var s=!1;t.each(o.related_products(),function(t,o){return o.id==e?void(s=!0):void 0}),s||o.related_products.push(new f(e,r,a))}},this.addUploadFile=function(e,t,r){return file=new v({},e,e,r,t,!0,o),o.files.push(file),file},this.removeFile=function(e){o.files.remove(e)},t.each(o.files(),function(e,t){t.checkFile()})};k.prototype=new e.observable_object_methods,t(function(){r=e.view_model=new k,e.view_models=t.extend({},e.view_models,{DVM:e.view_model}),r.applyErrors(a),ko.applyBindings(r,t("#content")[0]),t(".products.typeahead").typeahead({autoselect:!0,highlight:!0},{name:"products",limit:10,source:d.ttAdapter(),templates:{empty:'<div class="tt-no-suggestion"><?php echo addslashes($text_no_records_found); ?></div>',suggestion:Handlebars.compile('<p><span class="tt-nowrap">{{value}}<span class="tt-secondary-right">{{model}}</span></span></p>')}}).on("typeahead:selected",function(e,o){var r=ko.dataFor(this),a=t(this).data("method");a&&(r[a](o.id,o.value,o.model),t(this).typeahead("val",""))}),t("body").on("click",".file .cancel",function(e){var t=ko.contextFor(this),r=ko.dataFor(this);r._cancelHandler?r._cancelHandler.call(o,e,r):t.$root.removeFile(r)}).on("click",".file .start",function(e){var t=(ko.contextFor(this),ko.dataFor(this));t._startHandler&&t._startHandler.call(o,e,t)}).on("click",".global.start",function(){t(".files .start").click()}).on("click",".global.cancel",function(){t(".files .cancel").click()}).on("click",".file .delete",function(e){var t=ko.contextFor(this),r=ko.dataFor(this);r._deleteHandler?r._deleteHandler.call(o,e,r):t.$root.removeFile(r)}),t(document).on("dragover",function(e){var o=t("#dropzone"),r=window.dropZoneTimeout;if(o){if(r)clearTimeout(r);else{var a=o.parent(),s=t(".navbar-fixed-top").height()||0,i=Math.max(document.documentElement.clientHeight,window.innerHeight||0),n=Math.max(t(window).scrollTop(),a.offset().top)-a.offset().top+s,l=Math.min(i,a.height()+a.offset().top-t(window).scrollTop())+t(window).scrollTop()-Math.max(t(window).scrollTop(),a.offset().top)-s;o.css({height:l+"px",top:n+"px"}),o.addClass("in")}e.target===o[0]||t.contains(o[0],e.target)?o.addClass("hover"):o.removeClass("hover"),window.dropZoneTimeout=setTimeout(function(){window.dropZoneTimeout=null,o.removeClass("in hover")},100)}}).on("drop dragover",function(e){e.preventDefault()}),window.onbeforeunload=function(){return e.view_model.uploading()?e.texts.upload_in_progress:void 0},t("#fileupload").fileupload({url:"<?php echo $upload; ?>",dropZone:t("#dropzone"),dataType:"json",maxChunkSize:<?php echo $max_chunk_size; ?>,autoUpload:!1,model:e.view_model,<?php if ($edit) { ?>maxNumberOfFiles: 1,<?php } ?>multipart:!1}),e.onComplete(t("#page-overlay"),t("#content"))})}(window.bull5i=window.bull5i||{},jQuery);
//--></script>
<?php echo $footer; ?>
