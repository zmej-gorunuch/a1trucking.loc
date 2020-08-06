<?php if ($show_module) { ?>
	<?php if ($position != 'content_tab') { ?>
<h3><?php echo $heading_title; ?></h3>
<div class="pd-module-box">
	<?php } ?>
	<div id="pdm-<?php echo $mid; ?>" class="pd-container pd-module" data-mid="<?php echo $mid; ?>">
		<div class="pd-overlay fade">
			<div class="pd-overlay-progress"><i class="fa fa-refresh fa-spin fa-5x text-muted"></i></div>
		</div>
		<div class="pd-downloads pd-ll" data-mid="<?php echo $mid; ?>"><?php echo $downloads_search_data; ?></div>
	</div>
	<?php if ($position != 'content_tab') { ?>
</div>
	<?php } ?>
<script type="text/javascript"><!--
(function(bull5i,$,undefined){bull5i.texts=$.extend({},bull5i.texts,{error_ajax_request:'<?php echo addslashes($error_ajax_request); ?>'});<?php if ($lazy_load) { ?>$(function(){new Waypoint({element:document.getElementById('pdm-<?php echo $mid; ?>'),handler:function(){bull5i.pd_handle_request('<?php echo $lazy_load_url; ?>','',$(this.element));this.destroy();},offset:'100%'})})<?php } ?>}(window.bull5i=window.bull5i||{},jQuery));
//--></script>
<?php } ?>
