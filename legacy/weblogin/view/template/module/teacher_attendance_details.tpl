<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <?php if (!empty($records)) { ?>
        <a href="<?php echo $clear_teacher_data; ?>" onclick="return confirm('Are you sure you want to delete all records for this teacher?');" data-toggle="tooltip" title="Clear All Records for This Teacher" class="btn btn-danger">
          <i class="fa fa-trash"></i> Clear Teacher Data
        </a>
        <?php } ?>
        <a href="<?php echo $back; ?>" data-toggle="tooltip" title="Back" class="btn btn-default"><i class="fa fa-reply"></i> Back</a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if (!empty($success)) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-clock-o"></i> Submission History</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="active">
                <th style="width: 60px;" class="text-center">SL No</th>
                <th>Session No</th>
                <th>Meeting Link</th>
                <th>Submission Exact Date & Time</th>
                <th class="text-right" style="width: 100px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($records) { ?>
              <?php $i = 1; foreach ($records as $row) { ?>
              <tr>
                <td class="text-center"><?php echo $i++; ?></td>
                <td>Session <?php echo $row['session_no']; ?></td>
                <td><a href="<?php echo $row['meeting_link']; ?>" target="_blank"><?php echo $row['meeting_link']; ?></a></td>
                <td><i class="fa fa-calendar"></i> <?php echo $row['submitted_at']; ?></td>
                <td class="text-right">
                  <a href="<?php echo $row['delete']; ?>" onclick="return confirm('Are you sure you want to delete this session entry?');" data-toggle="tooltip" title="Delete This Entry" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="text-center" colspan="5">No detailed logs found for this teacher.</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>