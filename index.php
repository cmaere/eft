<?php

//die("am here");
/*******
This code initiate saris setup the sessions and it is where all the modules are called

developers.

charlie maere


**********/

//error_reporting(E_ALL);
ini_set('display_errors', 1);

//check session
function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
if ( is_session_started() === FALSE ) 	
{
	session_start();
}

// include classes
include('include/config/config.php');
require ('include/classes/templates/IT.php');

include('include/functions.php');
require_once 'include/connection/chaconnect.php';


//initiation
$page = "";
$user = "";
// login form action processing
if ((isset($_POST["loginform"])) && ($_POST["loginform"] == "login")) 
	{
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		//die("log in ".var_dump($_SESSION));
		
	}
	if(isset($_SESSION['username']))
	{
		$user = $_SESSION['username'];
	}
	if(isset($_SESSION['loginstatus']))
	{
		$status = $_SESSION['loginstatus'];	
	}


if (array_key_exists('page', $_GET)) 
{
	
         $page = htmlspecialchars($_GET['page']);
}
 
if ($user) 
{	
       
	// check if user used email
	if ((strpos($user,'@') !== false) && ($status !== "loggedin"))  {
	    $chaemail =  $user;
	    
	}
	else
	{
		if (array_key_exists('page', $_GET)) 
		{
			$page = htmlspecialchars($_GET['page']);
			if (array_key_exists('section', $_GET))
			{
			 	$section = htmlspecialchars($_GET['section']);
			}
			else
			{
				$section = "not in";
					
			}
			if($page == "Logout")
			{
			 	session_destroy();
			        echo '<meta http-equiv = "refresh" content ="0; 
			      						url = ./">';
			         		exit;
			        	
							
			}
		}
		
			 
		require_once("include/userprofselector.php");
	}
	
		 
 }
else if(($page =="Login")  || ($page =="Register"))
{
	require_once("landpage.php");
		
}
else 
{
	require_once("landpage.php");
}
	

?>