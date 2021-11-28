<?php
include("config.php");
header('Content-type: application/json');

$response_data['error_code'] 		 		= 0;
$response_data['error_msg']			 		= '';
$response_data['success_code']		 		= 0;
$response_data['food_category_list']	= array();



	$master_query = $mysqli->query("SELECT * FROM foodcategorytbl 
													ORDER BY c_id ");
	$j=0;
	if($master_query->num_rows > 0){
	 	while($query_data 	  = $master_query->fetch_array()){

			$response_data['food_category_list'][$j]['c_id'] 	=	$query_data['c_id'];
			$response_data['food_category_list'][$j]['c_name'] 	=	$query_data['c_name'];
			$response_data['food_category_list'][$j]['c_image'] 	=	$query_data['c_image'];
			$response_data['food_category_list'][$j]['c_status'] 	=	$query_data['c_status'];
			$j++;
	 	}
	}

	$response_data['success_code']	= 1;
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data);
	exit;


?>