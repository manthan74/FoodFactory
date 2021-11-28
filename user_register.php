<?php
include("config.php");
header('Content-type: application/json');

$response_data['error_code'] 		 = 0;
$response_data['error_msg']			 = '';
$response_data['success_code']		 = 0;
$response_data['user_detail']	 = array();
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

/*u_email
u_name
company_name
u_password*/


if(!isset($request_obj['u_email']) || !isset($request_obj['u_name']) || !isset($request_obj['u_phone']) || !isset($request_obj['u_password']) || !$request_obj['u_lat'] || !$request_obj['u_long'] ){

	$response_data['error_code'] 	= 1002;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	//header( "HTTP/1.1 400 Bad Request" );
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$u_email 			= $mysqli->real_escape_string(trim($request_obj['u_email']));
$u_name 				= $mysqli->real_escape_string(trim($request_obj['u_name']));
$u_phone 			= $mysqli->real_escape_string(trim($request_obj['u_phone']));
$u_password 			= trim($request_obj['u_password']);
$u_lat				= $mysqli->real_escape_string(trim($request_obj['u_lat']));
$u_long 			= $mysqli->real_escape_string(trim($request_obj['u_long'])); 



$password_regex   = "/[a-z].*[0-9]|[0-9].*[a-z]/i";
$username_regex   = "/^[A-Za-z0-9_-]{4,15}$/";

if(!filter_var($u_email, FILTER_VALIDATE_EMAIL)){
	$response_data['error_code'] 	= 1003;
	$response_data['error_msg']		= 'Please enter a valid email.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}
elseif(strlen($u_name) < 4 || !preg_match($username_regex, $u_name)){
	$response_data['error_code'] 	= 1004;
	$response_data['error_msg']		= 'Please enter valid user name of minimum length 4 containing characters and numbers.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}elseif($u_phone == ''){
	$response_data['error_code'] 	= 1005;
	$response_data['error_msg']		= 'Please enter your company number.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}else if(strlen($u_password) < 6 || !preg_match($password_regex, $u_password)){
	$response_data['error_code'] 	= 1006;
	$response_data['error_msg']		= 'Please enter password of minimum length 6 containing characters and numbers.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}


$unique_email 	= checkUnique_companyEmail($u_email);
if(!$unique_email){
	$response_data['error_code'] 	= 1007;
	$response_data['error_msg']		= 'Email Id is already registered, try another.';	
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$unique_u_name 	= checkUnique_companyUsername($u_name);
if(!$unique_u_name){
	$response_data['error_code'] 	= 1008;
	$response_data['error_msg']		= 'Username is already registered, try another.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$created_date   = date("Y-m-d H:i:s", time());
$md5_password 	= md5($u_password);


$user_query = $mysqli->query("INSERT INTO usertbl SET 
														u_name 		=	'$u_name',
														u_email 		=	'$u_email',
														u_phone 	=	'$u_phone',
														u_password 	=	'$md5_password',
														u_creationdate 	=	'$created_date',
														u_lat 		= '$u_lat',
														u_long 		= '$u_long'
																");

$u_id = $mysqli->insert_id;
if($u_id == 0){

	$response_data['error_code'] 	= 1009;
	$response_data['error_msg']		= 'Oops. We encountered an error. Please try again.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}else{
	$user_master_query 	= $mysqli->query("SELECT ru.* FROM usertbl as ru 
											WHERE ru.u_id 		= '".$u_id."' ;");

	$user_master 		= 	$user_master_query->fetch_array();

	$user_detail = array(
					'u_id'  		=> 	$user_master['u_id'],
					'u_name' 	=> 	$user_master['u_name'],
					'u_email' 	=> 	$user_master['u_email'],
					'u_phone' 	=> 	$user_master['u_phone'],
					'u_password' 	=>	$user_master['u_password'],
					'u_lat'		=> 	$user_master['u_lat'],
					'u_long'	=> 	$user_master['u_long']
					
				);

	$response_data['user_detail'] 	= $user_detail;
	$response_data['success_code']	= 1;

}

$response_data['success_code']	= 1;

echo generate_json($response_data, true);
header( "HTTP/1.1 200 OK" );
exit;