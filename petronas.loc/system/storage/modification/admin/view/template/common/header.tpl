<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/stylesheet/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<script src="view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
<script src="view/javascript/jquery/datetimepicker/locale/<?php echo $code; ?>.js" type="text/javascript"></script>
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
<?php foreach ($styles as $style) { ?>
<link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
</head>
<body>
<div id="container">
<header id="header" class="navbar navbar-static-top">
  <div class="navbar-header">
    <?php if ($logged) { ?>
    <a type="button" id="button-menu" class="pull-left"><i class="fa fa-indent fa-lg"></i></a>
    <?php } ?>
    <a href="<?php echo $home; ?>" class="navbar-brand"><img src="view/image/logo.png" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" /></a></div>
  <?php if ($logged) { ?>

<?php if (isset($storage_cleaner)) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.clear-dropdown li, .clear-dropdown a').on('click', function(e) {
		e.stopPropagation();
	});
});

function clearOption(type, key) {
	var pvnm_size = $('.clear-dropdown').prev('a').children('span').html();
	var pvnm_type = type + '-' + key;

	$.ajax({
		url: 'index.php?route=extension/module/pvnm_storage_cleaner/clear' + type + '&token=' + getURLVar('token'),
		type: 'post',
		data: 'key=' + key,
		dataType: 'json',
		beforeSend: function() {
			$('.clear-dropdown').prev('a').children('span').html('<i class=\'fa fa-spinner\'></i>');
			$('#button-' + pvnm_type + ' span').html('<i class=\'fa fa-spinner\'></i>');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		},
		success: function(json) {
			$('.clear-dropdown > .alert-success, .clear-dropdown > .alert-danger').remove();

			if (json['success']) {
				$('#button-' + pvnm_type).closest('li').addClass('bg-success');
				$('.clear-dropdown').append('<div class="alert alert-success" style="margin: 15px 20px 15px 20px; padding: 5px; font-size: 11px;"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				if (json['size']) {
					$('.clear-dropdown').prev('a').children('span').html(json['size']['all']);
					$('#button-' + pvnm_type + ' span').html(json['size'][pvnm_type]);
				}
			}

			if (json['error']) {
				$('.clear-dropdown').prev('a').children('span').html(pvnm_size);
				$('#button-' + pvnm_type).closest('li').addClass('bg-danger');
				$('.clear-dropdown').append('<div class="alert alert-danger" style="margin: 15px 20px 15px 20px; padding: 5px; font-size: 11px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
		}
	});
}

function clearAll() {
	clearOption('cache', 'system');
	clearOption('cache', 'modification');
	clearOption('cache', 'image');
	clearOption('log', 'error');
	clearOption('log', 'modification');
}
//--></script>
<?php } ?>
			
  <ul class="nav pull-right">

	<?php if (isset($storage_cleaner)) { ?>
	<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><?php if ($text_cleaner_size) { ?><span class="label label-warning pull-left"><?php echo $text_cleaner_size['all']; ?></span><?php } ?><i class="fa fa-eraser fa-lg"></i></a>
	  <ul class="dropdown-menu dropdown-menu-right clear-dropdown" style="width: 230px;">
		<li class="dropdown-header"><?php echo $text_cache; ?></li>
		<li><a><?php echo $text_cache_system; ?><button onclick="clearOption('cache', 'system');" type="button" data-loading-text="<i class='fa fa-spinner'></i>" data-toggle="tooltip" title="<?php echo $text_clear; ?>" class="btn btn-warning btn-xs pull-right" id="button-cache-system"><?php if ($text_cleaner_size) { ?><span><?php echo $text_cleaner_size['cache-system']; ?></span><?php } ?> <i class="fa fa-eraser"></i></button></a></li>
		<li><a><?php echo $text_cache_modification; ?><button onclick="clearOption('cache', 'modification');" type="button" data-loading-text="<i class='fa fa-spinner'></i>" data-toggle="tooltip" title="<?php echo $text_refresh; ?>" class="btn btn-warning btn-xs pull-right" id="button-cache-modification"><?php if ($text_cleaner_size) { ?><span><?php echo $text_cleaner_size['cache-modification']; ?></span><?php } ?> <i class="fa fa-eraser"></i></button></a></li>
		<li><a><?php echo $text_cache_image; ?><button onclick="clearOption('cache', 'image');" type="button" data-loading-text="<i class='fa fa-spinner'></i>" data-toggle="tooltip" title="<?php echo $text_clear; ?>" class="btn btn-warning btn-xs pull-right" id="button-cache-image"><?php if ($text_cleaner_size) { ?><span><?php echo $text_cleaner_size['cache-image']; ?></span><?php } ?> <i class="fa fa-eraser"></i></button></a></li>
		<li class="divider"></li>
		<li class="dropdown-header"><?php echo $text_log; ?></li>
		<li><a><?php echo $text_log_error; ?><button onclick="clearOption('log', 'error');" type="button" data-loading-text="<i class='fa fa-spinner'></i>" data-toggle="tooltip" title="<?php echo $text_clear; ?>" class="btn btn-warning btn-xs pull-right" id="button-log-error"><?php if ($text_cleaner_size) { ?><span><?php echo $text_cleaner_size['log-error']; ?></span><?php } ?> <i class="fa fa-eraser"></i></button></a></li>
		<li><a><?php echo $text_log_modification; ?><button onclick="clearOption('log', 'modification');" type="button" data-loading-text="<i class='fa fa-spinner'></i>" data-toggle="tooltip" title="<?php echo $text_clear; ?>" class="btn btn-warning btn-xs pull-right" id="button-log-modification"><?php if ($text_cleaner_size) { ?><span><?php echo $text_cleaner_size['log-modification']; ?></span><?php } ?> <i class="fa fa-eraser"></i></button></a></li>
		<li class="divider"></li>
		<li><a><button onclick="clearAll();" type="button" data-loading-text="<i class='fa fa-spinner'></i>" class="btn btn-warning btn-sm btn-block" id="button-clear-all"><?php echo $text_clear_all; ?><span class="pull-right"><i class="fa fa-eraser"></i></span></button></a></li>
	  </ul>
	</li>
	<?php } ?>
			
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><?php if($alerts > 0) { ?><span class="label label-danger pull-left"><?php echo $alerts; ?></span><?php } ?> <i class="fa fa-bell fa-lg"></i></a>
      <ul class="dropdown-menu dropdown-menu-right alerts-dropdown">
        <li class="dropdown-header"><?php echo $text_order; ?></li>
        <li><a href="<?php echo $processing_status; ?>" style="display: block; overflow: auto;"><span class="label label-warning pull-right"><?php echo $processing_status_total; ?></span><?php echo $text_processing_status; ?></a></li>
        <li><a href="<?php echo $complete_status; ?>"><span class="label label-success pull-right"><?php echo $complete_status_total; ?></span><?php echo $text_complete_status; ?></a></li>
        <li><a href="<?php echo $return; ?>"><span class="label label-danger pull-right"><?php echo $return_total; ?></span><?php echo $text_return; ?></a></li>
        <li class="divider"></li>
        <li class="dropdown-header"><?php echo $text_customer; ?></li>
        <li><a href="<?php echo $online; ?>"><span class="label label-success pull-right"><?php echo $online_total; ?></span><?php echo $text_online; ?></a></li>
        <li><a href="<?php echo $customer_approval; ?>"><span class="label label-danger pull-right"><?php echo $customer_total; ?></span><?php echo $text_approval; ?></a></li>
        <li class="divider"></li>
        <li class="dropdown-header"><?php echo $text_product; ?></li>
        <li><a href="<?php echo $product; ?>"><span class="label label-danger pull-right"><?php echo $product_total; ?></span><?php echo $text_stock; ?></a></li>
        <li><a href="<?php echo $review; ?>"><span class="label label-danger pull-right"><?php echo $review_total; ?></span><?php echo $text_review; ?></a></li>
        <li class="divider"></li>
        <li class="dropdown-header"><?php echo $text_affiliate; ?></li>
        <li><a href="<?php echo $affiliate_approval; ?>"><span class="label label-danger pull-right"><?php echo $affiliate_total; ?></span><?php echo $text_approval; ?></a></li>
      </ul>
    </li>
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-home fa-lg"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li class="dropdown-header"><?php echo $text_store; ?></li>
        <?php foreach ($stores as $store) { ?>
        <li><a href="<?php echo $store['href']; ?>" target="_blank"><?php echo $store['name']; ?></a></li>
        <?php } ?>
      </ul>
    </li>
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-life-ring fa-lg"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li class="dropdown-header"><?php echo $text_help; ?></li>
        <li><a href="http://myopencart.com" target="_blank"><?php echo $text_homepage; ?></a></li>
        <li><a href="http://docs.myopencart.com" target="_blank"><?php echo $text_documentation; ?></a></li>
        <li><a href="https://opencartforum.com" target="_blank"><?php echo $text_support; ?></a></li>
      </ul>
    </li>
    <li><a href="<?php echo $logout; ?>"><span class="hidden-xs hidden-sm hidden-md"><?php echo $text_logout; ?></span> <i class="fa fa-sign-out fa-lg"></i></a></li>
  </ul>
  <?php } ?>
</header>
