<?php
include("config.php");
header('Content-type: application/json');

$response_data['error_code'] 		 		= 0;
$response_data['error_msg']			 		= '';
$response_data['success_code']		 		= 0;
$response_data['search_list']	= array();


$request_obj = $_GET;

if(	!isset($request_obj['u_id']) ){
	$response_data['error_code'] 	= 1002;
	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data, true);
	exit;
}

$u_id = $mysqli->real_escape_string(trim($request_obj['u_id']));


	$master_query = $mysqli->query("SELECT * FROM searchtbl 
													where u_id = '".$u_id."' ORDER BY s_id ");
	$j=0;
	if($master_query->num_rows > 0){
	 	while($query_data 	  = $master_query->fetch_array()){

			$response_data['search_list'][$j]['s_id'] 	=	$query_data['s_id'];
			$response_data['search_list'][$j]['s_term'] 	=	$query_data['s_term'];
			$j++;
	 	}
	}

	$response_data['success_code']	= 1;
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data);
	exit;


?>