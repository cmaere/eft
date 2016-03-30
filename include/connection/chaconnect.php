<?php


//$cha = mysqli_connect($hostname_cha, strrev($username_cha), strrev($password_cha)); 
$cha = mysqli_connect($hostname_cha, strrev($username_cha), strrev($password_cha),$database_cha); 

if (!$cha){
	 printf(mysqli_error()."Failed to connect to db");
	 exit;
	}
@mysqli_select_db ($database_cha, $cha); 


global $szRootURL,$szRootPath,$szSiteTitle,$szWebmasterEmail,$arrStructure,$arrVariations,$intDefaultVariation;
global $szDBName,$szDBUsername,$szDBPassword,$szDiscussionAdmin,$szDiscussionPassword;
if (!$cha){
	 printf("welcome");
	 exit;
	}

	$arrVariations = array (
		1 => array( 'name' => 'English', 'shortname' => 'Eng'),
		2 => array( 'name' => 'Chichewa', 'shortname' => 'MW'),
	);
	
$arrVariationPreference = array (
		1 => 1,
		2 => 2
	);
	
	if (!isset($_SESSION['arrVariationPreference'])){
		// store it in the session variable
		$_SESSION['arrVariationPreference']=$arrVariationPreference;
	}
	
	// define the default variation
	$intDefaultVariation = 1;

	
	
	#Get Organisation Name and address
	$qorg = "SELECT * FROM organisation";
	$dborg = mysqli_query($cha,$qorg);
	if (!$dborg) {
	    printf("Error: %s\n", mysqli_error($cha));
	    exit();
	}
	while( $row_org=mysqli_fetch_array($dborg) ) {
	//$row_org = mysqli_fetch_assoc($dborg);
	$org = $row_org['Name'];
	$post = $row_org['Address'];
	$phone = $row_org['tel'];
	$fax = $row_org['fax'];
	$email = $row_org['email'];
	$website = $row_org['website'];
	$city = $row_org['city'];
}

function mysqli_result($result , $offset , $field = 0){
    $result->data_seek($offset);
    $row = $result->fetch_array();
    return $row[$field];
}
	//die("am here")
?>
