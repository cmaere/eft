<?php
session_start();
session_cache_limiter('nocache');       
@$loginerror  = $_SESSION['loginerror'];
$_SESSION['loginerror'] = "";
require_once 'google/appengine/api/users/UserService.php';

use google\appengine\api\users\User;
use google\appengine\api\users\UserService;
require_once('include/connection/chaconnect.php');
include("include/functions.php");


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
	
  $editFormAction .= "?". htmlentities($_SERVER['QUERY_STRING']);
  
}
	#Get Organisation Name
	$qorg = "SELECT * FROM organisation";
	$dborg = mysql_query($qorg);
	$row_org = mysql_fetch_assoc($dborg);
	$org = $row_org['Name'];
	$post = $row_org['Address'];
	$phone = $row_org['tel'];
	$fax = $row_org['fax'];
	$email = $row_org['email'];
	$website = $row_org['website'];
	$city = $row_org['city'];
	
 if(isset($_POST['Submit']) && $_POST['Submit'] !=""){
		$domain_array = 0;
		$today = date("F j, Y");   
		$LastName = addslashes($_POST['txtLastName']);
		$FirstName = addslashes($_POST['txtFirstName']);
		$byear = addslashes($_POST['txtYear']);
		$bmon = addslashes($_POST['txtMonth']);
		$bday = addslashes($_POST['txtDay']);
		$id = addslashes($_POST['txtRegNo']);
		$selectPosition = $_POST['selectPosition'];
		//$username = addslashes($_POST['txtLogin']);
		
		$Email = addslashes($_POST['txtEmail']);
		$fullname = $LastName . ", " . $FirstName;
		$bdate = $bday . "-" . $bmon . "-" . $byear;
		
		//die($bdate);
		
		if(strlen($bdate)<>10){
			$d = strlen($bdate);
		$_SESSION['loginerror'] = $bdate. ' - is Invalid Date of Birth! '; 
  		//echo '<meta http-equiv = "refresh" content ="0; url = registration.php">';
		}
	
		
		#check if use has submitted valid email address
		function check_email_address($Email) {
		  // First, we check that there's one @ symbol, and that the lengths are right
		  if (!ereg("[^@]{1,64}@[^@]{1,255}", $Email)) {
			// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
			return false;
	  }
	  // Split it into sections to make life easier
	  $email_array = explode("@", $Email);
	  $local_array = explode(".", $email_array[0]);
	  for ($i = 0; $i < sizeof($local_array); $i++) {
		 if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
		  return false;
		}
	  }  
	  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
		  if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
			return false;
		  }
		}
		  }
		  return true;
		}
		
		if($Email<>''){
				if (check_email_address($Email)) {
				  //echo $Email . ' is a valid email address. <br>';
					} else {
				$_SESSION['loginerror'] = $Email . '==> is not a valid email address! '; 
				//echo '<meta http-equiv = "refresh" content ="0; url = registration.php">';
				}
	}
	# check if user has created valid username and password
	
	if(strlen($id)<1){
	$_SESSION['loginerror'] = 'Invalid Identity Registration Number! '; 
	//echo '<meta http-equiv = "refresh" content ="0; url = registration.php">';
	}
	
	
	// search for existing students 
	
	$query = "SELECT student.RegNo
			  FROM student WHERE (student.RegNo='$id')";
	$result = mysql_query($query) or die("query erroe.<br>");
	$regnoFound = mysql_num_rows($result);
	if ($regnoFound>0) {
					   $RegNo = mysql_result($result,0,'RegNo');
					   #check if username exist
					   $sql ="SELECT UserName			
							  FROM security WHERE UserName='$username'";
					   $result = mysql_query($sql) or die("query error<br>");
					   $usernameFound = mysql_num_rows($result);
					   if ($usernameFound>0) {
							$login     = mysql_result($result,0,'UserName');
									$_SESSION['loginerror'] = " Registration NOT successful! <br> Some one is already using this USERNAME: '".$username."'
									 						<br>Please Select Another Username"; 
									//echo '<meta http-equiv = "refresh" content ="0; url = registration.php">';
							}
					   #check if regno exist
					   $sql ="SELECT RegNo  			
							  FROM security WHERE RegNo = '$id'";
					   $result = mysql_query($sql) or die("query error<br>");
					   $noFound = mysql_num_rows($result);
					   if ($noFound>0) {
							$userregno = mysql_result($result,0,'userregno');
									$_SESSION['loginerror'] = "Registration NOT Successful! <br>
															  Re-registration is not allowed in cha DATABASE<br>
															  There is already a user using this RegNo: ".$id."<br>
															  Please Sign in with your username and password!"; 
									echo '<meta http-equiv = "refresh" content ="0; url = /">';
									exit;
							}

				
	}
	else if($selectPosition == "Administrator" || $selectPosition == "Lecturer" )
	{
		
		
	   $sql ="SELECT UserName			
			  FROM security WHERE UserName='$username'";
	   $result = mysql_query($sql) or die("query error<br>");
	   $usernameFound = mysql_num_rows($result);
	   if ($usernameFound>0) {
			$login     = mysql_result($result,0,'UserName');
					$_SESSION['loginerror'] = " Registration NOT successful! <br> Some one is already using this USERNAME: '".$username."'
					 						<br>Please Select Another Username"; 
					echo '<meta http-equiv = "refresh" content ="0; url = /?page=Register">';
					exit;
			}
			
			
			
	}
	else{
	$_SESSION['loginerror'] = $id.' - Invalid Identity Registration Number (ID RegNo)! '; 
	}
#if no error captured register the candidate
if ($_SESSION['loginerror']==""){
	
	
	

	
	
	
		
		
	//Update Birth Date
	if($selectPosition == "Administrator" && $regnoFound==0 || $selectPosition == "Lecturer" && $regnoFound==0)
	{
		if($selectPosition == "Administrator")
		{
			$modulenum = 8;
		}
		else if($selectPosition == "Lecturer")
		{
			
			$modulenum = 1;
		}
		//create account
			$query = "INSERT INTO security (UserName, FullName, RegNo, Position, AuthLevel, Email, LastLogin, Registered)
					 VALUES ('$Email', '$fullname', '$id','$selectPosition', 'user', '$Email', now(), now())";
					// die($query);
					
			$result = mysql_query($query) or die(mysql_error());
			
			$sql2 = "UPDATE security SET Module=$modulenum WHERE RegNo = '$id'";
			//die($sql2);
			$query = mysql_query($sql2) or die("Cannot query the database.<br>");
			
		$sql = "INSERT INTO student(DBirth,Name,RegNo) Values('$bdate','$fullname','$id')";
		$query = mysql_query($sql) or die("Cannot3 query the database.<br>");
	}
	else
	{
		//create account
			$query = "INSERT INTO security (UserName, FullName, RegNo, Position, AuthLevel, Email, LastLogin, Registered)
					 VALUES ('$Email', '$fullname', '$id','$selectPosition', 'user', '$Email', now(), now())";
					// die($query);
			$result = mysql_query($query) or die("Query Failed, Words like Ng'ombe are not accepted <br>");
	$sql = "UPDATE student SET DBirth='$bdate' WHERE RegNo = '$id'";
	$query = mysql_query($sql) or die("Cannot query the database.<br>");
    }
		
	$_SESSION['loginerror'] = " Welcome '".$LastName.", ".$FirstName."' to cha"; 
	$_SESSION['username']=$username;
	
	echo "<script language='JavaScript'> alert('You have registered sucessufly please go to log in and log in if ur gmail account'); </script>";
	echo '<meta http-equiv = "refresh" content ="0; url = /">';
	exit;
}
	mysql_close( $cha);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>ChaSaris</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content=" Student Information System (SIS), accommodation information system, database system, examination database system, Student records system, database system">
<meta name="description" content="School Management Information System, Database System, charlie maere, Database System , Student Information System (SIS), Accommodation Record Keeping, Examination Results System, Student Normninal Roll Database">
<meta name="authors" content="Charlie maere">

<script language="JavaScript">

function chanotification(){
	
	alert("You have registered sucessufly please go to log in and log in if ur gmail account");
	//window.location("/");
	
}
</script>

<SCRIPT ID=clientEventHandlersJS LANGUAGE=javascript>
<!--

function fmAdd_onsubmit() {
if (fmAdd.txtLastName.value == "" || fmAdd.txtFirstName.value == "" || fmAdd.selectPosition.value=="" || fmAdd.txtLogin.value=="" || fmAdd.txtPWD.value=="" || fmAdd.txtRePWD.value=="")
	{window.alert("ChaSaris System Asks You to Fill in the Blank Text Fields");
	return false;
	}
	 if (fmAdd.txtPWD.value != fmAdd.txtRePWD.value){
		window.alert("Password Texts donot Match, Enter them again, ChaSaris");
		return false;
	}
}
//-->
</SCRIPT>
<script src="cha_files/cha.js" type="text/javascript"> </script>
<body onLoad="f_setfocus();">
<style type="text/css">
<!--
.style2 {color: #FFFFCC}
.style3 {color: #FFFFFF}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.style5 {color: #000000}
-->
</style>
<table border="0" cellspacing="0" cellpadding="0" width=100%>
<tr>
	<td align=center><br>
	  <br>
		<!-- Registration Form Starts -->
		<table border="0" cellspacing="0" cellpadding="0" width=540 style="border:2px solid rgb(119,119,119)">
		<tr>
			<td align=left>
			
			
			<table border="0" cellspacing="0" cellpadding='0' width='100%' background="themes/images/loginTopHeaderBg.gif">
			<tr>
				<td align=left><img src="themes/images/loginTopHeaderName.gif"></td>
				<td align=right><!--img src="themes/images/loginTopVersion.gif"--></td>
			</tr>
			</table>
			<table border="0" cellspacing="0" cellpadding='6' width='100%'>
			<tr>
				<td align=left valign=top class=small style="padding:10px">
					<!-- Sign in box -->
					<div align="center"><?php echo strtoupper($org)?><br>USER REGISTRATION FORM</div>
					<FORM action="<?php echo $editFormAction; ?>" method=post enctype="application/x-www-form-urlencoded" name=fmAdd id=fmAdd onsubmit="return fmAdd_onsubmit()" LANGUAGE=javascript>
       <TABLE width="100%" BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0 bordercolor="#006600" bgcolor="#FFFFCC">
							<?php
							if ($_SESSION['loginerror']!="")
							{
							?>
							<tr>
								<td colspan="6"><b class="small"><font color="Brown">
								<div align="center"></div><?php echo $_SESSION['loginerror']?></div>
								</font>
								</b>
								</td>
							</tr>
							<?php
							}
							?>
										 <TR>
                            <TD VALIGN=MIDDLE ALIGN=RIGHT colspan="4" height="28" nowrap <?php echo ($missingLastname)?'style=" color:#990000"':'';?>><div align="right" class="large"><font color="#0000CC">LAST NAME:</font></div></TD>
                            <TD colspan="2" ALIGN=LEFT VALIGN=MIDDLE><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000">
                                  <INPUT TYPE="text" SIZE="29" name="txtLastName" value="<?php echo((isset($_POST["txtLastName"]))?$_POST["txtLastName"]:"") ?>">
</font><font color="#000000"><span class="large style4"><font color="#0000CC">(LASTNAME)</font></span> </font></div></TD>
                            
                          </TR>
                          <TR>
                            <TD VALIGN=MIDDLE ALIGN=RIGHT colspan="4" height="28" nowrap><div align="right" class="large"><font color="#0000CC">FIRST NAME: </font></div></TD>
                            <TD colspan="2" ALIGN=LEFT VALIGN=MIDDLE><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000">
                                  <INPUT TYPE="text" SIZE="29" name="txtFirstName" value="<?php echo((isset($_POST["txtFirstName"]))?$_POST["txtFirstName"]:"") ?>">
</font><font color="#000000"><span class="large style4"><font color="#0000CC">(Firstname)</font></span> </font></div></TD>
                          </TR>
						    <TR>
                            <TD VALIGN=MIDDLE ALIGN=RIGHT colspan="4" height="28" nowrap><div align="right" class="large"><font color="#0000CC">DATE OF BIRTH: </font></div></TD>
                            <TD colspan="2" ALIGN=LEFT VALIGN=MIDDLE nowrap><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000">
                            <select name="txtDay" id="select">
							<option value="<?php echo((isset($_POST["txtDay"]))?$_POST["txtDay"]:"") ?>"><?php echo((isset($_POST["txtDay"]))?$_POST["txtDay"]:"") ?></option>  
                              <option value=>---</option>
                              <option value="01">01</option>
                              <option value="02">02</option>
                              <option value="03">03</option>
                              <option value="04">04</option>
                              <option value="05">05</option>
                              <option value="06">06</option>
                              <option value="07">07</option>
                              <option value="08">08</option>
                              <option value="09">09</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option value="20">20</option>
                              <option value="21">21</option>
                              <option value="22">22</option>
                              <option value="23">23</option>
                              <option value="24">24</option>
                              <option value="25">25</option>
                              <option value="26">26</option>
                              <option value="27">27</option>
                              <option value="28">28</option>
                              <option value="29">29</option>
                              <option value="30">30</option>
                              <option value="31">31</option>
                            </select>
                            <select name="txtMonth" id="txtMonth">
							<option value="<?php echo((isset($_POST["txtMonth"]))?$_POST["txtMonth"]:"") ?>"><?php echo((isset($_POST["txtMonth"]))?$_POST["txtMonth"]:"") ?></option>  
                              <option value=>-----------</option>
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                            <input name="txtYear" type="text" id="txtYear" size="3" maxlength="4" value="<?php echo((isset($_POST["txtYear"]))?$_POST["txtYear"]:"") ?>">
                            </font><font color="#000000"><span class="large style4"><font color="#0000CC">(dd-mm-<font color="#0000CC">yyyy</font>)</font></span> </font></div></TD>
                          </TR>
                          <TR>
                            <TD VALIGN=middle height="28" colspan="4" ALIGN=right>
                            <div align="right" class="large"><font color="#0000CC">ID RegNo: </font></div></TD>
                            <TD colspan="2" ALIGN=LEFT VALIGN=TOP><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000">
                                  <input name="txtRegNo" type="text" id="txtRegNo" size="29" value="<?php echo((isset($_POST["txtRegNo"]))?$_POST["txtRegNo"]:"") ?>">
                            </font><font color="#0000CC"></font></div></TD>
                          </TR>
                          <TR>
                            <TD colspan="4" VALIGN=MIDDLE ALIGN=RIGHT nowrap><div align="right" class="large"><font color="#0000CC">POSITION:</font></div></TD>
                            <TD colspan="2" ALIGN=LEFT VALIGN=MIDDLE><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000">
                                  <select name="selectPosition" id="selectPosition">
							<option value="<?php echo((isset($_POST["selectPosition"]))?$_POST["selectPosition"]:"") ?>"><?php echo((isset($_POST["selectPosition"]))?$_POST["selectPosition"]:"") ?></option>  
                                    <option value="student">student</option>
                                    <option value="Lecturer">Lecturer</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="student">Technician</option>
                                  </select>
                            </font></div></TD>
                          </TR>
                          
                          <TR>
                            <TD colspan="4" rowspan="2"><div align="right"></div>                              <div align="right"></div>                              <div align="right"><font color="#0000CC">EMAIL:</font></div></TD>
                            <TD colspan="2" rowspan="2" ALIGN=LEFT VALIGN=MIDDLE><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#0000CC">
                                  <input type="text" size="29" name="txtEmail" value="<?php echo((isset($_POST["txtEmail"]))?$_POST["txtEmail"]:"") ?>">
                            </font></div></TD>
                           
                          </TR>
                          <TR>
                           
                          </TR>
                          <TR>
                            <TD height="19"><div align="right"></div></TD>
                            <TD width="113" align="right" valign="bottom"><div align="right"><span class="style2"></span></div></TD>
                            <TD VALIGN=MIDDLE ALIGN=LEFT BGCOLOR="#FFFFCC"><div align="right"><span class="style2"><span class="style3"><span class="style2"><span class="style2"></span></span></span></span></div></TD>
                            <TD VALIGN=TOP ALIGN=LEFT><div align="right"><span class="style2"><span class="style3"><span class="style2"><span class="style2"></span></span></span></span></div></TD>
                            <TD valign="top" nowrap bgcolor="#FFFFCC">                              <div align="left" class="style2">
                                  <div align="center">
                                    <input type="submit" value="Submit" name="Submit">
                                    <span class="style45 style16"> ...............</span>
                                    <input type="reset" value=" Reset" name="Reset">
                                  </div>
                            </div></TD>
                            <?php $link = UserService::createLoginURL($_SERVER['REQUEST_URI']);?>
                            <TD valign="top" nowrap bgcolor="#FFFFCC"><div align="right">Are You Registered? <a href="<?php echo $link;  ?>">Sign in</a></div></TD>
                          </TR>
          </table>
          <input type="hidden" name="MM_insert" value="true">
          </FORM>				
					  </td>
			  </table>
			
			</td>
		</tr>
	  </table>
	
			<!-- Shadow -->
			<table border=0 cellspacing=0 cellpadding=0 width=640>
			
	  </table>
	</td>
</tr>
</table>
</body>
</html>