<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
	<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places&key=AIzaSyDb81aYEGJ9w5ZliWAMW4DlFoIJbgq-b3Y">
    </script>
	<!-- <script src="view/javascript/jquery/locationpicker/locationpicker.jquery.js" type="text/javascript"></script> -->
	<style>
		.gmap-location-picker {height:450px;width:650px;}
	</style>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-salon" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-salon" class="form-horizontal">
          <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="salon_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($salon_description[$language['language_id']]) ? $salon_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="salon_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>"><?php echo isset($salon_description[$language['language_id']]) ? $salon_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_address; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="salon_description[<?php echo $language['language_id']; ?>][address]" value="<?php echo isset($salon_description[$language['language_id']]) ? $salon_description[$language['language_id']]['address'] : ''; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_address[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_address[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  
                </div>
                <?php } ?></div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" id="googlemap"><?php echo $text_location_address;?></label>
					<div class="col-sm-10">
						<input class="form-control" id="searchTextField" name="location" type="text" value="" autocomplete="on"/>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $entry_map; ?></label>
						<div class="col-sm-10">
							<div id="gmap-location-picker" class="gmap-location-picker"></div>
							<a class="btn" onclick="moveMarker();">Обновить по координатам</a>
						</div>
				</div>
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-latitude"><?php echo $entry_latitude; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="latitude" value="<?php echo $latitude; ?>" placeholder="" id="latitude" class="form-control" />
                      <?php if (isset($error_latitude)) { ?>
                      <div class="text-danger"><?php echo $error_latitude; ?></div>
                      <?php } ?>
                    </div>
                  </div>
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-longitude"><?php echo $entry_longitude; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="longitude" value="<?php echo $longitude; ?>" placeholder="" id="longitude" class="form-control" />
                      <?php if (isset($error_longitude)) { ?>
                      <div class="text-danger"><?php echo $error_longitude; ?></div>
                      <?php } ?>
                    </div>
                  </div>
				
				
				
				
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
                <div class="col-sm-10">
                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
			<div class="form-group required">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_country; ?></label>
                <div class="col-sm-10">
					<select name="country_id" id="input-status" class="form-control">
						<option value="*"><?php echo $text_all;?></option>
						<?php foreach ($countries as $country) { ?>
                            <?php if ($country['country_id']==$country_id) { ?>
								<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
							<?php } else { ?>
								<option value="<?php echo $country['country_id']; ?>">&nbsp;&nbsp;<?php echo $country['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option> 
							<?php } ?>
                  
						<?php } ?>
					</select>
				</div>	
              </div>
			  <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_city; ?></label>
                <div class="col-sm-10">
					<select name="city_id" id="input-status" class="form-control">
					  <option value="*"><?php echo $text_all;?></option>
					  <?php foreach ($cities as $city) { ?>
					  
					  <?php if ($city['city_id']==$city_id) { ?>
					  <option value="<?php echo $city['city_id']; ?>" selected="selected"><?php echo $city['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
					  <?php } else { ?>
					  <option value="<?php echo $city['city_id']; ?>">&nbsp;&nbsp;<?php echo $city['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option> 
					  <?php } ?>
					  
					  <?php } ?>
					</select>
				</div>	
              </div>
			<div class="form-group required">
                <label class="col-sm-2 control-label" for="input-trend"><?php echo $entry_trend; ?></label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="min-height: 150px;max-height: 500px;overflow: auto;">
                    <table class="table table-striped">
                    <?php foreach ($trends as $trend) { ?>
                    <tr>
                      <td class="checkbox">
                        <label>
                          <?php if (in_array($trend['trend_id'], $salon_trend)) { ?>
                          <input type="checkbox" name="trend[]" value="<?php echo $trend['trend_id']; ?>" checked="checked" />
                          <?php echo $trend['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="trend[]" value="<?php echo $trend['trend_id']; ?>" />
                          <?php echo $trend['name']; ?>
                          <?php } ?>
                        </label>
                      </td>
                    </tr>
                    <?php } ?>
                    </table>
                  </div>
                  <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a></div>
              </div>
			  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-sort"><?php echo $entry_sort_order; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="" id="input-sort" class="form-control" />
                    </div>
                  </div>
		  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
          
        </form>
      </div>
    </div>
  </div>
</div>  
<script type="text/javascript">
	function address_search() {
		var input = document.getElementById('searchTextField');
		var autocomplete = new google.maps.places.Autocomplete(input);
		google.maps.event.addListener(autocomplete, 'place_changed', function () {
			var place = autocomplete.getPlace();

			var lat = place.geometry.location.lat();
			var lon = place.geometry.location.lng();

			document.getElementById('latitude').value = lat;
			document.getElementById('longitude').value = lon;
			moveMarker();
		});
	}
    google.maps.event.addDomListener(window, 'load', address_search);
</script>

<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
<?php if ($ckeditor) { ?>
ckeditorInit('input-description<?php echo $language['language_id']; ?>', '<?php echo $token; ?>');
<?php } else { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300, lang:'<?php echo $lang; ?>'});
<?php } ?>
<?php } ?>
//--></script>
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
$('#option a:first').tab('show');
//--></script>
<script type="text/javascript">
	var marker;
var map;

function initialize() {
    var myLatlng = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);

    $('#update-map').click(function(e) {
        var lat = parseFloat(document.getElementById('latitude').value);
        var lng = parseFloat(document.getElementById('longitude').value);
        var newLatLng = new google.maps.LatLng(lat, lng);
    
        marker.setPosition(newLatLng);
        map.setCenter(newLatLng);
    });

    var myOptions = {
        center: myLatlng,
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById('gmap-location-picker'), myOptions);

    marker = new google.maps.Marker({
        position: myLatlng,
        draggable: true,
        map: map
    });

    google.maps.event.addListener(marker, 'dragend', function(a) {
        $('input[name="latitude"]').val(a.latLng.lat().toFixed(6));
        $('input[name="longitude"]').val(a.latLng.lng().toFixed(6));
        map.panTo(a.latLng);
    });
}

function moveMarker() {
    var lat = parseFloat(document.getElementById('latitude').value);
    var lng = parseFloat(document.getElementById('longitude').value);
    var newLatLng = new google.maps.LatLng(lat, lng);

    marker.setPosition(newLatLng);
    map.setCenter(newLatLng);
}


$(document).ready(function() {
    initialize();
});
</script>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
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

					if (json['city'][i]['city_id'] == '<?php echo $city_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['city'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="*" selected="selected"><?php echo $text_all; ?></option>';
			}

			$('select[name=\'city_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>
<?php echo $footer; ?>
