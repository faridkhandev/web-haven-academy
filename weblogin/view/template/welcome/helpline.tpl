<?php echo $header; ?><?php echo $column_left; ?>
<div id="content"><div class="container-fluid">
	<div class="page-header">
	    <h1><?php echo $heading_title; ?></h1>
	    <ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
	    </ul>
	</div>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:600,500,400' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
	$.fn.tabs = function() {
		var selector = this;
		this.each(function() {
			var obj = $(this); 
			$(obj.attr('href')).hide();
			$(obj).click(function() {
				$(selector).removeClass('selected');
				$(selector).each(function(i, element) {
					$($(element).attr('href')).hide();
				});

				$(this).addClass('selected');
				$($(this).attr('href')).show();
				return false;
			});
		});
		$(this).show();
		$(this).first().click();
	};
	</script>
	<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	<?php } elseif ($success) {  ?>
		<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	<?php } ?>
	<?php $element = 1; ?>
	<?php $section = 1; ?>
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<div class="set-size" id="faq">
			<div class="content">
				<div>
					<div class="tabs clearfix">
						<!-- Tabs module -->
						<div id="tab-module" class="tab-content">
							<div id="tabs_faq" class="htabs tabs-product">
								<a href="#tab_faq_item" class="ttab"><span>Module items</span></a>
							</div>
							<div id="tab_faq_item" style="padding:20px">
								<table class="tabs-list">
									<thead>
										<tr>
											<td class="first">Name</td>
											<td>Link</td>
										</tr>
									</thead>
									<?php if(isset($module['items'])):?>
                                    <?php foreach($module['items'] as $tab): ?>
									<tbody id="module-items-<?php echo $element; ?>">
										<tr>
											<td class="first">
												<?php foreach ($languages as $language) { $lang_id = $language['language_id']; ?>
												<div class="language"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                                                    <input type="text" name="helpline_module[items][<?php echo $element; ?>][name][<?php echo $language['language_id']; ?>]" value="<?php if(isset($tab['name'][$lang_id])) { echo $tab['name'][$lang_id]; } ?>" style="width:100px">
                                                </div>
												<?php } ?>
											</td>
											<td class="first">
												 <input type="text" name="helpline_module[items][<?php echo $element; ?>][link]" value="<?php if(isset($tab['link'])) { echo $tab['link']; } ?>" class="form-control">
											</td>
										</tr>
									</tbody>
                                    <?php $element++; ?>
									<?php endforeach; ?>
                                    <?php endif; ?>
									<tfoot></tfoot>
								</table>
							</div>
						</div>
						<script type="text/javascript">
						$('#tabs_faq a').tabs();
						</script>
					</div>
					<!-- Buttons -->
					<div class="buttons"><input type="submit" name="button-save" class="button-save" value=""></div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript"><!--
$('.main-tabs a').tabs();
//--></script> 
<script type="text/javascript"><!--
$('#language a').tabs();
//--></script> 
<script type="text/javascript">
var element = <?php echo $element; ?>;
var section = <?php echo $section; ?>;
function addItems() {
	html  = '<tbody id="module-items-' + element + '">';
	html += '  <tr>';
	html += '    <td>';
	<?php foreach ($languages as $language) { ?>
	html += '		<div class="language"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="helpline_module[items][' + element + '][name][<?php echo $language['language_id']; ?>]"style="width:100px" ></div>';
	<?php } ?>
	html += '    </td>';
	html += '    <td class="text-center">';
	html += '		<input type="text" name="helpline_module[items][' + element + '][link]" class="form-control">';
    html += '    </td>';
	html += '    <td class="text-center">';
	html += '		<input type="text" name="helpline_module[items][' + element + '][order]" class="sort" >';
    html += '    </td>';
	html += '    <td class="text-center"><a onclick="$(\'#module-items-' + element + '\').remove();">Remove</a></td>';
	html += '  </tr>';
	html += '</tbody>';
	$('#tab_faq_item .tabs-list tfoot').before(html);
	element++;
}
function addSections() {
	html  = '<tbody id="module-sections-' + section + '">';
	html += '  <tr>';
	html += '    <td class="first">';
    html += '		<input type="hidden" name="helpline_module[sections][' + section + '][id]" >';
	<?php foreach ($languages as $language) { ?>
	html += '		<div class="language"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><input type="text" name="helpline_module[sections][' + section + '][title][<?php echo $language['language_id']; ?>]" ></div>';
	<?php } ?>
	html += '    </td>';
	html += '    <td class="text-center">';
	html += '		<input type="text" name="helpline_module[sections][' + section + '][order]" class="sort" >';
    html += '    </td>';
	html += '    <td class="text-center"><a onclick="$(\'#module-sections-' + section + '\').remove();">Remove</a></td>';
	html += '  </tr>';
	html += '</tbody>';
	$('#tab_faq_section .tabs-list tfoot').before(html);
	section++;
}
$(document).ready(function() {

});
</script>
<?php echo $footer; ?>