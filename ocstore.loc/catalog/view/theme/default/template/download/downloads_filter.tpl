<?php if (count($download_tags)) { ?>
<div class="pd-dt-o"></div>
<div class="pd-dt-c">
	<fieldset class="pd-dt">
		<legend><?php echo $text_filter_by; ?></legend>
		<div class="pd-dt-wc">
			<div class="pd-dt-w">
				<div class="btn-group" data-toggle="buttons">
					<?php foreach($download_tags as $id => $tag) { ?>
					<label class="btn btn-default<?php echo in_array($id, $tags) ? ' active' : ''; ?>" data-context="#pd-filter-results-<?php echo $mid; ?>"><input type="checkbox" id="tag-<?php echo $mid; ?>-<?php echo $id ?>" name="dtags[]" value="<?php echo $id ?>"<?php echo in_array($id, $tags) ? ' checked' : ''; ?>><?php echo $tag ?></label>
					<?php } ?>
				</div>
			</div>
		</div>
	</fieldset>
</div>
<?php } ?>
<div id="pd-filter-results-<?php echo $mid; ?>" class="pd-container" data-mid="<?php echo $mid; ?>">
	<div class="pd-overlay fade">
		<div class="pd-overlay-progress"><i class="fa fa-refresh fa-spin fa-5x text-muted"></i></div>
	</div>
	<div class="pd-downloads pd-ll"><?php echo $downloads_data; ?></div>
</div>
