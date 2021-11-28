<?php
include("config.php");
header('Content-type: application/json');

$response_data['error_code'] 		 		= 0;
$response_data['error_msg']			 		= '';
$response_data['success_code']		 		= 0;
$response_data['providers_list']	= array();


$request_obj = $_GET;

// if(	!isset($request_obj['u_id']) ){
// 	$response_data['error_code'] 	= 1002;
// 	$response_data['error_msg']		= 'Oops something went wrong. Please try again.';
// 	header( "HTTP/1.1 200 OK" );
// 	echo generate_json($response_data, true);
// 	exit;
// }

// $u_id = $mysqli->real_escape_string(trim($request_obj['u_id']));


	$master_query = $mysqli->query("SELECT * FROM menutbl as m JOIN menurestauranttbl as mr on mr.m_id = m.m_id JOIN restaurantprovidertbl as rp on rp.mr_id = mr.mr_id JOIN restaurantstbl as r on r.r_id = mr.r_id JOIN foodprovidertbl as fp on fp.fp_id = rp.fp_id");
 
	$j=0;
	if($master_query->num_rows > 0){
	 	while($query_data 	  = $master_query->fetch_array()){
			$response_data['providers_list'][$j]['fp_id'] 				=	$query_data['fp_id'];
			$response_data['providers_list'][$j]['fp_name'] 			=	$query_data['fp_name'];
			$response_data['providers_list'][$j]['fp_url'] 				=	$query_data['fp_url'];
			$response_data['providers_list'][$j]['rp_discountedcost'] 	=	$query_data['rp_discountedcost'];
			$j++;
	 	}
	}

	$master_query = $mysqli->query("SELECT * FROM menutbl as m JOIN menurestauranttbl as mr on mr.m_id = m.m_id JOIN restaurantprovidertbl as rp on rp.mr_id = mr.mr_id JOIN restaurantstbl as r on r.r_id = mr.r_id JOIN foodprovidertbl as fp on fp.fp_id = rp.fp_id");
 	$query_data 	  			= 	$master_query->fetch_array();
	$response_data['m_id']		=	$query_data['m_id'];
	$response_data['m_name']	=	$query_data['m_name'];
	$response_data['m_image']	=	$query_data['m_image'];
	$response_data['r_lat']		=	$query_data['r_lat'];
	$response_data['r_long']	=	$query_data['r_long'];
	$response_data['r_name']	=	$query_data['r_name'];
	$response_data['r_address']	=	$query_data['r_address'];
	$response_data['r_image']	=	$query_data['r_image'];
	$response_data['r_mobile']	=	$query_data['r_mobile'];
	$response_data['r_isopen']	=	$query_data['r_isopen'];

	

	$response_data['success_code']	= 1;
	header( "HTTP/1.1 200 OK" );
	echo generate_json($response_data);
	exit;

?>