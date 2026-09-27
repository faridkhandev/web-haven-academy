<?php
function token($length = 32) {
	// Create random token
	$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
	$max = strlen($string) - 1;
	
	$token = '';
	
	for ($i = 0; $i < $length; $i++) {
		$token .= $string[mt_rand(0, $max)];
	}	
	
	return $token;
}

/**
 * Backwards support for timing safe hash string comparisons
 * 
 * http://php.net/manual/en/function.hash-equals.php
 */

if(!function_exists('hash_equals')) {
	function hash_equals($known_string, $user_string) {
		$known_string = (string)$known_string;
		$user_string = (string)$user_string;

		if(strlen($known_string) != strlen($user_string)) {
			return false;
		} else {
			$res = $known_string ^ $user_string;
			$ret = 0;

			for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);

			return !$ret;
		}
	}
}

function createCSV($header, $content, $filename){
	// output headers so that the file is downloaded rather than displayed
	header('Content-type: text/csv');
	header('Content-Disposition: attachment; filename='.$filename.date('Y-m-d').'.csv');
	 
	// do not cache the file
	header('Pragma: no-cache');
	header('Expires: 0');
	// create a file pointer connected to the output stream
	$file = fopen('php://output', 'w');
	
	// send the column headers
	fputcsv($file, $header);
	
	foreach($content as $p){
		fputcsv($file, $p);
	}
	exit();
}

function createCSV1($header, $content, $filename){
	// output headers so that the file is downloaded rather than displayed
	header('Content-type: text/csv');
	header('Content-Disposition: attachment; filename='.$filename.date('Y-m-d').'.csv');
	 
	// do not cache the file
	header('Pragma: no-cache');
	header('Expires: 0');
	// create a file pointer connected to the output stream
	$file = fopen('php://output', 'w');
	
	// send the column headers
	fputcsv($file, $header);
	
	foreach($content as $key => $p){
		fputcsv($file, $p);
	}
	exit();
}