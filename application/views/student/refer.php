<?php $this->load->view('student/header'); ?>

<style>
/* Theme */
:root{
  --blue:#1154b4;
  --green:#318d5d;
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

/* Page heading */
.page__heading{
  background:#fff;
}
.page__heading .page-title{
  font-weight:900;
  letter-spacing:.3px;
}
.btn-brand{
  background: var(--green);
  border-color: var(--green);
  color:#fff;
  font-weight:800;
  border-radius:12px;
  padding:10px 14px;
}
.btn-brand:hover{ opacity:.92; color:#fff; }
.btn-blue{
  background: var(--blue);
  border-color: var(--blue);
  color:#fff;
  font-weight:800;
  border-radius:12px;
  padding:10px 14px;
}
.btn-blue:hover{ opacity:.92; color:#fff; }

/* Card shell */
.card-soft{
  border:1px solid rgba(0,0,0,.06);
  border-radius:16px;
  box-shadow:0 12px 30px rgba(0,0,0,.06);
  overflow:hidden;
}
.card-soft .card-header{
/*
  background:#fff;
  border-bottom:1px solid rgba(0,0,0,.06);
*/
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border-radius: 14px;
    background: rgba(255, 255, 255, .10);
    border: 1px solid rgba(255, 255, 255, .14);
}

/* Filter bar */
.filter-bar{
  display:flex;
  flex-wrap:wrap;
  gap:12px;
  align-items:end;
}
.filter-group label{
  font-size:12px;
  font-weight:400;
  letter-spacing:.5px;
  text-transform:uppercase;
/*  color:#6c757d;*/
    color: #FFF;
  margin-bottom:6px;
}
.filter-group input{
  border-radius:12px;
  height:44px;
}
.table-wrap{
  padding: 14px 14px 18px;
}

/* DataTables look */
table.dataTable thead th{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06) !important;
}
.table{
  border-radius:14px;
  overflow:hidden;
}
.table td, .table th{
  vertical-align:middle !important;
}

/* Modal */
.modal-content{
  border-radius:16px;
  overflow:hidden;
  border:0;
}
.modal-header{
  background: rgba(17,84,180,.08);
  border-bottom:1px solid rgba(0,0,0,.06);
}
.modal-title{
  font-weight:900;
}
.modal-body label{
  font-weight:800;
  font-size:13px;
}
.modal-body input{
  border-radius:12px;
  height:44px;
}
/* Compact page heading */
.page__heading{
    padding: 10px 0 !important;
    background: #ffffff;
}

.page__heading h1{
    font-size: 22px;        /* smaller, cleaner */
    font-weight: 800;
    letter-spacing: .2px;
    margin: 0;
}

/* Reduce container vertical spacing */
.page__container{
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* Thin border */
.page__heading.border-bottom{
    border-bottom: 1px solid rgba(0,0,0,.08) !important;
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
    
    [dir=ltr] .form-control{
        background: rgba(255, 255, 255, .12) !important;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, .18) !important;
    border-radius: 999px;
    font-weight: 400;
    padding: 10px 18px;
    height: auto;
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
  <div class="page__heading">
    <div class="container-fluid page__container d-flex align-items-center">
      <h1 class="mb-0 page-title">My Refer</h1>

      <?php if($this->session->userdata('student_status')==1){?>
        <a href="https://api.whatsapp.com/send?text=<?php echo $this->session->userdata('refer_link');?>"
           target="_blank"
           class="btn btn-accent ml-auto">
          Send New Refer Request
        </a>
      <?php } ?>
    </div>
  </div>

  <div class="container-fluid page__container mt-3">

    <div class="card card-soft">
      <div class="card-header">
        <form name="form_filter" enctype="multipart/form-data" id="form-filter">
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
              <button type="button" class="btn btn-accent" id="button-filter" style="height:44px;">
                Filter
              </button>
            </div>

          </div>
        </form>
      </div>

      <div class="table-wrap">
        <table class="table table-dark table-striped table-bordered nowrap" id="table" width="100%">
          <thead>
            <tr>
              <th class="text-left">ID</th>
              <th class="text-left">Name</th>
              <th class="text-left">Phone</th>
              <th class="text-left">Whatsapp</th>
              <th class="text-left">Gender</th>
              <th class="text-left">Date Added</th>
              <th class="text-left">Status</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <th class="text-left">ID</th>
              <th class="text-left">Name</th>
              <th class="text-left">Phone</th>
              <th class="text-left">Whatsapp</th>
              <th class="text-left">Gender</th>
              <th class="text-left">Date Added</th>
              <th class="text-left">Status</th>
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
  var url = '<?php echo base_url('student/refer'); ?>';

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
      }
    },
    "columns": [
      {"data": "student_no", "searchable": false},
      {"data": "student_name", "searchable": false},
      {"data": "student_phone", "searchable": false},
      {"data": "student_whatsapp", "searchable": false},
      {"data": "student_gender", "searchable": false},
      {"data": "created_at", "searchable": false},
      {"data": "student_status", "searchable": false},
      {"data": "action", "width":"14%", "orderable": false, "searchable": false, "className": "text-center",
        "render": function(data, type, full) {
          var html = '';
          if(full.whatsapp_status == 0){
            html += '<a data-toggle="modal" data-target="#confirm-status" data-id="'+data+'" data-student_no="'+full.student_no+'" data-student_name="'+full.student_name+'" class="btn btn-blue btn-sm" style="border-radius:10px;">Update WhatsApp</a>';
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
</script>

<?php $this->load->view('student/footer'); ?>

<!-- Modal -->
<div class="modal fade" id="confirm-status" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Update WhatsApp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div id="section-add">
          <div class="form-group">
            <label>New WhatsApp No (Example: 8801747355)</label>
            <input type="text" name="student_whatsapp" class="form-control" value="" placeholder="88017789080" />
          </div>
          <input type="hidden" name="student_id" value="" />
        </div>
        <div id="add-msg"></div>
      </div>

      <div class="modal-footer" id="footer-add">
        <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius:12px;">Cancel</button>
        <button type="button" id="button-add" data-loading-text="Loading" class="btn btn-brand">Save</button>
      </div>

    </div>
  </div>
</div>

<script>
$('#confirm-status').on('show.bs.modal', function(e) {
  var id = ($(e.relatedTarget).data('id'));
  var student_no = ($(e.relatedTarget).data('student_no'));
  var name = ($(e.relatedTarget).data('student_name'));

  $('#section-add input[name="student_id"]').val(id);
  $('#myModalLabel').html('ID: '+student_no+' | Name: '+name);
});

$('#button-add').click(function(){
  $.ajax({
    url: '<?php echo site_url('student/refer/updatewhatsappp'); ?>',
    type: 'post',
    data: $('#section-add input[type="text"], #section-add input[type="hidden"], #section-add textarea'),
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
        $('#add-msg').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }

      if (json['success']) {
        $('#footer-add').hide();
        $('#add-msg').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
</script>
