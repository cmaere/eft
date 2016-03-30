
<?php
// this script verifies the user from the database and assign proper previledges to the user
//Code Authors
//Charlie Maere
//die("still here in here prof");
$date = date('Y m d');
//encrypting the password
$encrypted_pass = "{jlungo-hash}" . base64_encode(pack("H*", sha1($_SESSION['password']))); 
// end encrypting the password
//die($encrypted_pass);
$query_AYear = "SELECT AYear, Semister_status FROM academicyear WHERE Status = 1";
$result_AYear=mysqli_query($cha, $query_AYear);
while ($line = mysqli_fetch_array($result_AYear, MYSQL_ASSOC)) 
{
	$year= $line["AYear"];  
        $semester = $line["Semister_status"];
} 
//die($year);
mysqli_free_result($result_AYear);	 
   
$sql = "SELECT UserName, password, UPPER(RegNo) AS RegNo ,LEFT(UPPER(RegNo),9) as RegNo2,RIGHT(UPPER(RegNo),3) AS RegNo3,AccpacID,weaver,Position, Module, PrivilegeID, FullName, Faculty FROM security WHERE UserName='$user' AND password = '$encrypted_pass'";

//die($sql);

$result = mysqli_query($cha,$sql);
$loginFoundUser = mysqli_num_rows($result);
//die($loginFoundUser."3 hjh");
    
 if ($loginFoundUser <> 0) 
 {
           
		  
	    $_SESSION['loginstatus'] = "loggedin";
           
            
           
            
    		$_SESSION['loginName']= mysqli_result($result,0,'FullName');
		$position = mysqli_result($result,0,'Position');
		$RegNo  = mysqli_result($result,0,'RegNo');
           	$RegNo2 = mysqli_result($result,0,'RegNo2');
                $RegNo3 = mysqli_result($result,0,'RegNo3');
		$module = mysqli_result($result,0,'Module');
		$userFaculty = mysqli_result($result,0,'Faculty');
		$privilege  = mysqli_result($result,0,'PrivilegeID');
		$mtumiaji = 3;
		mysqli_free_result($result); 			
	 	$update_login = "UPDATE security SET LastLogin = now() WHERE UserName = '$user'";
	 	$result = mysqli_query($cha,$update_login) or die("failed update LastLogin, tnm");
        	
      
      
      	  require_once("include/controller.php"); 
	

} 
else
{
	
	
	echo "<script language='JavaScript'> alert('Username or Password incorrect!'); </script>";
  	echo '<meta http-equiv = "refresh" content ="0; url = ./?page=Logout">';
   	exit;
}
	

//mysqli_close($cha);
?>
