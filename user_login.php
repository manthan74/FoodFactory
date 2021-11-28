<?php
include("config.php");
header('Content-type: application/json');

$response_data['error_code'] 		 	= 0;
$response_data['error_msg']			 	= '';
$response_data['success_code']		 	= 0;
$response_data['user_detail']		= array();
$response_data['img_url']		= $config['img_url'];
$date_time 							 	= date("Y-m-d H:i:s");

if(!isset($_POST) || (is_array($_POST) && count($_POST) < 1)){

	$response_data['error_code'] 	= 1001;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	//header( "HTTP/1.1 400 Bad Request" );
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$request_obj = $_POST;

if(!isset($request_obj['u_email']) || !isset($request_obj['u_password'])){

	$response_data['error_code'] 	= 1002;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	//header( "HTTP/1.1 400 Bad Request" );
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$u_email			= trim($request_obj['u_email']);
$u_password		= md5(trim($request_obj['u_password']));

$user_master_query = $mysqli->query("SELECT 
		ru.* 
	FROM 
		usertbl ru
	WHERE 
		ru.u_email 		= '".$u_email."' AND 
		ru.u_password 	= '".$u_password."' 
;");

if($user_master_query->num_rows < 1){

	$response_data['error_code'] 	= 1003;
	$response_data['error_msg']		= 'Invalid login credentials.';
	//header( "HTTP/1.1 404 Not Found" );
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$user_master 	= 	$user_master_query->fetch_array();
$u_id		=	$user_master['u_id'];

/*if($user_status == '0'){

	$response_data['error_code'] 	= 1004;
	$response_data['error_msg']		= 'Your account is inactivate.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}*/


	$mysqli->query("UPDATE usertbl SET 	login_check = 	'1',
												last_login 	=	'$date_time'
												 WHERE u_id ='$u_id'
										");
$user_detail = array(
					'u_id'  		=> 	$user_master['u_id'],
					'u_name' 	=> 	$user_master['u_name'],
					'u_phone' 	=> 	$user_master['u_phone'],
					'u_email' 	=> 	$user_master['u_email']
				);

$response_data['user_detail'] 	= $user_detail;
$response_data['success_code']	= 1;
header( "HTTP/1.1 200 OK" );
echo generate_json($response_data, true);
exit;

/*case 200: $text = 'OK'; break;
case 400: $text = 'Bad Request'; break; if info missing in parameter passed
case 401: $text = 'Unauthorized'; break;
case 402: $text = 'Payment Required'; break;
case 403: $text = 'Forbidden'; break;
case 404: $text = 'Not Found'; break; if ifo not found
case 500: $text = 'Internal Server Error'; break;
case 503: $text = 'Service Unavailable'; break;


case 200: $text = 'OK'; break;
case 400: $text = 'Bad Request'; break; if info missing in parameter passed
case 404: $text = 'Not Found'; break; if info not found in db


200 OK 						//all ok
400 Bad Request 			//if info missing in parameter passed
401 Unauthorized
402 Payment Required
404 Not Found 				//if info not found in db
500 Internal Server Error 	//

*/