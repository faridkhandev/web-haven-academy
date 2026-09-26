<?php $this->load->view('student/header'); ?>

<style>
:root{ --blue:#1154b4; --green:#318d5d; }

/* Compact heading */
.page__heading{ padding:10px 0 !important; background:#fff; }
.page__heading h1{ font-size:22px; font-weight:900; margin:0; letter-spacing:.2px; }
.page__heading.border-bottom{ border-bottom:1px solid rgba(0,0,0,.08) !important; }

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

/* Filter bar */
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

/* Table */
.table-wrap{ padding:14px 14px 18px; }
table.dataTable thead th{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06) !important;
}
.table{ border-radius:14px; overflow:hidden; }
.table td, .table th{ vertical-align:middle !important; }

/* Amount badges */
.badge-pill{
  border-radius:999px;
  padding:6px 10px;
  font-weight:900;
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

  <div class="page__heading border-bottom">
    <div class="container-fluid page__container">
      <h1 class="mb-0">Payment List</h1>
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
              <button type="button" class="btn btn-accent" id="button-filter" style="height:44px;">
                Filter
              </button>
            </div>

          </div>
        </form>
      </div>

      <div class="table-wrap">
        <div class="table-responsive">
          <table class="table table-dark table-striped table-bordered nowrap" id="table" width="100%">
            <thead>
              <tr>
                <th class="text-left">Reason</th>
                <th class="text-left">Credit Point</th>
                <th class="text-left">Debit Point</th>
                <th class="text-left">Balance Point</th>
                <th class="text-left">Date</th>
                <th class="text-left">Description</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
              <tr>
                <th class="text-left">Reason</th>
                <th class="text-left">Credit Point</th>
                <th class="text-left">Debit Point</th>
                <th class="text-left">Balance Point</th>
                <th class="text-left">Date</th>
                <th class="text-left">Description</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  var url = '<?php echo base_url('student/payment'); ?>';

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

        var filter_type = $.trim($('select[name="filter_type"]').val());
        if (filter_type) data.filter_type = filter_type;
      }
    },
    "columns": [
      {"data": "reason", "searchable": false},
      {
        "data": "credit_point",
        "searchable": false,
        "render": function(d){
          if(!d || d==0) return '<span class="badge badge-light badge-pill">0</span>';
          return '<span class="badge badge-success badge-pill">'+d+'</span>';
        }
      },
      {
        "data": "debit_point",
        "searchable": false,
        "render": function(d){
          if(!d || d==0) return '<span class="badge badge-light badge-pill">0</span>';
          return '<span class="badge badge-danger badge-pill">'+d+'</span>';
        }
      },
      {"data": "balance_point", "searchable": false},
      {"data": "created_at", "searchable": false},
      {"data": "description", "searchable": false}
    ]
  });

  $('#button-filter').on('click', function() {
    table.ajax.reload();
  });
});
</script>

<?php $this->load->view('student/footer'); ?>
