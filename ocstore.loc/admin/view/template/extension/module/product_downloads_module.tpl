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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> <?php echo $button_cancel; ?></button>
				<button type="button" class="btn btn-danger delete"><i class="fa fa-trash-o"></i> <?php echo $button_delete; ?></button>
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
							<h1 class="bull5i-navbar-brand"><i class="fa fa-files-o fa-fw ext-icon"></i> <?php echo $heading_title; ?></h1>
						</div>
						<div class="collapse navbar-collapse" id="bull5i-navbar-collapse">
							<div class="nav navbar-nav btn-group navbar-right">
								<button type="button" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_apply; ?>" class="btn btn-success" id="btn-apply" data-url="<?php echo $save; ?>" data-form="#sForm" data-context="#content" data-vm="ModuleVM" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"><i class="fa fa-check"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_apply; ?></span></button>
								<button type="submit" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_save; ?>" class="btn btn-primary" id="btn-save" data-url="<?php echo $save; ?>" data-form="#sForm" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"><i class="fa fa-save"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_save; ?></span></button>
								<button type="button" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_delete; ?>" class="btn btn-danger" id="btn-delete" data-url="<?php echo $delete; ?>" data-form="#sForm" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_deleting; ?></span>"><i class="fa fa-trash-o"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_delete; ?></span></button>
								<a href="<?php echo $cancel; ?>" class="btn btn-default" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_cancel; ?>" id="btn-cancel" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_canceling; ?></span>"><i class="fa fa-ban"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_cancel; ?></span></a>
								<a href="<?php echo $general_settings; ?>" class="btn btn-default btn-nav-link" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_general_settings; ?>" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_opening; ?></span>"><i class="fa fa-cog"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_general_settings; ?></span></a>
							</div>
						</div>

					</div>
				</nav>
			</div>
		</div>
	</div>

	<div class="alerts">
		<div class="container-fluid" id="alerts">
			<?php foreach ($alerts as $_type => $_alerts) { ?>
				<?php foreach ((array)$_alerts as $alert) { ?>
					<?php if ($alert) { ?>
			<div class="alert alert-<?php echo ($_type == "error") ? "danger" : $_type; ?> fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa <?php echo $alert_icon($_type); ?>"></i><?php echo $alert; ?>
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
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-pencil fa-fw"></i> <?php echo $text_edit_module; ?></h3></div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<!-- ko if: type() == 'product' -->
							<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<i class="fa fa-info-circle"></i> <?php echo $text_product_layout; ?>
							</div>
							<!-- /ko -->
							<fieldset>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'name<?php echo $default_language; ?>'}, css: {'has-error': names.hasError}"><?php echo $entry_name; ?></label>
									<!-- ko foreach: names -->
									<div class="col-sm-6 col-md-6 col-lg-5" data-bind="css: {'multi-row col-sm-offset-3 col-md-offset-2': $index() != 0, 'has-error': name.hasError}">
										<div class="input-group">
											<span class="input-group-addon" data-bind="attr: {title: $root.languages[language_id()].name}, tooltip: {title:$root.languages[language_id()].name}"><img data-bind="attr: {src: $root.languages[language_id()].flag, title: $root.languages[language_id()].name}" /></span>
											<input data-bind="attr: {name: 'names[' + language_id() + ']', id: 'name' + language_id()}, value: name" class="form-control">
										</div>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 has-error" data-bind="visible: name.hasError">
										<span class="help-block" data-bind="text: name.errorMsg"></span>
									</div>
									<!-- /ko -->
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'type'}"><?php echo $entry_type; ?></label>
									<div class="col-sm-3 col-md-2 fc-auto-width">
										<select data-bind="attr: {name: 'type', id: 'type'}, value: type" class="form-control">
											<option value="product"><?php echo $text_product_downloads; ?></option>
											<option value="custom"><?php echo $text_custom_downloads; ?></option>
											<option value="free"><?php echo $text_noncommercial_downloads; ?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'show_in_tab'}"><?php echo $entry_show_in_tab; ?></label>
									<div class="col-sm-3 col-md-2 fc-auto-width">
										<select data-bind="attr: {name: 'show_in_tab', id: 'show_in_tab'}, value: show_in_tab, disable: type() != 'product'" class="form-control">
											<option value="0"><?php echo $text_no; ?></option>
											<!-- ko if: !tab_position_used() || show_in_tab() == '1' --><option value="1"><?php echo $text_yes; ?></option><!-- /ko -->
										</select>
										<!-- ko if: type() != 'product' -->
										<input type="hidden" data-bind="attr: {name: 'show_in_tab'}, value: show_in_tab" />
										<!-- /ko -->
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_show_in_tab; ?></span>
									</div>
								</div>
								<div class="form-group" data-bind="css: {'has-error': downloads_per_page.hasError}">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'downloads_per_page'}"><?php echo $entry_downloads_per_page; ?></label>
									<div class="col-sm-2 col-lg-1">
										<input data-bind="attr: {name: 'downloads_per_page', id: 'downloads_per_page'}, value: downloads_per_page" class="form-control text-right">
									</div>
									<div class="has-error" data-bind="visible: downloads_per_page.hasError && downloads_per_page.errorMsg">
										<span class="help-block" data-bind="text: downloads_per_page.errorMsg"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'limit'}"><?php echo $entry_limit; ?></label>
									<div class="col-sm-2 col-lg-1">
										<input data-bind="attr: {name: 'limit', id: 'limit'}, value: limit" class="form-control text-right">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'show_empty_module0'}"><?php echo $entry_show_empty_module; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="show_empty_module" id="show_empty_module1" value="1" data-bind="checked: show_empty_module"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="show_empty_module" id="show_empty_module0" value="0" data-bind="checked: show_empty_module"> <?php echo $text_no; ?>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'show_search_bar0'}"><?php echo $entry_show_search_bar; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="show_search_bar" id="show_search_bar1" value="1" data-bind="checked: show_search_bar"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="show_search_bar" id="show_search_bar0" value="0" data-bind="checked: show_search_bar"> <?php echo $text_no; ?>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'show_filter_tags0'}"><?php echo $entry_show_filter_tags; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="show_filter_tags" id="show_filter_tags1" value="1" data-bind="checked: show_filter_tags"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="show_filter_tags" id="show_filter_tags0" value="0" data-bind="checked: show_filter_tags"> <?php echo $text_no; ?>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'show_file_size0'}"><?php echo $entry_show_file_size; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="show_file_size" id="show_file_size1" value="1" data-bind="checked: show_file_size"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="show_file_size" id="show_file_size0" value="0" data-bind="checked: show_file_size"> <?php echo $text_no; ?>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'show_date_added0'}"><?php echo $entry_show_date_added; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="show_date_added" id="show_date_added1" value="1" data-bind="checked: show_date_added"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="show_date_added" id="show_date_added0" value="0" data-bind="checked: show_date_added"> <?php echo $text_no; ?>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'show_date_modified0'}"><?php echo $entry_show_date_modified; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="show_date_modified" id="show_date_modified1" value="1" data-bind="checked: show_date_modified"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="show_date_modified" id="show_date_modified0" value="0" data-bind="checked: show_date_modified"> <?php echo $text_no; ?>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'show_icon0'}"><?php echo $entry_show_icon; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="show_icon" id="show_icon1" value="1" data-bind="checked: show_icon"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="show_icon" id="show_icon0" value="0" data-bind="checked: show_icon"> <?php echo $text_no; ?>
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'name_as_link0'}"><?php echo $entry_name_as_link; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="name_as_link" id="name_as_link1" value="1" data-bind="checked: name_as_link"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="name_as_link" id="name_as_link0" value="0" data-bind="checked: name_as_link"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_name_as_link; ?></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" data-bind="attr: {for: 'lazy_load'}"><?php echo $entry_lazy_load; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="lazy_load" id="lazy_load1" value="1" data-bind="checked: lazy_load"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="lazy_load" id="lazy_load0" value="0" data-bind="checked: lazy_load"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_lazy_load; ?></span>
									</div>
								</div>
								<!-- ko if: type() == 'custom' -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="downloads"><?php echo $entry_downloads; ?></label>
									<div class="col-sm-9 col-md-10">
										<input type="hidden" data-bind="attr: {name: 'downloads', id: 'downloads'}, value: downloads, select2: { minimumInputLength: 1, multiple: true, placeholder: '<?php echo $text_add_download; ?>' }, select2Params: bull5i.select2Downloads" class="form-control">
									</div>
								</div>
								<!-- /ko -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="status"><?php echo $entry_status; ?></label>
									<div class="col-sm-2 fc-auto-width">
										<select name="status" id="status" data-bind="value: status" class="form-control">
											<option value="1"><?php echo $text_enabled; ?></option>
											<option value="0"><?php echo $text_disabled; ?></option>
										</select>
										<input type="hidden" data-bind="attr: {name: 'name'}, value: name() + (show_in_tab() == '1' ? ' (Tab)' : '')">
										<input type="hidden" data-bind="attr: {name: 'module_id'}, value: module_id">
									</div>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript"><!--
!function(e,o){var a,t=<?php echo json_encode($errors); ?>,s=<?php echo json_encode($languages); ?>,h=<?php echo json_encode($names); ?>;e.texts=o.extend({},e.texts,{error_ajax_request:"<?php echo addslashes($error_ajax_request); ?>",error_module_name:"<?php echo addslashes($error_module_name); ?>",error_positive_integer:"<?php echo addslashes($error_positive_integer); ?>",default_name:"<?php echo addslashes($text_default_module_name); ?>"}),e.select2Downloads={separator:",",<?php if ($downloads) { ?>data:<?php echo $downloads; ?>,<?php } else { ?>initSelection:function(e,a){var t=[];o(e.val().split(",")).each(function(){t.push(this)}),o.ajax({type:"GET",url:"<?php echo $filter; ?>",dataType:"json",data:{query:t,type:"download",multiple:!0,token:"<?php echo $token; ?>"}}).done(function(t){var s=[],h=[];o.each(t,function(e,o){s.push({id:o.id,text:o.value}),h.push(o.id)}),e.val(h.join(",")),a(s)})},ajax:{type:"GET",url:"<?php echo $filter; ?>",dataType:"json",cache:!1,quietMillis:150,data:function(e){return{query:e,type:"download",token:"<?php echo $token; ?>"}},results:function(e){var a=[];return o.each(e,function(e,o){a.push({id:o.id,text:o.value})}),{results:a}}}<?php } ?>};var n=function(e,o,a){this.id=e,this.name=o,this.flag=a},i=function(o,a){var t=this;this.language_id=ko.observable(o),this.name=ko.observable(a).extend({required:{message:e.texts.error_module_name,context:t}}),this.hasError=ko.computed(this.hasError,this)};i.prototype=new e.observable_object_methods;var r=function(){var a=this,t={};this.languages={},o.each(s,function(o,s){a.languages[o]=new n(s.language_id,s.name,(s.hasOwnProperty("image")&&s.image)?"view/image/flags/"+s.image:"language/"+s.code+"/"+s.code+".png"),t[s.language_id]=h.hasOwnProperty(s.language_id)?h[s.language_id]:e.texts.default_name}),this.module_id=ko.observable("<?php echo $module_id; ?>"),this.names=ko.observableArray(o.map(t,function(e,o){return new i(o,e,a)})).withIndex("language_id").extend({hasError:{check:!0,context:a},applyErrors:{context:a},updateValues:{context:a}}),this.name=ko.computed(function(){return a.names.findByKey("<?php echo $default_language; ?>").name()}),this.type=ko.observable("<?php echo $type; ?>"),this.show_in_tab=ko.observable("<?php echo $show_in_tab; ?>"),this.limit=ko.observable("<?php echo $limit; ?>").extend({numeric:{precision:0,context:a}}),this.downloads_per_page=ko.observable("<?php echo $downloads_per_page; ?>").extend({numeric:{precision:0,context:a}}),this.show_file_size=ko.observable("<?php echo $show_file_size; ?>"),this.show_date_added=ko.observable("<?php echo $show_date_added; ?>"),this.show_date_modified=ko.observable("<?php echo $show_date_modified; ?>"),this.show_icon=ko.observable("<?php echo $show_icon; ?>"),this.name_as_link=ko.observable("<?php echo $name_as_link; ?>"),this.show_empty_module=ko.observable("<?php echo $show_empty_module; ?>"),this.show_filter_tags=ko.observable("<?php echo $show_filter_tags; ?>"),this.show_search_bar=ko.observable("<?php echo $show_search_bar; ?>"),this.lazy_load=ko.observable("<?php echo $lazy_load; ?>"),this.downloads=ko.observable("<?php echo $m_downloads; ?>"),this.status=ko.observable("<?php echo $status; ?>"),this.tab_position_used=ko.observable(parseInt("<?php echo $tab_position_used; ?>"))};r.prototype=new e.observable_object_methods,o(function(){a=e.view_model=new r,e.view_models=o.extend({},e.view_models,{ModuleVM:e.view_model}),a.applyErrors(t),ko.applyBindings(a,o("#content")[0]),e.onComplete(o("#page-overlay"),o("#content"))})}(window.bull5i=window.bull5i||{},jQuery);
//--></script>
<?php echo $footer; ?>
