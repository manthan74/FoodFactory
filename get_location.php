<?php
include("config.php");
header('Content-type: application/json');

$response_data['error_code'] 		 		= 0;
$response_data['error_msg']			 		= '';
$response_data['success_code']		 		= 0;
$response_data['location_list']	= array();



	$master_query = $mysqli->query("SELECT * FROM locationstbl 
													ORDER BY l_id ");
	$j=0;
	if($master_query->num_rows > 0){
	 	while($query_data 	  = $master_query->fetch_array()){

			$response_data['location_list'][$j]['l_id'] 	=	$query_data['l_id'];
			$response_data['location_list'][$j]['l_name'] 	=	$query_data['l_name'];
			$response_data['location_list'][$j]['l_lat'] 	=	$query_data['l_lat'];
			$response_data['location_list'][$j]['l_long'] 	=	$query_data['l_long'];
			$j++;
	 	}
	}

	$response_data['success_code']	= 1;
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data);
	exit;


?>