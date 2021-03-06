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
							<div class="nav navbar-nav navbar-right">
								<div class="nav navbar-nav navbar-form" id="nav-filter">
									<div class="form-group search-form">
										<label for="global-search" class="sr-only"><?php echo $text_search;?></label>
										<div class="search">
											<div class="input-group">
												<input type="text" name="search" class="form-control" placeholder="<?php echo $text_search;?>" id="global-search" value="<?php echo $search; ?>">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $text_search; ?>" id="global-search-btn"><i class="fa fa-search fa-fw"></i></button>
													<?php if ($search) { ?><button type="button" class="btn btn-default" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $text_clear_search; ?>" id="clear-global-search-btn"><i class="fa fa-times fa-fw"></i></button><?php } ?>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="nav navbar-nav navbar-btn btn-group">
									<button type="button" class="btn btn-primary" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_add; ?>" data-url="<?php echo $add; ?>" id="btn-insert" data-form="#pd-list-form" data-context="#content" data-overlay="#page-overlay"><i class="fa fa-plus"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_add; ?></span></button>
									<?php if ($pd_aa_status || $pd_ba_status) { ?>
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only"><?php echo $text_toggle_dropdown; ?></span>
										</button>
										<ul class="dropdown-menu first-level" role="menu">
											<?php if ($pd_ba_status) { ?>
											<li><a href="#" id="btn-batch-add" data-url="<?php echo $batch_add; ?>" data-form="#pd-list-form" data-context="#content" data-overlay="#page-overlay" ><?php echo $text_batch_add; ?></a></li>
											<?php } ?>
											<?php if ($pd_aa_status) { ?>
											<li class="dropdown-submenu drop-left">
												<!-- ko if: !aa_file_list_loaded() -->
												<a href="#" data-bind="html: bull5i.texts.auto_add_x.replace('%d', '<i class=\'fa fa-refresh fa-spin text-muted\'></i>')"></a>
												<!-- /ko -->
												<!-- ko if: aa_file_list_loaded() -->
												<a href="#"><!-- ko text: bull5i.texts.auto_add_x.replace('%d', aa_files().length) --><!-- /ko --></a>
												<!-- /ko -->
												<ul class="dropdown-menu">
													<!-- ko if: !aa_file_list_loaded() -->
													<li class="disabled"><a href="#"><!-- ko text: bull5i.texts.searching --><!-- /ko --></a></li>
													<!-- /ko -->
													<!-- ko if: aa_file_list_loaded() -->
													<!-- ko if: aa_files().length == 0 -->
													<li class="disabled"><a href="#"><!-- ko text: bull5i.texts.no_files_found --><!-- /ko --></a></li>
													<!-- /ko -->
													<!-- ko if: aa_files().length > 0 -->
													<li><a href="#" id="btn-auto-add" data-url="<?php echo $auto_add; ?>" data-form="#pd-list-form" data-context="#content" data-overlay="#page-overlay" ><!-- ko text: bull5i.texts.add_all_files --><!-- /ko --></a></li>
													<li class="divider"></li>
													<li class="dropdown-header"><!-- ko text: bull5i.texts.add_single_file --><!-- /ko --></li>
													<!-- ko foreach: aa_files -->
													<li><a href="#" class="auto-add-file" data-bind="attr: {'data-file': $data}"><small data-bind="text: $data"></small></a></li>
													<!-- /ko -->
													<!-- /ko -->
													<!-- /ko -->
												</ul>
											</li>
											<?php } ?>
										</ul>
									</div>
									<?php } ?>
									<button type="button" class="btn btn-default" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_copy; ?>" data-url="<?php echo $copy; ?>" id="btn-copy" data-form="#pd-list-form" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_copying; ?></span>" disabled><i class="fa fa-files-o"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_copy; ?></span></button>
									<button type="button" class="btn btn-danger" data-toggle="tooltip" data-container="body" data-placement="bottom" title="<?php echo $button_delete; ?>"data-url="<?php echo $delete; ?>" id="btn-delete" data-form="#pd-list-form" data-context="#content" data-overlay="#page-overlay" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <span class='visible-lg-inline visible-xs-inline'><?php echo $text_deleting; ?></span>" disabled><i class="fa fa-trash-o"></i> <span class="visible-lg-inline visible-xs-inline"><?php echo $button_delete; ?></span></button>
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-hover="tooltip" data-container="body" data-placement="bottom" title="<?php echo $text_other_actions; ?>">
											<span class="caret"></span>
											<span class="sr-only"><?php echo $text_toggle_dropdown; ?></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="<?php echo $view_free_samples; ?>"><?php echo $text_view_free_samples; ?></a></li>
											<li><a href="<?php echo $view_download_tags; ?>"><?php echo $text_view_tags; ?></a></li>
											<li class="disabled"><a href="#" id="btn-change-type-to-free" data-url="<?php echo $make_free; ?>" data-form="#pd-list-form" data-context="#content" data-overlay="#page-overlay" ><?php echo $text_make_free; ?></a></li>
											<li class="disabled"><a href="#" id="btn-change-type-to-regular" data-url="<?php echo $make_commercial; ?>" data-form="#pd-list-form" data-context="#content" data-overlay="#page-overlay" ><?php echo $text_make_commercial; ?></a></li>
										</ul>
									</div>
								</div>
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
				<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
			</div>
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data" id="pd-list-form" class="form-horizontal" role="form">
					<fieldset>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-list table-hover">
								<thead>
									<tr>
										<?php foreach ($columns as $column => $attr) {
										 switch($column) {
											case 'selector': ?>
										<th class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?> col_<?php echo $column; ?>"><input type="checkbox" id="master-selector" /></th>
											<?php break;
											default: ?>
											<?php if (!empty($attr['sort'])) { ?>
										<th class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?> col_<?php echo $column; ?>"><a href="<?php echo $sorts[$column]; ?>"><?php echo $attr['name']; ?><?php echo ($sort == $attr['sort']) ? ' <i class="fa fa-sort-' . strtolower($order) . '"></i>' : ''; ?></a></th>
											<?php } else { ?>
										<th class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?> col_<?php echo $column; ?>"><?php echo $attr['name']; ?></th>
											<?php } ?>
											<?php break;
										 } ?>
										<?php } ?>
									</tr>
									<tr class="filters">
										<?php foreach ($columns as $column => $attr) {
										 switch($column) {
											case 'selector':
											case 'size': ?>
										<td></td>
											<?php break;
											case 'login': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<select name="filter_<?php echo $column; ?>" class="form-control input-sm fltr <?php echo $column; ?>" data-column="<?php echo $column; ?>">
												<option value=""<?php echo (!isset($filters[$column]) || $filters[$column] == '') ? ' selected' : ''; ?>></option>
												<option value="1"<?php echo (isset($filters[$column]) && $filters[$column] == '1') ? ' selected' : ''; ?>><?php echo $text_yes; ?></option>
												<option value="0"<?php echo (isset($filters[$column]) && $filters[$column] == '0') ? ' selected' : ''; ?>><?php echo $text_no; ?></option>
											</select>
										</td>
											<?php break;
											case 'status': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<select name="filter_<?php echo $column; ?>" class="form-control input-sm fltr <?php echo $column; ?>" data-column="<?php echo $column; ?>">
												<option value=""<?php echo (!isset($filters[$column]) || $filters[$column] == '') ? ' selected' : ''; ?>></option>
												<option value="1"<?php echo (isset($filters[$column]) && $filters[$column] == '1') ? ' selected' : ''; ?>><?php echo $text_enabled; ?></option>
												<option value="0"<?php echo (isset($filters[$column]) && $filters[$column] == '0') ? ' selected' : ''; ?>><?php echo $text_disabled; ?></option>
											</select>
										</td>
											<?php break;
											case 'type': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<select name="filter_<?php echo $column; ?>" class="form-control input-sm fltr <?php echo $column; ?>" data-column="<?php echo $column; ?>">
												<option value=""<?php echo (!isset($filters[$column]) || $filters[$column] == '') ? ' selected' : ''; ?>></option>
												<option value="1"<?php echo (isset($filters[$column]) && $filters[$column] == '1') ? ' selected' : ''; ?>><?php echo $text_free; ?></option>
												<option value="0"<?php echo (isset($filters[$column]) && $filters[$column] == '0') ? ' selected' : ''; ?>><?php echo $text_regular; ?></option>
											</select>
										</td>
											<?php break;
											case 'constraint': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<select name="filter_<?php echo $column; ?>" class="form-control input-sm fltr <?php echo $column; ?>" data-column="<?php echo $column; ?>">
												<option value=""<?php echo (!isset($filters[$column]) || (int)$filters[$column] < 0 || (int)$filters[$column] > 3) ? ' selected' : ''; ?>></option>
												<option value="0"<?php echo (isset($filters[$column]) && $filters[$column] == '0') ? ' selected' : ''; ?>><?php echo $text_no_constraints; ?></option>
												<option value="1"<?php echo (isset($filters[$column]) && $filters[$column] == '1') ? ' selected' : ''; ?>><?php echo $text_quantitative; ?></option>
												<option value="2"<?php echo (isset($filters[$column]) && $filters[$column] == '2') ? ' selected' : ''; ?>><?php echo $text_temporal; ?></option>
												<option value="3"<?php echo (isset($filters[$column]) && $filters[$column] == '3') ? ' selected' : ''; ?>><?php echo $text_both; ?></option>
											</select>
										</td>
											<?php break;
											case 'customer_group': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<select name="filter_<?php echo $column; ?>" class="form-control input-sm fltr <?php echo $column; ?>" data-column="<?php echo $column; ?>">
												<option value=""<?php echo (!isset($filters[$column]) || $filters[$column] == '') ? ' selected' : ''; ?>></option>
												<option value="0"<?php echo (isset($filters[$column]) && $filters[$column] == '0') ? ' selected' : ''; ?>><?php echo $text_none; ?></option>
												<?php foreach ($customer_groups as $group) { ?>
												<option value="<?php echo $group['customer_group_id']; ?>"<?php echo (isset($filters[$column]) && $filters[$column] == $group['customer_group_id']) ? ' selected' : ''; ?>><?php echo $group['name']; ?></option>
												<?php } ?>
											</select>
										</td>
											<?php break;
											case 'action': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-sm btn-default" id="filter" data-toggle="tooltip" data-container="body" title="<?php echo $text_filter; ?>"><i class="fa fa-filter fa-fw"></i></button>
												<button type="button" class="btn btn-sm btn-default" id="clear-filter" data-toggle="tooltip" data-container="body" title="<?php echo $text_clear_filter; ?>"><i class="fa fa-times fa-fw"></i></button>
											</div>
										</td>
											<?php break;
											case 'tag':
											case 'related_products': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<input type="text" value="<?php echo isset($filters["{$column}_name"]) ? $filters["{$column}_name"] : ''; ?>" class="form-control input-sm fltr <?php echo $column; ?> typeahead id_based" placeholder="<?php echo $text_autocomplete; ?>">
											<input type="hidden" name="filter_<?php echo $column; ?>" value="<?php echo isset($filters[$column]) ? $filters[$column] : ''; ?>" class="fltr <?php echo $column; ?>" data-column="<?php echo $column; ?>">
										</td>
											<?php break;
											default: ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>"><input type="text" name="filter_<?php echo $column; ?>" value="<?php echo isset($filters[$column]) ? $filters[$column] : ''; ?>" class="form-control input-sm fltr <?php echo $column; ?>" data-column="<?php echo $column; ?>"></td>
											<?php break;
										 } ?>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php if ($downloads) { ?>
										<?php foreach ($downloads as $d) { ?>
									<tr<?php echo (!$d['exists']) ? ' class="danger"' : ''; ?>>
											<?php foreach ($columns as $column => $attr) {
												switch($column) {
													case 'selector': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>"><input type="checkbox" name="selected[]" value="<?php echo $d['download_id']; ?>"<?php echo ($d['selected']) ? ' checked' : ''; ?> /></td>
											<?php break;
													case 'login':
													case 'status': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>"><span class="label label-<?php echo $d[$column . '_class'];?>"><?php echo $d[$column]; ?></span></td>
											<?php break;
													case 'type': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>"><?php echo $d[$column]; ?></td>
											<?php break;
													case 'customer_group':
													case 'related_products': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<?php echo $d[$column]; ?>
											<?php if (!empty($d["{$column}_full"])) { ?><button type="button" class="btn btn-default btn-xs pull-right" data-toggle="popover" data-placement="bottom" data-html="true" data-trigger="manual" data-content="<?php echo $d["{$column}_full"]; ?>" data-popover-group="<?php echo $column; ?>"><i class="fa fa-info"></i></button><?php } ?>
										</td>
											<?php break;
													case 'action': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?> action">
											<div class="btn-group btn-group-flex">
												<?php foreach ($d['action'] as $action) { ?>
													<?php if ($action['url']) { ?>
												<a href="<?php echo $action['url']; ?>" id="<?php echo $action['name'] . "-" . $d['download_id']; ?>" class="btn <?php echo $action['class']; ?> btn-sm <?php echo $action['name']; ?>"<?php if ($action['title']) { ?> data-toggle="tooltip" data-container="body" title="<?php echo $action['title']; ?>"<?php } ?> data-loading-text="<?php if ($action['icon']) {?><i class='fa fa-spinner fa-spin'></i> <?php } ?><span<?php if ($action['icon']) { ?> class='visible-lg-inline'<?php } ?>><?php echo $action['text']; ?></span>"><?php if ($action['icon']) {?><i class="fa fa-<?php echo $action['icon']; ?>"></i> <?php } ?><span<?php if ($action['icon']) { ?> class="visible-lg-inline"<?php } ?>><?php echo $action['text']; ?></span></a>
													<?php } else { ?>
												<button type="button" id="<?php echo $action['name'] . "-" . $d['download_id']; ?>" class="btn <?php echo $action['class']; ?> btn-sm <?php echo $action['name']; ?>"<?php if ($action['title']) { ?> data-toggle="tooltip" data-container="body" title="<?php echo $action['title']; ?>"<?php } ?> data-loading-text="<?php if ($action['icon']) {?><i class='fa fa-spinner fa-spin'></i> <?php } ?><span<?php if ($action['icon']) { ?> class='visible-lg-inline'<?php } ?>><?php echo $action['text']; ?></span>"><?php if ($action['icon']) {?><i class="fa fa-<?php echo $action['icon']; ?>"></i> <?php } ?><span<?php if ($action['icon']) { ?> class="visible-lg-inline"<?php } ?>><?php echo $action['text']; ?></span></button>
													<?php } ?>
												<?php } ?>
												<?php if ($d['sub_action']) { ?>
												<div class="btn-group">
													<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="tooltip" data-container="body" title="<?php echo $text_other_actions; ?>">
														<span class="caret"></span>
														<span class="sr-only"><?php echo $text_toggle_dropdown; ?></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<?php foreach ($d['sub_action'] as $action) { ?>
														<li><a href="<?php echo ($action['url']) ? $action['url'] : '#' ; ?>" id="<?php echo $action['name'] . "-" . $d['download_id']; ?>" class="btn-icon <?php echo $action['name']; ?>"<?php if ($action['title']) { ?> data-toggle="tooltip" data-container="body" title="<?php echo $action['title']; ?>"<?php } ?>><?php if ($action['icon']) {?><i class="fa fa-<?php echo $action['icon']; ?>"></i><?php } ?><?php echo $action['text']; ?></a></li>
														<?php } ?>
													</ul>
												</div>
												<?php } ?>
											</div>
										</td>
											<?php break;
													case 'size': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $d['size_bytes']; ?>"><?php echo $d[$column]; ?></td>
											<?php break;
													case 'name': ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>">
											<?php echo $d[$column]; ?>
											<button type="button" class="btn btn-default btn-xs pull-right" data-toggle="popover" data-placement="bottom" data-html="true" data-trigger="manual" data-content="<?php echo $d['download_details']; ?>" data-popover-group="<?php echo $column; ?>"><i class="fa fa-info"></i></button>
										</td>
											<?php break;
													default: ?>
										<td class="<?php echo $attr['align']; ?> <?php echo $attr['class']; ?>"><?php echo $d[$column]; ?></td>
											<?php break;
												}
											} ?>
									</tr>
										<?php } ?>
									<?php } else { ?>
									<tr>
										<td class="text-center" colspan="<?php echo count($columns); ?>"><?php echo $text_no_results; ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</fieldset>
				</form>
				<div class="row">
					<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
					<div class="col-sm-6 text-right"><?php echo $results; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
!function(e,t,a){e.texts=t.extend({},e.texts,{copy_to_clipboard:"<?php echo addslashes($text_copy_to_clipboard); ?>",copied:"<?php echo addslashes($text_copied); ?>",auto_add_x:"<?php echo addslashes($text_auto_add_x); ?>",add_all_files:"<?php echo addslashes($text_add_all_files); ?>",add_single_file:"<?php echo addslashes($text_add_single_file); ?>",searching:"<?php echo addslashes($text_searching); ?>",no_files_found:"<?php echo addslashes($text_no_files_found); ?>",error_ajax_request:"<?php echo addslashes($error_ajax_request); ?>"}),e.filter=function(){var e="index.php?route=catalog/download_ext",a=t("#nav-filter").find("input,select").filter(function(){return t.trim(this.value).length>0}).serialize(),o=t("tr.filters .fltr:input").filter(function(){return t.trim(this.value).length>0}).serialize(),d="sort=<?php echo $sort; ?>",i="order=<?php echo $order; ?>",l="token=<?php echo $token; ?>",n=t.grep([e,a,o,d,i,l],function(e){return t.trim(e).length>0}).join("&");location=n},ZeroClipboard.config({moviePath:"view/javascript/pd/ZeroClipboard.swf"});var o=new ZeroClipboard;o.on("ready",function(){t("#global-zeroclipboard-html-bridge").tooltip({title:e.texts.copy_to_clipboard,placement:"bottom",trigger:"manual",container:"body"}),t("#global-zeroclipboard-html-bridge").on("mouseover",function(){t("#global-zeroclipboard-html-bridge").tooltip("show")}).on("mouseout",function(){t("#global-zeroclipboard-html-bridge").tooltip("hide")}),o.on("copy",function(){}).on("aftercopy",function(){t("#global-zeroclipboard-html-bridge").attr("title",e.texts.copied).tooltip("fixTitle").tooltip("show").off("hide.bs.tooltip").on("hide.bs.tooltip",function(){t(this).off("hide.bs.tooltip").attr("title",e.texts.copy_to_clipboard).tooltip("fixTitle")})})}),t("body").on("shown.bs.popover",function(){o.clip(t(".copy-me"))});var d=function(){t("input[name*='selected']:checked").length?t("#btn-change-type-to-regular,#btn-change-type-to-free").closest("li").removeClass("disabled"):t("#btn-change-type-to-regular,#btn-change-type-to-free").closest("li").addClass("disabled")};t("body").on("click","[data-toggle=popover]",function(){var e=t(this).data("popover-group"),a=t(this).data("bs.popover");t('[data-popover-group="'+e+'"]').not(this).popover("destroy"),a?t(".popover").not(a.$tip).remove():t(".popover").remove(),t(this).popover("toggle")}).on("click",function(e){var a=t(e.target).is("[data-toggle=popover]")||t(e.target).parent().is("[data-toggle=popover]"),o=t(e.target).closest(".popover").length>0;a||o||(t("[data-toggle=popover]").popover("destroy"),t(".popover").remove())}).on("change","input[name*='selected']",function(){d()}).on("click","#btn-change-type-to-free,#btn-change-type-to-regular",function(e){var a=this,o=t(t(this).data("form")),d={self:a,btn:t(this),form:o,url:t(this).data("url"),alerts:t("#alerts"),context:t(t(this).data("context"))};e.preventDefault(),d.url&&d.form&&!t(this).closest("li").hasClass("disabled")&&(d.btn.data("loading-text")?d.btn.button("loading"):d.btn.prop("disabled",!0),d.form.attr("action",d.url).submit())}).on("click","#btn-batch-add,#btn-auto-add",function(e){var a={btn:t(this),url:t(this).data("url")||this.href};e.preventDefault(),a.url&&(a.btn.data("loading-text")?a.btn.button("loading"):a.btn.prop("disabled",!0),window.location=a.url)}).on("click",".auto-add-file",function(e){var a=t(this).data("file");a&&(window.location="<?php echo $auto_add_file; ?>".replace("%s",encodeURIComponent(a))),e.preventDefault()}).on("click",'.dropdown-menu a[href="#"]',function(e){e.preventDefault()});var i=new Bloodhound({<?php if (isset($typeahead['tag']['prefetch'])) { ?>prefetch:"<?php echo $typeahead['tag']['prefetch']; ?>",<?php }; if (isset($typeahead['tag']['remote'])) { ?>remote:"<?php echo $typeahead['tag']['remote']; ?>",<?php } ?>datumTokenizer:Bloodhound.tokenizers.obj.whitespace("value"),queryTokenizer:Bloodhound.tokenizers.whitespace,dupDetector:function(e,t){return e.id&&t.id&&e.id==t.id},limit:10}),l=new Bloodhound({<?php if (isset($typeahead['related_products']['prefetch'])) { ?>prefetch:"<?php echo $typeahead['related_products']['prefetch']; ?>",<?php }; if (isset($typeahead['related_products']['remote'])) { ?>remote:"<?php echo $typeahead['related_products']['remote']; ?>",<?php } ?>datumTokenizer:Bloodhound.tokenizers.obj.whitespace("value"),queryTokenizer:Bloodhound.tokenizers.whitespace,dupDetector:function(e,t){return e.id&&t.id&&e.id==t.id},limit:10});i.initialize(),l.initialize(),t(".tag.typeahead").typeahead({autoselect:!0,highlight:!0},{name:"tag",limit:10,source:i.ttAdapter(),templates:{empty:'<div class="tt-no-suggestion"><?php echo addslashes($text_no_records_found); ?></div>',suggestion:Handlebars.compile('<p><span class="tt-nowrap">{{value}}</span></p>')}}),t(".related_products.typeahead").typeahead({autoselect:!0,highlight:!0},{name:"related_products",limit:10,source:l.ttAdapter(),templates:{empty:'<div class="tt-no-suggestion"><?php echo addslashes($text_no_records_found); ?></div>',suggestion:Handlebars.compile('<p><span class="tt-nowrap">{{value}}</span></p>')}}),t(".typeahead.tt-input.id_based").on("typeahead:selected",function(e,a,o){t(this).data("ta-selected",a).data("ta-name",o),t(this).closest("td").find("input[type=hidden][data-column="+o+"]").val(a.id),t(this).val()!=a.value&&t(this).typeahead("val",a.value)}).on("typeahead:autocompleted",function(e,a,o){t(this).data("ta-selected",a).data("ta-name",o),t(this).closest("td").find("input[type=hidden][data-column="+o+"]").val(a.id),t(this).val()!=a.value&&t(this).typeahead("val",a.value)}).on("typeahead:closed",function(){t(this).data("ta-selected")==a?t(this).typeahead("val",""):t(this).val()!=t(this).data("ta-selected").value&&(t(this).typeahead("val",""),t(this).closest("td").find("input[type=hidden][data-column="+t(this).data("ta-name")+"]").val(""),t(this).removeData("ta-selected"),t(this).removeData("ta-name"))})<?php if (isset($filters['tag_name'])) { ?>,t(".tag.typeahead.tt-input").typeahead("val","<?php echo addslashes(html_entity_decode($filters['tag_name'])); ?>").data({"ta-name":"tag","ta-selected":{value:"<?php echo addslashes(html_entity_decode($filters['tag_name'])); ?>",tokens:[],id:"<?php echo addslashes($filters['tag']); ?>"}})<?php } ?><?php if (isset($filters['related_products_name'])) { ?>,t(".related_products.typeahead.tt-input").typeahead("val","<?php echo addslashes(html_entity_decode($filters['related_products_name'])); ?>").data({"ta-name":"related_products_name","ta-selected":{value:"<?php echo addslashes(html_entity_decode($filters['related_products_name'])); ?>",tokens:[],id:"<?php echo addslashes($filters['related_products']); ?>"}})<?php } ?><?php if ($pd_aa_status) { ?>;var n=function(){var e=this;e.aa_file_list_loaded=ko.observable(!1),e.aa_files=ko.observableArray([]),e.addAutoAddFile=function(t){e.aa_files.push(t)}},s=new n;ko.applyBindings(s,t("#content")[0]),t.when(t.ajax({type:"GET",url:"<?php echo $auto_add_files; ?>",dataType:"json"})).then(function(e){s.aa_file_list_loaded(!0),e.files&&s&&t.each(e.files,function(e,t){s.addAutoAddFile(t)})},function(e,t,a){window.console&&window.console.log&&window.console.log("Failed to load auto add file list: "+a)})<?php } ?>,e.onComplete(t("#page-overlay"),t("#content"))}(window.bull5i=window.bull5i||{},jQuery);
//--></script>
<?php echo $footer; ?>
