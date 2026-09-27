<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i>Daily Best Performer</h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-notifcation" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<?php include 'view/template/common/message.tpl' ; ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-notifcation">
					<div class="table-responsive">
						<table id="discount" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
								<td class="text-left">Type</td>
								<td class="text-right">Name</td>
								<td class="text-right">ID</td>
								<td class="text-right">Image</td>
								<td class="text-right">Detail</td>
								<td></td>
								</tr>
							</thead>
							<tbody>
								 <?php $discount_row = 0; ?>
								<?php foreach($dailybest as $item){?>
									 <tr id="discount-row<?php echo $discount_row; ?>">
										<td><select name="weeklybest[<?php echo $discount_row; ?>][type]" class="form-control"><option value="">-Select-</option><option value="student" <?php if("student" == $item['type']) echo 'selected'; ?>>Student</option><option value="trainer" <?php if("trainer" == $item['type']) echo 'selected'; ?>>Trainer</option><option value="teamleader" <?php if("teamleader" == $item['type']) echo 'selected'; ?>>Team Leader</option></select></td>
										
										<td class="text-right"><input type="text" name="weeklybest[<?php echo $discount_row; ?>][entity_name]" value="<?php echo $item['entity_name']; ?>" class="form-control" /></td>
										<td class="text-right"><input type="text" name="weeklybest[<?php echo $discount_row; ?>][entity_no]" value="<?php echo $item['entity_no']; ?>" class="form-control" /></td>
										
										<td class="text-left"><a href="" id="thumb-image<?php echo $discount_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $item['thumb']; ?>"  data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="weeklybest[<?php echo $discount_row; ?>][entity_image]" value="<?php echo $item['entity_image']; ?>" id="input-image<?php echo $discount_row; ?>" /></td>
										
										<td class="text-right"><textarea name="weeklybest[<?php echo $discount_row; ?>][entity_description]" class="form-control"><?php echo $item['entity_description']; ?></textarea></td>
										<td class="text-left"><button type="button" onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
									</tr>
									<?php $discount_row++; ?>
								<?php } ?>	
							</tbody>
							<tfoot>
								<tr>
									<td colspan="5"></td>
									<td class="text-left"><button type="button" onclick="addDiscount();" data-toggle="tooltip" title="<?php echo $button_discount_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
								</tr>
							</tfoot>
						</table>
				</form>
			</div>
			<div class="panel-footer">
				<div class="pull-right">
					<button type="submit" form="form-notifcation" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickDate: true,
	pickTime: false,
	format: 'YYYY-MM-DD',
	inline: false,
});
$("#input-image").on('change', function () {		
	if (typeof (FileReader) != "undefined") {
		var image_holder = $("#file_image-holder");
		image_holder.empty();
		
		var reader = new FileReader();
		reader.onload = function (e) {
			$("<img />", {
				"src": e.target.result,
				"class": "thumb-image",
				"width": "200px",
				"height": "250px"
			}).appendTo(image_holder);
		
		}
		image_holder.show();
		reader.readAsDataURL($(this)[0].files[0]);
	} else {
		alert("This browser does not support FileReader.");
	}
});
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tr id="discount-row' + discount_row + '">';
    html += '  <td class="text-left"><select name="weeklybest[' + discount_row + '][type]" class="form-control"><option value="">-Select-</option><option value="student">Student</option><option value="trainer">Trainer</option><option value="teamleader">Team Leader</option></select></select></td>';
    html += '  <td class="text-right"><input type="text" name="weeklybest[' + discount_row + '][entity_name]" value="" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="weeklybest[' + discount_row + '][entity_no]" value="" class="form-control" /></td>';
	html += '  <td class="text-right"><a href="" id="thumb-image' + discount_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="weeklybest[' + discount_row + '][entity_image]" value="" id="input-image' + discount_row + '" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><textarea name="weeklybest[' + discount_row + '][entity_description]" class="form-control"></textarea></div></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#discount tbody').append(html);

	discount_row++;
}
//--></script>
<?php echo $footer; ?>