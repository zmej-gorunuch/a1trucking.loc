<table class="table table-condensed table-borderless table-popover">
	<tbody>
		<tr>
			<td class="text-right"><strong><?php echo $entry_filename; ?></strong></td>
			<td><?php echo $filename; ?></td>
		</tr>
		<?php if (!$exists) { ?>
		<tr>
			<td></td>
			<td class="text-danger"><?php echo $error_missing_file; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td class="text-right"><strong><?php echo $entry_mask; ?></strong></td>
			<td><?php echo $mask; ?></td>
		</tr>
		<?php if ($url) { ?>
		<tr>
			<td class="text-right"><strong><?php echo $entry_download_url; ?></strong></td>
			<td><?php echo $url; ?> <button type="button" class="btn btn-default btn-xs copy-me" data-clipboard-text="<?php echo $url; ?>"><i class="fa fa-clipboard copy-me"></i></button></td>
		</tr>
		<?php } ?>
		<tr>
			<td class="text-right"><strong><?php echo $entry_date_added; ?></strong></td>
			<td><?php echo $date_added; ?></td>
		</tr>
		<tr>
			<td class="text-right"><strong><?php echo $entry_date_modified; ?></strong></td>
			<td><?php echo $date_modified; ?></td>
		</tr>
	</tbody>
</table>
