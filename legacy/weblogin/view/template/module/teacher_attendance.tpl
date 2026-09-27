<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $clear_data; ?>" onclick="return confirm('Are you sure you want to delete all teacher attendance data? This cannot be undone!');" class="btn btn-danger" data-toggle="tooltip" title="Clear All Data">
          <i class="fa fa-trash"></i> Clear All Data
        </a>
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
    <?php if (!empty($error_warning)) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Teacher Summary List</h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-8">
              <div class="form-group">
                <label class="control-label" for="input-name">Search Teacher Name</label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="Teacher Name" id="input-name" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group" style="margin-top: 23px;">
                <button type="button" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
                <a href="<?php echo $reset; ?>" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr class="active">
                <th>Teacher Name</th>
                <th class="text-center">Total Links Submitted</th>
                <th class="text-center">Total Sessions Count</th>
                <th>Last Submitted Time</th>
                <th class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($teachers)) { ?>
              <?php foreach ($teachers as $teacher) { ?>
              <tr>
                <td><strong><?php echo $teacher['teacher_name']; ?></strong></td>
                <td class="text-center"><span class="badge" style="background-color: #3498db; font-size: 14px;"><?php echo $teacher['total_links']; ?></span></td>
                <td class="text-center"><span class="badge" style="background-color: #27ae60; font-size: 14px;"><?php echo $teacher['total_sessions']; ?></span></td>
                <td><?php echo $teacher['last_submitted']; ?></td>
                <td class="text-right">
                  <a href="<?php echo $teacher['view_link']; ?>" data-toggle="tooltip" title="View Full Attendance Details" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View Logs</a>
                </td>
              </tr>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="text-center" colspan="5">No attendance records found!</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=module/teacher_attendance&token=<?php echo $token; ?>';
	var filter_name = $('input[name=\'filter_name\']').val();
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	location = url;
});
//--></script>
<?php echo $footer; ?>