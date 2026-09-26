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

/* Small note */
.note-box{
  background: rgba(49,141,93,.10);
  border:1px solid rgba(49,141,93,.25);
  border-radius:14px;
  padding:12px 14px;
  color:#245d42;
  font-size:13px;
}

/* Inputs */
label{
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
.table{ border-radius:14px; overflow:hidden; }
.table thead th{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06) !important;
  font-weight:900;
}
.table td{ vertical-align:middle !important; }

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

.btn-red{
  background:#dc3545; border-color:#dc3545; color:#fff;
  font-weight:900; border-radius:12px; padding:10px 14px;
}
.btn-red:hover{ opacity:.92; color:#fff; }

.mini-btn{
  padding:8px 12px !important;
  height:40px;
}
    
    .btn-red{
        background-color: red !important;
        color: white !important;
    }
    
    .white-btn{
        background-color: white !important;
        color: black !important;
    }
    
    .btn-green{
        background-color: lawngreen!important;
        color: black !important;
        
    }
 
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

  <div class="page__heading border-bottom">
    <div class="container-fluid page__container d-flex align-items-center justify-content-between">
      <h1 class="mb-0">Withdrawal Medium List</h1>
    </div>
  </div>

  <?php
  if($student['student_country']=="India"){
    $payment = array('Gpay', 'Phone Pay', 'Paytm', 'Binance');
  }elseif($student['student_country']=="Bangladesh"){
    $payment = array('Bkash', 'Nagad', 'Rocket', 'Binance');
  }elseif($student['student_country']=="Nepal"){
    $payment = array('eSewa', 'Binance');
  }
  ?>

  <div class="container-fluid page__container mt-3 mb-5">

    <?php if(empty($payment_medium)){ ?>
      <div class="note-box mb-3 text-center">
        No Withdrawal Medium Added. Please add one below.
      </div>
    <?php } ?>

    <?php if(!empty($success)){?>
      <div class="alert alert-success alert-dismissible" style="border-radius:14px;">
        <strong>Success!</strong> <?php echo $success;?>
      </div>
    <?php } ?>

    <?php if(!empty($error_payment_medium)){?>
      <div class="alert alert-danger alert-dismissible" style="border-radius:14px;">
        <strong>Danger!</strong> <?php echo $error_payment_medium;?>
      </div>
    <?php } ?>

    <div class="card card-glass">
      <div class="card-header p-4">
        <div style="font-weight:900; font-size:16px;">Add / Update Payment Medium</div>
        <div style="font-size:13px; color: #FFF;">Choose medium type and enter your mobile/account number.</div>
      </div>

      <div class="table-wrap">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-medium">
          <div class="table-responsive">
            <table class="table  table-dark  table-striped table-bordered nowrap" id="table" width="100%">
              <thead>
                <tr>
                  <th class="text-left">Medium Name</th>
                  <th class="text-left">Mobile / Account No</th>
                  <th class="text-left" style="width:120px;">Action</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $medium_row = 0;
                if(!empty($payment_medium)){
                  foreach($payment_medium as $item){
                ?>
                  <tr id="medium-row<?php echo $medium_row; ?>">
                    <td>
                      <select name="payment_medium[<?php echo $medium_row; ?>][medium_name]" class="form-control">
                        <?php foreach($payment as $name){ ?>
                          <option value="<?php echo $name; ?>" <?php if($name == $item['medium_name']) echo 'selected'; ?>>
                            <?php echo $name; ?>
                          </option>
                        <?php } ?>
                      </select>

                      <?php if (!empty($error_medium[$medium_row]['medium_name'])) { ?>
                        <div class="text-danger mt-1"><?php echo $error_medium[$medium_row]['medium_name']; ?></div>
                      <?php } ?>
                    </td>

                    <td>
                      <input type="text"
                             name="payment_medium[<?php echo $medium_row; ?>][medium_code]"
                             value="<?php echo $item['medium_code']; ?>"
                             class="form-control"
                             placeholder="Enter mobile/account number"/>

                      <?php if (!empty($error_medium[$medium_row]['medium_code'])) { ?>
                        <div class="text-danger mt-1"><?php echo $error_medium[$medium_row]['medium_code']; ?></div>
                      <?php } ?>
                    </td>

                    <td class="text-left">
                      <button type="button"
                              onclick="$('#medium-row<?php echo $medium_row; ?>').remove();"
                              class="btn btn-red mini-btn">
                        <i class="fa-regular fa-trash-can me-2"></i>
                      </button>
                    </td>
                  </tr>
                <?php
                    $medium_row++;
                  }
                }
                ?>
              </tbody>

              <tfoot>
                <tr>
                  <td colspan="2"></td>
                  <td class="text-left">
                    <button type="button" onclick="addMedium();" class="btn white-btn">
                     <i class="fa-solid fa-plus"></i> Add
                    </button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>

          <div class="d-flex justify-content-end mt-3">
            <button type="submit" name="submit" class="btn btn-green">
              Save
            </button>
          </div>

        </form>
      </div>
    </div>

  </div>
</div>

<?php $this->load->view('student/footer'); ?>

<script type="text/javascript">
var medium_row = <?php echo $medium_row; ?>;

function addMedium() {
  var html  = '<tr id="medium-row' + medium_row + '">';
  html += '<td><select name="payment_medium[' + medium_row + '][medium_name]" class="form-control">';
  <?php foreach($payment as $name){ ?>
    html += '<option value="<?php echo $name; ?>"><?php echo $name; ?></option>';
  <?php } ?>
  html += '</select></td>';

  html += '<td><input type="text" name="payment_medium[' + medium_row + '][medium_code]" value="" class="form-control" placeholder="Enter mobile/account number"/></td>';

  html += '<td><button type="button" class="btn btn-red mini-btn" onclick="$(\'#medium-row' + medium_row + '\').remove();">Remove</button></td>';
  html += '</tr>';

  $('#table tbody').append(html);
  medium_row++;
}
</script>
