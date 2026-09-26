<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-user-group" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php include 'view/template/common/message.tpl' ; ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user-group" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php  } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_access; ?>(Menu Access, List Show Access)</label>
            <div class="col-sm-12">
				<div class="row">
				<?php foreach ($permissions as $permission) { ?>
					<div class="col-md-3">
						<div class="checkbox">
							<label class="checkbox-inline">
								<?php if (in_array($permission, $access)) { ?>
								<input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" checked="checked" />
								<?php $perArr = explode('/', $permission); echo ucwords($perArr[0]).'-'.ucwords($perArr[1])?>
								<?php } else { ?>
								<input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" />
								<?php $perArr = explode('/', $permission); echo ucwords($perArr[0]).'-'.ucwords($perArr[1])?>
								<?php } ?>
							</label>
						</div>
					</div>
                <?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a>
			</div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_modify; ?>(Add, Edit, Delete Access)</label>
			<div class="col-sm-12">
				<div class="row">
				<?php foreach ($permissions as $permission) { ?>
					<div class="col-md-3">
						<div class="checkbox">
							<label class="checkbox-inline">
								<?php if (in_array($permission, $modify)) { ?>
								<input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" checked="checked" />
								<?php $perArr = explode('/', $permission); echo ucwords($perArr[0]).'-'.ucwords($perArr[1])?>
								<?php } else { ?>
								<input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" />
								<?php $perArr = explode('/', $permission); echo ucwords($perArr[0]).'-'.ucwords($perArr[1])?>
								<?php } ?>
							</label>
						</div>
					</div>
                <?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a>
			</div>
			
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 