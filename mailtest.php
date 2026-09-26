<?php
$message = '';                     
$message .= '<strong>A password reset has been requested for this email account</strong><br>';
$message .= '<strong>Please click:</strong>'; 

$headers  = 'From: noreply@kosdigital.in' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail('abhijitscom@gmail.com','KOS Digital:Forgot Password Link',$message, $headers);


?>
<?php 
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "noreply@kosdigital.in";
    $to = "abhijitscom@gmail.com";
    $subject = "PHP Mail Test script";
    $message = '';                     
	$message .= '<strong>A password reset has been requested for this email account</strong><br>';
	$message .= '<strong>Please click:</strong>'; 
    $headers  = 'From: noreply@kosdigital.in' . "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
    if(mail($to,$subject,$message, $headers))
    echo "Test email sent";
?>