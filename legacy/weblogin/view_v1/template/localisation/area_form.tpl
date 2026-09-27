<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-country" data-toggle="tooltip" title="<?php echo 'Save'; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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



<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-country" class="form-horizontal">
	
          <div class="form-group required">

            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>

            <div class="col-sm-10">

              <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" placeholder="<?php echo $entry_name; ?>" autocomplete="on" runat="server" />

              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>

            </div>

          </div>

		  <div class="form-group">

            <label class="col-sm-2 control-label" for="input-country"><?php echo $entry_country; ?></label>

            <div class="col-sm-10">

              <select name="country_id" id="input-country" class="form-control">

                <option value=""><?php echo '--Please Select--'; ?></option>

                <?php foreach ($countries as $country) { ?>

                <?php if ($country['country_id'] == $country_id) { ?>

                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>

                <?php } else { ?>

                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-country">State/Zone</label>
            <div class="col-sm-10">
              <select name="zone_id" id="input-zone" class="form-control">
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_latitude; ?></label>
            <div class="col-sm-10">
				<input type="text" name="latitude" value="<?php if(isset($latitude)) echo $latitude; ?>" id="location_latitude" class="form-control" placeholder="<?php echo $entry_latitude; ?>" />
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_longitude; ?></label>
            <div class="col-sm-10">
				<input type="text" name="longitude" value="<?php if(isset($longitude)) echo $longitude; ?>" id="location_longitude" class="form-control" placeholder="<?php echo $entry_longitude; ?>" />
            </div>
          </div>
		  <input type="hidden" name="city_type" value="1" />
		  <?php /*?>
		  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-city-type"><span data-toggle="tooltip" title="<?php echo $help_city_type; ?>"><?php echo $entry_city_type; ?></span></label>
                <div class="col-sm-10">
                  <label class="radio-inline">
                    <?php if ($city_type) { ?>
                    <input type="radio" name="city_type" value="1" checked="checked" />
                    <?php echo $entry_primary; ?>
                    <?php } else { ?>
                    <input type="radio" name="city_type" value="1" />
                    <?php echo $entry_primary; ?>
                    <?php } ?>
                  </label>
                  <label class="radio-inline">
                    <?php if (!$city_type) { ?>
                    <input type="radio" name="city_type" value="0" checked="checked" />
                   <?php echo $entry_secondary; ?>
                    <?php } else { ?>
                    <input type="radio" name="city_type" value="0" />
                    <?php echo $entry_secondary; ?>
                    <?php } ?>
                  </label>
                </div>
            </div>
			
			<div class="form-group">
                <label class="col-sm-2 control-label" for="input-image"><span data-toggle="tooltip" title="<?php echo $help_image; ?>"><?php echo $entry_image; ?></span></label>
                <div class="col-sm-10">
                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
            </div> 
		<?php */ ?>	
			<input type="hidden" name="image" value="" id="input-image" />
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status">Status</label>
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


<script type="text/javascript"><!--

$('#edit_zone_price').on('show.bs.modal', function(e) {
	var id = ($(e.relatedTarget).data('id'));
	var name = ($(e.relatedTarget).data('name'));
	$('input[name=\'zoneId\']').val(id);
	$('#modalName').html(name+' ('+id+')');
});


$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=localisation/city/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			html = '<option value=""><?php echo '--Please Select--'; ?></option>';
			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}
					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo '--None--'; ?></option>';
			}
			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
$('select[name=\'country_id\']').trigger('change');
//--></script>
<?php /* ?>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
<script type="text/javascript">
	function initialize() {
		var input = document.getElementById('input-name');
		var autocomplete = new google.maps.places.Autocomplete(input);
		google.maps.event.addListener(autocomplete, 'place_changed', function () {
			var place = autocomplete.getPlace();
			var lat = place.geometry.location.lat();
			var lon = place.geometry.location.lng();
			document.getElementById('location_latitude').value = lat;
			document.getElementById('location_longitude').value = lon;
		});
	}
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php */ ?>
 <div class="modal fade" id="add_zone" tabindex="-1" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Branch to Zone: <span id="modalName">Melbourne-43 (42)</span></h4>
			</div>
			<div class="modal-body" style="min-height:160px">
				<table class="table table-striped table-bordered table-hover">
					<thead>
					  <tr>
						<td class="text-left required">Zone Name</td>
						<td class="text-left required">Pincodes</td>
					  </tr>
					</thead>
					<tbody>
					<tr id="addzonedata">
						<td class="text-left" style="width: 30%;" class="form-control"><input type="text" name="zone_name" value=""  class="form-control" /></td>
						<td class="text-left" style="width: 70%;" class="form-control"><textarea name="zone_pincodes" class="form-control" ></textarea></td>
					</tr>
					<tbody>	
				</table>	
			</div>
			<div class="modal-footer" id="footer-pickupset">
				<button type="button" class="btn btn-default" id="savezone">Save</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
  var filter_row = <?php echo $filter_row; ?>;
function addFilterRow() {
	html  = '<tr id="filter-row' + filter_row + '">';
	html += '  <td class="text-left" style="width: 20%;" class="form-control"><input type="hidden" name="geo_zone_id" value=""><input type="text" name="city_pincode[' + filter_row + '][geo_zone]" class="form-control" /></td>'
	html += '  <td class="text-left" style="width: 70%;"><textarea name="city_pincode[' + filter_row + '][pincode]" class="form-control"></textarea>';
	html += '  </td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#filter-row' + filter_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';	
	
	$('#filter #tablezone').append(html);
	
	filter_row++;
}

function saveServiceZone(zone_id){
	$.ajax({
		url: 'index.php?route=localisation/city/saveservicezone&token=<?php echo $token; ?>',
		type: 'post',
		data: $('#section-service'+zone_id+' input[type=\'text\'], #section-service'+zone_id+' input[type=\'hidden\']'),
		beforeSend: function() {
			$('#saveservicezone'+zone_id).button('loading');
		},
		complete: function() {
			$('#saveservicezone'+zone_id).button('reset');
		},
		success: function(json) {
			$('#section-service'+zone_id).after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
			/* $('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				
			}*/
		}
	});
}

$('#savezone').click(function(){
	$.ajax({
		url: 'index.php?route=localisation/city/addnewzone&token=<?php echo $token; ?>&city_id=<?php echo $city_id; ?>',
		type: 'post',
		data: $('#addzonedata input[type=\'text\'], #addzonedata textarea'),
		beforeSend: function() {
			$('#addzonedata').button('loading');
		},
		complete: function() {
			$('#addzonedata').button('reset');
		},
		success: function(json) {
			$('#savezone').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
			setTimeout(function () {location.reload();}, 1000);
		}
	});
});
  //--></script>

							
<?php echo $footer; ?>