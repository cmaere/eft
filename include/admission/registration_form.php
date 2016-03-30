<!-- This Code was Written By Charlie Maere october 2013-->
<!-- This is a student registration form which inputs student norminal details and dump to Google Cloud SQL  -->
	
<style>

.formfield
{
text-align:right;
text-decoration:norwap;
}
.error
{
font-size:8pt;
}

.style2 {color: #FF0000}
* calendar icon */
img.tcalIcon {
	cursor: pointer;
	margin-left: 1px;
	vertical-align: middle;
}
/* calendar container element */
div#tcal {
	position: absolute;
	visibility: hidden;
	z-index: 100;
	width: 158px;
	padding: 2px 0 0 0;
}
/* all tables in calendar */
div#tcal table {
	width: 100%;
	border: 1px solid silver;
	border-collapse: collapse;
	background-color: white;
}
/* navigation table */
div#tcal table.ctrl {
	border-bottom: 0;
}
/* navigation buttons */
div#tcal table.ctrl td {
	width: 15px;
	height: 20px;
}
/* month year header */
div#tcal table.ctrl th {
	background-color: white;
	color: black;
	border: 0;
}
/* week days header */
div#tcal th 
{
	border: 1px solid silver;
	border-collapse: collapse;
	text-align: center;
	padding: 3px 0;
	font-family: tahoma, verdana, arial;
	font-size: 10px;
	background-color: #D7D7FF;
	color: #054d87;
}

div#tcal th:hover 
{
background-color: silver;
color: white;
}
/* date cells */
div#tcal td 
{
	border:1px solid #D7D7FF;
	border-collapse: collapse;
	text-align: center;
	padding: 2px 0;
	font-family: tahoma, verdana, arial;
	font-size: 11px;
	width: 22px;
	cursor: pointer;
}
 div#tcal td:hover
 {
background-color: #D7D7FF;
color: #054d87;
 }

/* date highlight
   in case of conflicting settings order here determines the priority from least to most important */
div#tcal td.othermonth {
	color: silver;
}
div#tcal td.weekend {
	background-color: #d2d2d2;
}
div#tcal td.today {
	border: 1px solid #fcfcfcfc;
	background-color: lightblue;
}
div#tcal td.selected {
	background-color: #FFB3BE;
}
/* iframe element used to suppress windowed controls in IE5/6 */
iframe#tcalIF {
	position: absolute;
	visibility: hidden;
	z-index: 98;
	border: 0;
}
/* transparent shadow */
div#tcalShade {
	position: absolute;
	visibility: hidden;
	z-index: 99;
}
div#tcalShade table {
	border: 0;
	border-collapse: collapse;
	width: 100%;
}
div#tcalShade table td {
	border: 0;
	border-collapse: collapse;
	padding: 0;
}
table.ztable{
border:0px solid green;
border-left:0px dotted #CCC;
border-top:0px dotted #CCC;
border-bottom:0px dotted #CCC;
}
.ztable{
border-bottom:1px dotted #CCC;
border-right:0px dotted #CCC;
background-color: #F7F7F7; 
}
.formfield{
border-bottom:1px dotted #CCC;
}

.hseparator {
border:1px solid #CCC;
 width:98%;
 background-color:#CCC;
 font-weight:bold;
 }
form { 
margin:0px; 
padding:0px;

} 
a{
text-decoration:none;
}
img { border:0px;}

/* form elements */
	
label {
	display:block;
	font-weight:bold;
	margin:50px 0;
	}
	
input {
	border:1px solid #ccc;
	margin-bottom: 2px;
	font-family: Verdana,Helvetica,Sans-Serif;
	font-size: 12px;
	color:#777;
	background-color:#fff;
	}
	
textarea {
	width:300px;
	padding:2px;
	font-family: Verdana,Helvetica,Sans-Serif;
	height:70px;
	display:block;
	color:#777;
	border: 1px solid #ccc;
	}
	
select { 
	border:1px solid #ccc;
	margin-bottom: 2px;
	} 

option { 
	/*width: 200px;*/
	border:0px solid #ccc;   
	}

fieldset {
	padding: 1em;
	border:1px solid #CCC;
	background-color: #F7F7F7; 
	}
  
legend {
	margin-bottom: 8px;
	padding: 5px 5px 5px 5px;
	border:1px solid #CCC;
	background-color: #F7F7F4; 
	}


</style>


<?php

echo"	<div id='content' '=''>
<h2>Student Registration Form <span>for Student Academic Record Information System (SARIS)</span></h2>
<div class='innerLR'>";


if (isset($_GET['id'])) 
{
#get post variables
$id = addslashes($_GET['id']);
$reg = addslashes($_GET['RegNo']);
$edit=$_GET['edit'];
if($edit==yes)
{
$state1="submit";
$state2="hidden";
$state3="readonly";
$state4="";
$label_edit="";
}
else
{
$state1="hidden";
$state2="hidden";
$state3="readonly";
$state4="disabled";
$label_edit="<a href='$_SERVER[PHP_SELF]?id=$id&RegNo=$reg&edit=yes'><img src='./img/edit.png' alt='Click to Edit This Record'>Edit</a>";
}
$sql = "SELECT * FROM student WHERE Id ='$id' and RegNo='$reg'"; 
$update = mysql_query($sql) or die(mysql_error());
$update_row = mysql_fetch_array($update)or die(mysql_error());
$totalRows_update = mysql_num_rows($update)or die(mysql_error());
	$regno = $update_row['RegNo'];
	$stdid = $update_row['Id'];
	$history = $update_row['yr_repeated'];
	$AdmissionNo = $update_row['AdmissionNo'];     
	$degree = $update_row['ProgrammeofStudy'];
	$faculty = $update_row['Faculty'];
	$ayear = $update_row['EntryYear'];
	$combi = $update_row['Subject'];
	$campus = $update_row['Campus'];
	$manner = $update_row['MannerofEntry'];
	$rawname = $update_row['Name'];
		$expsurname = explode(",",$rawname);
		$surname = strtoupper($expsurname[0]);
		$othername = $expsurname[1];
		$expothername = explode(" ", $othername);
		$firstname = $expothername[1];
		$middlename = $expothername[2].' '.$expothername[3];
	$dtDOB = $update_row['DBirth'];
	$age = $update_row['age'];
	$sex = $update_row['Sex'];
	$sponsor = $update_row['Sponsor'];
	$country = $update_row['Nationality'];
	$district =$update_row['District'];
	$region =$update_row['Region'];
	$maritalstatus = $update_row['MaritalStatus'];
	$address = $update_row['Address'];
	$religion = $update_row['Religion'];
	$denomination = $update_row['Denomination'];
	$postaladdress =$update_row['postaladdress'];
	$residenceaddress = addslashes($update_row['residenceaddress']);
	$disabilityCategory = $update_row['disabilityCategory'];
	$status = $update_row['Status'];
	$gyear = $update_row['GradYear'];
	$phone1 = $update_row['Phone'];
	$email1 = $update_row['Email'];
	$formsix = $update_row['formsix'];
	$formfour = $update_row['formfour'];
	$diploma = $update_row['diploma'];
	$School_attended_olevel = $update_row['School_attended_olevel'];
	$School_attended_alevel = $update_row['School_attended_alevel'];
	$name = $surname.", ".$firstname." ".$middlename;
//Added fields
$village=$update_row['village'];
$account_number=$update_row['account_number'];
$bank_branch_name=$update_row['bank_branch_name'];
$bank_name=$update_row['bank_name'];
$form4no=$update_row['form4no'];
$form4name=$update_row['form4name'];
$form6name=$update_row['form6name'];
$form6no=$update_row['form6no'];
$form7name=$update_row['form7name'];
$form7no=$update_row['form7no'];
$paddress=$update_row['paddress'];
$currentaddaress=$update_row['currentaddaress'];
$f4year=$update_row['f4year'];
$f6year=$update_row['f6year'];
$f7year=$update_row['f7year'];
#next of kin info
$kin_email=$update_row['kin_email'];
$kin=$update_row['kin'];
$kin_phone=$update_row['kin_phone'];
$kin_address=$update_row['kin_address'];
$kin_job=$update_row['kin_job'];
$studylevel=$update_row['studylevel'];
$kin_relationship=$update_row['kin_relationship'];
//***********             
}else
{
$state1="hidden";
$state2="submit";
$state3="";
$state4="";
}


if (isset($_POST['save']))
{  
	
	     $disabilityCategory=$_POST['disabilityCategory'];
        $kin=addslashes($_POST['kin']);
        $kin_phone=addslashes($_POST['kin_phone']);
        $kin_address=addslashes($_POST['kin_address']);
        $kin_job=addslashes($_POST['kin_job']);
        $kin_email = $_POST['kin_email'];
	    $history = addslashes($_POST['history']);
		$regno = addslashes($_POST['regno']);
		$stdid = addslashes($_POST['stdid']);
	    $AdmissionNo = addslashes($_POST['AdmissionNo']);   
		$degree = addslashes($_POST['degree']);
		$faculty = addslashes($_POST['faculty']);
		$ayear = addslashes($_POST['ayear']);
		$combi = addslashes($_POST['combi']);
		$campus = addslashes($_POST['campus']);
		$manner = addslashes($_POST['manner']);
		$byear = addslashes($_POST['txtYear']);
		$bmon = addslashes($_POST['txtMonth']);
		$bday = addslashes($_POST['txtDay']);
		$dtDOB = $bday . " - " . $bmon . " - " . $byear;
		$surname = strtoupper(addslashes($_POST['surname']));
		$firstname = addslashes($_POST['firstname']);
		$middlename = addslashes($_POST['middlename']);
		$dtDOB = $_POST['dtDOB'];
		$age = $_POST['age'];
		$sex = $_POST['sex'];
		$sponsor = $_POST['txtSponsor'];
		$country = $_POST['country'];
		$district = addslashes($_POST['district']);
		$region = addslashes($_POST['region']);
		$maritalstatus = $_POST['maritalstatus'];
		$address = strtoupper($_POST['address']);
		$religion = $_POST['religion'];
		$denomination = $_POST['denomination'];
		$postaladdress = strtoupper(addslashes($_POST['postaladdress']));
		$residenceaddress = strtoupper(addslashes($_POST['residenceaddress']));
		$disability = $_POST['disability'];
		$status = $_POST['status'];
		$gyear = $_POST['dtDate'];
		$phone1 = $_POST['phone'];
		$email1 = $_POST['email'];
		$formsix = $_POST['formsix'];
		$formfour = $_POST['formfour'];
		$diploma = $_POST['diploma'];
		$studylevel= $_POST['studylevel'];
		$f4year= $_POST['f4year'];
		$f6year= $_POST['f6year'];
		$f7year= $_POST['f7year'];
		$denomination= $_POST['denomination'];
		$name = $surname.", ".$firstname." ".$middlename;


//Added fields
$village=$_POST['village'];
$account_number=$_POST['account_number'];
$bank_branch_name=$_POST['bank_branch_name'];
$bank_name=$_POST['bank_name'];
$form4no=$_POST['form4no'];
$form4name=$_POST['form4name'];
$form6name=$_POST['form6name'];
$form6no=$_POST['form6no'];
$form7name=$_POST['form7name'];
$form7no=$_POST['form7no'];
$paddress=$_POST['paddress'];
$currentaddaress=$_POST['currentaddaress'];
$kin_relationship=$_POST['kin_relationship'];
//*************
//FORMATING ERRORS
if(!$formsix||!$formfour||!$diploma||!$phone1||!$email1||!$regno||!$degree||!$faculty||!$ayear||!$combi||!$campus||!$manner||!$byear||!$bmon||!$bday||!$dtDOB||!$surname||!$firstname||!$dtDOB|| !$age||!$sex||!$sponsor||!$country||!$maritalstatus||!$address||!$religion||!$denomination||!$postaladdress||!$residenceaddress||!$status||!$gyear||!$name||!$village)
{ 
if(!$regno)
{
$regno_error="<font color='red'>*Registration Number Must be Filled</font>";
}
if(!$phone1)
{
//$phone1_error="<font color='red'>*Phone Number Must be Filled</font>";
}
if(!$studylevel)
{
//$studylevel_error="<font color='red'>*Study Level Must be Filled</font>";
}
if(!$email1)
{
//$email1_error="<font color='red'>*Email Must be Filled</font>";
}
if(!$formsix)
{
//$formsix_error="<font color='red'>*Form Six Necta Number Must be Filled</font>";
}
if(!$formfour)
{
$formfour_error="<font color='red'>*Form Four Necta Number Must be Filled</font>";
}
	 
if(!$diploma)
{
//$diploma_error="<font color='red'>*Diploma Necta Number Must be Filled</font>";
}
if(!$degree)
{
$degree="<font color='red'>*Degree Must be Filled</font>";
}
 	 
	 
if(!$faculty)
{
$faculty_error="<font color='red'>*Faculty  Must be Filled</font>";
}
	  
if(!$ayear)
{
$ayear_error="<font color='red'>*Date Must be Filled</font>";
}
	 
if(!$combi)
{
$combination_error="<font color='red'>*Combination  Must be Filled</font>";
} 	 
if(!$campus)
{
$campus_error="<font color='red'>*Campus Name Must be Filled</font>";
}	 
if(!$manner)
{
$manner_error="<font color='red'>*Manner Must be Filled</font>";
}
	 
	 
if(!$byear)
{
$byear_error="<font color='red'>*Birth Date Must be Filled</font>";
}
if(!$bmon)
{
$bmon_error="<font color='red'>*Month Must be Filled</font>";
}
if(!$sex)
{
$sex_error="<font color='red'>*Gender Must be Filled</font>";
}
	 
if(!$bday)
{
$bday_error="<font color='red'>*Birth day Must be Filled</font>";
}	
if(!$dtDOB)
{
$dtDOB_error="<font color='red'>*Date of birth Must be Filled</font>";
}
	 
if(!$surname)
{
$surname_error="<font color='red'>*Surname Must be Filled</font>";
}	 
	
if(!$firstname)
{
$firstname_error="<font color='red'>*First Name Must be Filled</font>";
}
/* 
if(!$middlename)
{
$middlename_error="<font color='red'>*Middle Name Must be Filled</font>";
}
*/
if(!$dtDOB)
{
$dtDOB_error="<font color='red'>*Date of Birth Must be Filled</font>";
}
if(!$age)
{
$age_error="<font color='red'>*Age Must be Filled</font>";
}
	 
if(!$sponsor)
{
$sponsor_error="<font color='red'>*Sponsor Must be Filled</font>";
}
if(!$country)
{
$country_error="<font color='red'>*Country Must be Filled</font>";
}
/* 
if(!$district)
{
$district_error="<font color='red'>*District Must be Filled</font>";
}
*/
if(!$region)
{
$region_error="<font color='red'>*Region Must be Filled</font>";
}
if(!$maritalstatus)
{
$maritalstatus_error="<font color='red'>*Marital Status Must be Filled</font>";
}
if(!$address)
{
$address_error="<font color='red'>*Address Must be Filled</font>";
}
if(!$religion)
{
$religion_error="<font color='red'>*Religion Must be Filled</font>";
}
if(!$village)
{
$village_error="<font color='red'>*Village Must be Filled</font>";
}
if(!$denomination)
{
$denomination_error="<font color='red'>*Denomination Must be Filled</font>";
}
if(!$postaladdress)
{
$postaladdress_error="<font color='red'>*Postal Address Must be Filled</font>";
}
if(!$residenceaddress)
{
$residenceaddress_error="<font color='red'>*Residentaddress Address Must be Filled</font>";
}
/*
if(!$disability)
{
$disability_error="<font color='red'>*Disability Must be Filled</font>";
}
*/
if(!$status)
{
$status_error="<font color='red'>*Status Address Must be Filled</font>";
}
if(!$gyear)
{
$gyear_error="<font color='red'>*Gyear Address Must be Filled</font>";
}
if(!$name)
{
$name_error="<font color='red'>*Name Address Must be Filled</font>";
}

$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	?>
	<form action=" <?php echo $editFormAction ?>" method="POST" name='admission'>
	<?php form(); ?>
	</form>

	<?php


}

//
#check if RegNo Exist

$qRegNo = "SELECT RegNo FROM student WHERE RegNo = '$regno'";
$dbRegNo = mysql_query($qRegNo);
$total = mysql_num_rows($dbRegNo);
if ($total==1)
{
echo"
<table>
<tr><td><img src='./img/error.gif'></td>
<td>
Cha Database System discovered,<br> 
Registration Number $regno Already exist!
<br><a href='./admissionRegistrationForm.php'>Go Back and Insert New One!</a>
</td></tr></table>";
}
else
{
#insert record
$sql="INSERT INTO student
(Name,AdmissionNo,
Sex,DBirth,
MannerofEntry,MaritalStatus,
Campus,ProgrammeofStudy,
Faculty,
Sponsor,GradYear,
EntryYear,Status,
Address,Nationality,
Region,District,Country,
Received,user,
Denomination, Religion,
Disability,f7year,
kin,kin_phone,
kin_address,kin_job,
disabilityCategory,Subject,
account_number,
bank_branch_name,
bank_name,
form7name,
form7no,
paddress,
Phone,
Email,
currentaddaress,
RegNo,
studylevel,
kin_relationship,
village,
kin_email
) 
VALUES
('$name','$AdmissionNo',
'$sex','$dtDOB',
'$manner','$maritalstatus',
'$campus','$degree',
'$faculty',' $sponsor',
'$gyear','$ayear',
'$status','$paddress',
'$country',
'$region','$district',
'$country',now(),
'$username','$denomination', 
'$religion','$disability','$f7year',
'$kin','$kin_phone',
'$kin_address','$kin_job',
'$disabilityCategory','$Subject',
'$account_number',
'$bank_branch_name',
'$bank_name',
'$form7name',
'$form7no',
'$paddress',
'$phone1',
'$email1',
'$currentaddaress',
'$regno',
'$studylevel',
'$kin_relationship',
'$village',
'$kin_email'
)";   
//echo $sql;
$dbstudent = mysql_query($sql)or die(mysql_error());
if(!$dbstudent)
{
echo "Admision Record Cant be Saved";
}else
{
echo "Admision Record Saved Successfuly";
}		
}
}
else
{	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	?>
	<form action=" <?php echo $editFormAction ?>" method="POST" name='admission'>
	<?php form(); ?>
	</form>

	<?php
}

#Updating Records
if(isset($_POST['actionupdate']))
{
	
	//die($history);
    $disabilityCategory=$_POST['disabilityCategory'];
        $kin=$_POST['kin'];
        $kin_phone=$_POST['kin_phone'];
        $kin_address=$_POST['kin_address'];
 $kin_job=$_POST['kin_job'];
$regno = addslashes($_POST['regno']);
$AdmissionNo = addslashes($_POST['AdmissionNo']);   
		$stdid = $_POST['stdid'];
		$history = $_POST['history'];
		$degree = $_POST['degree'];
		$faculty = $_POST['faculty'];
		$ayear = $_POST['ayear'];
		$combi = $_POST['combi'];
		$campus = $_POST['campus'];
		$manner = $_POST['manner'];
		$byear = addslashes($_POST['txtYear']);
		$bmon = addslashes($_POST['txtMonth']);
		$bday = addslashes($_POST['txtDay']);
		$dtDOB = $bday . " - " . $bmon . " - " . $byear;
		$surname = strtoupper(addslashes($_POST['surname']));
		$firstname = addslashes($_POST['firstname']);
		$middlename = addslashes($_POST['middlename']);
		$dtDOB = $_POST['dtDOB'];
		$age = $_POST['age'];
		$sex = $_POST['sex'];
		$sponsor = $_POST['txtSponsor'];
		$country = $_POST['country'];
		$district = addslashes($_POST['district']);
		$region = addslashes($_POST['region']);
		$maritalstatus = $_POST['maritalstatus'];
		$address = strtoupper($_POST['address']);
		$religion = $_POST['religion'];
		$denomination = $_POST['denomination'];
		$postaladdress = strtoupper(addslashes($_POST['postaladdress']));
		$residenceaddress = strtoupper(addslashes($_POST['residenceaddress']));
		$disability = $_POST['disability'];
		$status = $_POST['status'];
		$gyear = $_POST['dtDate'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$formsix = $_POST['formsix'];
		$formfour = $_POST['formfour'];
		$diploma = $_POST['diploma'];
		$studylevel= $_POST['studylevel'];
		$f4year= $_POST['f4year'];
		$f6year= $_POST['f6year'];
		$f7year= $_POST['f7year'];
		$denomination= $_POST['denomination'];
		$name = $surname.", ".$firstname." ".$middlename;

//Added fields
$village=$_POST['village'];
$account_number=$_POST['account_number'];
$bank_branch_name=$_POST['bank_branch_name'];
$bank_name=$_POST['bank_name'];
$form7name=$_POST['form7name'];
$form7no=$_POST['form7no'];
$paddress=$_POST['paddress'];
$currentaddaress=$_POST['currentaddaress'];
$kin_relationship=$_POST['kin_relationship'];

$qRegNo = "SELECT RegNo FROM student WHERE RegNo = '$regno'";
$dbRegNo = mysql_query($qRegNo);
$total = mysql_num_rows($dbRegNo);
if ($total>1) 
{
echo "cha Database System discovered,<br> Registration Number ". $regno. " Already exist";
echo "<br> Go Back and Insert New One!<hr><br>";
}
else
{
#update record
$sql="update student set Name='$name',
Sex='$sex',DBirth='$dtDOB',yr_repeated='$history',
MannerofEntry='$manner',
MaritalStatus='$maritalstatus',
Campus='$campus',ProgrammeofStudy='$degree',
Faculty='$faculty',Sponsor='$sponsor',
GradYear='$gyear',EntryYear='$ayear',
Status='$status',
Address='$paddress',Nationality='$country',
Region='$region',District='$district',
Country='$country',
Received=now(),user='$username',
Denomination='$denomination',
Religion='$religion',Disability='$disability',f7year='$f7year',
kin='$kin',kin_phone='$kin_phone',
kin_address='$kin_address',kin_job='$kin_job',
disabilityCategory='$disabilityCategory',
Subject='$combi',
account_number='$account_number',
bank_branch_name='$bank_branch_name',
bank_name='$bank_name',
form7name='$form7name',
form7no='$form7no',
paddress='$paddress',
Phone='$phone',
Email='$email',
AdmissionNo='$AdmissionNo',
RegNo='$regno',
currentaddaress='$currentaddaress',
kin_relationship='$kin_relationship',
village='$village',
kin_email='$kin_email',
studylevel='$studylevel'
where Id='$stdid'";
$dbstudent = mysql_query($sql) or die(mysql_error());
if(!$dbstudent)
{
echo "Admision Record Cant be Updated";
}else
{
echo "Admision Record Updated Successfully";
}		
}
}


?>		
	
	
							

</div>