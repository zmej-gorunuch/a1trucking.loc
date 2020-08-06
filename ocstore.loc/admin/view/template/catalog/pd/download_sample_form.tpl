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
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_apply; ?>" data-url="<?php echo $save; ?>" id="btn-apply" data-form="#pd-form" data-context="#content" data-overlay="#page-overlay" data-vm="DSVM" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"><i class="fa fa-check"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_apply; ?></span></button>
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

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
			</div>
			<div class="panel-body">

				<form action="<?php echo $save; ?>" method="post" enctype="multipart/form-data" id="pd-form" class="form-horizontal" role="form">
					<div class="row">
						<div class="col-sm-12">
							<fieldset>
								<!-- ko if: download_sample_id -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="inputID"><?php echo $entry_id; ?></label>
									<div class="col-sm-2 col-md-1">
										<p class="form-control-static" data-bind="text: download_sample_id" id="inputID"></p>
										<input type="hidden" name="download_sample_id" data-bind="value: download_sample_id">
									</div>
									<label class="col-sm-offset-1 col-md-offset-3 col-sm-3 col-md-2 control-label" for="inputDateAdded"><?php echo $entry_date_added; ?></label>
									<div class="col-sm-3 col-md-4">
										<p class="form-control-static" data-bind="text: date_added" id="inputDateAdded"></p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-push-6 col-sm-3 col-md-2 control-label" for="inputDateModified"><?php echo $entry_date_modified; ?></label>
									<div class="col-md-push-6 col-sm-3 col-md-4">
										<p class="form-control-static" data-bind="text: date_modified" id="inputDateModified"></p>
									</div>
									<label class="col-md-pull-6 col-sm-3 col-md-2 control-label" for="inputLastAccessed"><?php echo $entry_last_accessed; ?></label>
									<div class="col-md-pull-6 col-sm-3 col-md-4">
										<p class="form-control-static" data-bind="text: last_accessed" id="inputLastAccessed"></p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="inputHash"><?php echo $entry_hash; ?></label>
									<div class="col-sm-6 col-md-5 col-lg-4">
										<p class="form-control-static" data-bind="text: hash" id="inputHash"></p>
										<input type="hidden" name="hash" data-bind="value: hash">
									</div>
								</div>
								<!-- /ko -->
								<div class="form-group has-feedback" data-bind="css: {'has-success': download_id(), 'has-warning': !download_id() && download(), 'has-error': download.hasError}">
									<label class="col-sm-3 col-md-2 control-label required" data-bind="attr: {for: 'download'}"><?php echo $entry_download; ?></label>
									<div class="col-sm-6 col-md-5 col-lg-4">
										<input data-bind="attr: {name: 'download_name', id: 'download'}" class="form-control typeahead downloads" placeholder="<?php echo $text_autocomplete; ?>" autocomplete="off">
										<!-- ko if: !download.hasError() && download_id() -->
										<span class="fa fa-check form-control-feedback"></span>
										<!-- /ko -->
										<!-- ko if: !download.hasError() && !download_id() && download() -->
										<span class="fa fa-warning form-control-feedback"></span>
										<!-- /ko -->
										<!-- ko if: download.hasError() -->
										<span class="fa fa-times form-control-feedback"></span>
										<!-- /ko -->
										<input type="hidden" data-bind="attr: {name: 'download_id'}, value: download_id">
										<input type="hidden" data-bind="attr: {name: 'download'}, value: download">
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: download.hasError && download.errorMsg">
										<span class="help-block error-text" data-bind="text: download.errorMsg"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="constraint"><?php echo $entry_constraint; ?></label>
									<div class="col-sm-4 fc-auto-width">
										<select name="constraint" id="constraint" data-bind="value: constraint" class="form-control">
											<option value="0"><?php echo $text_quantitative; ?></option>
											<option value="1"><?php echo $text_temporal; ?></option>
											<option value="2"><?php echo $text_both; ?></option>
										</select>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: constraint() == '0'">
										<span class="help-block help-text"><?php echo $help_quantitative; ?></span>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: constraint() == '1'">
										<span class="help-block help-text"><?php echo $help_temporal; ?></span>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container" data-bind="visible: constraint() == '2'">
										<span class="help-block help-text"><?php echo $help_limit_both; ?></span>
									</div>
								</div>
								<div class="form-group has-feedback" data-bind="css: {'has-error': remaining.hasError}, visible: constraint() != '1'">
									<label class="col-sm-3 col-md-2 control-label required" for="remaining"><?php echo $entry_remaining; ?></label>
									<div class="col-sm-2">
										<input type="text" name="remaining" id="remaining" data-bind="value: remaining" class="form-control">
										<!-- ko if: remaining.hasError -->
										<span class="fa fa-times form-control-feedback"></span>
										<!-- /ko -->
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: remaining.hasError && remaining.errorMsg">
										<span class="help-block error-text" data-bind="text: remaining.errorMsg"></span>
									</div>
								</div>
								<div class="form-group has-feedback" data-bind="visible: constraint() != '0'">
									<label class="col-sm-3 col-md-2 control-label required" for="expiration_type" data-bind="css: {'has-error': expiration_type() == '0' && duration.hasError || expiration_type() == '1' && end_time.hasError}"><?php echo $entry_expiration; ?></label>
									<div class="col-sm-3 col-md-3 col-lg-2">
										<select name="expiration_type" id="expiration_type" data-bind="value: expiration_type" class="form-control">
											<option value="0"><?php echo $text_duration; ?></option>
											<option value="1"><?php echo $text_date_and_time; ?></option>
										</select>
									</div>
									<!-- ko if: expiration_type() == '0' -->
									<div class="col-sm-2 col-md-1" data-bind="css: {'has-error': duration.hasError}">
										<input type="text" name="duration" id="duration" data-bind="value: duration" class="form-control">
										<!-- ko if: duration.hasError -->
										<span class="fa fa-times form-control-feedback"></span>
										<!-- /ko -->
										<input type="hidden" name="end_time" data-bind="value: computed_end_time" class="form-control">
									</div>
									<div class="col-sm-3 col-md-2">
										<select name="duration_unit" id="duration_unit" data-bind="value: duration_unit" class="form-control">
											<option value="60"><?php echo $text_minutes; ?></option>
											<option value="3600"><?php echo $text_hours; ?></option>
											<option value="86400"><?php echo $text_days; ?></option>
											<option value="604800"><?php echo $text_weeks; ?></option>
										</select>
									</div>
									<div class="col-sm-offset-3 col-md-offset-0 col-sm-6 col-md-4 col-lg-5" data-bind="visible: computed_local_end_time() != ''">
										<p class="form-control-static text-info" data-bind="text: computed_local_end_time"></p>
									</div>
									<div class="clearfix"></div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: duration.hasError && duration.errorMsg, css: {'has-error': duration.hasError}">
										<span class="help-block error-text" data-bind="text: duration.errorMsg"></span>
									</div>
									<!-- /ko -->
									<!-- ko if: expiration_type() == '1' -->
									<div class="col-sm-4 col-md-3" data-bind="css: {'has-error': end_time.hasError}">
										<span class="input-group">
											<span class="input-group-btn">
												<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
											<input type="text" id="end_time" data-bind="datetimepicker:{picDate: true, pickTime: true, useSeconds: true, format: 'YYYY-MM-DD HH:mm:ss'}, value: end_time" class="form-control">
										</span>
										<!-- ko if: end_time.hasError -->
										<span class="fa fa-times form-control-feedback"></span>
										<!-- /ko -->
										<input type="hidden" name="end_time" data-bind="value: computed_end_time" class="form-control">
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: end_time.hasError && end_time.errorMsg, css: {'has-error': end_time.hasError}">
										<span class="help-block error-text" data-bind="text: end_time.errorMsg"></span>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_end_time; ?></span>
									</div>
									<!-- /ko -->
								</div>
								<!-- ko if: store_count > 1 -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="store_id"><?php echo $entry_store; ?></label>
									<div class="col-sm-4 fc-auto-width">
										<select name="store_id" id="store_id" data-bind="value: store_id" class="form-control">
											<?php foreach ($stores as $sid => $s) { ?>
											<option value="<?php echo $sid; ?>"><?php echo $s['name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<!-- /ko -->
								<!-- ko if: store_count == 1 -->
								<input type="hidden" name="store_id" data-bind="value: store_id">
								<!-- /ko -->
								<div class="form-group has-feedback" data-bind="css: {'has-success': customer_id()}">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'customer'}"><?php echo $entry_customer; ?></label>
									<div class="col-sm-5 col-md-4 col-lg-3">
										<input data-bind="attr: {name: 'customer', id: 'customer'}" class="form-control typeahead customers" placeholder="<?php echo $text_autocomplete; ?>" autocomplete="off">
										<!-- ko if: customer_id() -->
										<span class="fa fa-check form-control-feedback"></span>
										<!-- /ko -->
										<input type="hidden" data-bind="attr: {name: 'customer_id'}, value: customer_id">
										<input type="hidden" data-bind="attr: {name: 'customer_email'}, value: customer_email">
									</div>
								</div>
								<div class="form-group has-feedback" data-bind="css: {'has-error': name.hasError}">
									<label class="col-sm-3 col-md-2 control-label required" for="name"><?php echo $entry_name; ?></label>
									<div class="col-sm-5 col-md-4 col-lg-3">
										<input type="text" name="name" id="name" data-bind="value: name" class="form-control">
										<!-- ko if: name.hasError -->
										<span class="fa fa-times form-control-feedback"></span>
										<!-- /ko -->
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: name.hasError && name.errorMsg">
										<span class="help-block error-text" data-bind="text: name.errorMsg"></span>
									</div>
								</div>
								<div class="form-group has-feedback" data-bind="css: {'has-error': email.hasError}">
									<label class="col-sm-3 col-md-2 control-label required" for="email"><?php echo $entry_email; ?></label>
									<div class="col-sm-5 col-md-4 col-lg-3">
										<input type="text" name="email" id="email" data-bind="value: email" class="form-control">
										<!-- ko if: email.hasError -->
										<span class="fa fa-times form-control-feedback"></span>
										<!-- /ko -->
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: email.hasError && email.errorMsg">
										<span class="help-block error-text" data-bind="text: email.errorMsg"></span>
									</div>
								</div>
								<!-- ko if: language_count > 1 -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="language_id"><?php echo $entry_language; ?></label>
									<div class="col-sm-4 fc-auto-width">
										<select name="language_id" id="language_id" data-bind="value: language_id" class="form-control">
											<?php foreach ($languages as $lid => $l) { ?>
											<option value="<?php echo $lid; ?>"><?php echo $l['name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_language; ?></span>
									</div>
								</div>
								<!-- /ko -->
								<!-- ko if: language_count == 1 -->
								<input type="hidden" name="language_id" data-bind="value: language_id">
								<!-- /ko -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="send_sample_email"><?php echo $entry_send_sample_email; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="send_sample_email" id="send_sample_email1" value="1" data-bind="checked: send_sample_email"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="send_sample_email" id="send_sample_email0" value="0" data-bind="checked: send_sample_email"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_send_sample_link; ?></span>
									</div>
								</div>
							<fieldset>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript"><!--
!function(e,t,o){var a=<?php echo json_encode($errors); ?>;e.texts=t.extend({},e.texts,{error_ajax_request:"<?php echo addslashes($error_ajax_request); ?>",error_name:"<?php echo addslashes($error_name); ?>",error_email:"<?php echo addslashes($error_email); ?>",error_date_time:"<?php echo addslashes($error_date_time); ?>",error_positive_integer:"<?php echo addslashes($error_positive_integer); ?>"});var s=new Bloodhound({<?php if (isset($typeahead['downloads']['prefetch'])) { ?>prefetch:"<?php echo $typeahead['downloads']['prefetch']; ?>",<?php }; if (isset($typeahead['downloads']['remote'])) { ?>remote:"<?php echo $typeahead['downloads']['remote']; ?>",<?php } ?>datumTokenizer:Bloodhound.tokenizers.obj.whitespace("value"),queryTokenizer:Bloodhound.tokenizers.whitespace,dupDetector:function(e,t){return e.id&&t.id&&e.id==t.id},limit:10});s.initialize();var r=new Bloodhound({<?php if (isset($typeahead['customers']['prefetch'])) { ?>prefetch:"<?php echo $typeahead['customers']['prefetch']; ?>",<?php }; if (isset($typeahead['customers']['remote'])) { ?>remote:"<?php echo $typeahead['customers']['remote']; ?>",<?php } ?>datumTokenizer:Bloodhound.tokenizers.obj.whitespace("value"),queryTokenizer:Bloodhound.tokenizers.whitespace,dupDetector:function(e,t){return e.id&&t.id&&e.id==t.id},limit:10});r.initialize();var i=function(e){isNaN(parseInt(e))||parseInt(e)<=0?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(""))},d=function(e){this.min_length!=o&&e.length<this.min_length||this.max_length!=o&&e.length>this.max_length?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(""))},h=function(e){var t=moment.utc(e,"YYYY-MM-DD HH:mm:ss",!0);t.isValid()?(this.target.hasError(!1),this.target.errorMsg("")):(this.target.hasError(!0),this.target.errorMsg(this.message))},n=function(e){var t=new RegExp("^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$");t.test(e)?(this.target.hasError(!1),this.target.errorMsg("")):(this.target.hasError(!0),this.target.errorMsg(this.message))},m=function(){var o=this;this.language_count=parseInt("<?php echo count($languages); ?>"),this.store_count=parseInt("<?php echo count($stores); ?>"),this.download_sample_id=ko.observable("<?php echo $download_sample_id; ?>"),this.store_id=ko.observable("<?php echo $store_id; ?>"),this.hash=ko.observable("<?php echo $hash; ?>"),this.download_id=ko.observable("<?php echo $download_id; ?>"),this.download=ko.observable("<?php echo addslashes(html_entity_decode($download)); ?>").extend({validate:{context:o}}),this.date_added=ko.observable(moment.utc("<?php echo addslashes($date_added); ?>","YYYY-MM-DD HH:mm:ss").local().isValid()?moment.utc("<?php echo addslashes($date_added); ?>","YYYY-MM-DD HH:mm:ss").local().format("YYYY-MM-DD HH:mm:ss"):"0000-00-00 00:00:00"),this.date_modified=ko.observable(moment.utc("<?php echo addslashes($date_modified); ?>","YYYY-MM-DD HH:mm:ss").local().isValid()?moment.utc("<?php echo addslashes($date_modified); ?>","YYYY-MM-DD HH:mm:ss").local().format("YYYY-MM-DD HH:mm:ss"):"0000-00-00 00:00:00"),this.last_accessed=ko.observable(moment.utc("<?php echo addslashes($last_accessed); ?>","YYYY-MM-DD HH:mm:ss").local().isValid()?moment.utc("<?php echo addslashes($last_accessed); ?>","YYYY-MM-DD HH:mm:ss").local().format("YYYY-MM-DD HH:mm:ss"):"0000-00-00 00:00:00"),this.constraint=ko.observable("<?php echo $constraint; ?>"),this.remaining=ko.observable("<?php echo addslashes($remaining); ?>").extend({numeric:{precision:0,context:o},validate:{message:e.texts.error_positive_integer,context:o,method:i}}),this.expiration_type=ko.observable("<?php echo $expiration_type; ?>"),this.duration=ko.observable("<?php echo $duration; ?>").extend({numeric:{precision:0,context:o},validate:{message:e.texts.error_positive_integer,context:o,method:i}}),this.duration_unit=ko.observable("<?php echo $duration_unit; ?>"),this.end_time=ko.observable(moment.utc("<?php echo $end_time; ?>","YYYY-MM-DD HH:mm:ss").local().isValid()?moment.utc("<?php echo $end_time; ?>","YYYY-MM-DD HH:mm:ss").local().format("YYYY-MM-DD HH:mm:ss"):"0000-00-00 00:00:00").extend({validate:{message:e.texts.error_date_time,context:o,method:h}}),this.language_id=ko.observable("<?php echo $language_id; ?>"),this.send_sample_email=ko.observable("<?php echo $send_sample_email; ?>"),this.computed_local_end_time=ko.computed(function(){return 0==o.expiration_type()?o.duration.hasError()?"":moment().add(parseInt(o.duration())*parseInt(o.duration_unit()),"s").format("YYYY-MM-DD HH:mm:ss"):o.end_time.hasError()?"":moment(o.end_time(),"YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD HH:mm:ss")}),this.computed_end_time=ko.computed(function(){return 0==o.expiration_type()?o.duration.hasError()?"0000-00-00 00:00:00":moment().add(parseInt(o.duration())*parseInt(o.duration_unit()),"s").utc().format("YYYY-MM-DD HH:mm:ss"):o.end_time.hasError()?"0000-00-00 00:00:00":moment(o.end_time(),"YYYY-MM-DD HH:mm:ss").utc().format("YYYY-MM-DD HH:mm:ss")}),this.customer_id=ko.observable("<?php echo $customer_id; ?>"),this.customer=ko.observable("<?php echo $customer; ?>"),this.customer_email=ko.observable("<?php echo $customer_email; ?>"),this.name=ko.observable("<?php echo $name; ?>").extend({validate:{message:e.texts.error_name,context:o,method:d,min_length:1,max_length:64}}),this.email=ko.observable("<?php echo $email; ?>").extend({validate:{message:e.texts.error_email,context:o,method:n}}),o.email.subscribe(function(e){e!=o.customer_email()&&(t(".customers.typeahead.tt-input").typeahead("val",""),o.customer(""),o.customer_email(""),o.customer_id(""))})};m.prototype=new e.observable_object_methods,t(function(){DSVM=e.view_model=new m,e.view_models=t.extend({},e.view_models,{DSVM:e.view_model}),DSVM.applyErrors(a),ko.applyBindings(DSVM,t("#content")[0]),t(".downloads.typeahead").typeahead({autoselect:!0,highlight:!0},{name:"downloads",limit:10,source:s.ttAdapter(),templates:{empty:'<div class="tt-no-suggestion"><?php echo addslashes($text_no_records_found); ?></div>',suggestion:Handlebars.compile('<p><span class="tt-nowrap">{{value}}</span></p>')}}).on("typeahead:selected typeahead:autocompleted",function(e,o){{var a=ko.dataFor(this);t(this).data("method")}a.download_id(o.id),a.download(o.value)}).on("typeahead:closed blur",function(){var e=ko.dataFor(this),o=t(this).typeahead("val");""==o?(e.download_id(""),e.download("")):o!=e.download()&&e.download_id("")}),t(".customers.typeahead").typeahead({autoselect:!0,highlight:!0},{name:"customers",limit:10,source:r.ttAdapter(),templates:{empty:'<div class="tt-no-suggestion"><?php echo addslashes($text_no_records_found); ?></div>',suggestion:Handlebars.compile('<p>{{value}} <small class="text-muted">&lt;{{email}}&gt;</small></p>')}}).on("typeahead:selected typeahead:autocompleted",function(e,t){var o=ko.dataFor(this);o.customer_id(t.id),o.customer(t.value),o.customer_email(t.email),o.email(t.email),o.name(t.value)}).on("typeahead:closed blur",function(){var e=ko.dataFor(this),o=t(this).typeahead("val");(o!=e.customer()||e.email()!=e.customer_email())&&(t(this).typeahead("val",""),e.customer_id(""),e.customer(""),e.customer_email(""))}),t(".customers.typeahead.tt-input").typeahead("val",DSVM.customer()),t(".downloads.typeahead.tt-input").typeahead("val",DSVM.download()),e.onComplete(t("#page-overlay"),t("#content"))})}(window.bull5i=window.bull5i||{},jQuery);
//--></script>
<?php echo $footer; ?>
