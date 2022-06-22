<?php

	//Application definitions
	define('APPLICATION_TITLE', 'app.healthallround.org.uk');
	define('APPLICATION_NAME', 'Health All Round - CRM');

	//Database definitions
	define('DATABASE_SERVER', 'localhost');
	define('DATABASE_USERNAME', 'har');
	define('DATABASE_PASSWORD', '');
	define('DATABASE_DATABASENAME', 'harcrm');

	//Set error reporting preferences.
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	ini_set('display_errors', 1);

	//Set all pages to no cache
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	session_start([
	 'cookie_lifetime' => 7200,
	 'gc_maxlifetime' => 7200,
	]);

	//Function to validate string contains numbers
	function validate_string_isnumber($string, $optional = false) {
		if (strlen($string) != 0) {
			$l = ctype_digit($string);
		} else {
			if($optional == true){
				$l = true;
			} else {
				$l = false;
			}
		}
		return $l;
	}

	//Function to validate string contains a number
	function validate_string_isnumeric($string, $optional = false) {
		if (strlen($string) != 0) {
			$l = is_numeric($string);
		} else {
			if($optional == true){
				$l = true;
			} else {
				$l = false;
			}
		}
		return $l;
	}


	//Function to validate string length
	function validate_string_length($string, $min, $max) {
		$l = mb_strlen($string);
		return ($l >= $min && $l <= $max);
	}


	//Function to validate UK date
	function validate_string_isdate($string, $optional = false) {
		if (strlen($string) != 0) {
			$l = is_array(strptime($string, '%d/%m/%Y'));
		} else {
			if($optional == true){
				$l = true;
			} else {
				$l = false;
			}
		}
		return $l;
	}

	//Function to validate 24-hour time
	function validate_string_istime($string, $optional = false) {
		if (strlen($string) != 0) {
			$timeFormat = "/^\d{2}:\d{2}$/";
			$validFormat = preg_match($timeFormat, $string);
			$timeArray = explode(":", $string);
			$validHour = 0 <= $timeArray[0] && $timeArray[0] < 24;
			$validMins = 0 <= $timeArray[1] && $timeArray[1] < 60;
			$l = ($validFormat && $validHour && $validMins);
		} else {
			if($optional == true) {
				$l = true;
			} else {
				$l = false;
			}
		}
		return $l;
	}


	//Function to validate UK phone number
	function validate_string_isphone($string, $optional = false) {
		if (strlen($string) != 0) {
			if(ctype_digit(str_replace(' ', '', $string)) && mb_strlen(str_replace(' ', '', $string))>10){
				$l = true;
			} else {
				$l = false;
			}
		} else {
			if($optional == true){
				$l = true;
			} else {
				$l = false;
			}
		}
		return $l;
	}


	//Function to validate yes or no
	function validate_string_yesno($string, $optional = false) {
		if (strlen($string) != 0) {
			if($string=='yes' or $string=='no'){
				$l = true;
			} else {
				$l = false;
			}
		} else {
			if($optional == true){
				$l = true;
			} else {
				$l = false;
			}
		}
		return $l;
	}


	//Function to validate email address
	function validate_string_isemail($string, $optional = false) {
		if (strlen($string) != 0) {
			if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
				$l = false;
			} else {
				$l = true;
			}
		} else {
			if($optional == true){
				$l = true;
			} else {
				$l = false;
			}
		}
		return $l;
	}


	function display_file_size ($file_size){

		if ($file_size <= 1000){
			$return_file_size = "$file_size B";
		} else if ($file_size <= 1000000){
			$return_file_size = number_format( ($file_size / 1000),1);
			$return_file_size = "$return_file_size KB";
		} else if ($file_size <= 1000000000){
			$return_file_size = number_format( ($file_size / 1000000),1);
			$return_file_size = "$return_file_size MB";
		}

		return $return_file_size;
	}

?>
