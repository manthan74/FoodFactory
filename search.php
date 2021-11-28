<?php
include("config.php");
header('Content-type: application/json');

$response_data['error_code'] 		 = 0;
$response_data['error_msg']			 = '';
$response_data['success_code']		 = 0;
$response_data['search_detail']	 = array();
$response_data['img_url']	 = $config['img_url'];

$created_date  	  		= date('Y-m-d H:i:s', time());

if(!isset($_POST) || (is_array($_POST) && count($_POST) < 1)){

	$response_data['error_code'] 	= 1001;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	//header( "HTTP/1.1 400 Bad Request" );
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$request_obj = $_POST;


if(!isset($request_obj['u_id']) || !isset($request_obj['s_term']) ){

	$response_data['error_code'] 	= 1002;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	//header( "HTTP/1.1 400 Bad Request" );
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}


$u_id 				= $mysqli->real_escape_string(trim($request_obj['u_id']));
$s_term 			= $mysqli->real_escape_string(trim($request_obj['s_term']));


$created_date   = date("Y-m-d H:i:s", time());

$s_term_exists = $mysqli->query("SELECT * from searchtbl where s_term = '".$s_term."' AND u_id = '".$u_id."'");

if($s_term_exists->num_rows > 0){
		
		$search_master_query 	= $mysqli->query("SELECT * FROM restaurantstbl WHERE r_name LIKE '%$s_term%' ");

	$search_master 		= 	$search_master_query->fetch_array();

	$search_detail = array(
					'r_name' 	=> 	$search_master['r_name'],
					'r_image' 	=> 	$search_master['r_image']
				);

	$response_data['search_detail'] 	= $search_detail;
	$response_data['success_code']	= 1;
	}
	else{
		$user_query = $mysqli->query("INSERT INTO searchtbl SET 
														u_id 		=	'$u_id',
														s_term 		=	'$s_term',
														s_date 		= '$created_date'
																");

$s_id = $mysqli->insert_id;
if($s_id == 0){

	$response_data['error_code'] 	= 1009;
	$response_data['error_msg']		= 'Oops. We encountered an error. Please try again.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}else{
	$search_master_query 	= $mysqli->query("SELECT * FROM restaurantstbl WHERE r_name LIKE '%$s_term%' ");

	$search_master 		= 	$search_master_query->fetch_array();

	$search_detail = array(
					'r_name' 	=> 	$search_master['r_name'],
					'r_image' 	=> 	$search_master['r_image']
				);

	$response_data['search_detail'] 	= $search_detail;
	$response_data['success_code']	= 1;

}
	}




$response_data['success_code']	= 1;

echo generate_json($response_data, true);
header( "HTTP/1.1 200 OK" );
exit;