<?php
/* 
This is code is written by charlie maere
This is a JSON script queries from mysql database and passes data to a JSON function
Code Authors
============
Charlie Maere


Country: Malawi
Date: 29th May 2014
Email: cmaere@kcn.unima.mw
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("dbconnect2.php");

$account = $_GET['account'];

$sql = "SELECT `account`,`bill`,`date`,`name` FROM `cha_lwb` WHERE `account` = '$account'";
$output = array();

//die("here2  ".$sql);
$result = mysqli_query($kcn,$sql) or die(mysqli_error());
while($row=mysqli_fetch_assoc($result))
{
	$output[]=$row;
	//var_dump($row);
	//die("here2  ".$row);
	
}
$encode = json_encode($output);
//var_dump($output);
echo $encode;




?>