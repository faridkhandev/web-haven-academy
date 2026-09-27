<?php if ($error_warning) { ?>
<script>$.notify("<?php echo $error_warning; ?>", {autoHideDelay: 5000,className: 'error'});</script>
<?php } ?>
<?php if ($success) { ?>
<script>$.notify("<?php echo $success; ?>", {autoHideDelay: 5000,className: 'success'});</script>
<?php } ?>