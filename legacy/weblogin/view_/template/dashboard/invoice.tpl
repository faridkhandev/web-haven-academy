<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $heading_title; ?></h3>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <td class="text-right"><?php echo $column_invoice; ?></td>
          <td><?php echo $column_customer; ?></td>
          <td><?php echo $column_email; ?></td>
          <td><?php echo $column_dog; ?></td>
          <td><?php echo $column_microchip; ?></td>
          <td><?php echo $column_checkin; ?></td>
          <td><?php echo $column_checkout; ?></td>
          <td><?php echo $column_payment; ?></td>
          <td><?php echo $column_total; ?></td>
          <td><?php echo $column_date; ?></td>
          <td class="text-right" style="width:10%"><?php echo $column_action; ?></td>
        </tr>
      </thead>
      <tbody>
        <?php if ($invoices) { ?>
        <?php foreach ($invoices as $invoice) { ?>
        <tr>
          <td class="text-right"><?php echo $invoice['invoice_no']; ?></td>
          <td><?php echo $invoice['customername']; ?></td>
          <td><?php echo $invoice['email']; ?></td>
          <td><?php echo $invoice['name']; ?></td>
          <td><?php echo $invoice['microchip_number']; ?></td>
          <td><?php echo $invoice['checkin_date']; ?></td>
          <td><?php echo $invoice['checkout_date']; ?></td>
          <td><?php echo $invoice['payment_mode']; ?></td>
          <td><?php echo $invoice['total']; ?></td>
          <td><?php echo $invoice['date_added']; ?></td>
          <td class="text-right" style="width:10%"><a href="<?php echo $invoice['view']; ?>" data-toggle="tooltip" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>&nbsp;<a href="<?php echo $invoice['pdf']; ?>" data-toggle="tooltip" title="Print" class="btn btn-info" target="_blank"><i class="fa fa-print"></i></a></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td class="text-center" colspan="11"><?php echo $text_no_results; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
