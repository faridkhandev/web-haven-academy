<?php $this->load->view('student/header'); ?>

<style>
:root{ --blue:#1154b4; --green:#318d5d; }

/* Compact heading */
.page__heading{ padding:10px 0 !important; background:#fff; }
.page__heading.border-bottom{ border-bottom:1px solid rgba(0,0,0,.08) !important; }
.page__heading h1{ font-size:22px; font-weight:900; margin:0; letter-spacing:.2px; }

/* Card */
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

.btn-danger-soft{
  background: rgba(220,53,69,.12);
  border:1px solid rgba(220,53,69,.20);
  color:#dc3545;
  font-weight:900;
  border-radius:12px;
  padding:8px 12px;
}
.btn-danger-soft:hover{ background: rgba(220,53,69,.18); color:#dc3545; }

.btn-info-soft{
  background: rgba(17,84,180,.10);
  border:1px solid rgba(17,84,180,.20);
  color: var(--blue);
  font-weight:900;
  border-radius:12px;
  padding:8px 12px;
}
.btn-info-soft:hover{ background: rgba(17,84,180,.16); color: var(--blue); }

/* Table */
.table-wrap{ padding:14px 14px 18px; }
.table{ border-radius:14px; overflow:hidden; }
table.dataTable thead th{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06) !important;
  font-weight:900;
}
.table td, .table th{ vertical-align:middle !important; }

/* Badges */
.badge-pill{
  border-radius:999px;
  padding:6px 10px;
  font-weight:900;
  font-size:12px;
}
</style>

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top:60px;">

  <div class="page__heading border-bottom">
    <div class="container-fluid page__container d-flex align-items-center justify-content-between">
      <h1 class="mb-0">Sell Point Request List</h1>
    </div>
  </div>

  <div class="container-fluid page__container mt-3 mb-5">

    <div class="card card-soft">
      <div class="card-header p-4">

        <form id="form-filter">
          <div class="filter-bar">

            <div class="filter-group">
              <label>Start Date</label>
              <input type="text"
                     class="form-control flatpickrStart"
                     name="filter_start_date"
                     placeholder="YYYY-MM-DD"
                     value="<?php echo $filter_start_date;?>">
            </div>

            <div class="filter-group">
              <label>End Date</label>
              <input type="text"
                     class="form-control flatpickrEnd"
                     name="filter_end_date"
                     placeholder="YYYY-MM-DD"
                     value="<?php echo $filter_end_date;?>">
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
              <button type="button" class="btn btn-blue" id="button-filter" style="height:44px;">
                Filter
              </button>
            </div>

          </div>
        </form>

      </div>

      <div class="table-wrap">
        <table class="table table-striped table-bordered nowrap" id="table" width="100%">
          <thead>
            <tr>
              <th class="text-left">Request Point</th>
              <th class="text-left">Requested At</th>
              <th class="text-left">Buyer ID</th>
              <th class="text-left">Status</th>
              <th class="text-left">Screenshot</th>
              <th class="text-left">Approve At</th>
              <th class="text-left">Cancel At</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <th class="text-left">Request Point</th>
              <th class="text-left">Requested At</th>
              <th class="text-left">Buyer ID</th>
              <th class="text-left">Status</th>
              <th class="text-left">Screenshot</th>
              <th class="text-left">Approve At</th>
              <th class="text-left">Cancel At</th>
              <th class="text-left">Action</th>
            </tr>
          </tfoot>
        </table>
      </div>

    </div>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  var url = '<?php echo base_url('student/sellpointlist'); ?>';

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

        var filter_approve_status = $.trim($('select[name="filter_approve_status"]').val());
        if (filter_approve_status) data.filter_approve_status = filter_approve_status;
      }
    },
    "columns": [
      {"data":"point","searchable":false},
      {"data":"requested_at","searchable":false},
      {"data":"username","searchable":false},
      {
        "data":"status",
        "searchable":false,
        "render": function(d, type, full){
          var s = (full.raw_status || d || '').toString().toLowerCase();
          if(s === 'paid'){
            return '<span class="badge badge-success badge-pill">Paid</span>';
          }
          if(s === 'pending'){
            return '<span class="badge badge-warning badge-pill">Pending</span>';
          }
          if(s === 'cancel'){
            return '<span class="badge badge-danger badge-pill">Cancel</span>';
          }
          return '<span class="badge badge-secondary badge-pill">'+(full.raw_status || d)+'</span>';
        }
      },
      {"data":"screenshot","searchable":false},
      {"data":"approve_at","searchable":false},
      {"data":"cancelled_at","searchable":false},
      {
        "data":"action",
        "width":"14%",
        "orderable":false,
        "searchable":false,
        "className":"text-center",
        "render": function(data, type, full){
          var html = '';

          if(full.raw_status === 'Pending'){
            html += '<button type="button" class="btn btn-danger-soft mr-2" onclick="confirm(\'Are you sure?\') ? makeComplain('+full.id+') : false;">Complain</button>';
          }

          if(full.raw_status === 'Paid'){
            if(full.is_transfer == 1){
              html += '<button type="button" class="btn btn-danger-soft mr-2" onclick="confirm(\'Are you sure?\') ? makeComplain('+full.id+') : false;">Complain</button>';
              html += '<button type="button" class="btn btn-info-soft" onclick="confirm(\'Are you sure?\') ? makeAccept('+full.id+') : false;">Confirm Payment</button>';
            }
          }

          return html;
        }
      }
    ]
  });

  $('#button-filter').on('click', function() {
    table.ajax.reload();
  });
});

function makeComplain(id){
  $.ajax({
    url: '<?php echo base_url('student/sellpointlist/complain'); ?>',
    type: 'post',
    data: 'id='+id,
    dataType: 'json',
    success: function(json) {
      if (json['error']) alert(json['error']);
      if (json['success']) { alert(json['success']); location.reload(); }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}

function makeAccept(id){
  $.ajax({
    url: '<?php echo base_url('student/sellpointlist/accept'); ?>',
    type: 'post',
    data: 'id='+id,
    dataType: 'json',
    success: function(json) {
      if (json['error']) alert(json['error']);
      if (json['success']) { alert(json['success']); location.reload(); }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
</script>

<?php $this->load->view('student/footer'); ?>
