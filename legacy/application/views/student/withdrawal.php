<?php $this->load->view('student/header'); ?>

<style>
:root{ --blue:#1154b4; --green:#318d5d; }

/* Compact heading */
.page__heading{ padding:10px 0 !important; background:#fff; }
.page__heading h1{ font-size:22px; font-weight:900; margin:0; letter-spacing:.2px; }
.page__heading.border-bottom{ border-bottom:1px solid rgba(0,0,0,.08) !important; }

/* Buttons */
.btn-blue{
  background:var(--blue); border-color:var(--blue); color:#fff;
  font-weight:900; border-radius:12px; padding:10px 14px;
}
.btn-blue:hover{ opacity:.92; color:#fff; }
.btn-green{
  background:var(--green); border-color:var(--green); color:#fff;
  font-weight:900; border-radius:12px; padding:10px 14px;
}
.btn-green:hover{ opacity:.92; color:#fff; }

/* Cards */
.card-soft{
  border:1px solid rgba(0,0,0,.06);
  border-radius:16px;
  box-shadow:0 12px 30px rgba(0,0,0,.06);
  overflow:hidden;
  background:#fff;
}
.card-soft .card-header{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06);
}

/* Stat cards */
.stat{
  border-radius:16px;
  border:1px solid rgba(0,0,0,.06);
  background:#fff;
  box-shadow:0 10px 25px rgba(0,0,0,.05);
  padding:14px 16px;
}
.stat .label{
  font-size:12px; font-weight:900; letter-spacing:.4px;
  text-transform:uppercase; color:#6c757d;
}
.stat .value{
  font-size:18px; font-weight:900; margin-top:6px;
}
.stat.blue{ border-left:4px solid var(--blue); }
.stat.green{ border-left:4px solid var(--green); }

/* Note box */
.note-box{
  background: rgba(49,141,93,1);
  border:0px solid rgba(49,141,93,.25);
  border-radius:14px;
  padding:12px 14px;
  color:#FFF;
  font-size:13px;
}

/* Filters */
.filter-bar{
  display:flex;
  flex-wrap:wrap;
  gap:12px;
  align-items:end;
}
.filter-group label{
  font-size:12px;
  font-weight:900;
  letter-spacing:.4px;
  text-transform:uppercase;
  color:#6c757d;
  margin-bottom:6px;
}
.form-control{ border-radius:12px; height:44px; }
.form-control:focus{
  border-color: rgba(17,84,180,.55);
  box-shadow: 0 0 0 .2rem rgba(17,84,180,.12);
}

/* Table */
.table-wrap{ padding:14px 14px 18px; }
table.dataTable thead th{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06) !important;
}
.table{ border-radius:14px; overflow:hidden; }
.table td, .table th{ vertical-align:middle !important; }

/* Modal */
.modal-content{ border-radius:16px; overflow:hidden; border:0; }
.modal-header{ background: rgba(17,84,180,.08); border-bottom:1px solid rgba(0,0,0,.06); }
.modal-title{ font-weight:900; }
.small-hint{ font-size:12px; color:#6c757d; }
    
    .filter-group label{
        color: #FFF;
    }
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
    
    
    
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top:60px;">

  <!-- Heading -->
  <div class="page__heading border-bottom">
    <div class="container-fluid page__container d-flex align-items-center">
      <h1 class="mb-0">Withdrawal</h1>
      <a data-toggle="modal" data-target="#modal-large" class="btn btn-accent ml-auto">
        New Withdrawal Request
      </a>
    </div>
  </div>

  <div class="container-fluid page__container mt-3">

    <?php if($status == 0){?>
      <div class="alert alert-danger" style="border-radius:14px;">
        Your Account Pending Withdrawal Point is: <strong><?php echo $student_pending_point;?></strong>
      </div>
    <?php } ?>

    <!-- Stats -->
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="card-glass">
            <div class="card-body card-glass-thumb">
          <div class="label">Minimum Withdrawal</div>
          <div class="value"><?php echo $minimum_withdrawal_point;?></div>
            </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3">
        <div class="card-glass">
            <div class="card-body card-glass-thumb">
          <div class="label">Balance Point</div>
          <div class="value"><?php echo $balance_point;?></div>
        </div>
          </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3">
        <div class="card-glass">
            <div class="card-body card-glass-thumb">
          <div class="label">Total Requested</div>
          <div class="value"><?php echo $total_withdrawal_request_point;?></div>
        </div>
          </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-3">
        <div class="card-glass">
            <div class="card-body card-glass-thumb">
          <div class="label">Final Balance After Request</div>
          <div class="value"><?php echo ($balance_point-$total_withdrawal_request_point); ?></div>
        </div>
          </div>
      </div>
    </div>

    <div class="note-box mb-3">
      <strong>Info:</strong> 1 Point = <strong><?php echo $money_conversion;?></strong> Rs.
      For Nepal minimum withdrawal point is <strong>2000</strong>. After withdrawal you will get money within <strong>72 hours</strong>.
    </div>

    <!-- Table + Filter -->
    <div class="card card-soft">
      <div class="card-header p-4">

        <form id="form-filter">
          <div class="filter-bar">

            <div class="filter-group">
              <label>Start Date</label>
              <input type="text" class="form-control flatpickrStart" name="filter_start_date"
                     placeholder="YYYY-MM-DD" value="<?php echo $filter_start_date;?>">
            </div>

            <div class="filter-group">
              <label>End Date</label>
              <input type="text" class="form-control flatpickrEnd" name="filter_end_date"
                     placeholder="YYYY-MM-DD" value="<?php echo $filter_end_date;?>">
            </div>

            <div class="filter-group">
              <label>Status</label>
              <select name="filter_approve_status" class="form-control">
                <option value="">-Select-</option>
                <option value="Paid">Approve</option>
                <option value="Pending">Pending</option>
                <option value="Cancel">Cancel</option>
              </select>
            </div>

            <div class="filter-group">
              <button type="button" class="btn btn-accent" id="button-filter" style="height:44px;">Filter</button>
            </div>

          </div>
        </form>

      </div>

      <div class="table-wrap">
        <table class="table table-dark table-striped table-bordered nowrap" id="table" width="100%">
          <thead>
            <tr>
              <th class="text-left">Request Point</th>
              <th class="text-left">Requested At</th>
              <th class="text-left">Status</th>
              <th class="text-left">Approve At</th>
              <th class="text-left">Cancel At</th>
              <th class="text-left">Comment</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <th class="text-left">Request Point</th>
              <th class="text-left">Requested At</th>
              <th class="text-left">Status</th>
              <th class="text-left">Approve At</th>
              <th class="text-left">Cancel At</th>
              <th class="text-left">Comment</th>
            </tr>
          </tfoot>
        </table>
      </div>

    </div>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  var url = '<?php echo base_url('student/withdrawal'); ?>';

  var table = $('#table').DataTable({
    "stateSave": true,
    "scrollY": "100%",
    "scrollX": true,
    "searching": false,
    "order": [],
    "processing": false,
    "serverSide": true,
    "lengthMenu": [[10,20,50,100,250,500,750,1000,-1],[10,20,50,100,250,500,750,1000,"All"]],
    "pageLength": 20,
    "ajax": {
      "url": url,
      "type": "POST",
      "data": function (data) {
        var filter_end_date = $.trim($('input[name="filter_end_date"]').val());
        if (filter_end_date) data.filter_end_date = filter_end_date;

        var filter_start_date = $.trim($('input[name="filter_start_date"]').val());
        if (filter_start_date) data.filter_start_date = filter_start_date;

        // ✅ FIX: it is a SELECT, not input
        var filter_approve_status = $.trim($('select[name="filter_approve_status"]').val());
        if (filter_approve_status) data.filter_approve_status = filter_approve_status;
      }
    },
    "columns": [
      {"data": "withdrawal_point", "searchable": false},
      {"data": "requested_at", "searchable": false},
      {
        "data": "approve_status",
        "searchable": false,
        "render": function(data){
          if(data === 'Paid') return '<span class="badge badge-success" style="border-radius:999px;padding:6px 10px;">Paid</span>';
          if(data === 'Pending') return '<span class="badge badge-warning" style="border-radius:999px;padding:6px 10px;">Pending</span>';
          if(data === 'Cancel') return '<span class="badge badge-danger" style="border-radius:999px;padding:6px 10px;">Cancel</span>';
          return data;
        }
      },
      {"data": "approve_at", "searchable": false},
      {"data": "cancelled_at", "searchable": false},
      {"data": "comment", "searchable": false}
    ]
  });

  $('#button-filter').on('click', function() {
    table.ajax.reload();
  });
});
</script>

<?php $this->load->view('student/footer'); ?>

<!-- ================= MODAL ================= -->
<div id="modal-large" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <div class="w-100">
          <?php if($status == 0){?>
            <div class="alert alert-danger mb-2" style="border-radius:14px;">
              Your Pending Withdrawal Point <strong><?php echo $student_pending_point;?></strong> is not clear.
              Admin will deduct pending points first, then remaining amount will be transferred.
            </div>
          <?php } ?>

          <h6 class="modal-title" id="modal-large-title" style="font-weight:900;">
            Minimum Withdrawal: <?php echo $minimum_withdrawal_point;?> |
            1 Point = <?php echo $money_conversion;?> Rs
          </h6>
        </div>

        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>

      <div class="modal-body">
        <div id="section-add">
          <?php if($balance_point>$minimum_withdrawal_point){?>

            <div class="form-group required">
              <label class="control-label">Point</label>
              <input type="text" name="withdrawal_point" class="form-control" value="" placeholder="Enter point">
              <small class="small-hint">Example: 2000</small>
            </div>

            <div class="form-group required">
              <label class="control-label">Select Payment Medium</label>

              <?php if(!empty($payment_medium)){?>
                <select name="payment_medium" class="form-control">
                  <option value="">-Please Select-</option>
                  <?php foreach($payment_medium as $item){?>
                    <option value="<?php echo $item['medium_name'];?> - <?php echo $item['medium_code'];?>">
                      <?php echo $item['medium_name'];?> - <?php echo $item['medium_code'];?>
                    </option>
                  <?php } ?>
                </select>
              <?php }else{ ?>
                <p class="mb-0">
                  No Withdrawal Medium Added. Please add from
                  <a href="<?php echo base_url('student/medium'); ?>">here</a>.
                </p>
              <?php } ?>

            </div>

            <div class="form-group">
              <label class="control-label">Additional Message (Optional)</label>
              <textarea name="withdrawal_message" class="form-control" placeholder="Any additional message(optional)" style="height:90px;border-radius:12px;"></textarea>
            </div>

          <?php }else{ ?>
            <div class="alert alert-warning" style="border-radius:14px;">
              You can not send withdrawal request due to low point.
            </div>
          <?php } ?>
        </div>

        <div id="add-msg"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius:12px;">Close</button>
        <?php if($balance_point>$minimum_withdrawal_point){?>
          <button type="button" id="button-add" class="btn btn-green">Send Request</button>
        <?php } ?>
      </div>

    </div>
  </div>
</div>

<script>
$('#button-add').click(function(){
  $.ajax({
    url: '<?php echo base_url('student/withdrawal/addrequest'); ?>',
    type: 'post',
    data: $('#section-add input[type="text"], #section-add input[type="hidden"], #section-add select, #section-add textarea'),
    dataType: 'json',
    beforeSend: function() {
      $('#button-add').button('loading');
    },
    complete: function() {
      $('#button-add').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      if (json['error']) {
        $('#add-msg').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
      if (json['success']) {
        $('#add-msg').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        location.reload();
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
</script>
