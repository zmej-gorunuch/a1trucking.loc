<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-salon').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-trend"><?php echo $column_trend; ?></label>
                <select name="filter_trend" id="input-trend" class="form-control">
                  <option value="*"><?php echo $text_all;?></option>
                  <?php foreach ($trends as $trend) { ?>
                  
                  <?php if ($trend['trend_id']==$filter_trend) { ?>
                  <option value="<?php echo $trend['trend_id']; ?>" selected="selected"><?php echo $trend['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
                  <?php } else { ?>
                  <option value="<?php echo $trend['trend_id']; ?>">&nbsp;&nbsp;<?php echo $trend['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option> 
                  <?php } ?>
                  
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-country"><?php echo $column_country; ?></label>
                <select name="filter_country" id="input-country" class="form-control">
                  <option value="*"><?php echo $text_all;?></option>
                  <?php foreach ($countries as $country) { ?>
                  
                  <?php if ($country['country_id']==$filter_country) { ?>
                  <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
                  <?php } else { ?>
                  <option value="<?php echo $country['country_id']; ?>">&nbsp;&nbsp;<?php echo $country['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option> 
                  <?php } ?>
                  
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
				 <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
			  
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $column_city; ?></label>
                <select name="filter_town" id="input-town" class="form-control">
				  <option value="*"><?php echo $text_all;?></option>
                  <?php foreach ($cities as $city) { ?>
                  
                  <?php if ($city['city_id']==$filter_city) { ?>
                  <option value="<?php echo $city['city_id']; ?>" selected="selected"><?php echo $city['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
                  <?php } else { ?>
                  <option value="<?php echo $city['city_id']; ?>">&nbsp;&nbsp;<?php echo $city['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option> 
                  <?php } ?>
                  
                  <?php } ?>
                </select>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-salon">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'sd.name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'td.name') { ?>
                    <a href="<?php echo $sort_town; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_city; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_town; ?>"><?php echo $column_city; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'cd.name') { ?>
                    <a href="<?php echo $sort_country; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_country; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_country; ?>"><?php echo $column_country; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 's.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($salons) { ?>
                <?php foreach ($salons as $salon) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($salon['salon_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $salon['salon_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $salon['salon_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $salon['name']; ?></td>
                  <td class="text-left"><?php echo $salon['town']; ?></td>
                  <td class="text-left"><?php echo $salon['country']; ?></td>
                  <td class="text-left"><?php echo $salon['status']; ?></td>
                  <td class="text-right"><a href="<?php echo $salon['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=salons/salons&token=<?php echo $token; ?>';

	var filter_name = $('#input-name').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_country = $('#input-country').val();

	if (filter_country && filter_country != '*') {
		url += '&filter_country=' + encodeURIComponent(filter_country);
	}
	
	var filter_town = $('#input-town').val();

	if (filter_town && filter_town != '*') {
		url += '&filter_town=' + encodeURIComponent(filter_town);
	}

	var filter_trend = $('#input-trend').val();

	if (filter_trend && filter_trend != '*') {
		url += '&filter_trend=' + encodeURIComponent(filter_trend);
	}


	var filter_status = $('#input-status').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
	
	location = url;
});
//--></script>
  <script type="text/javascript"><!--
$('#input-name').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=salons/salons/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['salon_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});


//--></script>
<script type="text/javascript"><!--
$('select[name=\'filter_country\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=salons/country/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'filter_country\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			html = '<option value=""><?php echo $text_all; ?></option>';

			if (json['city'] && json['city'] != '') {
				for (i = 0; i < json['city'].length; i++) {
					html += '<option value="' + json['city'][i]['city_id'] + '"';

					if (json['city'][i]['city_id'] == '<?php echo $filter_town; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['city'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="*" selected="selected"><?php echo $text_all; ?></option>';
			}

			$('select[name=\'filter_town\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'filter_country\']').trigger('change');
//--></script>

</div>
<?php echo $footer; ?>