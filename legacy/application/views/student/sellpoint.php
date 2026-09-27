<?php $this->load->view('student/header'); ?>

<style>
:root{ --blue:#1154b4; --green:#318d5d; }

/* Compact heading */
.page__heading{ padding:10px 0 !important; background:#fff; }
.page__heading.border-bottom{ border-bottom:1px solid rgba(0,0,0,.08) !important; }
.page__heading h3{ font-size:20px; font-weight:900; margin:0; letter-spacing:.2px; }

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

/* Table */
.table-wrap{ padding:14px 14px 18px; }
.table{ border-radius:14px; overflow:hidden; }
.table thead th{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06) !important;
  font-weight:900;
}
.table td, .table th{ vertical-align:middle !important; }

/* Modal */
.modal-content{ border-radius:16px; overflow:hidden; border:0; }
.modal-header{
  background: rgba(17,84,180,.08);
  border-bottom:1px solid rgba(0,0,0,.06);
}
.modal-title{ font-weight:900; }
.form-control{ border-radius:12px; height:44px; }
.form-control:focus{
  border-color: rgba(17,84,180,.55);
  box-shadow: 0 0 0 .2rem rgba(17,84,180,.12);
}
.note-box{
  background: rgba(49,141,93,.10);
  border:1px solid rgba(49,141,93,.25);
  border-radius:14px;
  padding:12px 14px;
  color:#245d42;
  font-size:13px;
}
</style>

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top:60px;">

  <div class="page__heading border-bottom">
    <div class="container-fluid page__container d-flex align-items-center justify-content-between">
      <h3 class="mb-0">Buy Seller Point ID List</h3>
    </div>
  </div>

  <div class="container-fluid page__container mt-3 mb-5">

    <?php if($status == 0){ ?>
      <div class="alert alert-danger" style="border-radius:14px;">
        Your Account Pending Withdrawal Point is: <strong><?php echo $student_pending_point;?></strong>
      </div>
    <?php } ?>

    <!-- Stats -->
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-3">
        <div class="stat green">
          <div class="label">Total Balance Point</div>
          <div class="value"><?php echo $balance_point;?></div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mb-3">
        <div class="stat blue">
          <div class="label">Point Conversion</div>
          <div class="value">1 Point = <?php echo $money_conversion;?> Rs</div>
        </div>
      </div>
    </div>

    <div class="card card-soft">
      <div class="card-header p-4">
        <div style="font-weight:900;font-size:16px;">Available Seller IDs</div>
        <div class="text-muted" style="font-size:13px;">Select an ID and send sell request from Action button.</div>
      </div>

      <div class="table-wrap">
        <div class="table-responsive">
          <table class="table table-striped table-bordered nowrap" id="table" width="100%">
            <thead>
              <tr>
                <th class="text-left">ID No</th>
                <th class="text-left">Name</th>
                <th class="text-left" style="width:120px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if($user_lists){ ?>
                <?php foreach($user_lists as $item){?>
                  <tr>
                    <td><?php echo $item['username'];?></td>
                    <td><?php echo $item['firstname'].' '.$item['lastname'];?></td>
                    <td class="text-left">
                      <a data-toggle="modal"
                         data-target="#confirm-status"
                         data-id="<?php echo $item['user_id']; ?>"
                         type="button"
                         class="btn btn-blue"
                         style="padding:8px 12px;">
                        Send
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th class="text-left">ID No</th>
                <th class="text-left">Name</th>
                <th class="text-left">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

    </div>

  </div>
</div>

<?php $this->load->view('student/footer'); ?>

<!-- ================= MODAL ================= -->
<div id="confirm-status" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <div class="w-100">
          <?php if($status == 0){ ?>
            <div class="alert alert-danger mb-2" style="border-radius:14px;">
              Your Pending Withdrawal Point <strong><?php echo $student_pending_point;?></strong> is not clear.
              You can not sell point to any Buy Seller ID.
            </div>
          <?php }else{ ?>
            <h6 class="modal-title">
              Minimum Withdrawal Point: <?php echo $minimum_withdrawal_point;?>
              | 1 Point = <?php echo $money_conversion;?> Rs
            </h6>
          <?php } ?>
        </div>

        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>

      <div class="modal-body">
        <div id="section-add">

          <?php if($status != 0){ ?>
            <?php if($balance_point>$minimum_withdrawal_point){ ?>

              <div class="form-group required">
                <label style="font-size:12px;font-weight:900;color:#6c757d;text-transform:uppercase;">Point</label>
                <input type="text" name="point" class="form-control" value="" placeholder="Enter point">
              </div>

              <input type="hidden" name="user_id" id="input-user_id" value="" />

              <div class="note-box">
                Make sure your point is enough. After sending request, admin will process.
              </div>

            <?php }else{ ?>
              <div class="alert alert-warning" style="border-radius:14px;">
                You can not send request due to low point.
              </div>
            <?php } ?>
          <?php } ?>

        </div>

        <div id="add-msg"></div>
      </div>

      <div class="modal-footer" id="footer-add">
        <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius:12px;">Close</button>

        <?php if($status != 0){ if($balance_point>$minimum_withdrawal_point){?>
          <button type="button" id="button-add" class="btn btn-green">Send Request</button>
        <?php } } ?>
      </div>

    </div>
  </div>
</div>

<script>
$('#confirm-status').on('show.bs.modal', function(e) {
  var id = ($(e.relatedTarget).data('id'));
  $('#input-user_id').val(id);
});

$('#button-add').click(function(){
  $.ajax({
    url: '<?php echo base_url('student/sellpoint/addrequest'); ?>',
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
        $('#add-msg').prepend(
          '<div class="alert alert-danger" style="border-radius:14px;">' +
          json['error'] +
          '<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
        );
      }

      if (json['success']) {
        $('#footer-add').hide();
        $('#add-msg').prepend(
          '<div class="alert alert-success" style="border-radius:14px;">' +
          json['success'] +
          '<button type="button" class="close" data-dismiss="alert">&times;</button></div>'
        );
        location.reload();
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
</script>
