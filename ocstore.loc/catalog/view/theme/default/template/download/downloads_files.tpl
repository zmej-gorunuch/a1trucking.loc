<?php if ($show_downloads) { ?>
<div class="table-responsive">
	<table class="table table-striped table-hover table-vcenter">
		<thead>
			<tr>
				<th class="text-left dl-name">
					<a href="<?php echo $sort_name; ?>"><?php echo $column_file_name; ?><?php if ($sort == 'name') { ?> <i class="fa fa-sort-<?php echo strtolower($order); ?>"></i><?php } ?></a>
				</th>
				<?php if ($show_file_size) { ?>
				<th class="text-center dl-size">
					<a href="<?php echo $sort_size; ?>"><?php echo $column_size; ?><?php if ($sort == 'size') { ?> <i class="fa fa-sort-<?php echo strtolower($order); ?>"></i><?php } ?></a>
				</th>
				<?php } ?>
				<?php if ($show_date_added) { ?>
				<th class="text-center dl-date">
					<a href="<?php echo $sort_added; ?>"><?php echo $column_date_added; ?><?php if ($sort == 'added') { ?> <i class="fa fa-sort-<?php echo strtolower($order); ?>"></i><?php } ?></a>
				</th>
				<?php } ?>
				<?php if ($show_date_modified) { ?>
				<th class="text-center dl-date">
					<a href="<?php echo $sort_modified; ?>"><?php echo $column_date_modified; ?><?php if ($sort == 'modified') { ?> <i class="fa fa-sort-<?php echo strtolower($order); ?>"></i><?php } ?></a>
				</th>
				<?php } ?>
				<?php if (!$make_file_name_link) { ?><th class="text-center dl-link"><?php echo $column_link; ?></th><?php } ?>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($downloads as $download) { ?>
			<tr>
				<td class="text-left">
				<?php if ($show_icons && !empty($download['icon'])) { if ($use_fa_icons) { ?><i class="fa <?php echo $download['icon']; ?>"></i><?php } else { ?><img src="<?php echo $download['icon']; ?>" class="dl_ico" /><?php } ?> <?php } ?>
				<?php if ($make_file_name_link) { ?>
				<?php if ($download['href']) { ?>
				<a href="<?php echo $download['href']; ?>"><?php echo $download['name']; ?></a>
				<?php } else { ?>
				<button type="button" class="btn btn-link btn-pd pd-nowrap button-cart" data-loading-text="<?php echo $text_loading; ?>"><?php echo $download['link_text']; ?></button>
				<?php } ?>
				<?php } else { ?>
				<?php echo $download['name']; ?>
				<?php } ?>
				<?php if ($show_free_download_count && $download['free']) {
				echo " <small>({$text_downloaded} {$download['downloaded']})</small>";
				} else if ($show_downloads_remaining && !empty($download['remaining'])) {
				echo " <small>({$text_remaining} {$download['remaining']})</small>";
				} ?>
				</td>
				<?php if ($show_file_size) { ?><td class="text-center"><?php echo $download['size']; ?></td><?php } ?>
				<?php if ($show_date_added) { ?><td class="text-center"><?php echo $download['date_added']; ?></td><?php } ?>
				<?php if ($show_date_modified) { ?><td class="text-center"><?php echo $download['date_modified']; ?></td><?php } ?>
				<?php if (!$make_file_name_link) { ?>
				<td class="text-center">
					<?php if ($download['href']) { ?>
					<a href="<?php echo $download['href']; ?>" class="btn btn-link btn-pd pd-nowrap"><?php echo $download['link_text']; ?></a>
					<?php } else { ?>
					<button type="button" class="btn btn-link btn-pd pd-nowrap button-cart" data-loading-text="<?php echo $text_loading; ?>"><?php echo $download['link_text']; ?></button>
					<?php } ?>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
			<?php if (!count($downloads)) { ?>
			<tr>
				<td class="text-center" colspan="<?php echo 1 + (int)$show_file_size + (int)$show_date_added + (int)$show_date_modified + !(int)$make_file_name_link; ?>"><?php echo $text_no_downloads; ?></td>
			<tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<div class="row">
	<div class="col-sm-12 col-lg-push-6 col-lg-6 text-right"><?php echo $results; ?></div>
	<div class="col-sm-12 col-lg-pull-6 col-lg-6 text-left"><?php echo $pagination; ?></div>
</div>
<?php } else { ?>
<?php } ?>
