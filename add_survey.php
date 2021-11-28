<?php
include("config.php");
header('Content-type: application/json');

$response_data['error_code'] 		 = 0;
$response_data['error_msg']			 = '';
$response_data['success_code']		 = 0;
$created_date  	  					 = date('Y-m-d H:i:s', time());

if(!isset($_POST) || (is_array($_POST) && count($_POST) < 1)){

	$response_data['error_code'] 	= 1001;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	//header( "HTTP/1.1 400 Bad Request" );
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$request_obj = $_POST;

/*
u_id
c_ids
music_tag
*/

if(	!isset($request_obj['u_id']) || !isset($request_obj['c_ids']) || !isset($request_obj['price_from']) || !isset($request_obj['price_to']) || !isset($request_obj['pref_delivery_from']) || !isset($request_obj['pref_delivery_to'])){
	$response_data['error_code'] 	= 1002;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$u_id 				= 	$mysqli->real_escape_string(trim($request_obj['u_id']));
$c_ids 			= 	$mysqli->real_escape_string(trim($request_obj['c_ids']));
$price_from				= 	$mysqli->real_escape_string(trim($request_obj['price_from']));
$price_to 		=  $mysqli->real_escape_string(trim($request_obj['price_to']));
$pref_delivery_from 	= $mysqli->real_escape_string(trim($request_obj['pref_delivery_from']));
$pref_delivery_to 	= $mysqli->real_escape_string(trim($request_obj['pref_delivery_to']));


if($u_id == '' || $u_id == '0'){
	$response_data['error_code'] 	= 1003;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}elseif($c_ids == '' || $c_ids == '0'){
	$response_data['error_code'] 	= 1004;
	$response_data['error_msg']		= 'Error processing business details';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}


	

		$insert_query = $mysqli->query("INSERT INTO surveytbl SET 
													u_id 		= '$u_id',
													c_ids 	= '$c_ids',
													price_from 		= '$price_from',
													price_to	= '$price_to',
													pref_delivery_from = '$pref_delivery_from',
													pref_delivery_to = '$pref_delivery_to'
											");
		$s_id = $mysqli->insert_id;

		if($s_id > 0){
			$response_data['success_code']			= 1;
			$response_data['c_ids']			= $c_ids;
			$response_data['s_id']			= $s_id;
			
		}else{		
			$response_data['error_code'] 	= 1009;
			$response_data['error_msg']		= 'Oops. We encountered an error. Please try again.';
			header( "HTTP/1.1 200 OK" );
			echo generate_json($response_data, true);
			exit;

		}

	echo generate_json($response_data, true);
	header( "HTTP/1.1 200 OK" );
	exit;