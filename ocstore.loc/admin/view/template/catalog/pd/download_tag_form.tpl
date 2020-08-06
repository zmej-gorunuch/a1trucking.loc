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
							<h1 class="bull5i-navbar-brand"><i class="fa fa-tag fa-fw ext-icon"></i> <?php echo $heading_title; ?></h1>
						</div>
						<div class="collapse navbar-collapse" id="bull5i-navbar-collapse">
							<div class="nav navbar-nav navbar-btn btn-group navbar-right">
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_apply; ?>" data-url="<?php echo $save; ?>" id="btn-apply" data-form="#pd-form" data-context="#content" data-overlay="#page-overlay" data-vm="DTVM" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_saving; ?></span>"><i class="fa fa-check"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_apply; ?></span></button>
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
								<!-- ko if: download_tag_id -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="inputID"><?php echo $entry_id; ?></label>
									<div class="col-sm-2 col-md-1">
										<p class="form-control-static" data-bind="text: download_tag_id" id="inputID"></p>
										<input type="hidden" name="download_tag_id" data-bind="value: download_tag_id">
									</div>
								</div>
								<!-- /ko -->
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label required" data-bind="attr: {for: 'name<?php echo $default_language; ?>'}, css: {'has-error': descriptions.hasError}"><?php echo $entry_name; ?></label>
									<div class="col-sm-6 col-md-5 col-lg-4">
									<!-- ko foreach: descriptions -->
										<div data-bind="css: {'multi-row': $index() != 0, 'has-error': name.hasError}">
											<div class="input-group">
												<span class="input-group-addon" data-bind="attr: {title: $root.languages[language_id()].name}, tooltip: {}"><img data-bind="attr: {src: $root.languages[language_id()].flag, title: $root.languages[language_id()].name}" /></span>
												<input data-bind="attr: {name: 'descriptions[' + language_id() + '][name]', id: 'name' + language_id()}, value: name" class="form-control">
											</div>
										</div>
										<div class="has-error" data-bind="visible: name.hasError && name.errorMsg">
											<span class="help-block" data-bind="text: name.errorMsg"></span>
										</div>
									<!-- /ko -->
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="administrative0"><?php echo $entry_administrative; ?></label>
									<div class="col-sm-9 col-md-10">
										<label class="radio-inline">
											<input type="radio" name="administrative" id="administrative1" value="1" data-bind="checked: administrative"> <?php echo $text_yes; ?>
										</label>
										<label class="radio-inline">
											<input type="radio" name="administrative" id="administrative0" value="0" data-bind="checked: administrative"> <?php echo $text_no; ?>
										</label>
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 help-container">
										<span class="help-block help-text"><?php echo $help_administrative; ?></span>
									</div>
								</div>
								<div class="form-group" data-bind="css: {'has-error': sort_order.hasError}">
									<label class="col-sm-3 col-md-2 control-label" for="sort_order"><?php echo $entry_sort_order; ?></label>
									<div class="col-sm-3 col-md-2 col-lg-1">
										<input type="text" name="sort_order" id="sort_order" data-bind="value: sort_order" class="form-control text-right">
									</div>
									<div class="col-sm-offset-3 col-md-offset-2 col-sm-9 col-md-10 error-container" data-bind="visible: sort_order.hasError && sort_order.errorMsg">
										<span class="help-block error-text" data-bind="text: sort_order.errorMsg"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 col-md-2 control-label" for="selected_downloads"><?php echo $entry_related; ?></label>
									<div class="col-sm-9 col-md-10">
										<div class="radio">
											<label>
												<input type="radio" value="1" name="link_to" id="all_downloads" data-bind="checked: link_to"> <?php echo $text_all_downloads; ?>
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" value="0" name="link_to" id="selected_downloads" data-bind="checked: link_to"> <?php echo $text_selected_downloads; ?>
											</label>
										</div>
										<div class="row">
											<div class="col-sm-6 col-md-5 col-lg-4">
												<input class="form-control typeahead downloads" placeholder="<?php echo $text_autocomplete; ?>" autocomplete="off" data-method="addSelected">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-8 col-lg-6 multi-row">
												<div class="well well-sm well-scroll-box form-control" data-bind="css: {disabled: link_to() != '0'}">
												<!-- ko foreach: related_downloads -->
													<div>
														<button type="button" data-bind="click: $parent.removeSelected, tooltip: {}" class="btn btn-link btn-xs" data-original-title="<?php echo $text_remove; ?>"><i class="fa fa-minus-circle text-danger"></i></button>
														<!-- ko text: name --><!-- /ko -->
														<input type="hidden" data-bind="attr: {name: 'related_downloads[' + $index() + '][download_id]'}, value: id" />
														<input type="hidden" data-bind="attr: {name: 'related_downloads[' + $index() + '][name]'}, value: name" />
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
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript"><!--
!function(e,o){var t=<?php echo json_encode($languages); ?>,a=<?php echo json_encode($errors); ?>,r=<?php echo json_encode($descriptions); ?>,s=<?php echo json_encode($related_downloads); ?>;e.texts=o.extend({},e.texts,{error_ajax_request:"<?php echo addslashes($error_ajax_request); ?>",error_name:"<?php echo addslashes($error_name); ?>",error_positive_integer:"<?php echo addslashes($error_positive_integer); ?>"});var n=new Bloodhound({<?php if (isset($typeahead['downloads']['prefetch'])) { ?>prefetch:"<?php echo $typeahead['downloads']['prefetch']; ?>",<?php }; if (isset($typeahead['downloads']['remote'])) { ?>remote:"<?php echo $typeahead['downloads']['remote']; ?>",<?php } ?>datumTokenizer:Bloodhound.tokenizers.obj.whitespace("value"),queryTokenizer:Bloodhound.tokenizers.whitespace,dupDetector:function(e,o){return e.id&&o.id&&e.id==o.id},limit:10});n.initialize();var i=function(e){isNaN(parseInt(e))||parseInt(e)<0?(this.target.hasError(!0),this.target.errorMsg(this.message)):(this.target.hasError(!1),this.target.errorMsg(""))},d=function(e,o,t){this.id=e,this.name=o,this.flag=t},h=function(e,o){this.id=e,this.name=o},p=function(o,t){var a=this;this.language_id=ko.observable(o),this.name=ko.observable(t).extend({required:{message:e.texts.error_name,context:a}}),this.hasError=ko.computed(this.hasError,this)};p.prototype=new e.observable_object_methods;var l=function(){var a=this,n={};this.languages={},o.each(t,function(e,o){a.languages[e]=new d(o.language_id,o.name,(o.hasOwnProperty("image")&&o.image)?"view/image/flags/"+o.image:"language/"+o.code+"/"+o.code+".png")}),this.default_language="<?php echo $default_language; ?>",o.each(a.languages,function(e,o){n[o.id]=r.hasOwnProperty(o.id)?r[o.id]:{name:""}}),this.descriptions=ko.observableArray(o.map(n,function(e,o){return new p(o,e.hasOwnProperty("name")?e.name:"",a)})).withIndex("language_id").extend({hasError:{check:!0,context:a},applyErrors:{context:a},updateValues:{context:a}}),this.download_tag_id=ko.observable("<?php echo $download_tag_id; ?>"),this.administrative=ko.observable("<?php echo $administrative; ?>"),this.sort_order=ko.observable("<?php echo $sort_order; ?>").extend({numeric:{precision:0,context:a},validate:{validate:i,message:e.texts.error_positive_integer,context:a}}),this.link_to=ko.observable("<?php echo $link_to; ?>"),this.related_downloads=ko.observableArray(o.map(s,function(e){return new h(e.download_id,e.name)})),this.removeSelected=function(e){a.related_downloads.remove(e)},this.addSelected=function(e,t){if("0"==a.link_to()){var r=!1;o.each(a.related_downloads(),function(o,t){return t.id==e?void(r=!0):void 0}),r||a.related_downloads.push(new h(e,t))}}};l.prototype=new e.observable_object_methods,o(function(){DTVM=e.view_model=new l,e.view_models=o.extend({},e.view_models,{DTVM:e.view_model}),DTVM.applyErrors(a),ko.applyBindings(DTVM,o("#content")[0]),o(".downloads.typeahead").typeahead({autoselect:!0,highlight:!0},{name:"downloads",limit:10,source:n.ttAdapter(),templates:{empty:['<div class="tt-no-suggestion"><?php echo addslashes($text_no_records_found); ?></div>'].join("\n"),suggestion:Handlebars.compile('<p><span class="tt-nowrap">{{value}}</span></p>')}}).on("typeahead:selected",function(e,t){var a=(ko.contextFor(this),ko.dataFor(this)),r=o(this).data("method");r&&(a[r](t.id,t.value),o(this).typeahead("val",""))}),e.onComplete(o("#page-overlay"),o("#content"))})}(window.bull5i=window.bull5i||{},jQuery);
//--></script>
<?php echo $footer; ?>
