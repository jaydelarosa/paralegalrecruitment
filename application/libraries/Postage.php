<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Postage {

    function time_ago($date,$granularity=1) {
	    $date = strtotime($date);
	    $difference = time() - $date;
	    $retval = '';
	    $periods = array('decade' => 315360000,
	        'year' => 31536000,
	        'month' => 2628000,
	        'week' => 604800, 
	        'day' => 86400,
	        'hour' => 3600,
	        'min' => 60,
	        'sec' => 1);

	    foreach ($periods as $key => $value) {
	        if ($difference >= $value) {
	            $time = floor($difference/$value);
	            $difference %= $value;
	            $retval .= ($retval ? ' ' : '').$time.' ';
	            $retval .= (($time > 1) ? $key.'s' : $key);
	            $granularity--;
	        }
	        if ($granularity == '0') { break; }
	    }
	    return $retval;      
	}

	function member_since($date,$granularity=2) {
	    $date = strtotime($date);
	    $difference = time() - $date;
	    $retval = '';
	    $periods = array('decade' => 315360000,
	        'yr' => 31536000,
	        'mo' => 2628000,
	        'wk' => 604800, 
	        'day' => 86400,
	        'hr' => 3600,
	        'min' => 60,
	        'sec' => 1);

	    foreach ($periods as $key => $value) {
	        if ($difference >= $value) {
	            $time = floor($difference/$value);
	            $difference %= $value;
	            $retval .= ($retval ? ' ' : '').$time.' ';
	            $retval .= (($time > 1) ? $key.'s' : $key);
	            $granularity--;
	        }
	        if ($granularity == '0') { break; }
	    }
	    return $retval;      
	}

	function member_since_expiry($date,$granularity=2) {
	    $date = strtotime($date);

	    if( $date > time() ){
	    	$difference = $date - time();
	    }
	    else{
	    	$difference = time() - $date;
	    }

	    $retval = '';
	    $periods = array('decade' => 315360000,
	        'yr' => 31536000,
	        'mo' => 2628000,
	        'wk' => 604800, 
	        'day' => 86400,
	        'hr' => 3600,
	        'min' => 60,
	        'sec' => 1);

	    foreach ($periods as $key => $value) {
	        if ($difference >= $value) {
	            $time = floor($difference/$value);
	            $difference %= $value;
	            $retval .= ($retval ? ' ' : '').$time.' ';
	            $retval .= (($time > 1) ? $key.'s' : $key);
	            $granularity--;
	        }
	        if ($granularity == '0') { break; }
	    }
	    return $retval;      
	}

	function get_days($date,$granularity=1) {

		$now = time(); // or your date as well
		$your_date = strtotime($date);
		$datediff = $now - $your_date;

		$days = round($datediff / (60 * 60 * 24));
		$days = abs($days);

	    return $days.' Days';      
	}

	function get_num_days($date,$now,$granularity=1) {

		$now = strtotime($now); // or your date as well
		$your_date = strtotime($date);
		$datediff = $now - $your_date;

		$days = round($datediff / (60 * 60 * 24));
		$days = abs($days);

	    return $days;      
	}

	function get_num_days_no_abs($date,$now,$granularity=1) {

		$now = strtotime($now); // or your date as well
		$your_date = strtotime($date);
		$datediff = $your_date - $now;

		$days = round($datediff / (60 * 60 * 24));
		// $days = abs($days);

	    return $days;      
	}


}
