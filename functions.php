<?php
function GUID(){

    if (function_exists('com_create_guid') === true){
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function generate_json($response_data, $object_flag = false){
	
	$json_object = $object_flag==true?JSON_FORCE_OBJECT:null;
	return json_encode($response_data, $json_object);
}

function checkUnique_companyEmail($email_id, $user_id = 0){
	global $mysqli;
	$extra_cond = $user_id!=0?" AND user_id <> '".$user_id."'":"";
	$check_email_query = $mysqli->query("SELECT * FROM usertbl WHERE u_email = '".$email_id."'".$extra_cond.";");

	if($check_email_query->num_rows > 0){
		return FALSE;
	}
	return TRUE;
}

function checkUnique_companyUsername($username, $user_id = 0){
	global $mysqli;
	$extra_cond = $user_id!=0?" AND user_id <> '".$user_id."'":"";
	$check_username_query = $mysqli->query("SELECT * FROM usertbl WHERE u_name = '".$username."'".$extra_cond.";");

	if($check_username_query->num_rows > 0){
		return FALSE;
	}
	return TRUE;
}

function get_business_categoryid_frm_businessid($businessid){

	global $mysqli;
	$business_category_id = 0;

	$master_query = $mysqli->query("SELECT business_category_id FROM business_master 
											WHERE business_id = '$businessid'  ");
	$j=0;
	if($master_query->num_rows > 0){
	 	$query_data 	  = $master_query->fetch_array();
		$business_category_id	=	$query_data['business_category_id'];
	}

	return $business_category_id;
}
