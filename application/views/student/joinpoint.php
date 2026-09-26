<?php $this->load->view('student/header'); ?>

<style>

        :root{
  --bg1:#0f2027;
  --bg2:#203a43;
  --bg3:#2c5364;
  --glass: rgba(255,255,255,.10);
  --glass-border: rgba(255,255,255,.16);
  --accent:#ffc107;
  --text-soft: rgba(255,255,255,.78);
}
    body{
    background: linear-gradient(135deg, var(--bg1), var(--bg2), var(--bg3));
    color: #fff;
    }  
    
    .card-glass{
  background: var(--glass);
  border: 1px solid var(--glass-border);
  border-radius: 18px;
  backdrop-filter: blur(12px);
  box-shadow: 0 18px 45px rgba(0,0,0,.25);
}
    
.page__container .card-body {
    padding: 15px 20px;
}
    .card-glass-thumb{
        color: #FFF;
    }
    .card-glass-thumb .label{
        color: var(--accent);
        min-height: 50px;
    }
    
    
    .card-glass-thumb .value{
        font-size: 2.2rem;
    font-weight: 400;
    margin-top: 20px;
    margin-bottom: 7px;
    }
    
    
.page__heading {
    background: none !important;
    color: #FFF;
}
    
[dir=ltr] .card {
    background: var(--glass);
    border: 1px solid var(--glass-border);
    border-radius: 18px;
    backdrop-filter: blur(12px);
    box-shadow: 0 18px 45px rgba(0, 0, 0, .25);
          color: #FFF;
}
[dir=ltr] .card-header:first-child{
  border-radius: 18px 18px 0 0;
}

[dir=ltr] .card .badge{
  background: rgba(255, 193, 7, .15);
border: 1px solid rgba(255, 193, 7, .35);
color: var(--accent);
  font-size: 18px;
}
    [dir=ltr] .card p{
        margin-bottom: 0px;
    }
    
[dir=ltr] .btn.btn-accent{
  background: var(--accent);
  color: #111;
  border: none;
  border-radius: 999px;
  font-weight: 700;
  padding: 10px 18px;
}
[dir=ltr] .btn.btn-accent:hover{ background:#ffb300; }
    
    [dir=ltr] .card .form-control{
        background: rgba(255, 255, 255, .12) !important;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, .18) !important;
    border-radius: 999px;
    font-weight: 400;
    padding: 10px 18px;
    height: auto;
    }
    
    [dir=ltr] .card .form-control option{
        color: #000
    }
    
    [dir=ltr] .table thead th{
        color: #FFF;
    }
    .dataTables_scrollHeadInner{
        max-width: 100%;
    }
    [dir=ltr] .dataTable{
         max-width: 100%;
    }
    
    [dir=ltr] .page-link{
        height: 34px;
    }
    [dir=ltr] .card-header{
        border-bottom: 0px;
    }
    
    
</style>

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container d-flex align-items-center">
			<h1 class="mb-0">Joining Point Withdrawal</h1>
			<?php if ($student['admin_approve'] == 1 && $student['is_point_requested'] == 0){ ?>
			<a onclick="sendJoiningPoint()" class="btn btn-success ml-auto"><i class="material-icons">send</i> Joining Point Withdrawal Request</a>
			<?php } ?>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="card">
			<div class="card-header">
				<div class="row">
				    <?php if ($student['joining_point'] == 10000){ ?>
				        <?php if ($student['admin_approve'] == 1){ ?>
				            <?php if ($student['is_point_requested'] == 0){ ?>
				            <p>Please click on above button for sending joining point withdrawal request. Your joining point is <?php echo $student['joining_point']; ?></p>
				            <?php } ?>
				            
				            <?php if ($student['is_point_requested'] == 1 && $student['is_point_send'] == 0){ ?>
				                <p>You already requested to withdrawal joining point <?php echo $student['joining_point']; ?>. It is pending from admin approval.</p>
				                <?php }else{ ?>
				                <p>Admin already send your joining point <?php echo $student['joining_point']; ?>. </p>
				                <?php } ?>
				        <?php }else{ ?>
				        <p>Your joining point <?php echo $student['joining_point']; ?> is waiting for admin verification. After admin verify you can send withdrawal request.</p>
				        <?php } ?>
				    <?php }else{ ?>
				    <p>Sorry you are not authorize to view the content</p>
				    <?php } ?>
				</div>    
			</div> 
		</div> 
	</div>
</div>
<script type="text/javascript">
function sendJoiningPoint(){
    $.ajax({
		url: '<?php echo base_url('student/withdrawal/joinrequest'); ?>',
		type: 'post',
		data: 'status=1',
		dataType: 'json',
		success: function(json) {
		    alert('Your request successfully send to admin');
			location.reload();
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
</script>
<?php $this->load->view('student/footer'); ?>