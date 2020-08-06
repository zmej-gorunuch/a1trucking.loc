<?php echo $header; ?>
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
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_apply; ?>" data-url="<?php echo $save; ?>" id="btn-apply" data-form="#pd-form" data-context="#content" data-overlay="#page-overlay" data-vm="DSVM" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"><i class="fa fa-check"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_apply; ?></span></button>
								<button type="button" class="btn btn-primary" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_save; ?>" data-url="<?php echo $save; ?>" id="btn-save" data-form="#pd-form" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"><i class="fa fa-save"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_save; ?></span></button>
								<a href="<?php echo $cancel; ?>" class="btn btn-default" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_cancel; ?>" id="btn-cancel" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_canceling; ?></span>"><i class="fa fa-ban"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_cancel; ?></span></a>
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

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
			</div>
			<div class="panel-body">

				<form action="<?php echo $save; ?>" method="post" enctype="multipart/form-data" id="pd-form" class="form-horizontal" role="form">
					<div class="row">
						<div class="col-sm-12">
							<fieldset>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="directory"><?php echo $entry_directory; ?></label>
									<!-- ko if: !directory_list_loaded() -->
									<div class="col-sm-9 col-md-10">
										<p class="form-control-static"><?php echo $text_loading_dir_list; ?> <i class="fa fa-refresh fa-spin text-muted"></i></p>
									</div>
									<!-- /ko -->
									<!-- ko if: directory_list_loaded() && directories().length == 0 -->
									<div class="col-sm-9 col-md-10">
										<span class="form-control-static-inline pad-r10"><?php echo $text_no_directories_found; ?></span>
										<button type="button" class="btn btn-default" title="<?php echo $text_refresh_dir_list; ?>" data-bind="click: $root.getDirectoryListing, tooltip: {}"><i class="fa fa-refresh"></i></button>
									</div>
									<!-- /ko -->
									<!-- ko if: directory_list_loaded() && directories().length > 0 -->
									<div class="col-sm-6 col-md-5 col-lg-4">
										<div class="input-group">
											<select name="directory" id="directory" data-bind="value: directory" class="form-control">
												<option value=""></option>
												<!-- ko foreach: directories -->
												<option data-bind="attr: {value: path}, text: name"></option>
												<!-- /ko -->
											</select>
											<div class="input-group-btn">
												<button type="button" class="btn btn-default" title="<?php echo $text_refresh_dir_list; ?>" data-bind="click: $root.getDirectoryListing, tooltip: {}"><i class="fa fa-refresh"></i></button>
											</div>
										</div>
									</div>
									<!-- /ko -->
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="directory"><?php echo $entry_files; ?></label>
									<div class="col-sm-9 col-md-10">
										<div id="file-list-overlay" class="bull5i-overlay file-list fade" data-bind="css: { in: $root.searching_files() }">
											<p class="file-list-overlay-progress"><?php echo $text_searching; ?> <i class="fa fa-refresh fa-spin text-muted"></i></p>
										</div>
										<!-- ko if: directory_list_loaded() && directories().length > 0 -->
										<div class="form-control-static">
											<!-- ko if: directory() == '' -->
											<span class="text-danger"><?php echo $text_select_directory; ?></span>
											<!-- /ko -->
											<!-- ko if: directory() != '' && files().length == 0 -->
											<span><?php echo $text_no_files_found; ?></span>
											<!-- /ko -->
											<!-- ko foreach: files -->
											<div data-bind="text: $data"></div>
											<!-- /ko -->
										</div>
										<!-- /ko -->
									</div>
								</div>
								<div class="form-group" data-bind="css: {'has-error': file_types.hasError}">
									<label class="col-sm-3 col-md-2 control-label" for="file_types"><?php echo $entry_file_types; ?></label>
									<div class="col-sm-6 col-md-5 col-lg-4">
										<input type="text" name="file_types" id="file_types" data-bind="value: file_types, disable: all_types" class="form-control">
									</div>
									<div class="col-sm-3 col-md-5 col-lg-6">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="all_types" value="1" data-bind="checked: all_types"> <?php echo $text_all_types; ?>
												<!-- ko ifnot: all_types -->
												<input type="hidden" name="all_types" value="0">
												<!-- /ko -->
												<!-- ko if: all_types -->
												<input type="hidden" name="file_types" value="">
												<!-- /ko -->
											</label>
										</div>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: file_types.hasError && file_types.errorMsg">
										<span class="help-block error-text" data-bind="text: file_types.errorMsg"></span>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_file_types; ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="excludes"><?php echo $entry_excludes; ?></label>
									<div class="col-sm-6 col-md-5 col-lg-4">
										<input type="text" name="excludes" id="excludes" data-bind="value: excludes" class="form-control">
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_excludes; ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="recursive0"><?php echo $entry_recursive; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="recursive" id="recursive1" value="1" data-bind="checked: recursive"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="recursive" id="recursive0" value="0" data-bind="checked: recursive"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_recursive; ?></span>
									</div>
								</div>
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
								<div class="form-group" data-bind="fadeVisible: add_to_previous_orders() == '1'">
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
								<div class="form-group" data-bind="visible: recursive() == 1">
									<label class="col-sm-3 col-md-2 control-label" for="path_to_tags0"><?php echo $entry_path_to_tags; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="path_to_tags" id="path_to_tags1" value="1" data-bind="checked: path_to_tags"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="path_to_tags" id="path_to_tags0" value="0" data-bind="checked: path_to_tags"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_path_to_tags; ?></span>
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
										<input type="text" name="total_downloads" id="total_downloads" data-bind="value: total_downloads" class="form-control text-right">
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
									<label class="col-sm-3 col-md-2 control-label" for="no_products"><?php echo $entry_related_products; ?></label>
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
													<?php foreach ($categories as $category) { ?>
													<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
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
													<?php foreach ($manufacturers as $manufacturer) { ?>
													<option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
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
														<button type="button" data-bind="click: $parent.removeRelatedProduct, tooltip: {}" class="btn btn-link btn-xs" data-original-title="<?php echo $text_remove; ?>"><i class="fa fa-minus-circle text-danger"></i></button>
														<!-- ko text: name --><!-- /ko -->
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
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
!function(e,t,o){var i,r=null,s=null,a=<?php echo json_encode($errors); ?>,n=<?php echo json_encode($related_products); ?>,h=<?php echo json_encode($customer_groups); ?>,c=<?php echo json_encode(is_array($download_customer_groups) ? $download_customer_groups : array()); ?>;e.texts=t.extend({},e.texts,{error_ajax_request:"<?php echo addslashes($error_ajax_request); ?>",error_positive_integer:"<?php echo addslashes($error_positive_integer); ?>",error_integer:"<?php echo addslashes($error_integer); ?>",error_filetype:"<?php echo addslashes($error_filetype); ?>"}),e.select2Tags={tokenSeparators:[","],separator:",",initSelection:function(e,o){var i=[];t(e.val().split(",")).each(function(){i.push({id:this,text:this})}),o(i)},<?php if ($download_tags) { ?>tags:<?php echo $download_tags; ?>,<?php } else { ?>tags:[],ajax:{type:"GET",url:"<?php echo $autocomplete; ?>",dataType:"json",cache:!1,quietMillis:150,data:function(e){return{query:e,type:"tag",token:"<?php echo $token; ?>",create:!0}},results:function(e){var o=[];return t.each(e,function(e,t){o.push({id:t.value,text:t.value})}),{results:o}}}<?php } ?>};var l=new Bloodhound({<?php if (isset($typeahead['products']['prefetch'])) { ?>prefetch:"<?php echo $typeahead['products']['prefetch']; ?>",<?php }; if (isset($typeahead['products']['remote'])) { ?>remote:"<?php echo $typeahead['products']['remote']; ?>",<?php } ?>datumTokenizer:Bloodhound.tokenizers.obj.whitespace("value"),queryTokenizer:Bloodhound.tokenizers.whitespace,dupDetector:function(e,t){return e.id&&t.id&&e.id==t.id},limit:10});l.initialize();var d=function(e){isNaN(parseInt(e))||this.hasOwnProperty("minValue")&&parseInt(e)<this.minValue||this.hasOwnProperty("maxValue")&&minValue>this.maxValue?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(""))},p=function(e){"1"!=this.context.constraint()&&"3"!=this.context.constraint()||!(isNaN(parseInt(e))||this.hasOwnProperty("minValue")&&parseInt(e)<this.minValue||this.hasOwnProperty("maxValue")&&minValue>this.maxValue)?(this.target.hasError(!1),this.target.errorMsg("")):(this.target.hasError(!0),this.target.errorMsg(this.message))},u=function(e,t,o){this.id=e,this.name=t,this.model=o},_=function(e,t){this.path=e,this.name=t},f=function(e,t){this.id=e,this.name=t},v=function(){var i=this;this.validateFileType=function(e){e=e==o?i.file_types():e,this.target.hasError(!e&&!i.all_types()),this.target.errorMsg(this.target.hasError()?this.message:"")},this.differentiate_customers=parseInt("<?php echo $differentiate_customers; ?>"),this.directories=ko.observableArray([]),this.files=ko.observableArray([]),this.directory_list_loaded=ko.observable(!1),this.searching_files=ko.observable(!1),this.directory=ko.observable("<?php echo $directory; ?>"),this.all_types=ko.observable(parseInt("<?php echo (int)$all_types; ?>")),this.file_types=ko.observable("<?php echo $file_types; ?>").extend({validate:{message:e.texts.error_filetype,method:i.validateFileType,context:i}}),this.excludes=ko.observable("<?php echo $excludes; ?>"),this.recursive=ko.observable("<?php echo $recursive; ?>"),this.tags=ko.observable("<?php echo $tags; ?>").extend({validate:{context:i},notify:"always"}),this.path_to_tags=ko.observable("<?php echo $path_to_tags; ?>"),this.sort_order=ko.observable("<?php echo $sort_order; ?>").extend({numeric:{precision:0,context:i}}),this.constraint=ko.observable("<?php echo $constraint; ?>"),this.duration=ko.observable("<?php echo $duration; ?>").extend({numeric:{precision:0,context:i},validate:{method:d,minValue:0,message:e.texts.error_positive_integer,context:i}}),this.duration_unit=ko.observable("<?php echo $duration_unit; ?>"),this.duration_in_seconds=ko.computed(function(){return i.duration.hasError()?"0":parseInt(i.duration())*parseInt(i.duration_unit())}),this.total_downloads=ko.observable("<?php echo $total_downloads; ?>").extend({numeric:{precision:0,context:i},validate:{method:p,minValue:1,message:e.texts.error_integer,context:i}}),this.download_type=ko.observable("<?php echo $download_type; ?>"),this.login=ko.observable("<?php echo $login; ?>"),this.status=ko.observable("<?php echo $status; ?>"),this.add_to_previous_orders=ko.observable("<?php echo (int)$add_to_previous_orders; ?>"),this.notify_customers=ko.observable("<?php echo (int)$notify_customers; ?>"),this.customer_groups=ko.observableArray(t.map(h,function(e){return new f(e.customer_group_id,e.name)})),this.selected_customer_groups=ko.observableArray(c),this.link_to=ko.observable("<?php echo $link_to; ?>"),this.category=ko.observable("<?php echo $category; ?>"),this.manufacturer=ko.observable("<?php echo $manufacturer; ?>"),this.related_products=ko.observableArray(t.map(n,function(e){return new u(e.product_id,e.name,e.model)})),this.directory_name=ko.computed(function(){var e="";return ko.utils.arrayForEach(i.directories(),function(t){i.directory()==t.path&&(e=t.name)}),e}),this.directory.subscribe(function(){i.getFileListing()}),this.file_types.subscribe(function(){i.getFileListing()}),this.excludes.subscribe(function(){i.getFileListing()}),this.recursive.subscribe(function(){i.getFileListing()}),this.all_types.subscribe(function(){i.getFileListing(),i.file_types.validate()}),this.constraint.subscribe(function(){i.total_downloads.validate(i.total_downloads())}),this.removeRelatedProduct=function(e){i.related_products.remove(e)},this.addRelatedProduct=function(e,o,r){if("2"==i.link_to()){var s=!1;t.each(i.related_products(),function(t,o){return o.id==e?void(s=!0):void 0}),s||i.related_products.push(new u(e,o,r))}},this.clearDirectories=function(){i.directories.removeAll()},this.addDirectory=function(e,o){var r=!1;t.each(i.directories(),function(t,o){return o.path==e?void(r=!0):void 0}),r||i.directories.push(new _(e,o))},this.updateFiles=function(e){var o=t(i.files()).not(e).get(),r=t(e).not(i.files()).get();t.each(r,function(e,t){i.files.push(t)}),i.files.sort(),t.each(o,function(e,t){i.files.remove(t)})},this.getDirectoryListing=function(){i.directory_list_loaded(!1),i.clearDirectories(),t.when(t.ajax({type:"GET",url:"<?php echo $dir_list; ?>",dataType:"json"})).then(function(e){e.directories&&t.each(e.directories,function(e,t){i.addDirectory(e,t)}),i.directory_list_loaded(!0)},function(e,t,o){window.console&&window.console.log&&window.console.log("Failed to load directory list: "+o)})},this.getFileListing=function(){return""==i.directory()?void i.updateFiles([]):(i.searching_files(!0),r&&clearTimeout(r),void(r=setTimeout(function(){s&&s.abort(),s=t.ajax({type:"GET",url:"<?php echo $file_list; ?>",dataType:"json",data:{d:i.directory(),b:i.directory_name(),r:i.recursive(),af:i.all_types(),ft:i.file_types(),ex:i.excludes()}}).done(function(e){i.updateFiles(e.files?e.files:[])}).fail(function(e,t,o){window.console&&window.console.log&&window.console.log("Failed to load file list: "+o)}).always(function(){i.searching_files(!1)})},400)))}};v.prototype=new e.observable_object_methods,t(function(){i=e.view_model=new v,e.view_models=t.extend({},e.view_models,{DVM:e.view_model}),i.applyErrors(a),i.getDirectoryListing(),ko.applyBindings(i,t("#content")[0]),e.resetDirectory=function(){e.view_model&&e.view_model.directory&&e.view_model.directory("")},t(".products.typeahead").typeahead({autoselect:!0,highlight:!0},{name:"products",limit:10,source:l.ttAdapter(),templates:{empty:'<div class="tt-no-suggestion"><?php echo addslashes($text_no_records_found); ?></div>',suggestion:Handlebars.compile('<p><span class="tt-nowrap">{{value}}<span class="tt-secondary-right">{{model}}</span></span></p>')}}).on("typeahead:selected",function(e,o){var i=ko.dataFor(this),r=t(this).data("method");r&&(i[r](o.id,o.value),t(this).typeahead("val",""))}),e.onComplete(t("#page-overlay"),t("#content"))})}(window.bull5i=window.bull5i||{},jQuery);
//--></script>
<?php echo $footer; ?>
