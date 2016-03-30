<?php
/* 
This is code is written by kcn ict Developers
It is a Database connector which connects to Mysql and Authenticates
Code Authors
============
Charlie Maere

Country: Malawi
Date: 29th May 2014
Email: cmaere@kcn.unima.mw
*/


@$hostname_kcn = "localhost";
@$database_kcn = "lwb";
@$username_kcn = "root";
@$password_kcn = "";
$kcn = mysqli_connect($hostname_kcn, $username_kcn, $password_kcn,$database_kcn); 
if (!$kcn){
	 printf(mysqli_error()."Connection to the Database has Failed please contact cmaere@kcn.unima.mw if you fail to resolve the problem!");
	 exit;
	}

//$con = @mysqli_select_db ($database_kcn, $kcn); 
@mysqli_set_charset($kcn, 'utf8');



?>

