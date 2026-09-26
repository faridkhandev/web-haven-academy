<?php
global $db;
?>

<?php echo $header; ?><?php if($user_group_id ==1){ ?><?php echo $column_left; ?><?php } ?>

<div id="content">

  <div class="page-header">

    <div class="container-fluid">

      <div class="pull-right"> <button type="submit" form="form-customer-group" data-toggle="tooltip" title="<?php echo 'Save'; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>

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

    <?php if ($error_warning) { ?>

    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>

      <button type="button" class="close" data-dismiss="alert">&times;</button>

    </div>

    <?php } ?>

    <?php if ($success) { ?>

    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>

      <button type="button" class="close" data-dismiss="alert">&times;</button>

    </div>

    <?php } ?>

    <div class="panel panel-default">

      <div class="panel-heading">

        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>

      </div>

      <div class="panel-body">

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customer-group">

          <div class="table-responsive">

            <table class="table table-bordered table-hover">

              <thead>

                <tr>

					<th></th>

					<?php

					foreach($groups as $group){

					?>

					<th><?php echo $group['name']; ?></th>

					<?php	

					}

					?>

                </tr>

              </thead>

				<?php $colspan = count($groups); ?>

				<?php foreach($controllers as $controller){

					echo '<tbody>';

					echo '<tr><td colspan="'.$colspan.'">'.$controller['name'].'</td></tr>';

				?>

					<?php		

					foreach($controller['tasklist'] as $task){

						echo '<tr>';

						echo '<td>'.$task['task_name'].'</td>';	

						foreach($groups as $group){

							/* echo "SELECT value FROM  ". DB_PREFIX ."group_to_controller_task WHERE customer_group_id =".$customer_group_id." AND ctid =".$task['ctid']." AND plan_id =".$singleplan['plan_id']; */

							$query = $db->query("SELECT value FROM  ". DB_PREFIX ."controller_task_group WHERE customer_group_id =".$group['user_group_id']." AND ctid =".$task['ctid']);

							

							if(isset($query->row['value'])){

								$value = $query->row['value'];

							}else{

								$value = 0;

							}

							?>

							<td><input type="number" name="task[<?php echo $controller['controller_id']  ?>][<?php echo $group['user_group_id']; ?>][<?php echo $task['ctid']; ?>]" value="<?php echo $value; ?>" /></td>

							<?php

						}

						echo '</tr>';		

					}

					echo '</tbody>';

				}

				?>            

            </table>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<?php echo $footer; ?> 