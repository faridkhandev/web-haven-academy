	</div><!--id="appbody" end-->	
	<footer id="footer">
		<div id="serverTime">
			 <small>Server Time</small>
			 <h5>15:16</h5>
		</div>
		<div id="autoLogOutTimer"></div>
		<div class="copy-right">
		
		<span>				
			<strong><?php echo APPNAME.' '.APPVERSION.' © '.COPYRIGHTYEAR; ?></strong>				
			<small><?php echo $text_footer ?></small>			
		</span>	
		<span class="tasks">			
		<ul class="text-center">
			<!--li><a href="#"><i class="fa fa-cog fa-fw"></i></a></li>
			<li><a href="#"><i class="fa fa-cog fa-fw"></i></a></li>
			<li><a href="#"><i class="fa fa-cog fa-fw"></i></a></li-->
		</ul>	
		</span>		
		</div>  
	</footer>  
	</div>  
	<?php echo (isset($modal) && ($modal != NULL || $modal != '')) ? $modal : ''; ?>
	
	<script>
	$("#main-nav li:has(ul)").click(function(e){
	  $(this).siblings().children("a").collapse("hide");
	  $(this).siblings().children("div").collapse("hide");  
	  //e.stopPropagation();
	}); 

	//$(".nav-item123").click(function(){
	 // $(this).children(".nav-link").attr("aria-expanded","true");
	//}); 
	$("#button-menu").click(function(){
        $("body").toggleClass("slIde");
    });
	//$(".sidebar ").mouseover(function(){
     //   $("body").removeClass("slIde");
    //});
	</script>
	
		<div class="modal fade" id="myModalReceive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Invoice Bill</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="form-invoice">
							<div class="form-group">
								<label class="col-sm-3 control-label">Search By Invoice No</label>
								<div class="col-sm-9 input-group">
									<input type="text" class="form-control" name="invoice_no" id="header_invoice_no" />
								</div>
								<button type="button" id="button-invoice-search" data-loading-text="Loading" class="btn btn-danger sbtn">Search</button>
							</div>
							<div id="invoice-msg"></div>
						</form>
					</div>
					<div class="modal-footer" id="footer-invoice">
					<div class="row">
						<div class="col-sm-12">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="myModalGive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Voucher Bill</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="form-voucher">
							<div class="form-group">
								<label class="col-sm-3 control-label">Search By Voucher No</label>
								<div class="col-sm-9 input-group">
									<input type="text" class="form-control" name="voucher_no" id="header_voucher_no" />
								</div>
							</div>
							<button type="button" id="button-voucher-search" data-loading-text="Loading" class="btn btn-danger sbtn">Search</button>
							<div id="voucher-msg"></div>
						</form>
					</div>
					<div class="modal-footer" id="footer-voucher">
						<div class="row">
						<div class="col-sm-12">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script>
			$('#button-invoice-search').click(function(){
				var invoice_no = $('#header_invoice_no').val();
				$.ajax({
					url: 'index.php?route=module/invoice/search&token=<?php echo $token ?>',
					type: 'post',
					data: $('#form-invoice input[type=\'text\'], #form-invoice input[type=\'hidden\'], #form-invoice textarea'),
					dataType: 'json',
					beforeSend: function() {
						$('#button-invoice-search').button('loading');
					},
					complete: function() {
						 $('#button-invoice-search').button('reset');
					},
					success: function(json) {
						$('.alert, .text-danger').remove();
						if (json['error']) {
							$('#invoice-msg').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						}
						
						if (json['success']) {							
							$('#footer-invoice').hide();
							alert('Invoice no found, we are redirect to invoice');
							setTimeout(function () {window.location.href = "index.php?route=module/invoice&token=<?php echo $token ?>&filter_invoice="+invoice_no; }, 2000);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			});
			
			$('#button-voucher-search').click(function(){
				var voucher_no = $('#header_voucher_no').val();
				$.ajax({
					url: 'index.php?route=module/voucher/search&token=<?php echo $token ?>',
					type: 'post',
					data: $('#form-voucher input[type=\'text\'], #form-voucher input[type=\'hidden\'], #form-voucher textarea'),
					dataType: 'json',
					beforeSend: function() {
						$('#button-voucher-search').button('loading');
					},
					complete: function() {
						 $('#button-voucher-search').button('reset');
					},
					success: function(json) {
						$('.alert, .text-danger').remove();
						if (json['error']) {
							$('#voucher-msg').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						}
						
						if (json['success']) {							
							$('#footer-voucher').hide();
							alert('Voucher no found, we are redirect to voucher');
							setTimeout(function () {window.location.href = "index.php?route=module/voucher&token=<?php echo $token ?>&filter_voucher="+voucher_no; }, 2000);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			});
		</script>
	
	</body>
</html>