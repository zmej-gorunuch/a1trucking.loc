<?php echo $header; ?>
<div class="modal fade" id="legal_text" tabindex="-1" role="dialog" aria-labelledby="legal_text_label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="legal_text_label"><?php echo $text_terms; ?></h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default cancel" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>
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
							<ul class="nav navbar-nav">
								<li class="active"><a href="#settings" data-toggle="tab"><!-- ko if: general_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !general_errors()}"></i> <!-- /ko --><?php echo $tab_settings; ?></a></li>
								<li><a href="#modules" data-toggle="tab"><!-- ko if: module_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !module_errors()}"></i> <!-- /ko --><?php echo $tab_modules; ?></a></li>
								<li><a href="#icons" data-toggle="tab"><?php echo $tab_icons; ?></a></li>
								<li><a href="#statistics" data-toggle="tab"><?php echo $tab_statistics; ?></a></li>
								<li><a href="#ext-support" data-toggle="tab"><?php echo $tab_support; ?></a></li>
								<li><a href="#about-ext" data-toggle="tab"><?php echo $tab_about; ?></a></li>
							</ul>
							<div class="nav navbar-nav btn-group navbar-right">
								<?php if ($update_pending) { ?><button type="button" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_upgrade; ?>" class="btn btn-info" id="btn-upgrade" data-url="<?php echo $upgrade; ?>" data-form="#sForm" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_upgrading; ?></span>"><i class="fa fa-arrow-circle-up"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_upgrade; ?></span></button><?php } ?>
								<?php if (!$update_pending && $db_errors) { ?><button type="button" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_fix_db; ?>" class="btn btn-info" id="btn-fix-db" data-url="<?php echo $fix_db; ?>" data-form="#sForm" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_fixing; ?></span>"><i class="fa fa-wrench"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_fix_db; ?></span></button><?php } ?>
								<button type="button" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_apply; ?>" class="btn btn-success" id="btn-apply" data-url="<?php echo $save; ?>" data-form="#sForm" data-context="#content" data-vm="ExtVM" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"<?php echo $update_pending ? ' disabled': ''; ?>><i class="fa fa-check"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_apply; ?></span></button>
								<button type="submit" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_save; ?>" class="btn btn-primary" id="btn-save" data-url="<?php echo $save; ?>" data-form="#sForm" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>" <?php echo $update_pending ? ' disabled': ''; ?>><i class="fa fa-save"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_save; ?></span></button>
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

		<form action="<?php echo $save; ?>" method="post" enctype="multipart/form-data" id="sForm" class="form-horizontal" role="form">
			<div class="tab-content">
				<div class="tab-pane active" id="settings">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#settings-navbar-collapse">
									<span class="sr-only"><?php echo $text_toggle_navigation; ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<h3 class="panel-title"><i class="fa fa-cog fa-fw"></i> <?php echo $tab_settings; ?></h3>
							</div>
							<div class="collapse navbar-collapse" id="settings-navbar-collapse">
								<ul class="nav navbar-nav">
									<li class="active"><a href="#general-settings" data-toggle="tab"><!-- ko if: gs_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !gs_errors()}"></i> <!-- /ko --><?php echo $tab_general; ?></a></li>
									<li><a href="#free-downloads" data-toggle="tab"><!-- ko if: fd_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !fd_errors()}"></i> <!-- /ko --><?php echo $tab_free_downloads; ?></a></li>
									<li><a href="#regular-downloads" data-toggle="tab"><!-- ko if: rd_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !rd_errors()}"></i> <!-- /ko --><?php echo $tab_regular_downloads; ?></a></li>
									<li><a href="#samples" data-toggle="tab"><!-- ko if: ds_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !ds_errors()}"></i> <!-- /ko --><?php echo $tab_samples; ?></a></li>
									<li><a href="#hide-add-to-cart" data-toggle="tab"><!-- ko if: hatc_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !hatc_errors()}"></i> <!-- /ko --><?php echo $tab_hide_add_to_cart; ?></a></li>
									<li><a href="#auto-add" data-toggle="tab"><!-- ko if: aa_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !aa_errors()}"></i> <!-- /ko --><?php echo $tab_auto_add; ?></a></li>
									<li><a href="#batch-add" data-toggle="tab"><!-- ko if: ba_errors() --><i class="fa fa-exclamation-circle text-danger hidden" data-bind="css:{'hidden': !ba_errors()}"></i> <!-- /ko --><?php echo $tab_batch_add; ?></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
							<div class="tab-content">
								<div class="tab-pane active" id="general-settings">
									<div class="row">
										<div class="col-sm-12">
											<fieldset>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_status"><?php echo $entry_extension_status; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_status" id="pd_status" data-bind="value: status" class="form-control">
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
														</select>
														<input type="hidden" name="pd_installed" value="1" />
														<input type="hidden" name="pd_installed_version" value="<?php echo $installed_version; ?>" />
														<input type="hidden" name="product_downloads_status" data-bind="value: status" />
														<input type="hidden" name="pd_hash_chars" value="<?php echo $pd_hash_chars; ?>" />
														<input type="hidden" name="pd_as" data-bind="value: as" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_force_download0"><?php echo $entry_force_download; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_force_download" id="pd_force_download1" value="1" data-bind="checked: force_download"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_force_download" id="pd_force_download0" value="0" data-bind="checked: force_download"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_force_download; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_require_login0"><?php echo $entry_require_login; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_require_login" id="pd_require_login1" value="1" data-bind="checked: require_login"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_require_login" id="pd_require_login0" value="0" data-bind="checked: require_login"> <?php echo $text_no; ?>
														</label>
														<span class="text-muted text-inline-info"><?php echo $text_global_setting; ?></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_require_login; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_show_login_required_text0"><?php echo $entry_show_login_required_text; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_show_login_required_text" id="pd_show_login_required_text1" value="1" data-bind="checked: show_login_required_text"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_show_login_required_text" id="pd_show_login_required_text0" value="0" data-bind="checked: show_login_required_text"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_show_login_required_text; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_add_to_previous_orders0"><?php echo $entry_add_to_previous_orders; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_add_to_previous_orders" id="pd_add_to_previous_orders1" value="1" data-bind="checked: add_to_previous_orders"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_add_to_previous_orders" id="pd_add_to_previous_orders0" value="0" data-bind="checked: add_to_previous_orders"> <?php echo $text_no; ?>
														</label>
														<span class="text-muted text-inline-info"><?php echo $text_default_setting; ?></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_add_to_previous_orders; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_update_previous_orders0"><?php echo $entry_update_previous_orders; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_update_previous_orders" id="pd_update_previous_orders1" value="1" data-bind="checked: update_previous_orders"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_update_previous_orders" id="pd_update_previous_orders0" value="0" data-bind="checked: update_previous_orders"> <?php echo $text_no; ?>
														</label>
														<span class="text-muted text-inline-info"><?php echo $text_default_setting; ?></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_update_previous_orders; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_delete_file_from_system0"><?php echo $entry_delete_file_from_system; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_delete_file_from_system" id="pd_delete_file_from_system1" value="1" data-bind="checked: delete_file_from_system"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_delete_file_from_system" id="pd_delete_file_from_system0" value="0" data-bind="checked: delete_file_from_system"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_delete_file_from_system; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_remove_sql_changes0"><?php echo $entry_remove_sql_changes; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_remove_sql_changes" id="pd_remove_sql_changes1" value="1" data-bind="checked: remove_sql_changes"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_remove_sql_changes" id="pd_remove_sql_changes0" value="0" data-bind="checked: remove_sql_changes"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_remove_sql_changes; ?></span>
													</div>
												</div>
												<!-- ko if: _sas() == 1 -->
												<div class="form-group">
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-6 col-md-5 col-lg-4">
														<select class="form-control" data-bind="selectedOptions: _as" multiple>
															<?php foreach ($stores as $store_id => $store) { ?>
															<option value="<?php echo $store_id; ?>"><?php echo $store['name']; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<!-- /ko -->
											</fieldset>
											<fieldset>
												<legend><?php echo $text_dashboard_widget; ?></legend>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $help_dashboard_widget; ?></span>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<button class="btn <?php echo $dashboard_widget['class']; ?>" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $dashboard_widget['name']; ?>" data-url="<?php echo $dashboard_widget['link']; ?>" data-context="#content" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php echo $dashboard_widget['loading']; ?>"><i class="fa <?php echo $dashboard_widget['icon']; ?>"></i> <?php echo $dashboard_widget['name']; ?></button>
													</div>
												</div>
											</fieldset>
											<fieldset>
												<legend><?php echo $text_downloads_page; ?></legend>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $text_downloads_page_info; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_status"><?php echo $entry_downloads_page; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_dp_status" id="pd_dp_status" data-bind="value: dp_status" class="form-control">
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
														</select>
													</div>
												</div>
												<!-- ko if: dp_status() == 1 -->
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_header_link"><?php echo $entry_downloads_page_link; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="checkbox-inline">
															<input type="checkbox" name="pd_dp_header_link" id="pd_dp_header_link" value="1" data-bind="checked: dp_header_link"> <?php echo $text_header; ?>
															<!-- ko if: dp_header_link() != 1 -->
															<input type="hidden" name="pd_dp_header_link" value="0">
															<!-- /ko -->
														</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="pd_dp_footer_link" id="pd_dp_footer_link" value="1" data-bind="checked: dp_footer_link"> <?php echo $text_footer; ?>
															<!-- ko if: dp_footer_link() != 1 -->
															<input type="hidden" name="pd_dp_footer_link" value="0">
															<!-- /ko -->
														</label>
													</div>
												</div>
												<div class="form-group" data-bind="visible: seo_url, css: {'has-error': dp_seo_keyword.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_seo_keyword"><?php echo $entry_seo_keyword; ?></label>
													<div class="col-sm-4 col-md-3 col-lg-2">
														<input type="text" name="pd_dp_seo_keyword" id="pd_dp_seo_keyword" data-bind="value: dp_seo_keyword" class="form-control">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: dp_seo_keyword.hasError && dp_seo_keyword.errorMsg">
														<span class="help-block error-text" data-bind="text: dp_seo_keyword.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_dp_seo_keyword; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': dp_downloads_per_page.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_downloads_per_page"><?php echo $entry_downloads_per_page; ?></label>
													<div class="col-sm-2 col-md-2 col-lg-1">
														<input type="text" name="pd_dp_downloads_per_page" id="pd_dp_downloads_per_page" data-bind="value: dp_downloads_per_page" class="form-control text-right">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: dp_downloads_per_page.hasError && dp_downloads_per_page.errorMsg">
														<span class="help-block error-text" data-bind="text: dp_downloads_per_page.errorMsg"></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': dp_delay_download.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_delay_download"><?php echo $entry_delay_download; ?></label>
													<div class="col-sm-3 col-md-3 col-lg-2">
														<div class="input-group">
															<input type="text" name="pd_dp_delay_download" id="pd_dp_delay_download" data-bind="value: dp_delay_download" class="form-control text-right">
															<span class="input-group-addon">ms</span>
														</div>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: dp_delay_download.hasError && dp_delay_download.errorMsg">
														<span class="help-block error-text" data-bind="text: dp_delay_download.errorMsg"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_show_search_bar0"><?php echo $entry_show_search_bar; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_search_bar" id="pd_dp_show_search_bar1" value="1" data-bind="checked: dp_show_search_bar"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_search_bar" id="pd_dp_show_search_bar0" value="0" data-bind="checked: dp_show_search_bar"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_show_filter_tags0"><?php echo $entry_show_filter_tags; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_filter_tags" id="pd_dp_show_filter_tags1" value="1" data-bind="checked: dp_show_filter_tags"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_filter_tags" id="pd_dp_show_filter_tags0" value="0" data-bind="checked: dp_show_filter_tags"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_show_file_size0"><?php echo $entry_show_file_size; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_file_size" id="pd_dp_show_file_size1" value="1" data-bind="checked: dp_show_file_size"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_file_size" id="pd_dp_show_file_size0" value="0" data-bind="checked: dp_show_file_size"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_show_date_added0"><?php echo $entry_show_date_added; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_date_added" id="pd_dp_show_date_added1" value="1" data-bind="checked: dp_show_date_added"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_date_added" id="pd_dp_show_date_added0" value="0" data-bind="checked: dp_show_date_added"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_show_date_modified0"><?php echo $entry_show_date_modified; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_date_modified" id="pd_dp_show_date_modified1" value="1" data-bind="checked: dp_show_date_modified"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_date_modified" id="pd_dp_show_date_modified0" value="0" data-bind="checked: dp_show_date_modified"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_show_icon0"><?php echo $entry_show_icon; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_icon" id="pd_dp_show_icon1" value="1" data-bind="checked: dp_show_icon"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_dp_show_icon" id="pd_dp_show_icon0" value="0" data-bind="checked: dp_show_icon"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_dp_name_as_link0"><?php echo $entry_name_as_link; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_dp_name_as_link" id="pd_dp_name_as_link1" value="1" data-bind="checked: dp_name_as_link"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_dp_name_as_link" id="pd_dp_name_as_link0" value="0" data-bind="checked: dp_name_as_link"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<!-- /ko -->
												<!-- ko if: dp_status() != 1 -->
												<input type="hidden" name="pd_dp_header_link" data-bind="value: dp_header_link() ? 1 : 0">
												<input type="hidden" name="pd_dp_footer_link" data-bind="value: dp_footer_link() ? 1 : 0">
												<input type="hidden" name="pd_dp_downloads_per_page" data-bind="value: dp_downloads_per_page">
												<input type="hidden" name="pd_dp_show_search_bar" data-bind="value: dp_show_search_bar">
												<input type="hidden" name="pd_dp_show_filter_tags" data-bind="value: dp_show_filter_tags">
												<input type="hidden" name="pd_dp_show_file_size" data-bind="value: dp_show_file_size">
												<input type="hidden" name="pd_dp_show_date_added" data-bind="value: dp_show_date_added">
												<input type="hidden" name="pd_dp_show_date_modified" data-bind="value: dp_show_date_modified">
												<input type="hidden" name="pd_dp_show_icon" data-bind="value: dp_show_icon">
												<input type="hidden" name="pd_dp_name_as_link" data-bind="value: dp_name_as_link">
												<!-- /ko -->
											</fieldset>
											<fieldset>
												<legend><?php echo $text_account_downloads_page; ?></legend>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $text_account_downloads_page_info; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_cadp_status"><?php echo $entry_account_downloads_page; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_cadp_status" id="pd_cadp_status" data-bind="value: cadp_status" class="form-control">
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
														</select>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_cadp_status; ?></span>
													</div>
												</div>
												<!-- ko if: cadp_status() == 1 -->
												<div class="form-group" data-bind="css: {'has-error': cadp_downloads_per_page.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_cadp_downloads_per_page"><?php echo $entry_downloads_per_page; ?></label>
													<div class="col-sm-2 col-md-2 col-lg-1">
														<input type="text" name="pd_cadp_downloads_per_page" id="pd_cadp_downloads_per_page" data-bind="value: cadp_downloads_per_page" class="form-control text-right">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: cadp_downloads_per_page.hasError && cadp_downloads_per_page.errorMsg">
														<span class="help-block error-text" data-bind="text: cadp_downloads_per_page.errorMsg"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_cadp_show_icon0"><?php echo $entry_show_icon; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_cadp_show_icon" id="pd_cadp_show_icon1" value="1" data-bind="checked: cadp_show_icon"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_cadp_show_icon" id="pd_cadp_show_icon0" value="0" data-bind="checked: cadp_show_icon"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_cadp_show_expired_downloads0"><?php echo $entry_show_expired_downloads; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_cadp_show_expired_downloads" id="pd_cadp_show_expired_downloads1" value="1" data-bind="checked: cadp_show_expired_downloads"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_cadp_show_expired_downloads" id="pd_cadp_show_expired_downloads0" value="0" data-bind="checked: cadp_show_expired_downloads"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_add_free_downloads_to_order0a"><?php echo $entry_add_free_downloads_to_order; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" id="pd_add_free_downloads_to_order1a" value="1" data-bind="checked: add_free_downloads_to_order"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" id="pd_add_free_downloads_to_order0a" value="0" data-bind="checked: add_free_downloads_to_order"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_add_free_downloads_to_order; ?></span>
													</div>
												</div>
												<!-- /ko -->
												<!-- ko if: cadp_status() != 1 -->
												<input type="hidden" name="pd_cadp_downloads_per_page" data-bind="value: cadp_downloads_per_page">
												<input type="hidden" name="pd_cadp_show_icon" data-bind="value: cadp_show_icon">
												<input type="hidden" name="pd_cadp_show_expired_downloads" data-bind="value: cadp_show_expired_downloads">
												<!-- /ko -->
											</fieldset>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="free-downloads">
									<div class="row">
										<div class="col-sm-12">
											<fieldset>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $text_free_downloads; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_show_free_download_count0"><?php echo $entry_show_download_count; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_show_free_download_count" id="pd_show_free_download_count1" value="1" data-bind="checked: show_free_download_count"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_show_free_download_count" id="pd_show_free_download_count0" value="0" data-bind="checked: show_free_download_count"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_require_login_free0"><?php echo $entry_require_login; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_require_login_free" id="pd_require_login_free1" value="1" data-bind="checked: require_login_free"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_require_login_free" id="pd_require_login_free0" value="0" data-bind="checked: require_login_free"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_download_require_login; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_show_download_without_link0"><?php echo $entry_show_download_without_link; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_show_download_without_link" id="pd_show_download_without_link1" value="1" data-bind="checked: show_download_without_link"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_show_download_without_link" id="pd_show_download_without_link0" value="0" data-bind="checked: show_download_without_link"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_show_download_without_link; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_add_free_downloads_to_order0"><?php echo $entry_add_free_downloads_to_order; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_add_free_downloads_to_order" id="pd_add_free_downloads_to_order1" value="1" data-bind="checked: add_free_downloads_to_order"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_add_free_downloads_to_order" id="pd_add_free_downloads_to_order0" value="0" data-bind="checked: add_free_downloads_to_order"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_add_free_downloads_to_order; ?></span>
													</div>
												</div>
												<!-- ko if: require_login_free() == 1 || require_login() == 1 || true -->
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_differentiate_customers0"><?php echo $entry_differentiate_customers; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_differentiate_customers" id="pd_differentiate_customers1" value="1" data-bind="checked: differentiate_customers"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_differentiate_customers" id="pd_differentiate_customers0" value="0" data-bind="checked: differentiate_customers"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_differentiate_customers; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_default_customer_group; ?></label>
													<div class="col-sm-9 col-md-7 col-lg-5">
														<div class="well well-sm well-scroll-box form-control" data-bind="css: {disabled: differentiate_customers() != 1}">
															<!-- ko foreach: customer_groups() -->
															<div class="checkbox">
																<label><input type="checkbox" name="pd_customer_groups[]" data-bind="attr: {value: id}, checked: $root.selected_customer_groups" /> <!-- ko text: name --><!-- /ko --></label>
															</div>
															<!-- /ko -->
														</div>
													</div>
												</div>
												<!-- /ko -->
												<!-- ko if: require_login_free() != 1 && require_login() != 1 && false -->
												<input type="hidden" name="pd_differentiate_customers" data-bind="value: differentiate_customers">
												<!-- ko foreach: selected_customer_groups() -->
													<input type="hidden" name="pd_customer_groups[]" data-bind="value: $data" />
												<!-- /ko -->
												<!-- /ko -->
											</fieldset>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="regular-downloads">
									<div class="row">
										<div class="col-sm-12">
											<fieldset>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $text_regular_downloads; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_show_purchased_downloads0"><?php echo $entry_show_purchased_downloads; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_show_purchased_downloads" id="pd_show_purchased_downloads1" value="1" data-bind="checked: show_purchased_downloads"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_show_purchased_downloads" id="pd_show_purchased_downloads0" value="0" data-bind="checked: show_purchased_downloads"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_show_purchased_downloads; ?></span>
													</div>
												</div>
												<!-- ko if: show_purchased_downloads() == 1 -->
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_show_downloads_remaining0"><?php echo $entry_show_downloads_remaining; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_show_downloads_remaining" id="pd_show_downloads_remaining1" value="1" data-bind="checked: show_downloads_remaining"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_show_downloads_remaining" id="pd_show_downloads_remaining0" value="0" data-bind="checked: show_downloads_remaining"> <?php echo $text_no; ?>
														</label>
													</div>
												</div>
												<!-- /ko -->
												<!-- ko if: show_purchased_downloads() != 1 -->
												<input type="hidden" name="pd_show_downloads_remaining" data-bind="value: show_downloads_remaining">
												<!-- /ko -->
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_show_purchasable_downloads0"><?php echo $entry_show_purchasable_downloads; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_show_purchasable_downloads" id="pd_show_purchasable_downloads1" value="1" data-bind="checked: show_purchasable_downloads"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_show_purchasable_downloads" id="pd_show_purchasable_downloads0" value="0" data-bind="checked: show_purchasable_downloads"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_show_purchasable_downloads; ?></span>
													</div>
												</div>
												<!-- ko if: show_purchasable_downloads() == 1 -->
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_require_login_regular0"><?php echo $entry_require_login; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_require_login_regular" id="pd_require_login_regular1" value="1" data-bind="checked: require_login_regular"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_require_login_regular" id="pd_require_login_regular0" value="0" data-bind="checked: require_login_regular"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_download_require_login; ?></span>
													</div>
												</div>
												<!-- /ko -->
												<!-- ko if: show_purchasable_downloads() != 1 -->
												<input type="hidden" name="pd_require_login_regular" data-bind="value: require_login_regular">
												<!-- /ko -->
											</fieldset>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="samples">
									<div class="row">
										<div class="col-sm-12">
											<fieldset>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $text_download_samples; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_show_sample_constraint0"><?php echo $entry_show_sample_constraint; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_show_sample_constraint" id="pd_show_sample_constraint1" value="1" data-bind="checked: show_sample_constraint"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_show_sample_constraint" id="pd_show_sample_constraint0" value="0" data-bind="checked: show_sample_constraint"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_show_sample_constraint; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_require_login_sample0"><?php echo $entry_require_login; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_require_login_sample" id="pd_require_login_sample1" value="1" data-bind="checked: require_login_sample"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_require_login_sample" id="pd_require_login_sample0" value="0" data-bind="checked: require_login_sample"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_download_require_login; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': delay_download_sample.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_delay_download_sample"><?php echo $entry_delay_download; ?></label>
													<div class="col-sm-3 col-md-3 col-lg-2">
														<div class="input-group">
															<input type="text" name="pd_delay_download_sample" id="pd_delay_download_sample" data-bind="value: delay_download_sample" class="form-control text-right">
															<span class="input-group-addon">ms</span>
														</div>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: delay_download_sample.hasError && delay_download_sample.errorMsg">
														<span class="help-block error-text" data-bind="text: delay_download_sample.errorMsg"></span>
													</div>
												</div>
												<div class="form-group" data-bind="visible: seo_url, css: {'has-error': ds_seo_keyword.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ds_seo_keyword"><?php echo $entry_seo_keyword; ?></label>
													<div class="col-sm-4 col-md-3 col-lg-2">
														<input type="text" name="pd_ds_seo_keyword" id="pd_ds_seo_keyword" data-bind="value: ds_seo_keyword" class="form-control">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: ds_seo_keyword.hasError && ds_seo_keyword.errorMsg">
														<span class="help-block error-text" data-bind="text: ds_seo_keyword.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_ds_seo_keyword; ?></span>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="hide-add-to-cart">
									<div class="row">
										<div class="col-sm-12">
											<fieldset>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $text_hide_add_to_cart; ?></span>
													</div>
												</div>
											</fieldset>
											<fieldset>
												<legend><?php echo $text_product_page; ?></legend>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_product_atc_action"><?php echo $entry_add_to_cart_button_action; ?></label>
													<div class="col-sm-3 fc-auto-width">
														<select name="pd_product_atc_action" id="pd_product_atc_action" data-bind="value: product_atc_action" class="form-control">
															<option value="0"><?php echo $text_no_action; ?></option>
															<option value="1"><?php echo $text_hide; ?></option>
															<option value="2"><?php echo $text_hide_with_free; ?></option>
															<option value="3"><?php echo $text_replace; ?></option>
														</select>
													</div>
													<!-- ko if: product_atc_action() == 2 -->
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_hide_with_only_free_downloads; ?></span>
													</div>
													<!-- /ko -->
													<!-- ko if: product_atc_action() == 3 -->
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_replace_atc_button; ?></span>
													</div>
													<!-- /ko -->
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_product_price_action"><?php echo $entry_price_tag_action; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_product_price_action" id="pd_product_price_action" data-bind="value: product_price_action" class="form-control">
															<option value="0"><?php echo $text_no_action; ?></option>
															<option value="1"><?php echo $text_hide; ?></option>
															<option value="2"><?php echo $text_replace; ?></option>
														</select>
													</div>
												</div>
												<div data-bind="visible: product_price_action() == 2">
													<div class="form-group">
														<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10">
															<ul class="nav nav-pills">
																<!-- ko foreach: product_replace_price_with -->
																<li data-bind="css: { active: language_id == $root.default_language }"><a data-bind="attr: {href: '#tab_product_replace_price' + language_id}" data-toggle="pill"><img data-bind="attr: {src: $root.languages[language_id].flag, title: $root.languages[language_id].name}" /> <!-- ko text: $root.languages[language_id].name --><!-- /ko --></a></li>
																<!-- /ko -->
															</ul>
														</div>
													</div>
													<div class="form-group">
														<div class="tab-content">
															<!-- ko foreach: {data: product_replace_price_with } -->
															<div data-bind="attr: {id: 'tab_product_replace_price' + language_id}, css: { active: language_id == $root.default_language }" class="tab-pane">
																<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'pd_product_replace_price_with' + language_id}"><?php echo $entry_replace_price_with; ?></label>
																<div class="col-sm-9 col-md-10">
																	<textarea data-bind="attr: {name: 'pd_product_replace_price_with[' + language_id + ']', id: 'pd_product_replace_price_with' + language_id}, value: value, summernote: {height: 300}" class="form-control" rows="5"></textarea>
																</div>
															</div>
															<!-- /ko -->
														</div>
													</div>
												</div>
											</fieldset>
											<fieldset>
												<legend><?php echo $text_product_list_pages; ?></legend>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_list_atc_action"><?php echo $entry_add_to_cart_button_action; ?></label>
													<div class="col-sm-3 fc-auto-width">
														<select name="pd_list_atc_action" id="pd_list_atc_action" data-bind="value: list_atc_action" class="form-control">
															<option value="0"><?php echo $text_no_action; ?></option>
															<option value="1"><?php echo $text_hide; ?></option>
															<option value="2"><?php echo $text_hide_with_free; ?></option>
															<option value="3"><?php echo $text_replace; ?></option>
														</select>
													</div>
													<!-- ko if: list_atc_action() == 2 -->
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_hide_with_only_free_downloads; ?></span>
													</div>
													<!-- /ko -->
													<!-- ko if: list_atc_action() == 3 -->
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_replace_atc_button; ?></span>
														<span class="help-block help-text"><?php echo $help_performance_impact; ?></span>
													</div>
													<!-- /ko -->
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_list_price_action"><?php echo $entry_price_tag_action; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_list_price_action" id="pd_list_price_action" data-bind="value: list_price_action" class="form-control">
															<option value="0"><?php echo $text_no_action; ?></option>
															<option value="1"><?php echo $text_hide; ?></option>
															<option value="2"><?php echo $text_replace; ?></option>
														</select>
													</div>
												</div>
												<div data-bind="visible: list_price_action() == 2">
													<div class="form-group">
														<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10">
															<ul class="nav nav-pills">
																<!-- ko foreach: list_replace_price_with -->
																<li data-bind="css: { active: language_id == $root.default_language }"><a data-bind="attr: {href: '#tab_list_replace_price' + language_id}" data-toggle="pill"><img data-bind="attr: {src: $root.languages[language_id].flag, title: $root.languages[language_id].name}" /> <!-- ko text: $root.languages[language_id].name --><!-- /ko --></a></li>
																<!-- /ko -->
															</ul>
														</div>
													</div>
													<div class="form-group">
														<div class="tab-content">
															<!-- ko foreach: {data: list_replace_price_with } -->
															<div data-bind="attr: {id: 'tab_list_replace_price' + language_id}, css: { active: language_id == $root.default_language }" class="tab-pane">
																<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'pd_list_replace_price_with' + language_id}"><?php echo $entry_replace_price_with; ?></label>
																<div class="col-sm-9 col-md-10">
																	<textarea data-bind="attr: {name: 'pd_list_replace_price_with[' + language_id + ']', id: 'pd_list_replace_price_with' + language_id}, value: value, summernote: {height: 300}" class="form-control" rows="5"></textarea>
																</div>
															</div>
															<!-- /ko -->
														</div>
													</div>
												</div>
											</fieldset>
											<fieldset>
												<legend><?php echo $text_product_modules; ?></legend>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_module_atc_action"><?php echo $entry_add_to_cart_button_action; ?></label>
													<div class="col-sm-3 fc-auto-width">
														<select name="pd_module_atc_action" id="pd_module_atc_action" data-bind="value: module_atc_action" class="form-control">
															<option value="0"><?php echo $text_no_action; ?></option>
															<option value="1"><?php echo $text_hide; ?></option>
															<option value="2"><?php echo $text_hide_with_free; ?></option>
															<option value="3"><?php echo $text_replace; ?></option>
														</select>
													</div>
													<!-- ko if: module_atc_action() == 2 -->
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_hide_with_only_free_downloads; ?></span>
													</div>
													<!-- /ko -->
													<!-- ko if: module_atc_action() == 3 -->
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_replace_atc_button; ?></span>
														<span class="help-block help-text"><?php echo $help_performance_impact; ?></span>
													</div>
													<!-- /ko -->
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_module_price_action"><?php echo $entry_price_tag_action; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_module_price_action" id="pd_module_price_action" data-bind="value: module_price_action" class="form-control">
															<option value="0"><?php echo $text_no_action; ?></option>
															<option value="1"><?php echo $text_hide; ?></option>
															<option value="2"><?php echo $text_replace; ?></option>
														</select>
													</div>
												</div>
												<div data-bind="visible: module_price_action() == 2">
													<div class="form-group">
														<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10">
															<ul class="nav nav-pills">
																<!-- ko foreach: module_replace_price_with -->
																<li data-bind="css: { active: language_id == $root.default_language }"><a data-bind="attr: {href: '#tab_module_replace_price' + language_id}" data-toggle="pill"><img data-bind="attr: {src: $root.languages[language_id].flag, title: $root.languages[language_id].name}" /> <!-- ko text: $root.languages[language_id].name --><!-- /ko --></a></li>
																<!-- /ko -->
															</ul>
														</div>
													</div>
													<div class="form-group">
														<div class="tab-content">
															<!-- ko foreach: {data: module_replace_price_with } -->
															<div data-bind="attr: {id: 'tab_module_replace_price' + language_id}, css: { active: language_id == $root.default_language }" class="tab-pane">
																<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'pd_module_replace_price_with' + language_id}"><?php echo $entry_replace_price_with; ?></label>
																<div class="col-sm-9 col-md-10">
																	<textarea data-bind="attr: {name: 'pd_module_replace_price_with[' + language_id + ']', id: 'pd_module_replace_price_with' + language_id}, value: value, summernote: {height: 300}" class="form-control" rows="5"></textarea>
																</div>
															</div>
															<!-- /ko -->
														</div>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="auto-add">
									<div class="row">
										<div class="col-sm-12">
											<fieldset>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $text_auto_add; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_status"><?php echo $entry_auto_add_status; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_aa_status" id="pd_aa_status" data-bind="value: aa_status" class="form-control">
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
														</select>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': aa_directory.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_directory"><?php echo $entry_source_directory; ?></label>
													<div class="col-sm-6 col-md-5 col-lg-4">
														<input type="text" name="pd_aa_directory" id="pd_aa_directory" data-bind="value: aa_directory" class="form-control">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: aa_directory.hasError">
														<span class="help-block error-text" data-bind="text: aa_directory.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_source_directory; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': aa_file_types.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_file_types"><?php echo $entry_file_types; ?></label>
													<div class="col-sm-6 col-md-5 col-lg-4">
														<input type="text" name="pd_aa_file_types" id="pd_aa_file_types" data-bind="value: aa_file_types, disable: aa_all_types" class="form-control">
													</div>
													<div class="col-sm-3 col-md-5 col-lg-6">
														<div class="checkbox">
															<label>
																<input type="checkbox" name="pd_aa_all_types" value="1" data-bind="checked: aa_all_types"> <?php echo $text_all_types; ?>
																<!-- ko ifnot: aa_all_types -->
																<input type="hidden" name="pd_aa_all_types" value="0">
																<!-- /ko -->
															</label>
														</div>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: aa_file_types.hasError && aa_file_types.errorMsg">
														<span class="help-block error-text" data-bind="text: aa_file_types.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_file_types; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_excludes"><?php echo $entry_excludes; ?></label>
													<div class="col-sm-6 col-md-5 col-lg-4">
														<input type="text" name="pd_aa_excludes" id="pd_aa_excludes" data-bind="value: aa_excludes" class="form-control">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_excludes; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_recursive0"><?php echo $entry_recursive_search; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_aa_recursive" id="pd_aa_recursive1" value="1" data-bind="checked: aa_recursive"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_aa_recursive" id="pd_aa_recursive0" value="0" data-bind="checked: aa_recursive"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_recursive; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': aa_file_tags.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_file_tags"><?php echo $entry_tags; ?></label>
													<div class="col-sm-9 col-md-7 col-lg-6">
														<input type="hidden" name="pd_aa_file_tags" id="pd_aa_file_tags" data-bind="value: aa_file_tags, select2: { minimumInputLength: 1, multiple: true, allowClear: true, placeholder: '<?php echo $text_add_tag; ?>' }, select2Params: bull5i.select2Tags" class="form-control">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: aa_file_tags.hasError && aa_file_tags.errorMsg">
														<span class="help-block error-text" data-bind="text: aa_file_tags.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_tags; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="visible: aa_recursive() == 1">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_path_to_tags0"><?php echo $entry_path_to_tags; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_aa_path_to_tags" id="pd_aa_path_to_tags1" value="1" data-bind="checked: aa_path_to_tags"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_aa_path_to_tags" id="pd_aa_path_to_tags0" value="0" data-bind="checked: aa_path_to_tags"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_path_to_tags; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': aa_sort_order.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_sort_order"><?php echo $entry_sort_order; ?></label>
													<div class="col-sm-2 col-md-2 col-lg-1">
														<input type="text" name="pd_aa_sort_order" id="pd_aa_sort_order" data-bind="value: aa_sort_order" class="form-control text-right">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: aa_sort_order.hasError && aa_sort_order.errorMsg">
														<span class="help-block error-text" data-bind="text: aa_sort_order.errorMsg"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_constraint"><?php echo $entry_constraint; ?></label>
													<div class="col-sm-4 fc-auto-width">
														<select name="pd_aa_constraint" id="pd_aa_constraint" data-bind="value: aa_constraint" class="form-control">
															<option value="0"><?php echo $text_no_constraints; ?></option>
															<option value="1"><?php echo $text_quantitative; ?></option>
															<option value="2"><?php echo $text_temporal; ?></option>
															<option value="3"><?php echo $text_both; ?></option>
														</select>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: aa_constraint() == '1'">
														<span class="help-block help-text"><?php echo $help_quantitative; ?></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: aa_constraint() == '2'">
														<span class="help-block help-text"><?php echo $help_temporal; ?></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: aa_constraint() == '3'">
														<span class="help-block help-text"><?php echo $help_limit_both; ?></span>
													</div>
												</div>
												<div class="form-group has-feedback" data-bind="css: {'has-error': aa_total_downloads.hasError}, visible: aa_constraint() == '1' || aa_constraint() == '3'">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_total_downloads"><?php echo $entry_total_downloads; ?></label>
													<div class="col-sm-2 col-md-2 col-lg-1">
														<input type="text" name="pd_aa_total_downloads" id="pd_aa_total_downloads" data-bind="value: aa_total_downloads" class="form-control">
														<!-- ko if: aa_total_downloads.hasError -->
														<span class="fa fa-times form-control-feedback"></span>
														<!-- /ko -->
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: aa_total_downloads.hasError && aa_total_downloads.errorMsg">
														<span class="help-block error-text" data-bind="text: aa_total_downloads.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_total_downloads; ?></span>
													</div>
												</div>
												<div class="form-group has-feedback" data-bind="css: {'has-error': aa_duration.hasError}, visible: aa_constraint() == '2' || aa_constraint() == '3'">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_duration"><?php echo $entry_duration; ?></label>
													<div class="col-sm-2 col-md-1">
														<input type="text" name="pd_aa_duration" id="pd_aa_duration" data-bind="value: aa_duration" class="form-control">
														<!-- ko if: aa_duration.hasError -->
														<span class="fa fa-times form-control-feedback"></span>
														<!-- /ko -->
													</div>
													<div class="col-sm-3 col-md-2">
														<select name="pd_aa_duration_unit" id="pd_aa_duration_unit" data-bind="value: aa_duration_unit" class="form-control">
															<option value="60"><?php echo $text_minutes; ?></option>
															<option value="3600"><?php echo $text_hours; ?></option>
															<option value="86400"><?php echo $text_days; ?></option>
															<option value="604800"><?php echo $text_weeks; ?></option>
															<option value="2629746"><?php echo $text_months; ?></option>
															<option value="31556952"><?php echo $text_years; ?></option>
														</select>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: aa_duration.hasError && aa_duration.errorMsg">
														<span class="help-block error-text" data-bind="text: aa_duration.errorMsg"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_free_download0"><?php echo $entry_free_download; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_aa_free_download" id="pd_aa_free_download1" value="1" data-bind="checked: aa_free_download"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_aa_free_download" id="pd_aa_free_download0" value="0" data-bind="checked: aa_free_download"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_free_download; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_login0"><?php echo $entry_require_login; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_aa_login" id="pd_aa_login1" value="1" data-bind="checked: aa_login"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_aa_login" id="pd_aa_login0" value="0" data-bind="checked: aa_login"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_download_require_login; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_aa_download_status"><?php echo $entry_download_status; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_aa_download_status" id="pd_aa_download_status" data-bind="value: aa_download_status" class="form-control">
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
														</select>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="batch-add">
									<div class="row">
										<div class="col-sm-12">
											<fieldset>
												<div class="row">
													<div class="col-sm-12 help-container">
														<span class="help-block help-text"><?php echo $text_batch_add; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_status"><?php echo $entry_auto_add_status; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_ba_status" id="pd_ba_status" data-bind="value: ba_status" class="form-control">
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
														</select>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': ba_directory.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_directory"><?php echo $entry_source_directory; ?></label>
													<div class="col-sm-6 col-md-5 col-lg-4">
														<input type="text" name="pd_ba_directory" id="pd_ba_directory" data-bind="value: ba_directory" class="form-control">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: ba_directory.hasError">
														<span class="help-block error-text" data-bind="text: ba_directory.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_source_directory; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': ba_file_types.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_file_types"><?php echo $entry_file_types; ?></label>
													<div class="col-sm-6 col-md-5 col-lg-4">
														<input type="text" name="pd_ba_file_types" id="pd_ba_file_types" data-bind="value: ba_file_types, disable: ba_all_types" class="form-control">
													</div>
													<div class="col-sm-3 col-md-5 col-lg-6">
														<div class="checkbox">
															<label>
																<input type="checkbox" name="pd_ba_all_types" value="1" data-bind="checked: ba_all_types"> <?php echo $text_all_types; ?>
																<!-- ko ifnot: ba_all_types -->
																<input type="hidden" name="pd_ba_all_types" value="0">
																<!-- /ko -->
															</label>
														</div>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: ba_file_types.hasError && ba_file_types.errorMsg">
														<span class="help-block error-text" data-bind="text: ba_file_types.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_file_types; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_excludes"><?php echo $entry_excludes; ?></label>
													<div class="col-sm-6 col-md-5 col-lg-4">
														<input type="text" name="pd_ba_excludes" id="pd_ba_excludes" data-bind="value: ba_excludes" class="form-control">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_excludes; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_recursive0"><?php echo $entry_recursive_search; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_ba_recursive" id="pd_ba_recursive1" value="1" data-bind="checked: ba_recursive"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_ba_recursive" id="pd_ba_recursive0" value="0" data-bind="checked: ba_recursive"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_recursive; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': ba_file_tags.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_file_tags"><?php echo $entry_tags; ?></label>
													<div class="col-sm-9 col-md-7 col-lg-6">
														<input type="hidden" name="pd_ba_file_tags" id="pd_ba_file_tags" data-bind="value: ba_file_tags, select2: { minimumInputLength: 1, multiple: true, allowClear: true, placeholder: '<?php echo $text_add_tag; ?>' }, select2Params: bull5i.select2Tags" class="form-control">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: ba_file_tags.hasError && ba_file_tags.errorMsg">
														<span class="help-block error-text" data-bind="text: ba_file_tags.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_tags; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="visible: ba_recursive() == 1">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_path_to_tags0"><?php echo $entry_path_to_tags; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_ba_path_to_tags" id="pd_ba_path_to_tags1" value="1" data-bind="checked: ba_path_to_tags"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_ba_path_to_tags" id="pd_ba_path_to_tags0" value="0" data-bind="checked: ba_path_to_tags"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_path_to_tags; ?></span>
													</div>
												</div>
												<div class="form-group" data-bind="css: {'has-error': ba_sort_order.hasError}">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_sort_order"><?php echo $entry_sort_order; ?></label>
													<div class="col-sm-2 col-md-2 col-lg-1">
														<input type="text" name="pd_ba_sort_order" id="pd_ba_sort_order" data-bind="value: ba_sort_order" class="form-control text-right">
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: ba_sort_order.hasError && ba_sort_order.errorMsg">
														<span class="help-block error-text" data-bind="text: ba_sort_order.errorMsg"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_constraint"><?php echo $entry_constraint; ?></label>
													<div class="col-sm-4 fc-auto-width">
														<select name="pd_ba_constraint" id="pd_ba_constraint" data-bind="value: ba_constraint" class="form-control">
															<option value="0"><?php echo $text_no_constraints; ?></option>
															<option value="1"><?php echo $text_quantitative; ?></option>
															<option value="2"><?php echo $text_temporal; ?></option>
															<option value="3"><?php echo $text_both; ?></option>
														</select>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: ba_constraint() == '1'">
														<span class="help-block help-text"><?php echo $help_quantitative; ?></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: ba_constraint() == '2'">
														<span class="help-block help-text"><?php echo $help_temporal; ?></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: ba_constraint() == '3'">
														<span class="help-block help-text"><?php echo $help_limit_both; ?></span>
													</div>
												</div>
												<div class="form-group has-feedback" data-bind="css: {'has-error': ba_total_downloads.hasError}, visible: ba_constraint() == '1' || ba_constraint() == '3'">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_total_downloads"><?php echo $entry_total_downloads; ?></label>
													<div class="col-sm-2 col-md-2 col-lg-1">
														<input type="text" name="pd_ba_total_downloads" id="pd_ba_total_downloads" data-bind="value: ba_total_downloads" class="form-control">
														<!-- ko if: ba_total_downloads.hasError -->
														<span class="fa fa-times form-control-feedback"></span>
														<!-- /ko -->
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: ba_total_downloads.hasError && ba_total_downloads.errorMsg">
														<span class="help-block error-text" data-bind="text: ba_total_downloads.errorMsg"></span>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_total_downloads; ?></span>
													</div>
												</div>
												<div class="form-group has-feedback" data-bind="css: {'has-error': ba_duration.hasError}, visible: ba_constraint() == '2' || ba_constraint() == '3'">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_duration"><?php echo $entry_duration; ?></label>
													<div class="col-sm-2 col-md-1">
														<input type="text" name="pd_ba_duration" id="pd_ba_duration" data-bind="value: ba_duration" class="form-control">
														<!-- ko if: ba_duration.hasError -->
														<span class="fa fa-times form-control-feedback"></span>
														<!-- /ko -->
													</div>
													<div class="col-sm-3 col-md-2">
														<select name="pd_ba_duration_unit" id="pd_ba_duration_unit" data-bind="value: ba_duration_unit" class="form-control">
															<option value="60"><?php echo $text_minutes; ?></option>
															<option value="3600"><?php echo $text_hours; ?></option>
															<option value="86400"><?php echo $text_days; ?></option>
															<option value="604800"><?php echo $text_weeks; ?></option>
															<option value="2629746"><?php echo $text_months; ?></option>
															<option value="31556952"><?php echo $text_years; ?></option>
														</select>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: ba_duration.hasError && ba_duration.errorMsg">
														<span class="help-block error-text" data-bind="text: ba_duration.errorMsg"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_free_download0"><?php echo $entry_free_download; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_ba_free_download" id="pd_ba_free_download1" value="1" data-bind="checked: ba_free_download"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_ba_free_download" id="pd_ba_free_download0" value="0" data-bind="checked: ba_free_download"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_free_download; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_login0"><?php echo $entry_require_login; ?></label>
													<div class="col-sm-9 col-md-10">
														<label class="radio-inline">
															<input type="radio" name="pd_ba_login" id="pd_ba_login1" value="1" data-bind="checked: ba_login"> <?php echo $text_yes; ?>
														</label>
														<label class="radio-inline">
															<input type="radio" name="pd_ba_login" id="pd_ba_login0" value="0" data-bind="checked: ba_login"> <?php echo $text_no; ?>
														</label>
													</div>
													<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
														<span class="help-block help-text"><?php echo $help_download_require_login; ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 col-md-2 control-label" for="pd_ba_download_status"><?php echo $entry_download_status; ?></label>
													<div class="col-sm-2 fc-auto-width">
														<select name="pd_ba_download_status" id="pd_ba_download_status" data-bind="value: ba_download_status" class="form-control">
															<option value="1"><?php echo $text_enabled; ?></option>
															<option value="0"><?php echo $text_disabled; ?></option>
														</select>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="modules">
					<div class="panel panel-default" id="pd-modules">
						<div class="panel-heading">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#modules-navbar-collapse">
									<span class="sr-only"><?php echo $text_toggle_navigation; ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<h3 class="panel-title"><i class="fa fa-puzzle-piece fa-fw"></i> <?php echo $tab_modules; ?></h3>
							</div>
							<div class="collapse navbar-collapse" id="modules-navbar-collapse">
								<ul class="nav navbar-nav navbar-right">
									<li><button type="button" class="btn btn-primary add-module" data-toggle="tooltip" data-container="body" data-placement="left" title="<?php echo $button_add_module; ?>"><i class="fa fa-plus-circle"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_add_module; ?></span></button></li>
								</ul>
							</div>
						</div>
						<!-- ko if: modules().length == 0 -->
						<div class="panel-body">
							<p><?php echo $text_no_modules; ?></p>
						</div>
						<!-- /ko -->
						<!-- ko if: modules().length > 0 -->
						<div class="alert alert-info panel-margin">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="fa fa-info-circle"></i> <?php echo $text_product_layout; ?>
						</div>
						<!-- /ko -->
						<ul class="list-group">
							<!-- ko foreach: modules -->
							<li class="list-group-item" data-bind="css: {'list-group-item-disabled': !parseInt(status()) }">
								<fieldset>
									<div class="row">
										<div class="col-sm-2 col-xs-4">
											<h2 class="no-margin"># <!-- ko text: module_id() ? module_id() : '?' --><!-- /ko --></h2>
											<input type="hidden" data-bind="attr: {name: 'modules[' + $index() + '][name]'}, value: name() + (show_in_tab() == '1' ? ' (Tab)' : '')">
											<input type="hidden" data-bind="attr: {name: 'modules[' + $index() + '][module_id]'}, value: module_id">
										</div>
										<div class="col-sm-10 col-xs-8">
											<button type="button" class="btn btn-danger remove-module pull-right" data-toggle="tooltip" data-container="body" data-placement="left" title="<?php echo $button_remove; ?>" data-bind="tooltip: {}"><i class="fa fa-minus-circle"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_remove; ?></span></button>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 col-md-4 col-lg-3">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $parent.index + '_name' + $root.default_language}, css: {'has-error': names.hasError}"><?php echo $entry_name; ?></label>
												<!-- ko foreach: names -->
												<div data-bind="css: {'multi-row': $index() != 0, 'has-error': name.hasError}">
													<div class="input-group">
														<span class="input-group-addon" data-bind="attr: {title: $root.languages[language_id()].name}, tooltip: {title:$root.languages[language_id()].name}"><img data-bind="attr: {src: $root.languages[language_id()].flag, title: $root.languages[language_id()].name}" /></span>
														<input data-bind="attr: {name: 'modules[' + $parentContext.$index() + '][names][' + language_id() + ']', id: 'pd_' + $parentContext.$index() + '_name' + language_id()}, value: name" class="form-control">
													</div>
												</div>
												<div class="has-error" data-bind="visible: name.hasError && name.errorMsg">
													<span class="help-block" data-bind="text: name.errorMsg"></span>
												</div>
												<!-- /ko -->
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_type'}"><?php echo $entry_type; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][type]', id: 'pd_' + $index() + '_type'}, value: type" class="form-control">
													<option value="product"><?php echo $text_product_downloads; ?></option>
													<option value="custom"><?php echo $text_custom_downloads; ?></option>
													<option value="free"><?php echo $text_noncommercial_downloads; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-2 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_show_in_tab'}, tooltip:{}" data-toggle="tooltip" data-original-title="<?php echo $help_show_in_tab; ?>"><?php echo $entry_show_in_tab; ?> <i class="fa fa-question-circle text-info"></i></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][show_in_tab]', id: 'pd_' + $index() + '_show_in_tab'}, value: show_in_tab, disable: type() != 'product'" class="form-control">
													<!-- ko if: !$root.tabPositionUsed() || show_in_tab() == '1' --><option value="1"><?php echo $text_yes; ?></option><!-- /ko -->
													<option value="0"><?php echo $text_no; ?></option>
												</select>
												<!-- ko if: type() != 'product' -->
												<input type="hidden" data-bind="attr: {name: 'modules[' + $index() + '][show_in_tab]'}, value: show_in_tab" />
												<!-- /ko -->
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin" data-bind="css: {'has-error': downloads_per_page.hasError}">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_per_page'}"><?php echo $entry_downloads_per_page; ?></label>
												<input data-bind="attr: {name: 'modules[' + $index() + '][downloads_per_page]', id: 'pd_' + $index() + '_per_page'}, value: downloads_per_page" class="form-control text-right">
												<div class="has-error" data-bind="visible: downloads_per_page.hasError && downloads_per_page.errorMsg">
													<span class="help-block" data-bind="text: downloads_per_page.errorMsg"></span>
												</div>
											</div>
										</div>
										<div class="col-sm-3 col-md-2 col-lg-1">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_limit'}"><?php echo $entry_limit; ?></label>
												<input data-bind="attr: {name: 'modules[' + $index() + '][limit]', id: 'pd_' + $index() + '_limit'}, value: limit" class="form-control text-right">
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_show_empty_module'}"><?php echo $entry_show_empty_module; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][show_empty_module]', id: 'pd_' + $index() + '_show_empty_module'}, value: show_empty_module" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_show_search_bar'}"><?php echo $entry_show_search_bar; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][show_search_bar]', id: 'pd_' + $index() + '_show_search_bar'}, value: show_search_bar" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_show_filter_tags'}"><?php echo $entry_show_filter_tags; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][show_filter_tags]', id: 'pd_' + $index() + '_show_filter_tags'}, value: show_filter_tags" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_show_file_size'}"><?php echo $entry_show_file_size; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][show_file_size]', id: 'pd_' + $index() + '_show_file_size'}, value: show_file_size" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_show_date_added'}"><?php echo $entry_show_date_added; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][show_date_added]', id: 'pd_' + $index() + '_show_date_added'}, value: show_date_added" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_show_date_modified'}"><?php echo $entry_show_date_modified; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][show_date_modified]', id: 'pd_' + $index() + '_show_date_modified'}, value: show_date_modified" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_show_icon'}"><?php echo $entry_show_icon; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][show_icon]', id: 'pd_' + $index() + '_show_icon'}, value: show_icon" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_name_as_link'}, tooltip:{}" data-toggle="tooltip" data-original-title="<?php echo $help_name_as_link; ?>"><?php echo $entry_name_as_link; ?> <i class="fa fa-question-circle text-info"></i></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][name_as_link]', id: 'pd_' + $index() + '_name_as_link'}, value: name_as_link" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_lazy_load'}, tooltip:{}" data-toggle="tooltip" data-original-title="<?php echo $help_lazy_load; ?>"><?php echo $entry_lazy_load; ?> <i class="fa fa-question-circle text-info"></i></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][lazy_load]', id: 'pd_' + $index() + '_lazy_load'}, value: lazy_load" class="form-control">
													<option value="1"><?php echo $text_yes; ?></option>
													<option value="0"><?php echo $text_no; ?></option>
												</select>
											</div>
										</div>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_status'}"><?php echo $entry_status; ?></label>
												<select data-bind="attr: {name: 'modules[' + $index() + '][status]', id: 'pd_' + $index() + '_status'}, value: status" class="form-control">
													<option value="1"><?php echo $text_enabled; ?></option>
													<option value="0"><?php echo $text_disabled; ?></option>
												</select>
											</div>
										</div>
									</div>
									<!-- ko if: type() == 'custom' -->
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group no-margin">
												<label class="control-label" data-bind="attr: {for: 'pd_' + $index() + '_downloads'}"><?php echo $entry_downloads; ?></label>
												<input type="hidden" data-bind="attr: {name: 'modules[' + $index() + '][downloads]', id: 'pd_' + $index() + '_downloads'}, value: downloads, select2: { minimumInputLength: 1, multiple: true, placeholder: '<?php echo $text_add_download; ?>' }, select2Params: bull5i.select2Downloads" class="form-control">
											</div>
										</div>
									</div>
									<!-- /ko -->
								</fieldset>
							</li>
							<!-- /ko -->
						</ul>
					</div>
				</div>
				<div class="tab-pane" id="icons">
					<div class="panel panel-default">
						<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-picture-o fa-fw"></i> <?php echo $text_file_type_icons; ?></h3></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label class="col-sm-3 col-md-2 control-label" for="pd_use_fa_icons0"><?php echo $entry_use_fa_icons; ?></label>
										<div class="col-sm-9 col-md-10">
											<label class="radio-inline">
												<input type="radio" name="pd_use_fa_icons" id="pd_use_fa_icons1" value="1" data-bind="checked: use_fa_icons"> <?php echo $text_yes; ?>
											</label>
											<label class="radio-inline">
												<input type="radio" name="pd_use_fa_icons" id="pd_use_fa_icons0" value="0" data-bind="checked: use_fa_icons"> <?php echo $text_no; ?>
											</label>
										</div>
									</div>
									<!-- ko if: use_fa_icons() != "1" -->
									<div class="form-group">
										<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_icon_dir; ?></label>
										<div class="col-sm-9 col-md-10">
											<p class="form-control-static"><?php echo $icon_dir; ?></p>
										</div>
									</div>
									<?php foreach($icons as $icon) { ?>
									<div class="file-type-icon"><img src="<?php echo $icon["src"] ?>" /> <?php echo $icon["type"] ?></div>
									<?php }?>
									<!-- /ko -->
									<!-- ko if: use_fa_icons() == "1" -->
									<?php foreach($fa_icons as $ext => $icon) { ?>
									<div class="file-type-icon"><i class="fa <?php echo $icon; ?>"></i> <?php echo $ext ?></div>
									<?php }?>
									<!-- /ko -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="statistics">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="navbar-header">
								<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $tab_statistics; ?></h3>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12 text-center">
									<div class="btn-group" data-toggle="buttons-radio">
										<button type="button" class="btn btn-default switch-chart active" data-type="daily" data-chart="downloads" data-temporal="1" data-toggle="button"><?php echo $button_daily; ?></button>
										<button type="button" class="btn btn-default switch-chart" data-type="weekly" data-chart="downloads" data-temporal="1" data-toggle="button"><?php echo $button_weekly; ?></button>
										<button type="button" class="btn btn-default switch-chart" data-type="monthly" data-chart="downloads" data-temporal="1" data-toggle="button"><?php echo $button_monthly; ?></button>
										<button type="button" class="btn btn-default switch-chart" data-type="yearly" data-chart="downloads" data-temporal="1" data-toggle="button"><?php echo $button_yearly; ?></button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div id="general-downloads-chart"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 text-center">
									<div class="btn-group" data-toggle="buttons-radio">
										<button type="button" class="btn btn-default switch-chart active" data-type="today_top" data-chart="files" data-toggle="button"><?php echo $button_today; ?></button>
										<button type="button" class="btn btn-default switch-chart" data-type="yesterday_top" data-chart="files" data-toggle="button"><?php echo $button_yesterday; ?></button>
										<button type="button" class="btn btn-default switch-chart" data-type="week_top" data-chart="files" data-toggle="button"><?php echo $button_last_7_days; ?></button>
										<button type="button" class="btn btn-default switch-chart" data-type="month_top" data-chart="files" data-toggle="button"><?php echo $button_last_30_days; ?></button>
										<button type="button" class="btn btn-default switch-chart" data-type="year_top" data-chart="files" data-toggle="button"><?php echo $button_last_365_days; ?></button>
										<button type="button" class="btn btn-default switch-chart" data-type="most_downloaded" data-chart="files" data-toggle="button"><?php echo $button_overall; ?></button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="chart-h500" id="file-downloads-chart"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="ext-support">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#support-navbar-collapse">
									<span class="sr-only"><?php echo $text_toggle_navigation; ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<h3 class="panel-title"><i class="fa fa-phone fa-fw"></i> <?php echo $tab_support; ?></h3>
							</div>
							<div class="collapse navbar-collapse" id="support-navbar-collapse">
								<ul class="nav navbar-nav">
									<li class="active"><a href="#general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
									<li><a href="#faq" data-toggle="tab" title="<?php echo $text_faq; ?>"><?php echo $tab_faq; ?></a></li>
									<li><a href="#services" data-toggle="tab"><?php echo $tab_services; ?></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
							<div class="tab-content">
								<div class="tab-pane active" id="general">
									<div class="row">
										<div class="col-sm-12">
											<h3>Getting support</h3>
											<p>I consider support a priority of mine, so if you need any help with your purchase you can contact me in one of the following ways:</p>
											<ul>
												<li>Send an email to <a href="mailto:<?php echo $ext_support_email; ?>?subject='<?php echo $text_support_subject; ?>'"><?php echo $ext_support_email; ?></a></li>
												<li>Post in the <a href="<?php echo $ext_support_forum; ?>" target="_blank">extension forum thread</a> or send me a <a href="http://forum.opencart.com/ucp.php?i=pm&mode=compose&u=17771">private message</a></li>
												<!--li><a href="<?php echo $ext_store_url; ?>" target="_blank">Leave a comment</a> in the extension store comments section</li-->
											</ul>
											<p>I usually reply within a few hours, but can take up to 36 hours.</p>
											<p>Please note that all support is free if it is an issue with the product. Only issues due conflicts with other third party extensions/modules or custom front end theme are the exception to free support. Resolving such conflicts, customizing the extension or doing additional bespoke work will be provided with the hourly rate of <span id="hourly_rate">USD 50 / EUR 40</span>.</p>

											<h4>Things to note when asking for help</h4>
											<p>Please describe your problem in as much detail as possible. When contacting, please provide the following information:</p>
											<ul>
												<li>The OpenCart version you are using: <strong><?php echo $oc_version; ?></strong></li>
												<li>The extension name and version: <strong><?php echo $ext_name; ?> v<?php echo $ext_version; ?></strong></li>
												<li>If you got any error messages, please include them in the message.</li>
												<li>In case the error message is generated by a vQmod cached file, please also attach that file.</li>
											</ul>
											<p>Any additional information that you can provide about the issue is greatly appreciated and will make problem solving much faster.</p>

											<h3 class="page-header">Happy with <?php echo $ext_name; ?>?</h3>
											<p>I would appreciate it very much if you could <a href="<?php echo $ext_store_url; ?>" target="_blank">rate the extension</a> once you've had a chance to try it out. Why not tell everybody how great this extension is by <a href="<?php echo $ext_store_url; ?>" target="_blank">leaving a comment</a> as well.</p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="alert alert-info">
												<p><?php echo $text_other_extensions; ?></p>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="faq">
									<h3><?php echo $text_faq; ?></h3>
									<ul class="media-list" id="faqs">
										<li class="media">
											<div class="pull-left">
												<i class="fa fa-question-circle fa-4x media-object"></i>
											</div>
											<div class="media-body">
												<h4 class="media-heading">Why isn't the extension showing in store front end?</h4>

												<p class="short-answer">Verify that VQMod is working. If you are using a custom theme please make sure you have properly integrated the extension with your theme. Check for any <a href="#" class="external-tab-link" data-target="#about-ext">license issues</a>.</p>

												<button type="button" class="btn btn-default btn-sm" data-toggle="collapse" data-target="#not_working" data-parent="#faqs">Show the full answer</button>
												<div class="collapse full-answer" id="not_working">
													<p>There may be several causes due to which the extension may not appear to be working in the store front end.</p>

													<ol>
														<li>
															<p>Verify that VQMod is working (for the store front end), proper VQMod cached files are being generated and none of the <?php echo $ext_name; ?> VQMod script files are reporting any errors in the VQMod error log files.</p>
															<p>If VQMod reports errors then these must be addressed. In case proper VQMod cached files are not being generated then VQMod installation needs to be fixed.</p>
														</li>

														<li>
															<p>If you are using a custom theme please make sure you have properly integrated the extension with your theme. See <a href="#theme_integration" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="theme_integration">"How to integrate the extension with a custom theme?"</a> FAQ below.</p>
														</li>

														<li>
															<p>If you have a multi store installation, you need to verify that proper amount of licenses have been purchased. Check the <a href="#" class="external-tab-link" data-target="#about-ext">About tab</a> License section to see whether <?php echo $ext_name; ?> is activated on all of your stores.</p>
															<p>In case <?php echo $ext_name; ?> is inactive on some of your stores, you will need to purchase additional licenses for each inactive store you wish to enable the extension on.</p>
														</li>
													</ol>

													<p>In case none of the above helped you to get the extension working please contact me on the support email given on the <a href="#" class="external-tab-link" data-target="#general">General Support</a> section.</p>
												</div>
											</div>
										</li>
										<li class="media">
											<div class="pull-left">
												<i class="fa fa-question-circle fa-4x media-object"></i>
											</div>
											<div class="media-body">
												<h4 class="media-heading">How to translate the extension to another language?</h4>

												<p class="short-answer">Copy the extension language files (see full answer) to your language folder and translate the strings inside the copied files. Additionally translate the language strings found in the <em>vqmod/xml/product_downloads.xml</em> vQmod script file.</p>

												<button type="button" class="btn btn-default btn-sm" data-toggle="collapse" data-target="#translation" data-parent="#faqs">Show the full answer</button>
												<div class="collapse full-answer" id="translation">
													<ol>
														<li>
															<p><strong>Copy</strong> the following language files <strong>to YOUR_LANGUAGE folder</strong> under the appropriate location as shown below:</p>
															<div class="btm-mgn">
																<em class="text-muted"><small>FROM:</small></em>
																<ul class="list-unstyled">
																	<li>admin/language/en-gb/catalog/download_ext.php</li>
																	<li>admin/language/en-gb/catalog/download_sample.php</li>
																	<li>admin/language/en-gb/catalog/download_tag.php</li>
																	<li>admin/language/en-gb/extension/dashboard/downloads.php</li>
																	<li>admin/language/en-gb/mail/download_sample.php</li>
																	<li>admin/language/en-gb/mail/download_updated.php</li>
																	<li>admin/language/en-gb/extension/module/product_downloads.php</li>
																	<li>catalog/language/en-gb/download/download.php</li>
																</ul>
																<em class="text-muted"><small>TO:</small></em>
																<ul class="list-unstyled">
																	<li>admin/language/YOUR_LANGUAGE/catalog/download_ext.php</li>
																	<li>admin/language/YOUR_LANGUAGE/catalog/download_sample.php</li>
																	<li>admin/language/YOUR_LANGUAGE/catalog/download_tag.php</li>
																	<li>admin/language/YOUR_LANGUAGE/extension/dashboard/downloads.php</li>
																	<li>admin/language/YOUR_LANGUAGE/mail/download_sample.php</li>
																	<li>admin/language/YOUR_LANGUAGE/mail/download_updated.php</li>
																	<li>admin/language/YOUR_LANGUAGE/extension/module/product_downloads.php</li>
																	<li>catalog/language/YOUR_LANGUAGE/download/download.php</li>
																</ul>
															</div>
														</li>

														<li>
															<p><strong>Open</strong> each of the copied <strong>language files</strong> with a text editor such as <a href="http://www.sublimetext.com/">Sublime Text</a> or <a href="http://notepad-plus-plus.org/">Notepad++</a> and <strong>make the required translations</strong>. You can also leave the files in English.</p>
															<p><span class="label label-info">Note</span> You only need to translate the parts that are to the right of the equal sign.</p>
															<p><span class="label label-danger">Important</span> The <em>admin/language/en-gb/mail/download_sample.php</em> and <em>admin/language/en-gb/mail/download_updated.php</em> language files need to be translated to each custom language your store front end uses, because these are used for sending email notifications to customers.</p>
														</li>

														<li>
															<p>Some of the translatable strings are located inside the vQmod script file <em>vqmod/xml/product_downloads.xml</em>, so <strong>open the XML file</strong> with a text editor (<strong>not</strong> with a word processor application such as MS Word) and <strong>search</strong> for a <em>file</em> block that edits the <em>admin/language/en-gb/catalog/download.php</em> language file. It should look similar to the following:</p>
															<pre class="prettyprint linenums"><code class="language-xml">    &lt;file name="admin/language/en-gb/catalog/product.php"&gt;
				&lt;operation&gt;
						&lt;search position="after"&gt;&lt;![CDATA[
						$_['text_amount']
						]]&gt;&lt;/search&gt;
						&lt;add&gt;&lt;![CDATA[
$_['text_free']              = 'Free';
						]]&gt;&lt;/add&gt;
				&lt;/operation&gt;
		&lt;/file&gt;</code></pre>
														</li>

														<li>
															<p>Make a <strong>copy</strong> of the whole <em>file</em> block, <strong>replace</strong> <em>en-gb</em> with <em>YOUR_LANGUAGE</em> in the file path and <strong>translate the string(s)</strong>. You can also leave the strings in English.</p>

															<p><span class="label label-info">Note</span> If you want to quickly familiarize yourself with the simple <a href="http://code.google.com/p/vqmod/" target="_blank">vQmod</a> script syntax, please check out the <a href="http://code.google.com/p/vqmod/wiki/Scripting" target="_blank">official Wiki page</a></p>

															<p>The end result would look similar to the following example:</p>

															<pre class="prettyprint linenums"><code class="language-xml">    &lt;file name="admin/language/en-gb/catalog/product.php"&gt;
				&lt;operation&gt;
						&lt;search position="after"&gt;&lt;![CDATA[
						$_['text_amount']
						]]&gt;&lt;/search&gt;
						&lt;add&gt;&lt;![CDATA[
$_['text_free']              = 'Free';
						]]&gt;&lt;/add&gt;
				&lt;/operation&gt;
		&lt;/file&gt;

		&lt;file name="admin/language/YOUR_LANGUAGE/catalog/product.php"&gt;
				&lt;operation&gt;
						&lt;search position="after"&gt;&lt;![CDATA[
						$_['text_amount']
						]]&gt;&lt;/search&gt;
						&lt;add&gt;&lt;![CDATA[
$_['text_free']              = 'YOUR_LANGUAGE_TRANSLATION';
						]]&gt;&lt;/add&gt;
				&lt;/operation&gt;
		&lt;/file&gt;</code></pre>
														</li>

														<li>
															<p>Now, repeat steps <strong>3</strong> and <strong>4</strong> for the blocks that edit the following language files:</p>
															<ul class="list-unstyled">
																<li>admin/language/en-gb/catalog/option.php</li>
																<li>admin/language/en-gb/common/menu.php</li>
																<li>catalog/language/en-gb/common/header.php</li>
																<li>catalog/language/en-gb/common/footer.php</li>
																<li>catalog/language/en-gb/product/product.php</li>
															</ul>
														</li>
													</ol>

												</div>
											</div>
										</li>
										<li class="media">
											<div class="pull-left">
												<i class="fa fa-question-circle fa-4x media-object"></i>
											</div>
											<div class="media-body">
												<h4 class="media-heading">How to integrate the extension with a custom theme?</h4>

												<p class="short-answer">If you are using a custom theme and the extension is not working out of the box then the first thing to do is to make a copy of the <em>vqmod/xml/product_downloads_default_theme_patch.xml</em> vQmod script file and change all occurrences of the theme name to point to your custom theme folder.</p>

												<button type="button" class="btn btn-default btn-sm" data-toggle="collapse" data-target="#theme_integration" data-parent="#faqs">Show the full answer</button>
												<div class="collapse full-answer" id="theme_integration">
													<p>In order to integrate the <?php echo $ext_name; ?> extension with your custom theme you need to make a copy of the <em>vqmod/xml/product_downloads_default_theme_patch.xml</em> file and give it a different name (eg. <em>product_downloads_custom_theme_patch.xml</em>). Then open the copied vqmod file with a text editor such as <a href="http://www.sublimetext.com/">Sublime Text</a> or <a href="http://notepad-plus-plus.org/">Notepad++</a> and change the theme name from 'default' to your custom theme (folder name) for all of the blocks that edit the default theme template files.</p>
													<p>If changing the theme name does not make it work, then your custom theme structure must differ in some way from the default theme. In this case you need to further tailor the vqmod search &amp; replace/insert patterns for the appropriate template file(s) to deal with the structural peculiarities of your custom theme. Please see the comments in the vqmod script file to better understand the meaning of each modification.</p>
													<p>As due to the very nature of a custom theme there does not exist a universal solution. A custom theme may have a different way of displaying things. Take a look at the changes made to the default theme and work out adjustments to the search &amp; replace patterns to suit your theme.</p>
													<p>If you do not know how the vqmod script works, I kindly suggest you read about it from the vqmod <a href="https://github.com/vqmod/vqmod/wiki" target="_blank">wiki pages</a>. vQmod log files (<em>vqmod/logs/*.log</em>) are helpful for debugging. They will tell you where the script fails (meaning which vqmod search line it does not find in the referenced file), so you need to adjust that part of the script.</p>
													<p>If you would like to change the look of the downloads page or how downloads are displayed you should copy <em>catalog/view/theme/default/template/download/*.tpl</em> template files to <em>catalog/view/theme/<strong>YOUR_CUSTOM_THEME_FOLDER_NAME</strong>/template/download/</em> folder and make changes to those files.</p>
													<p>Should you find yourself in trouble with the changes I can offer commercial custom theme integration service. Please refer to the <a href="#" class="external-tab-link" data-target="#services">Services</a> section.</p>
												</div>
											</div>
										</li>
										<li class="media">
											<div class="pull-left">
												<i class="fa fa-question-circle fa-4x media-object"></i>
											</div>
											<div class="media-body">
												<h4 class="media-heading">How to upgrade the extension?</h4>
												<p class="short-answer">Back up your system, disable the extension, overwrite the current extension files with new ones and click Upgrade on the extension settings page. After upgrade is complete enable the extension again.</p>

												<button type="button" class="btn btn-default btn-sm" data-toggle="collapse" data-target="#upgrade" data-parent="#faqs">Show the full answer</button>
												<div class="collapse full-answer" id="upgrade">
													<ol>
														<li>
															<p><strong>Back up your system</strong> before making any upgrades or changes.</p>
															<p><span class="label label-info">Note</span> Although <?php echo $ext_name; ?> does not overwrite any OpenCart core files, it is always a good practice to create a system backup before making any changes to the system.</p>
														</li>
														<li><strong>Disable</strong> <?php echo $ext_name; ?> <strong>extension</strong> on the module settings page (<em>Extensions > Extensions > Modules > <?php echo $ext_name; ?></em>) by changing <em>Extension status</em> setting to "Disabled".</li>

														<li>
															<p><strong>Upload</strong> the <strong>extension archive</strong> <em>ProductDownloadsPRO-x.x.x.ocmod.zip</em> using the <a href="<?php echo $extension_installer; ?>" target="_blank">Extension Installer</a>.</p>
															<p><span class="label label-info">Note</span> Do not worry, no OpenCart core files will be replaced! Only the previously installed <?php echo $ext_name; ?> files will be overwritten.</p>
															<p><span class="label label-danger">Important</span> If you have done custom modifications to the extension (for example customized it for your theme) then back up the modified files and re-apply the modifications after upgrade. To see which files have changed, please take a look at the <a href="#" class="external-tab-link" data-target="#changelog,#about-ext">Changelog</a>.</p>
														</li>

														<li>
															<p><strong>Open</strong> the <?php echo $ext_name; ?> <strong>module settings page</strong> <small>(<em>Extensions > Extensions > Modules > <?php echo $ext_name; ?></em>)</small> and <strong>refresh the page</strong> by pressing <em>Ctrl + F5</em> twice to force the browser to update the css changes.</p>
														</li>

														<li><p>You should see a notice stating that new version of extension files have been found. <strong>Upgrade the extension</strong> by clicking on the 'Upgrade' button.</p></li>

														<li>After the extension has been successfully upgraded <strong>enable the extension</strong> by changing <em>Extension status</em> setting to "Enabled".</li>
													</ol>
												</div>
											</div>
										</li>
									</ul>
								</div>
								<div class="tab-pane" id="services">
									<h3>Premium Services<button type="button" class="btn btn-default btn-sm pull-right" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_refresh; ?>" id="btn-refresh-services" data-loading-text="<i class='fa fa-refresh fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_loading; ?></span>"><i class="fa fa-refresh"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_refresh; ?></span></button></h3>
									<div id="service-container">
										<p data-bind="visible: service_list_loading()">Loading service list ... <i class="fa fa-refresh fa-spin"></i></p>
										<p data-bind="visible: service_list_loaded() && services().length == 0">There are currently no available services for this extension.</p>
										<table class="table table-hover">
											<tbody data-bind="foreach: services">
												<tr class="srvc">
													<td>
														<h4 class="service" data-bind="html: name"></h4>
														<span class="help-block">
															<p class="description" data-bind="visible: description != '', html: description"></p>
															<p data-bind="visible: turnaround != ''"><strong>Turnaround time</strong>: <span class="turnaround" data-bind="html: turnaround"></span></p>
															<span class="hidden code" data-bind="html: code"></span>
														</span>
													</td>
													<td class="nowrap text-right top-pad"><span class="currency" data-bind="html: currency"></span> <span class="price" data-bind="html: price"></span></td>
													<td class="text-right"><button type="button" class="btn btn-sm btn-primary purchase"><i class="fa fa-shopping-cart"></i> Buy Now</button></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="about-ext">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#about-navbar-collapse">
									<span class="sr-only"><?php echo $text_toggle_navigation; ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<h3 class="panel-title"><i class="fa fa-info fa-fw"></i> <?php echo $tab_about; ?></h3>
							</div>
							<div class="collapse navbar-collapse" id="about-navbar-collapse">
								<ul class="nav navbar-nav">
									<li class="active"><a href="#ext-info" data-toggle="tab"><?php echo $tab_extension; ?></a></li>
									<li><a href="#changelog" data-toggle="tab"><?php echo $tab_changelog; ?></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
							<div class="tab-content">
								<div class="tab-pane active" id="ext-info">
									<div class="row">
										<div class="col-sm-12">
											<h3><?php echo $text_extension_information; ?></h3>

											<div class="form-group">
												<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_extension_name; ?></label>
												<div class="col-sm-9 col-md-10">
													<p class="form-control-static"><?php echo $ext_name; ?></p>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_installed_version; ?></label>
												<div class="col-sm-9 col-md-10">
													<p class="form-control-static"><strong><?php echo $installed_version; ?></strong></p>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_extension_compatibility; ?></label>
												<div class="col-sm-9 col-md-10">
													<p class="form-control-static"><?php echo $ext_compatibility; ?></p>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_extension_store_url; ?></label>
												<div class="col-sm-9 col-md-10">
													<p class="form-control-static"><a href="<?php echo $ext_store_url; ?>" target="_blank"><?php echo htmlspecialchars($ext_store_url); ?></a></p>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_copyright_notice; ?></label>
												<div class="col-sm-9 col-md-10">
													<p class="form-control-static">&copy; 2011 - <?php echo date("Y"); ?> Romi Agar</p>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9 col-md-offset-2 col-md-10">
													<p class="form-control-static"><a href="#legal_text" id="legal_notice" data-toggle="modal"><?php echo $text_terms; ?></a></p>
												</div>
											</div>

											<h3 class="page-header"><?php echo $text_license; ?></h3>
											<p><?php echo $text_license_text; ?></p>

											<div class="form-group has-success">
												<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_active_on; ?></label>
												<div class="col-sm-9 col-md-10">
													<p class="form-control-static" data-bind="text: asn"></p>
												</div>
											</div>
											<div class="form-group has-error" data-bind="visible: iasn() != ''">
												<label class="col-sm-3 col-md-2 control-label"><?php echo $entry_inactive_on; ?></label>
												<div class="col-sm-9 col-md-10">
													<p class="form-control-static" data-bind="text: iasn"></p>
												</div>
												<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container">
													<span class="help-block error-text"><?php echo $help_purchase_additional_licenses; ?></span>
													<a href="<?php echo $ext_purchase_url; ?>" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-shopping-cart"></i> <?php echo $button_purchase_license; ?></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="changelog">
									<div class="row">
										<div class="col-sm-12">
											<div class="release">
												<h3>Version 5.1.8 <small class="release-date text-muted">27 Sep 2016</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Fatal error when adding product with checkbox options to cart</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/extension/module/product_downloads.php</li>
														<li>admin/view/template/extension/module/product_downloads.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.1.7 <small class="release-date text-muted">31 Aug 2016</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Order event hooks</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/extension/module/product_downloads.php</li>
														<li>admin/model/extension/module/product_downloads.php</li>
														<li>admin/view/template/extension/module/product_downloads.tpl</li>
														<li>catalog/controller/checkout/download.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.1.6 <small class="release-date text-muted">10 Jul 2016</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Admin downloads pagination</li>
														<li><em class="text-success">Fixed:</em> Downloaded count for commercial downloads on the downloads list page</li>
														<li><em class="text-success">Fixed:</em> SSL detection</li>
														<li><em class="text-success">Fixed:</em> Support for OpenCart 2.3.0.0</li>
														<li><em class="text-info">Changed:</em> Minor UI improvements</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_sample.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/view/javascript/pd/catalog.min.js</li>
														<li>admin/view/javascript/pd/module.min.js</li>
														<li>catalog/controller/checkout/download.php</li>
														<li>catalog/controller/download/download.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/controller/extension/dashboard/downloads.php</li>
														<li>admin/controller/extension/module/product_downloads.php</li>
														<li>admin/language/en-gb/extension/dashboard/downloads.php</li>
														<li>admin/language/en-gb/extension/module/product_downloads.php</li>
														<li>admin/model/extension/module/product_downloads.php</li>
														<li>admin/view/template/extension/dashboard/downloads_form.tpl</li>
														<li>admin/view/template/extension/dashboard/downloads_info.tpl</li>
														<li>admin/view/template/extension/module/product_downloads.tpl</li>
														<li>admin/view/template/extension/module/product_downloads_module.tpl</li>
														<li>catalog/controller/extension/module/product_downloads.php</li>
														<li>upload.php</li>
													</ul>

													<h4><i class="fa fa-minus text-danger"></i> Files removed:</h4>

													<ul>
														<li>admin/controller/dashboard/downloads.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/en-gb/dashboard/downloads.php</li>
														<li>admin/language/en-gb/module/product_downloads.php</li>
														<li>admin/language/english/catalog/download_*.php</li>
														<li>admin/language/english/dashboard/downloads.php</li>
														<li>admin/language/english/mail/download_*.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/module/product_downloads.php</li>
														<li>admin/view/template/dashboard/downloads.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>admin/view/template/module/product_downloads_module.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/language/english/download/download.php</li>
														<li>system/library/upload.php</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.1.5 <small class="release-date text-muted">13 Mar 2016</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> SQL error when the extension has been uploaded, but not yet installed</li>
														<li><em class="text-success">Fixed:</em> PHP undefined index notice when copying a download</li>
														<li><em class="text-success">Fixed:</em> Free downloads module shows even if there are no downloads and empty module should not be displayed</li>
														<li><em class="text-success">Fixed:</em> Product downloads tab shows even if there are no downloads and empty module should not be displayed</li>
														<li><em class="text-success">Fixed:</em> Multiple lazy loading modules on a page can cancel each other out if loading at the same time</li>
														<li><em class="text-success">Fixed:</em> Support for OpenCart 2.2.0.0</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_sample.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/controller/dashboard/downloads.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/model/catalog/download_sample.php</li>
														<li>admin/model/catalog/download_tag.php</li>
														<li>admin/model/module/product_downloads.php</li>
														<li>admin/view/javascript/pd/catalog.min.js</li>
														<li>admin/view/javascript/pd/module.min.js</li>
														<li>admin/view/stylesheet/pd/css/catalog.min.css</li>
														<li>admin/view/stylesheet/pd/css/module.min.css</li>
														<li>admin/view/template/catalog/pd/download_ext_form.tpl</li>
														<li>admin/view/template/catalog/pd/download_tag_form.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>admin/view/template/module/product_downloads_module.tpl</li>
														<li>catalog/controller/checkout/download.php</li>
														<li>catalog/controller/download/download.php</li>
														<li>catalog/controller/download/sample.php</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/javascript/pd/downloads.min.js</li>
														<li>catalog/view/theme/default/template/download/downloads_module.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/language/en-gb/catalog/download_ext.php</li>
														<li>admin/language/en-gb/catalog/download_sample.php</li>
														<li>admin/language/en-gb/catalog/download_tag.php</li>
														<li>admin/language/en-gb/dashboard/downloads.php</li>
														<li>admin/language/en-gb/mail/download_sample.php</li>
														<li>admin/language/en-gb/mail/download_updated.php</li>
														<li>admin/language/en-gb/module/product_downloads.php</li>
														<li>catalog/language/en-gb/download/download.php</li>
													</ul>

												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.1.4 <small class="release-date text-muted">07 Dec 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Module settings validation error when downloads page was disabled</li>
														<li><em class="text-success">Fixed:</em> Admin download tags list page buttons</li>
														<li><em class="text-success">Fixed:</em> Negative page requests</li>
														<li><em class="text-success">Fixed:</em> Product downloads count</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/template/catalog/pd/download_tag_list.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/download/download.php</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.1.3 <small class="release-date text-muted">29 Oct 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> File upload fails</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>system/library/UploadHandler.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.1.2 <small class="release-date text-muted">01 Oct 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> E-mail notifications in OpenCart 2.0.3+</li>
														<li><em class="text-success">Fixed:</em> OpenCart 2.1.0.x support</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_sample.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/stylesheet/pd/css/catalog.min.css</li>
														<li>admin/view/stylesheet/pd/css/module.min.css</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>system/library/upload.php</li>
														<li>system/library/UploadHandler.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.1.1 <small class="release-date text-muted">09 Sep 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Undefined PHP Notice in cart library</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/javascript/pd/module.min.js</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.1.0 <small class="release-date text-muted">29 Aug 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Downloads &amp; download samples page SEO URL keyword changeable</li>
														<li><em class="text-success">Fixed:</em> Empty download tab display</li>
														<li><em class="text-info">Changed:</em> Some minor refactoring</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_sample.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/download/download.php</li>
														<li>catalog/controller/download/sample.php</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>system/helper/pd.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.0.6 <small class="release-date text-muted">16 Aug 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Download name as link does not display download name</li>
														<li><em class="text-success">Fixed:</em> Download link on product page</li>
														<li><em class="text-success">Fixed:</em> Download filtering when global search string was present</li>
														<li><em class="text-success">Fixed:</em> Conflict with Questions &amp; Answers PRO extension modules on the same page</li>
														<li><em class="text-info">Changed:</em> Products autocomplete by model as well</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/view/javascript/pd/catalog.min.js</li>
														<li>admin/view/javascript/pd/module.min.js</li>
														<li>admin/view/stylesheet/pd/css/catalog.min.css</li>
														<li>admin/view/stylesheet/pd/css/module.min.css</li>
														<li>admin/view/template/catalog/pd/*</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>admin/view/template/module/product_downloads_module.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/view/javascript/pd/downloads.min.js</li>
														<li>catalog/view/theme/default/template/download/downloads_files.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.0.5 <small class="release-date text-muted">04 Jun 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Custom account downloads page does not show downloads table on OpenCart 2.0.3.x</li>
														<li><em class="text-success">Fixed:</em> Categories on download edit page are not in alphabetical order</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/view/theme/default/template/download/account_download.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.0.4 <small class="release-date text-muted">23 May 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Error getting customer group ID</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/download/download.php</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/javascript/pd/downloads.min.js</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.0.3 <small class="release-date text-muted">25 Apr 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Filtering in IE</li>
														<li><em class="text-success">Fixed:</em> Customer differentiation</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_sample.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/javascript/pd/catalog.min.js</li>
														<li>admin/view/javascript/pd/module.min.js</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/javascript/pd/downloads.min.js</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.0.2 <small class="release-date text-muted">01 Apr 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Compatibility with OpenCart 2.0.2.0</li>
														<li><em class="text-success">Fixed:</em> Category and manufacturer selection on download form</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_sample.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/module/product_downloads.php</li>
														<li>admin/view/template/catalog/pd/download_ext_form.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.0.1 <small class="release-date text-muted">22 Mar 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Dashboard widget error when extension is not installed</li>
														<li><em class="text-success">Fixed:</em> Undefined method error in store front end</li>
														<li><em class="text-success">Fixed:</em> Minor CSS issues</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/dashboard/downloads.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/stylesheet/pd/css/catalog.min.css</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 5.0.0 <small class="release-date text-muted">19 Feb 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Option downloads</li>
														<li><em class="text-primary">New:</em> Limit access to commercial downloads quantitatively (as in OpenCart 1.5) and/or temporally</li>
														<li><em class="text-primary">New:</em> Include free downloads in orders and show them on customer account downloads page</li>
														<li><em class="text-primary">New:</em> Quick associate a download with all products from the selected manufacturer</li>
														<li><em class="text-primary">New:</em> Dashboard widget showing total number of downloads for given period</li>
														<li><em class="text-primary">New:</em> Increased download name maximum length to 128 characters</li>
														<li><em class="text-primary">New:</em> Browser upload speed increased up to 2 times by reducing server response times</li>
														<li><em class="text-primary">New:</em> Date modified column for modules</li>
														<li><em class="text-primary">New:</em> Free downloads module (can be added to the Search page to display download search results)</li>
														<li><em class="text-success">Fixed:</em> PHP memory limit is exceeded when uploading large files</li>
														<li><em class="text-success">Fixed:</em> Upload speed calculation</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_sample.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/catalog/download_ext.php</li>
														<li>admin/language/english/catalog/download_sample.php</li>
														<li>admin/language/english/catalog/download_tag.php</li>
														<li>admin/language/english/mail/download_sample.php</li>
														<li>admin/language/english/mail/download_updated.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/model/catalog/download_sample.php</li>
														<li>admin/model/catalog/download_tag.php</li>
														<li>admin/model/module/product_downloads.php</li>
														<li>admin/view/javascript/pd/fileupload/*</li>
														<li>admin/view/javascript/pd/ZeroClipboard.min.js</li>
														<li>admin/view/template/mail/download_sample.html.tpl</li>
														<li>admin/view/template/mail/download_updated.html.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/download/download.php</li>
														<li>catalog/controller/download/sample.php</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/language/english/download/download.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/javascript/pd/downloads.min.js</li>
														<li>catalog/view/theme/default/template/download/*.tpl</li>
														<li>system/helper/pd.php</li>
														<li>system/library/UploadHandler.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/controller/dashboard/downloads.php</li>
														<li>admin/language/english/dashboard/downloads.php</li>
														<li>admin/view/javascript/pd/catalog.min.js</li>
														<li>admin/view/javascript/pd/module.min.js</li>
														<li>admin/view/javascript/pd/upload.min.js</li>
														<li>admin/view/stylesheet/pd/css/catalog.min.css</li>
														<li>admin/view/stylesheet/pd/css/module.min.css</li>
														<li>admin/view/template/catalog/pd/*</li>
														<li>admin/view/template/dashboard/downloads.tpl</li>
														<li>admin/view/template/module/product_downloads_module.tpl</li>
														<li>catalog/controller/checkout/download.php</li>
														<li>catalog/model/checkout/download.php</li>
														<li>catalog/view/javascript/pd/moment-with-locales.min.js</li>
														<li>catalog/view/theme/default/stylesheet/pd/css/account.downloads.min.css</li>
														<li>catalog/view/theme/default/stylesheet/pd/css/downloads.min.css</li>
														<li>catalog/view/theme/default/template/download/account_download.tpl</li>
														<li>system/library/upload.php</li>
														<li>vqmod/xml/product_downloads_default_theme_patch.xml</li>
													</ul>

													<h4><i class="fa fa-minus text-danger"></i> Files removed:</h4>

													<ul>
														<li>admin/view/javascript/pd/custom.min.js</li>
														<li>admin/view/javascript/pd/moment.min.js</li>
														<li>admin/view/javascript/pd/upload.custom.min.js</li>
														<li>admin/view/stylesheet/pd/css/catalog.custom.min.css</li>
														<li>admin/view/stylesheet/pd/css/module.custom.min.css</li>
														<li>admin/view/stylesheet/pd/fonts/*</li>
														<li>admin/view/template/catalog/download_ext*.tpl</li>
														<li>admin/view/template/catalog/download_info.tpl</li>
														<li>admin/view/template/catalog/download_sample*.tpl</li>
														<li>admin/view/template/catalog/download_tag*.tpl</li>
														<li>catalog/view/javascript/jquery/jquery-1.11.1.min.js</li>
														<li>catalog/view/javascript/jquery/jquery-migrate-1.2.1.min.js</li>
														<li>catalog/view/theme/default/stylesheet/pd/css/downloads.custom.min.css</li>
														<li>catalog/view/theme/default/stylesheet/pd/fonts/*</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 4.0.2 <small class="release-date text-muted">04 Jan 2015</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Download to Customer Group setting when none were selected</li>
														<li><em class="text-success">Fixed:</em> Empty custom downloads module does not hide itself</li>
														<li><em class="text-success">Fixed:</em> Content length calculation on file download</li>
														<li><em class="text-success">Fixed:</em> Custom SEO URLs routing and curly braces replace</li>
														<li><em class="text-success">Fixed:</em> Version number update when upgrading extension</li>
														<li><em class="text-success">Fixed:</em> Minor template file issues</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/model/module/product_downloads.php</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/view/theme/default/template/download/download.tpl</li>
														<li>catalog/view/theme/default/template/download/sample.tpl</li>
														<li>system/helper/pd.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 4.0.1 <small class="release-date text-muted">02 Oct 2014</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> MySQL &lt;5.6.5 support</li>
														<li><em class="text-success">Fixed:</em> Autocomplete issue on product edit page</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/model/module/product_downloads.php</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>system/library/UploadHandler.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 4.0.0 <small class="release-date text-muted">21 Aug 2014</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Revamped module admin interface</li>
														<li><em class="text-primary">New:</em> Downloads statistics charts</li>
														<li><em class="text-primary">New:</em> Download samples</li>
														<li><em class="text-primary">New:</em> Separate downloads page that collects together all free downloads</li>
														<li><em class="text-primary">New:</em> Download delay</li>
														<li><em class="text-primary">New:</em> Free download link displayed on download edit page</li>
														<li><em class="text-primary">New:</em> Push download to previous orders associated with the related products</li>
														<li><em class="text-primary">New:</em> Notify customers about updated downloads</li>
														<li><em class="text-primary">New:</em> Multi-upload support when inserting a new download</li>
														<li><em class="text-primary">New:</em> 'Hide "Add to Cart" button' on related products</li>
														<li><em class="text-primary">New:</em> Updated third-party libraries</li>
														<li><em class="text-success">Fixed:</em> Manual order editing download count &amp; free downloads added</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/catalog/download_ext.php</li>
														<li>admin/language/english/catalog/download_tag.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/model/catalog/download_tag.php</li>
														<li>admin/view/static/bull5i_pd_pro_extension_terms.htm</li>
														<li>admin/view/stylesheet/pd_style.css</li>
														<li>admin/view/template/catalog/download_ext_form.tpl</li>
														<li>admin/view/template/catalog/download_ext_list.tpl</li>
														<li>admin/view/template/catalog/download_tag_form.tpl</li>
														<li>admin/view/template/catalog/download_tag_list.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>system/library/UploadHandler.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/controller/catalog/download_sample.php</li>
														<li>admin/language/english/catalog/download_sample.php</li>
														<li>admin/language/english/mail/download_sample.php</li>
														<li>admin/language/english/mail/download_updated.php</li>
														<li>admin/model/catalog/download_sample.php</li>
														<li>admin/model/module/product_downloads.php</li>
														<li>admin/view/javascript/pd/*</li>
														<li>admin/view/stylesheet/pd/*</li>
														<li>admin/view/template/catalog/download_ext_batch_add_form.tpl</li>
														<li>admin/view/template/catalog/download_info.tpl</li>
														<li>admin/view/template/catalog/download_sample_form.tpl</li>
														<li>admin/view/template/catalog/download_sample_list.tpl</li>
														<li>admin/view/template/mail/download_sample.html.tpl</li>
														<li>admin/view/template/mail/download_sample.text.tpl</li>
														<li>admin/view/template/mail/download_updated.html.tpl</li>
														<li>admin/view/template/mail/download_updated.text.tpl</li>
														<li>catalog/controller/download/download.php</li>
														<li>catalog/controller/download/sample.php</li>
														<li>catalog/language/english/download/download.php</li>
														<li>catalog/view/javascript/jquery/jquery-1.11.1.min.js</li>
														<li>catalog/view/javascript/jquery/jquery-migrate-1.2.1.min.js</li>
														<li>catalog/view/javascript/pd/downloads.min.js</li>
														<li>catalog/view/theme/default/stylesheet/pd/*</li>
														<li>catalog/view/theme/default/template/download/download.tpl</li>
														<li>catalog/view/theme/default/template/download/downloads_files.tpl</li>
														<li>catalog/view/theme/default/template/download/downloads_filter.tpl</li>
														<li>catalog/view/theme/default/template/download/downloads_module.tpl</li>
														<li>catalog/view/theme/default/template/download/downloads_page.tpl</li>
														<li>catalog/view/theme/default/template/download/downloads_search.tpl</li>
														<li>catalog/view/theme/default/template/download/sample.tpl</li>
														<li>catalog/view/theme/default/template/download/unavailable.tpl</li>
														<li>system/helper/pd.php</li>
													</ul>

													<h4><i class="fa fa-minus text-danger"></i> Files removed:</h4>

													<ul>
														<li>admin/view/image/pd-pro/*</li>
														<li>admin/view/javascript/bootstrap.custom.min.js</li>
														<li>admin/view/javascript/jquery.actual.min.js</li>
														<li>admin/view/javascript/jquery.fileupload.js</li>
														<li>admin/view/javascript/jquery.iframe-transport.js</li>
														<li>admin/view/javascript/jquery.taghandler.js</li>
														<li>admin/view/javascript/jquery.ui.widget.js</li>
														<li>admin/view/javascript/product.downloads.pro.js</li>
														<li>admin/view/static/bull5i_pd_pro_extension_help.htm</li>
														<li>admin/view/stylesheet/bootstrap.custom.min.css</li>
														<li>admin/view/stylesheet/pd_style.css</li>
														<li>admin/view/template/catalog/download_ext_directory_add_form.tpl</li>
														<li>catalog/controller/product/download.php</li>
														<li>catalog/language/english/module/product_downloads.php</li>
														<li>catalog/language/english/product/download.php</li>
														<li>catalog/view/javascript/pd.pro.custom.min.js</li>
														<li>catalog/view/theme/default/image/asc.png</li>
														<li>catalog/view/theme/default/image/desc.png</li>
														<li>catalog/view/theme/default/image/loading_dls.gif</li>
														<li>catalog/view/theme/default/stylesheet/pd_pro.css</li>
														<li>catalog/view/theme/default/template/module/product_downloads.tpl</li>
														<li>catalog/view/theme/default/template/product/download.tpl</li>
														<li>catalog/view/theme/default/template/product/download_header.tpl</li>
														<li>system/helper/product_downloads.php</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.7.6 <small class="release-date text-muted">18 Mar 2014</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Quantity input on store product page</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.7.5 <small class="release-date text-muted">24 May 2013</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> PHP 5.2 support</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.7.4 <small class="release-date text-muted">12 May 2013</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Login redirection back to product page</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.7.3 <small class="release-date text-muted">15 Apr 2013</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> IE &amp; Firefox file upload button issues</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/stylesheet/pd_style.css</li>
														<li>admin/view/template/catalog/download_ext_form.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.7.2 <small class="release-date text-muted">06 Apr 2013</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> 'product/product' route layout detection</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.7.1 <small class="release-date text-muted">30 Mar 2013</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Compatibility with PHP versions &lt; 5.4.0</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.7.0 <small class="release-date text-muted">18 Mar 2013</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> 'Hide "Add to Cart" button' feature</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/view/stylesheet/pd_style.css</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/product/download.php</li>
														<li>catalog/view/javascript/pd.pro.custom.min.js</li>
														<li>catalog/view/theme/default/stylesheet/pd_pro.css</li>
														<li>catalog/view/theme/default/template/module/product_downloads.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>catalog/language/english/product/download.php</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.6.0 <small class="release-date text-muted">28 Jan 2013</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Download filename autocomplete for files stored in the download folder</li>
														<li><em class="text-primary">New:</em> Updated third-party libraries</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/catalog/download_ext.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/model/catalog/download_tag.php</li>
														<li>admin/view/javascript/jquery.fileupload.js</li>
														<li>admin/view/javascript/jquery.iframe-transport.js</li>
														<li>admin/view/javascript/jquery.taghandler.js</li>
														<li>admin/view/javascript/product.downloads.pro.js</li>
														<li>admin/view/stylesheet/pd_style.css</li>
														<li>admin/view/template/catalog/download_ext_form.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/language/english/module/product_downloads.php</li>
														<li>system/helper/product_downloads.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/view/javascript/bootstrap.custom.min.js</li>
														<li>admin/view/javascript/jquery.ui.widget.js</li>
														<li>admin/view/static/bull5i_pd_pro_extension_help.htm</li>
														<li>admin/view/static/bull5i_pd_pro_extension_terms.htm</li>
														<li>admin/view/stylesheet/bootstrap.custom.min.css</li>
														<li>system/library/UploadHandler.php</li>
													</ul>

													<h4><i class="fa fa-minus text-danger"></i> Files removed:</h4>

													<ul>
														<li>admin/view/javascript/bootstrap-transition.js</li>
														<li>admin/view/static/rmg_extension_help.htm</li>
														<li>admin/view/static/rmg_extension_terms.htm</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.5.5 <small class="release-date text-muted">08 Nov 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> An output buffering error that could corrupt downloaded file</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>catalog/controller/product/download.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.5.4 <small class="release-date text-muted">12 Nov 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> A potential undefined offset notice on file download</li>
														<li><em class="text-success">New:</em> Improved CSS &amp; JS interoperability</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>catalog/controller/product/download.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.5.3 <small class="release-date text-muted">16 Oct 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Large file downloads</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>catalog/controller/product/download.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.5.2 <small class="release-date text-muted">12 Oct 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Tags overlay in Store Front</li>
														<li><em class="text-success">Fixed:</em> Batch Add filtered file list display</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>catalog/view/theme/default/template/product/download_header.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.5.1 <small class="release-date text-muted">19 Sep 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> An undefined index notice when the download mask did not contain a file extension</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>catalog/controller/product/download.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.5.0 <small class="release-date text-muted">15 Sep 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> HTML documentation</li>
														<li><em class="text-primary">New:</em> Excluded files list for auto add and batch add</li>
														<li><em class="text-primary">New:</em> Recurisve search and path-to-tags features to auto add</li>
														<li><em class="text-primary">New:</em> Improved file name sanitization</li>
														<li><em class="text-primary">New:</em> Updated third-party libraries</li>
														<li><em class="text-success">Fixed:</em> Customer group based download display</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/catalog/download_ext.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/view/javascript/product.downloads.pro.js</li>
														<li>admin/view/stylesheet/pd_style.css</li>
														<li>admin/view/template/catalog/download_ext_directory_add_form.tpl</li>
														<li>admin/view/template/catalog/download_ext_form.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/theme/default/stylesheet/pd_pro.css</li>
														<li>catalog/view/theme/default/template/module/product_downloads.tpl</li>
														<li>catalog/view/theme/default/template/product/download.tpl</li>
														<li>catalog/view/theme/default/template/product/download_header.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/view/image/pd-pro/loading_14.gif</li>
														<li>admin/view/javascript/bootstrap-transition.js</li>
														<li>admin/view/javascript/jquery.actual.min.js</li>
														<li>admin/view/javascript/jquery.fileupload.js</li>
														<li>admin/view/javascript/jquery.iframe-transport.js</li>
														<li>admin/view/javascript/jquery.taghandler.js</li>
														<li>catalog/view/javascript/pd.pro.custom.min.js</li>
														<li>catalog/view/theme/default/stylesheet/pd_pro.css</li>
													</ul>

													<h4><i class="fa fa-minus text-danger"></i> Files removed:</h4>

													<ul>
														<li>admin/view/javascript/jquery/jquery.fileupload.js</li>
														<li>admin/view/javascript/jquery/jquery.actual.min.js</li>
														<li>admin/view/javascript/jquery/jquery.iframe-transport.js</li>
														<li>admin/view/javascript/jquery/jquery.taghandler.js</li>
														<li>catalog/view/javascript/jquery/jquery.actual.min.js</li>
														<li>catalog/view/javascript/jquery/jquery.query.min.js</li>
														<li>catalog/view/javascript/jquery/pd.pro.custom.min.js</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.4.1 <small class="release-date text-muted">08 Jun 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> PHP &lt; 5.3.0 compatibility</li>
														<li><em class="text-success">Fixed:</em> A JavaScript upload issue when upload fails</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/view/javascript/product.downloads.pro.js</li>
														<li>admin/view/template/catalog/download_ext_list.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.4.0 <small class="release-date text-muted">05 Jun 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Option to choose whether file is deleted from the file system when download is deleted</li>
														<li><em class="text-primary">New:</em> New AJAX based file uploading system (shows upload progress, large file upload support)</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/catalog/download_ext.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/view/javascript/product.downloads.pro.js</li>
														<li>admin/view/stylesheet/pd_style.css</li>
														<li>admin/view/template/catalog/download_ext_form.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/view/image/glyphicons-halflings-white.png</li>
														<li>admin/view/image/progressbar.gif</li>
														<li>admin/view/javascript/jquery/jquery.fileupload.js</li>
														<li>admin/view/javascript/jquery/jquery.iframe-transport.js</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.3.1 <small class="release-date text-muted">11 May 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> Undefined index notice on download insert page</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/view/template/catalog/download_ext_form.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.3.0 <small class="release-date text-muted">09 May 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Apply button to save Product Downloads PRO settings without leaving the page</li>
														<li><em class="text-primary">New:</em> Code refactoring</li>
														<li><em class="text-success">Fixed:</em> Downloads displaying when customer group filtering was enabled</li>
														<li><em class="text-success">Fixed:</em> Download pagination count in admin when filtering</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/view/template/catalog/download_ext_list.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/controller/product/download.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/theme/default/template/product/download_header.tpl</li>
														<li>catalog/view/theme/*/template/common/header.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.2.0 <small class="release-date text-muted">23 Apr 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Administrative download tags which are not visible in the store front end</li>
														<li><em class="text-primary">New:</em> Downloaded count for free downloads</li>
														<li><em class="text-success">Fixed:</em> Download tag sorting in admin</li>
														<li><em class="text-success">Fixed:</em> Download editing giving error on filename</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/catalog/download_tag.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/catalog/download_ext.php</li>
														<li>admin/language/english/catalog/download_tag.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/model/catalog/download_tag.php</li>
														<li>admin/view/template/catalog/download_ext_directory_add_form.tpl</li>
														<li>admin/view/template/catalog/download_ext_form.tpl</li>
														<li>admin/view/template/catalog/download_ext_list.tpl</li>
														<li>admin/view/template/catalog/download_tag_form.tpl</li>
														<li>admin/view/template/catalog/download_tag_list.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/controller/product/download.php</li>
														<li>catalog/language/english/module/product_downloads.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/theme/default/template/product/download.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/view/image/loading_16.gif</li>
														<li>system/helper/product_downloads.php</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.1.1 <small class="release-date text-muted">17 Apr 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-success">Fixed:</em> PHP warning messages when the upload file size exceeds the limit set by the PHP upload_max_filesize directive</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/catalog/download_ext.php</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.1.0 <small class="release-date text-muted">17 Mar 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Option to choose extension position on product page (content top, content tab or content bottom)</li>
														<li><em class="text-success">Fixed:</em> Default values are not prefilled when adding a new language or deleted when removing a language</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/view/javascript/product.downloads.pro.js</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/view/theme/default/template/product/download_header.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>catalog/controller/module/product_downloads.php</li>
														<li>catalog/language/english/module/product_downloads.php</li>
														<li>catalog/view/theme/default/template/module/product_downloads.tpl</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 3.0.0 <small class="release-date text-muted">08 Mar 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Option to access purchased downloads from product page download tab</li>
														<li><em class="text-primary">New:</em> Option to show purchasable downloads on product page in the download tab</li>
														<li><em class="text-primary">New:</em> Optimized downloads loading</li>
														<li><em class="text-success">Fixed:</em> Downloads pagination issue</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/view/template/catalog/download_tag_form.tpl</li>
														<li>admin/view/template/catalog/download_tag_list.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/theme/default/template/product/download.tpl</li>
														<li>catalog/view/theme/default/template/product/download_header.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/view/image/pd-pro/tag.png</li>
														<li>admin/view/image/pd-pro/tag-add.png</li>
														<li>admin/view/image/pd-pro/tag-edit.png</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 2.1.0 <small class="release-date text-muted">25 Feb 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Option to load downloads without AJAX to improve SEO</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/product/download.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/theme/default/template/product/download_header.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 2.0.0 <small class="release-date text-muted">20 Feb 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li><em class="text-primary">New:</em> Batch add folder scan uses AJAX to speed up initial page load</li>
														<li><em class="text-primary">New:</em> Download status field</li>
														<li><em class="text-primary">New:</em> Download filtering in admin</li>
														<li><em class="text-primary">New:</em> Downloads can be displayed without download link to customer who are not logged in</li>
													</ul>

													<h4><i class="fa fa-pencil text-primary"></i> Files changed:</h4>

													<ul>
														<li>admin/controller/catalog/download_ext.php</li>
														<li>admin/controller/module/product_downloads.php</li>
														<li>admin/language/english/module/product_downloads.php</li>
														<li>admin/model/catalog/download_ext.php</li>
														<li>admin/model/catalog/download_tag.php</li>
														<li>admin/view/template/catalog/download_ext_directory_add_form.tpl</li>
														<li>admin/view/template/module/product_downloads.tpl</li>
														<li>catalog/controller/product/download.php</li>
														<li>catalog/model/catalog/download.php</li>
														<li>catalog/view/theme/default/template/product/download.tpl</li>
														<li>catalog/view/theme/default/template/product/download_header.tpl</li>
														<li>vqmod/xml/product_downloads.xml</li>
													</ul>

													<h4><i class="fa fa-plus text-success"></i> Files added:</h4>

													<ul>
														<li>admin/language/english/catalog/download_ext.php</li>
														<li>admin/view/template/catalog/download_ext_form.tpl</li>
														<li>admin/view/template/catalog/download_ext_list.tpl</li>
													</ul>

													<h4><i class="fa fa-minus text-danger"></i> Files removed:</h4>

													<ul>
														<li>catalog/view/theme/default/stylesheet/pd_style.css</li>
													</ul>
												</blockquote>
											</div>

											<div class="release">
												<h3>Version 1.0.0 <small class="release-date text-muted">17 Feb 2012</small></h3>

												<blockquote>
													<ul class="list-unstyled">
														<li>Initial release</li>
													</ul>
												</blockquote>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript"><!--
!function(e,o,t){var a,s={module_id:"<?php echo addslashes($pd_m_module_id); ?>",names:[],type:"<?php echo addslashes($pd_m_type); ?>",show_in_tab:parseInt("<?php echo (int)$pd_m_show_in_tab; ?>"),limit:parseInt("<?php echo (int)$pd_m_limit; ?>"),downloads_per_page:parseInt("<?php echo (int)$pd_m_downloads_per_page; ?>"),show_file_size:parseInt("<?php echo (int)$pd_m_show_file_size; ?>"),show_date_added:parseInt("<?php echo (int)$pd_m_show_date_added; ?>"),show_date_modified:parseInt("<?php echo (int)$pd_m_show_date_modified; ?>"),show_icon:parseInt("<?php echo (int)$pd_m_show_icon; ?>"),name_as_link:parseInt("<?php echo (int)$pd_m_name_as_link; ?>"),show_empty_module:parseInt("<?php echo (int)$pd_m_show_empty_module; ?>"),show_filter_tags:parseInt("<?php echo (int)$pd_m_show_filter_tags; ?>"),show_search_bar:parseInt("<?php echo (int)$pd_m_show_search_bar; ?>"),lazy_load:parseInt("<?php echo (int)$pd_m_lazy_load; ?>"),status:parseInt("<?php echo (int)$pd_m_status; ?>"),downloads:""},r=<?php echo json_encode($errors); ?>,i=<?php echo json_encode($modules); ?>,_=<?php echo json_encode($languages); ?>,d=<?php echo json_encode($customer_groups); ?>,n=<?php echo json_encode(is_array($pd_customer_groups) ? $pd_customer_groups : array()); ?>,h=<?php echo json_encode($pd_product_replace_price_with); ?>,p=<?php echo json_encode($pd_module_replace_price_with); ?>,l=<?php echo json_encode($pd_list_replace_price_with); ?>,c=<?php echo json_encode($stores); ?>;e.token="<?php echo $token; ?>",e.texts=o.extend({},e.texts,{error_ajax_request:"<?php echo addslashes($error_ajax_request); ?>",error_module_name:"<?php echo addslashes($error_module_name); ?>",error_seo_keyword:"<?php echo addslashes($error_seo_keyword); ?>",error_positive_integer:"<?php echo addslashes($error_positive_integer); ?>",error_integer:"<?php echo addslashes($error_integer); ?>",error_filetype:"<?php echo addslashes($error_filetype); ?>",default_name:"<?php echo addslashes($text_default_module_name); ?>",download_count:"<?php echo addslashes($text_download_count); ?>",downloads:"<?php echo addslashes($text_downloads); ?>",loading_chart_data:"<?php echo addslashes($text_loading_chart_data); ?>"}),e.select2Tags={tokenSeparators:[","],separator:",",initSelection:function(e,t){var a=[];o(e.val().split(",")).each(function(){a.push({id:this,text:this})}),t(a)},<?php if ($tags) { ?>tags:<?php echo $tags; ?>,<?php } else { ?>tags:[],ajax:{type:"GET",url:"<?php echo $filter; ?>",dataType:"json",cache:!1,quietMillis:150,data:function(e){return{query:e,type:"tag",token:"<?php echo $token; ?>",create:!0}},results:function(e){var t=[];return o.each(e,function(e,o){t.push({id:o.value,text:o.value})}),{results:t}}}<?php } ?>},e.select2Downloads={separator:",",<?php if ($downloads) { ?>data:<?php echo $downloads; ?>,<?php } else { ?>initSelection:function(e,t){var a=[];o(e.val().split(",")).each(function(){a.push(this)}),o.ajax({type:"GET",url:"<?php echo $filter; ?>",dataType:"json",data:{query:a,type:"download",multiple:!0,token:"<?php echo $token; ?>"}}).done(function(a){var s=[],r=[];o.each(a,function(e,o){s.push({id:o.id,text:o.value}),r.push(o.id)}),e.val(r.join(",")),t(s)})},ajax:{type:"GET",url:"<?php echo $filter; ?>",dataType:"json",cache:!1,quietMillis:150,data:function(e){return{query:e,type:"download",token:"<?php echo $token; ?>"}},results:function(e){var t=[];return o.each(e,function(e,o){t.push({id:o.id,text:o.value})}),{results:t}}}<?php } ?>};var u=e.charts={downloads:new Highcharts.Chart({chart:{renderTo:"general-downloads-chart",type:"area",showAxes:!0},title:{text:""},xAxis:{startOfWeek:1,type:"datetime",title:{text:null}},yAxis:{title:{text:e.texts.download_count},allowDecimals:!1,min:0},tooltip:{pointFormat:"<b>{point.y:,.0f}</b> "+e.texts.downloads,shared:!0},plotOptions:{area:{fillColor:"rgba(230,242,250,0.5)",marker:{enabled:!1,symbol:"circle",radius:2,states:{hover:{enabled:!0}}},shadow:!1,lineWidth:2,states:{hover:{lineWidth:2}},threshold:null}},legend:{enabled:!1},credits:{enabled:!1}}),files:new Highcharts.Chart({chart:{renderTo:"file-downloads-chart",type:"column"},title:{text:""},xAxis:{categories:[],title:{enabled:!1,text:null},labels:{rotation:-90,align:"right",y:20,style:{fontSize:"13px",fontFamily:"Verdana, sans-serif"}}},yAxis:{title:{text:e.texts.download_count},allowDecimals:!1,min:0},tooltip:{pointFormat:"<b>{point.y:,.0f}</b> "+e.texts.downloads,formatter:function(){return this.series&&this.series.xAxis&&this.series.xAxis.full_category_names&&this.series.xAxis.full_category_names[this.point.x]?'<span style="font-size: 10px">'+this.series.xAxis.full_category_names[this.point.x]+"</span><br/><b>"+this.y+" </b> "+e.texts.downloads:"<b>"+this.y+" </b> "+e.texts.downloads}},plotOptions:{column:{pointPadding:.1,borderWidth:0,dataLabels:{enabled:!0,rotation:-90,align:"left",x:4,y:-10,style:{fontSize:"13px",fontFamily:"Verdana, sans-serif"}}}},legend:{enabled:!1},credits:{enabled:!1}})},b=function(t,a){return t.showLoading(e.texts.loading_chart_data),o.getJSON("<?php echo addslashes($statistics); ?>",{type:a},function(e){if(e.categories&&e.series&&e.title){var a="undefined"!=typeof e.temporal?e.temporal:!1;t.setTitle({text:e.title});var s=[];a||(o.each(e.categories,function(e,o){s.push(o.length>15?o.slice(0,13)+"...":o)}),t.xAxis[0].setCategories(s),t.xAxis[0].full_category_names=e.categories);var r=[];o.each(e.series,function(e,o){r.push(a?[Date.parse(o.date),parseInt(o.count)]:parseInt(o))});var i={data:r,type:a?"area":"column",color:"#2f7ed8",fillColor:"rgba(230,242,250,0.5)"};t.hideLoading(),t.series.length?t.series[0].setData(r,!1):t.addSeries(i,!1),t.redraw()}})};e.load_service_list=function(e){var e=e!==t?1*e:0,s=o.Deferred();return a.service_list_loaded()&&!e||a.service_list_loading()?s.reject():(a.service_list_loading(!0),o.when(o.ajax({url:"<?php echo $services; ?>",data:{force:e},dataType:"json"})).then(function(e){a.service_list_loaded(!0),a.service_list_loading(!1),a.clearServices(),e.services&&o.each(e.services,function(e,o){var t=o.code,s=o.name,r=o.description||"",i=o.currency,_=o.price,d=o.turnaround;a.addService(t,s,r,i,_,d)}),e.rate&&o("#hourly_rate").html(e.rate),s.resolve()},function(e,o,t){a.service_list_loaded(!0),a.service_list_loading(!1),s.reject(),window.console&&window.console.log&&window.console.log("Failed to load services list: "+t)})),s.promise()};var w=function(e){isNaN(parseInt(e))||this.hasOwnProperty("minValue")&&parseInt(e)<this.minValue||this.hasOwnProperty("maxValue")&&minValue>this.maxValue?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(""))},m=function(e){!parseInt(this.root.seo_url())||e?(this.target.hasError(!1),this.target.errorMsg("")):(this.target.hasError(!0),this.target.errorMsg(this.message))},v=function(e,o,t,a,s,r){this.code=e,this.name=o,this.description=t,this.currency=a,this.price=s,this.turnaround=r},g=function(e,o){this.language_id=e,this.value=ko.observable(o)},f=function(e,o,t){this.id=e,this.name=o,this.flag=t},y=function(e,o){this.id=e,this.name=o},k=function(o,t){var a=this;this.language_id=ko.observable(o),this.name=ko.observable(t).extend({required:{message:e.texts.error_module_name,context:a}}),this.hasError=ko.computed(this.hasError,this)};k.prototype=new e.observable_object_methods;var x=function(t,a,s,r,i,_,d,n,h,p,l,c,u,b,w,m,v,g){var f=this,y={};o.each(g.languages,function(o,t){y[t.id]=a.hasOwnProperty(t.id)?a[t.id]:e.texts.default_name}),this.module_id=ko.observable(t),this.names=ko.observableArray(o.map(y,function(e,o){return new k(o,e,f)})).withIndex("language_id").extend({hasError:{check:!0,context:f},applyErrors:{context:f},updateValues:{context:f}}),this.name=ko.computed(function(){return f.names.findByKey("<?php echo $default_language; ?>").name()}),this.type=ko.observable(s),this.show_in_tab=ko.observable(r),this.limit=ko.observable(i).extend({numeric:{precision:0,context:f}}),this.downloads_per_page=ko.observable(_).extend({numeric:{precision:0,context:f},validate:{context:f}}),this.show_file_size=ko.observable(d),this.show_date_added=ko.observable(n),this.show_date_modified=ko.observable(h),this.show_icon=ko.observable(p),this.name_as_link=ko.observable(l),this.show_empty_module=ko.observable(c),this.show_filter_tags=ko.observable(u),this.show_search_bar=ko.observable(b),this.lazy_load=ko.observable(w),this.downloads=ko.observable(m),this.status=ko.observable(v),this.hasError=ko.computed(this.hasError,this)};x.prototype=new e.observable_object_methods;var $=function(){var a=this;this.languages={},o.each(_,function(e,o){a.languages[e]=new f(o.language_id,o.name,(o.hasOwnProperty("image")&&o.image)?"view/image/flags/"+o.image:"language/"+o.code+"/"+o.code+".png")}),this.validateFileType=function(e){e=e==t?this.target():e,this.target.hasError(!e&&!this.all_types()),this.target.errorMsg(this.target.hasError()?this.message:"")},this.default_language="<?php echo $default_language; ?>",this.status=ko.observable("<?php echo $pd_status; ?>"),this.seo_url=ko.observable(parseInt("<?php echo $seo_url; ?>")),this.force_download=ko.observable("<?php echo $pd_force_download; ?>"),this.require_login=ko.observable("<?php echo $pd_require_login; ?>"),this.show_login_required_text=ko.observable("<?php echo $pd_show_login_required_text; ?>"),this.add_to_previous_orders=ko.observable("<?php echo $pd_add_to_previous_orders; ?>"),this.update_previous_orders=ko.observable("<?php echo $pd_update_previous_orders; ?>"),this.delete_file_from_system=ko.observable("<?php echo $pd_delete_file_from_system; ?>"),this.remove_sql_changes=ko.observable("<?php echo $pd_remove_sql_changes; ?>"),this._sas=ko.observable(0),this._as=ko.observableArray(JSON.parse(atob("<?php echo $pd_as; ?>"))),this.as=ko.computed(function(){return btoa(JSON.stringify(a._as()))}),this.asn=ko.computed(function(){var e=[];return ko.utils.arrayForEach(a._as(),function(o){c.hasOwnProperty(o)&&e.push(c[o].name)}),e.join(", ")}),this.iasn=ko.computed(function(){var e=[];return o.map(c,function(o,t){-1==a._as().indexOf(t.toString())&&e.push(o.name)}),e.join(", ")}),this.dp_status=ko.observable("<?php echo $pd_dp_status; ?>"),this.dp_header_link=ko.observable(parseInt("<?php echo (int)$pd_dp_header_link; ?>")),this.dp_footer_link=ko.observable(parseInt("<?php echo (int)$pd_dp_footer_link; ?>")),this.dp_seo_keyword=ko.observable("<?php echo $pd_dp_seo_keyword; ?>").extend({validate:{message:e.texts.error_seo_keyword,context:a,method:m,root:a}}),this.dp_downloads_per_page=ko.observable("<?php echo (int)$pd_dp_downloads_per_page; ?>").extend({numeric:{precision:0,context:a},validate:{method:w,minValue:0,message:e.texts.error_positive_integer,context:a}}),this.dp_delay_download=ko.observable("<?php echo (int)$pd_dp_delay_download; ?>").extend({numeric:{precision:0,context:a},validate:{method:w,minValue:0,message:e.texts.error_positive_integer,context:a}}),this.dp_show_search_bar=ko.observable("<?php echo $pd_dp_show_search_bar; ?>"),this.dp_show_filter_tags=ko.observable("<?php echo $pd_dp_show_filter_tags; ?>"),this.dp_show_file_size=ko.observable("<?php echo $pd_dp_show_file_size; ?>"),this.dp_show_date_added=ko.observable("<?php echo $pd_dp_show_date_added; ?>"),this.dp_show_date_modified=ko.observable("<?php echo $pd_dp_show_date_modified; ?>"),this.dp_show_icon=ko.observable("<?php echo $pd_dp_show_icon; ?>"),this.dp_name_as_link=ko.observable("<?php echo $pd_dp_name_as_link; ?>"),this.dp_errors=ko.computed(function(){return a.dp_downloads_per_page.hasError()||a.dp_delay_download.hasError()||a.dp_seo_keyword.hasError()}),this.cadp_status=ko.observable("<?php echo $pd_cadp_status; ?>"),this.cadp_downloads_per_page=ko.observable("<?php echo (int)$pd_cadp_downloads_per_page; ?>").extend({numeric:{precision:0,context:a},validate:{method:w,minValue:0,message:e.texts.error_positive_integer,context:a}}),this.cadp_show_icon=ko.observable("<?php echo $pd_cadp_show_icon; ?>"),this.cadp_show_expired_downloads=ko.observable("<?php echo $pd_cadp_show_expired_downloads; ?>"),this.cadp_errors=ko.computed(function(){return a.cadp_downloads_per_page.hasError()}),this.gs_errors=ko.computed(function(){return a.dp_errors()||a.cadp_errors()}),this.show_free_download_count=ko.observable("<?php echo $pd_show_free_download_count; ?>"),this.require_login_free=ko.observable("<?php echo $pd_require_login_free; ?>"),this.show_download_without_link=ko.observable("<?php echo $pd_show_download_without_link; ?>"),this.add_free_downloads_to_order=ko.observable("<?php echo $pd_add_free_downloads_to_order; ?>"),this.differentiate_customers=ko.observable("<?php echo $pd_differentiate_customers; ?>"),this.customer_groups=ko.observableArray(o.map(d,function(e){return new y(e.customer_group_id,e.name)})),this.selected_customer_groups=ko.observableArray(n),this.fd_errors=ko.computed(function(){return!1}),this.show_purchased_downloads=ko.observable("<?php echo $pd_show_purchased_downloads; ?>"),this.show_downloads_remaining=ko.observable("<?php echo $pd_show_downloads_remaining; ?>"),this.show_purchasable_downloads=ko.observable("<?php echo $pd_show_purchasable_downloads; ?>"),this.require_login_regular=ko.observable("<?php echo $pd_require_login_regular; ?>"),this.rd_errors=ko.computed(function(){return!1}),this.show_sample_constraint=ko.observable("<?php echo $pd_show_sample_constraint; ?>"),this.require_login_sample=ko.observable("<?php echo $pd_require_login_sample; ?>"),this.delay_download_sample=ko.observable("<?php echo (int)$pd_delay_download_sample; ?>").extend({numeric:{precision:0,context:a},validate:{method:w,minValue:0,message:e.texts.error_positive_integer,context:a}}),this.ds_seo_keyword=ko.observable("<?php echo $pd_ds_seo_keyword; ?>").extend({validate:{message:e.texts.error_seo_keyword,context:a,method:m,root:a}}),this.ds_errors=ko.computed(function(){return a.delay_download_sample.hasError()||a.ds_seo_keyword.hasError()}),this.product_atc_action=ko.observable("<?php echo $pd_product_atc_action; ?>"),this.product_price_action=ko.observable("<?php echo $pd_product_price_action; ?>"),this.product_replace_price_with=ko.observableArray([]).withIndex("language_id"),o.each(a.languages,function(e,o){var t=h;a.product_replace_price_with.push(t.hasOwnProperty(o.id)?new g(o.id,t[o.id]):new g(o.id,""))}),this.module_atc_action=ko.observable("<?php echo $pd_module_atc_action; ?>"),this.module_price_action=ko.observable("<?php echo $pd_module_price_action; ?>"),this.module_replace_price_with=ko.observableArray([]).withIndex("language_id"),o.each(a.languages,function(e,o){var t=p;a.module_replace_price_with.push(t.hasOwnProperty(o.id)?new g(o.id,t[o.id]):new g(o.id,""))}),this.list_atc_action=ko.observable("<?php echo $pd_list_atc_action; ?>"),this.list_price_action=ko.observable("<?php echo $pd_list_price_action; ?>"),this.list_replace_price_with=ko.observableArray([]).withIndex("language_id"),o.each(a.languages,function(e,o){var t=l;a.list_replace_price_with.push(t.hasOwnProperty(o.id)?new g(o.id,t[o.id]):new g(o.id,""))}),this.hatc_errors=ko.computed(function(){return!1}),this.aa_status=ko.observable("<?php echo $pd_aa_status; ?>"),this.aa_directory=ko.observable("<?php echo addslashes($pd_aa_directory); ?>").extend({validate:{context:a}}),this.aa_constraint=ko.observable("<?php echo $pd_aa_constraint; ?>"),this.aa_duration=ko.observable("<?php echo $pd_aa_duration; ?>").extend({numeric:{precision:0,context:a},validate:{method:w,minValue:0,message:e.texts.error_positive_integer,context:a}}),this.aa_duration_unit=ko.observable("<?php echo $pd_aa_duration_unit; ?>"),this.aa_total_downloads=ko.observable("<?php echo $pd_aa_total_downloads; ?>").extend({numeric:{precision:0,context:a},validate:{method:w,minValue:-1,message:e.texts.error_integer,context:a}}),this.aa_all_types=ko.observable(parseInt("<?php echo (int)$pd_aa_all_types; ?>")),this.aa_file_types=ko.observable("<?php echo $pd_aa_file_types; ?>").extend({validate:{message:e.texts.error_filetype,method:a.validateFileType,context:a,all_types:a.aa_all_types}}),this.aa_excludes=ko.observable("<?php echo $pd_aa_excludes; ?>"),this.aa_file_tags=ko.observable("<?php echo $pd_aa_file_tags; ?>").extend({validate:{context:a},notify:"always"}),this.aa_free_download=ko.observable("<?php echo $pd_aa_free_download; ?>"),this.aa_path_to_tags=ko.observable("<?php echo $pd_aa_path_to_tags; ?>"),this.aa_recursive=ko.observable("<?php echo $pd_aa_recursive; ?>"),this.aa_login=ko.observable("<?php echo $pd_aa_login; ?>"),this.aa_sort_order=ko.observable("<?php echo $pd_aa_sort_order; ?>").extend({numeric:{precision:0,context:a}}),this.aa_download_status=ko.observable("<?php echo $pd_aa_download_status; ?>"),this.aa_errors=ko.computed(function(){return a.aa_directory.hasError()||a.aa_file_tags.hasError()||a.aa_total_downloads.hasError()}),this.aa_all_types.subscribe(function(){a.aa_file_types.validate()}),this.ba_status=ko.observable("<?php echo $pd_ba_status; ?>"),this.ba_directory=ko.observable("<?php echo addslashes($pd_ba_directory); ?>").extend({validate:{context:a}}),this.ba_constraint=ko.observable("<?php echo $pd_ba_constraint; ?>"),this.ba_duration=ko.observable("<?php echo $pd_ba_duration; ?>").extend({numeric:{precision:0,context:a},validate:{method:w,minValue:0,message:e.texts.error_positive_integer,context:a}}),this.ba_duration_unit=ko.observable("<?php echo $pd_ba_duration_unit; ?>"),this.ba_total_downloads=ko.observable("<?php echo $pd_ba_total_downloads; ?>").extend({numeric:{precision:0,context:a},validate:{method:w,minValue:-1,message:e.texts.error_integer,context:a}}),this.ba_all_types=ko.observable(parseInt("<?php echo (int)$pd_ba_all_types; ?>")),this.ba_file_types=ko.observable("<?php echo $pd_ba_file_types; ?>").extend({validate:{message:e.texts.error_filetype,method:a.validateFileType,context:a,all_types:a.ba_all_types}}),this.ba_excludes=ko.observable("<?php echo $pd_ba_excludes; ?>"),this.ba_file_tags=ko.observable("<?php echo $pd_ba_file_tags; ?>").extend({validate:{context:a}}),this.ba_free_download=ko.observable("<?php echo $pd_ba_free_download; ?>"),this.ba_path_to_tags=ko.observable("<?php echo $pd_ba_path_to_tags; ?>"),this.ba_recursive=ko.observable("<?php echo $pd_ba_recursive; ?>"),this.ba_login=ko.observable("<?php echo $pd_ba_login; ?>"),this.ba_sort_order=ko.observable("<?php echo $pd_ba_sort_order; ?>").extend({numeric:{precision:0,context:a}}),this.ba_download_status=ko.observable("<?php echo $pd_ba_download_status; ?>"),this.ba_errors=ko.computed(function(){return a.ba_directory.hasError()||a.ba_file_tags.hasError()||a.ba_total_downloads.hasError()}),this.ba_all_types.subscribe(function(){a.ba_file_types.validate()}),this.general_errors=ko.computed(function(){return a.ba_errors()||a.aa_errors()||a.hatc_errors()||a.ds_errors()||a.rd_errors()||a.fd_errors()||a.dp_errors()||a.cadp_errors()||a.gs_errors()}),a.modules=ko.observableArray(o.map(i,function(e){return new x(e.hasOwnProperty("module_id")?e.module_id:s.module_id,e.hasOwnProperty("names")?e.names:s.names,e.hasOwnProperty("type")?e.type:s.type,e.hasOwnProperty("show_in_tab")?e.show_in_tab:s.show_in_tab,e.hasOwnProperty("limit")?e.limit:s.limit,e.hasOwnProperty("downloads_per_page")?e.downloads_per_page:s.downloads_per_page,e.hasOwnProperty("show_file_size")?e.show_file_size:s.show_file_size,e.hasOwnProperty("show_date_added")?e.show_date_added:s.show_date_added,e.hasOwnProperty("show_date_modified")?e.show_date_modified:s.show_date_modified,e.hasOwnProperty("show_icon")?e.show_icon:s.show_icon,e.hasOwnProperty("name_as_link")?e.name_as_link:s.name_as_link,e.hasOwnProperty("show_empty_module")?e.show_empty_module:s.show_empty_module,e.hasOwnProperty("show_filter_tags")?e.show_filter_tags:s.show_filter_tags,e.hasOwnProperty("show_search_bar")?e.show_search_bar:s.show_search_bar,e.hasOwnProperty("lazy_load")?e.lazy_load:s.lazy_load,e.hasOwnProperty("downloads")?e.downloads:s.downloads,e.hasOwnProperty("status")?e.status:s.status,a)})).extend({hasError:{check:!0,context:a},applyErrors:{context:a},updateValues:{context:a}}),this.module_errors=ko.computed(function(){return a.modules.hasError()}),this.tabPositionUsed=ko.computed(function(){var e=!1;return ko.utils.arrayForEach(a.modules(),function(o){"1"==o.show_in_tab()&&(e=!0)}),e}),this.use_fa_icons=ko.observable("<?php echo $pd_use_fa_icons; ?>"),a.service_list_loaded=ko.observable(!1),a.service_list_loading=ko.observable(!1),a.services=ko.observableArray([]),a.addService=function(e,o,t,s,r,i){a.services.push(new v(e,o,t,s,r,i))},a.clearServices=function(){a.services.removeAll()},a.addModule=function(){a.modules.push(new x("",[],s.type,s.show_in_tab,s.limit,s.downloads_per_page,s.show_file_size,s.show_date_added,s.show_date_modified,s.show_icon,s.name_as_link,s.show_empty_module,s.show_filter_tags,s.show_search_bar,s.lazy_load,s.downloads,s.status,a))},a.deleteModule=function(e){e&&a.modules.remove(e)}};$.prototype=new e.observable_object_methods,o(function(){var t=window.location.hash,s=t.split("?")[0];a=e.view_model=new $,e.view_models=o.extend({},e.view_models,{ExtVM:e.view_model}),a.applyErrors(r),a.aa_file_types.validate(),a.ba_file_types.validate(),ko.applyBindings(a,o("#content")[0]),o("#legal_text .modal-body").load("view/static/bull5i_pd_pro_extension_terms.htm"),o("body").on("shown.bs.tab","a[data-toggle='tab'][href='#ext-support'],a[data-toggle='tab'][href='#services']",function(){e.load_service_list()}).on("keydown","#pd_status",function(e){if(e.altKey&&e.shiftKey&&e.ctrlKey&&83==e.keyCode){var o=ko.dataFor(this);o._sas(0==o._sas()?1:0)}}).on("shown.bs.tab","a[data-toggle='tab'][href='#statistics']",function(){for(key in u)u[key].reflow()}).on("click",".switch-chart",function(){var e=o(this).data("chart"),t=o(this).data("type"),a=parseInt(o(this).data("temporal"));b(u[e],t,a)}).on("click",'[data-toggle="buttons-radio"] .btn',function(){var e=!0,t=o(this).closest('[data-toggle="buttons-radio"]');t.length&&(o(this).hasClass("active")?e=!1:t.find(".active").removeClass("active")),e&&o(this).toggleClass("active")}),o.when(b(u.downloads,"daily")).pipe(b(u.files,"today_top")),e.onComplete(o("#page-overlay"),o("#content")).done(function(){e.activateTab(s)})})}(window.bull5i=window.bull5i||{},jQuery);
//--></script>
<?php echo $footer; ?>
