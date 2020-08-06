<?php echo $header; ?>
























<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      
      <div class="row">
        <form action="" method="post" id="form-salon" class="form-horizontal form-vacancies">
		<div class="col-md-1 text-right">
          <label class="control-label" for="input-country"><?php echo $text_country; ?></label>
        </div>
        <div class="col-md-2 text-right">
          <select id="input-country" name="country_id" class="form-control">
            <option value="0"><?php echo $text_all;?></option>
                  <?php foreach ($countries as $country) { ?>
                  
                  <?php if ($country['country_id']==$country_id) { ?>
                  <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option> 
                  <?php } ?>
                  
                  <?php } ?>
          </select>
        </div>
        <div class="col-md-1 text-right">
          <label class="control-label" for="input-city"><?php echo $text_city; ?></label>
        </div>
        <div class="col-md-2 text-right">
			<select name="city_id" id="input-city" class="form-control">
				  <option value="0"><?php echo $text_all;?></option>
            </select>
        </div>
		<div class="col-md-1 text-right">
          <label class="control-label" for="input-trend"><?php echo $text_trend; ?></label>
        </div>
        <div class="col-md-2 text-right">
			<select name="trend_id" id="input-trend" class="form-control">
				 
                  <option value="0"><?php echo $text_all;?></option>
                  <?php foreach ($trends as $trend) { ?>
                  
                  <?php if ($trend['trend_id']==$trend_id) { ?>
                  <option value="<?php echo $trend['trend_id']; ?>" selected="selected"><?php echo $trend['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $trend['trend_id']; ?>"><?php echo $trend['name']; ?></option> 
                  <?php } ?>
                  
                  <?php } ?>
                
            </select>
        </div>
		<div class="col-md-3 text-left"><input type="submit" class="btn" value="<?php echo $button_filtr;?>"/></div>
		
		</form>
      </div>
	  <br />
	  
      <div class="row allvacancies">
        <?php if ($vacancies) { ?>
		<?php foreach ($vacancies as $vacancy) { ?>
        <div class="vacancies col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="vacanciesin">
		
          
            <div class="image"><img src="<?php echo $vacancy['thumb']; ?>" alt="<?php echo $vacancy['name']; ?>" title="<?php echo $vacancy['name']; ?>" class="img-responsive" /></div>
            <div>
              <div class="caption">
                <h4 id="salon-<?php echo $vacancy['vacancy_id'];?>-name"><?php echo $vacancy['name']; ?></h4>
                <!--<p id="salon-<?php echo $vacancy['vacancy_id'];?>-address"><?php echo $vacancy['address']; ?></p>-->
                <p id="salon-<?php echo $vacancy['vacancy_id'];?>-descr"><?php echo $vacancy['description']; ?></p>
              </div>
              <div class="button-group">
				<a class="openmodal" href="#mapmodals" role="button" data-toggle="modal" data-lat="<?php echo $vacancy['latitude']; ?>,<?php echo $vacancy['longitude']; ?>" data-id="salon-<?php echo $vacancy['vacancy_id']; ?>"><?php echo $text_show_on_map; ?></a>
              </div>
            </div>
        </div>
        </div>
        
        <?php } ?>
		<?php } else {?>
		<p><?php echo $text_empty; ?></p>
		<?php } ?>
      </div>
	  <script type="text/javascript">
jQuery(window).load(function () {
$('.allvacancies').masonry({
  // options
  itemSelector: '.vacancies',
  gutter: 0
  //columnWidth: 200
});
});
</script>
	  
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
<script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDb81aYEGJ9w5ZliWAMW4DlFoIJbgq-b3Y"></script>
<script>
  function map_init(var_lati,var_long,var_markerTitle,var_contentString){
	  
    var var_location = new google.maps.LatLng(var_lati,var_long);
	
    var var_mapoptions = {
      zoom: 14,
      mapTypeControl: false,
      center:var_location,
      panControl:false,
      rotateControl:false,
      streetViewControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
 
    var var_map = new google.maps.Map(document.getElementById("map-canvas"), var_mapoptions);
 
    var var_infowindow = new google.maps.InfoWindow({
      content: var_contentString
    });
    
    var var_marker = new google.maps.Marker({
		position: var_location,
		map: var_map,
		title:var_markerTitle,
		maxWidth: 200,
		maxHeight: 200
    });
    
    google.maps.event.addListener(var_marker, 'click', function() {
		  var_infowindow.open(var_map,var_marker);
    });
 
      $('#mapmodals').on('shown.bs.modal', function () {
          google.maps.event.trigger(var_map, "resize");
          var_map.setCenter(var_location);
		  var_infowindow.open(var_map,var_marker);
      });
  }
 
$(document).on("click", ".openmodal", function () {
    var vacancy_id = $(this).data('id');
	mapTitle = $('#'+vacancy_id+'-name').text();
    mapAddress = $('#'+vacancy_id+'-address').text();
    mapDescr = $('#'+vacancy_id+'-descr').text();
	
    var data = $(this).data("lat").split(',');
    map_init(data[0], data[1],mapTitle,
	  		'<div id="mapInfo">'+
            '<p>'+mapTitle+'</p>'+
            '<p>'+mapAddress+'</p>'+
            '<p>'+mapDescr+'</p>'+
            '</div>');
    
    $(".modal-header #title_id").html(mapTitle);
    $('#mapmodals').modal('show');
});
</script>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=vacancies/vacancies/city&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
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
				html += '<option value="0" selected="selected"><?php echo $text_all; ?></option>';
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
<style>
	#map-canvas {
  
  height:480px;
}
</style>	
<!-- Modals -->
  <div class="modal fade" id="mapmodals">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="title_id"></h4>
        </div>
        <div class="modal-body">
          <div id="map-canvas"></div>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>
<?php echo $footer; ?>