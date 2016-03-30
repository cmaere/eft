<?php

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


// end check session

//main layout functions

//menu section function to automatically create a section  and check if its active or not	
function cha_activesection($activesection,$section,$menulink,$sectionname,$icon,$module)
{	

	// getting the priveledge of a module
	
	$sql = "SELECT sections.sectionpage FROM sections, sectionsName WHERE sections.sectionpage=sectionsName.id  AND sectionsName.sectionname = '$activesection' AND `module` = $module";
	//die($sql);
   $result = mysql_query($sql) or die("query error<br>");
   $noFound = mysql_num_rows($result);
   if($noFound <> 0)
   {
	   
	   
		if($section == $activesection)
		{
			echo "<li class='hasSubmenu active'>";
	


			echo "<a data-toggle='collapse' class='glyphicons $icon' href='#$menulink'><i></i><span>$sectionname</span></a>
				<ul style='height: auto;' class='collapse' id='$menulink'>";
		}
		else
		{
			echo "<li class='hasSubmenu'>";
	


			echo "<a data-toggle='collapse' class='glyphicons $icon collapsed' href='#$menulink'><i></i><span>$sectionname</span></a>
				<ul style='height: 0px;' class='collapse' id='$menulink'>";
		}
		return(1);
	}
	else
	{
		return(0);
	}
	
}	

//menu function to automatically create a menu  and check if its active or not		
function cha_activebutton($activepage,$page,$link,$buttonname,$module)
{	
	$sql = "SELECT functions.sectionpage FROM functions, functionName WHERE functions.function=functionName.id  AND functionName.functionname = '$activepage' AND functions.module = $module";
	//die($sql);
   $result = mysql_query($sql) or die("query error<br>");
   $noFound = mysql_num_rows($result);
   if($noFound <> 0)
   {
	   
		if($page == $activepage)
		{
			echo "	
				<li class='hasSubmenu active'>
				<a href='$link'><i></i><span>$buttonname</span></a>
		
				</li> ";

		}
		else
		{
			echo "
				<li class='hasSubmenu'>
				<a href='$link'><i></i><span>$buttonname</span></a>
		
				</li>";	
		
			
		}
		return(1);
	}
	else
	{
 	   
		return(0);
	}

}

function closemenu($section,$module)
{
	$sql = "SELECT functionName.functionname FROM functionName
INNER JOIN functions ON (functionName.id = functions.function)
INNER JOIN  sectionsName ON (functions.sectionpage = sectionsName.id)
 WHERE  sectionsName.sectionname='$section' AND functions.module = $module ";
	//die($sql);
   $result = mysql_query($sql) or die("query error<br>");
   $count = mysql_num_rows($result);
   
	if($count > 0){ echo "</ul><span class='count'>$count</span></li>";}
}

// end main layout functions

// institute form functions
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
//cha modifications - declaring a function to check submission status


function cha_substate($name, $ayear, $score, $code,$examcat)
{

            
            
           //die("am here now");
            //cha modification
            $sql_lectsubstatus = "select substatus from submitresult where Lecturer_Name = '$name' and acYear = '$ayear' and courseCode = '$code' and category = '$examcat'";
            
            //die($sql_lectsubstatus);
			$qsubstatus=mysql_query($sql_lectsubstatus) or die('cha q Problem');
			$total_row = mysql_num_rows($qsubstatus);
            //die("cha===".$total_row);
			if($total_row > 0){
            ?>
             <td>
            <?php echo $score; ?></td>
            <?php
            
            }
            else
            {
            ?>
                <td>
            <input name='cwk[]' type='text' id='cwk[]' value='<?php echo $score; ?>' size='3'></td>
            
            <?php
            
            }
            
            






}


//end modification

//*************REGISTRATION FORM
function form()
{
global $state1,$state2,$state3,$label_edit,$state4,$AdmissionNo,$stdid, $studylevel,$kin_relationship;
global $disabilityCategory,$studylevel,$father,$father_job,$mother,$mother_job,$father_address,$history,
$father_phone,$mother_address,$mother_phone,
$brother,$brother_phone,$brother_address,$brother_job,
$sister,$sister_phone,$sister_address,$sister_job,
$spouse,$spouse_phone,$spouse_address,$spouse_job,
$kin,$kin_phone,$kin_address,$kin_job,$School_attended_olevel,$School_attended_to_alevel,$School_attended_alevel,$School_attended_from_alevel,
$relative,$relative_phone,$relative_address,$relative_job,$School_attended_to_olevel,$School_attended_from_olevel,
$txtYear,$txtDay,$txtMonth,$sponsor,$maritalstatus,$country,$formsix,$formfour,$diploma,$phone1,$email1,$regno,$degree,$faculty,$ayear,$combi,$campus,$manner,$byear,$bmon,$bday,$dtDOB,$surname,$firstname,$middlename,$dtDOB,$age,$sex,$sponsor,$country,$district,$region,$maritalstatus,$address,$religion,$denomination,$postaladdress,$residenceaddress,$disability,$status,$gyear,$name,$ayear,$campus,
$kin,$kin_phone,$kin_address,$kin_job,$f4year,$f6year,$f7year,$kin_email;
global $disabilityCategory_erro,$studylevel_error,$maritalstatus_error,$country_error,$ayear_error,$formsix_error,$formfour_error,$diploma_error,$phone1_error,$email1_error,$regno_error,$degree_error,$faculty_error,$ayear_error,$combi_error,$campus_error,$manner_error,$byear_error,$bmon_error,$bday_error,$dtDOB_error,$surname_error,$firstname_error,$middlename_error,$dtDOB_error,$age_error,$sex_error,$sponsor_error,$country_error,$district_error,$region_error,$maritalstatus_error,$address_error,$religion_error,$denomination_error,$postaladdress_error,$residenceaddress_error,$disability_error,$status_error,$gyear_error,$name_error;
global $account_number,$bank_branch_name,$bank_name,$form4no,$form4name,$form6name,$form6no,$form7name,$form7no,$paddress,$currentaddaress,$village;

?> 

	



	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Study Programme Information</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 300px; padding: 0px; position: relative;">
				
<fieldset>
<table align="center" cellspacing='2' >
<tr>
<td> 
<?php echo $label_edit;?>&nbsp;
</td>
<td class='zatable'>
<input name="actionupdate" type="<?php echo $state1;?>" value="Save Changes"  onmouseover="this.style.background='#DEFEDE'"
onmouseout="this.style.background='#CFCFCF'" title="Click to Save Changes">
<input name="save" type="<?php echo $state2;?>" value="Save Record"
 onmouseover="this.style.background='#DEFEDE'"
onmouseout="this.style.background='#CFCFCF'" title="Click to Save Record" >
</td>
</tr>
</table>




<table  cellpadding='0' cellspacing='0' class='ztable'>

  <tr>
    <td colspan="4" nowrap="nowrap" class="hseparator">
	Study Programme Information    </td>
    </tr>
  
  
  <tr>
    <td nowrap="nowrap" class='formfield'>Year of Admission:<span class="style2">*</span></td>
   <td class='ztable'>
<select name="ayear" id="select" class="vform" <?php echo $state4;?> title="Select Year of Admission">
<?php
if(!$ayear)
{
echo"<option value=''>[Select Academic Year]</option>";
}else
{
echo"<option value='$ayear'>$ayear</option>";
}
$nm=mysql_query("SELECT AYear FROM academicyear where AYear!='$ayear' ORDER BY AYear DESC");
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[AYear]'>$show[AYear]</option>";      
}
?>										                                        												 
</select>
<?php echo $ayear_error; 
?>
</td>
<td nowrap="nowrap" class="formfield">Admission No:<span class="style2">*</span>	</td>
<td class='ztable'>
<input name="hiddenregno" type="hidden" id="hiddenregno" value = "7070"    <?php echo $state3;?> <?php echo $state4;?> />
<input name="stdid" type="hidden" id="stdid" value = "<?php echo $stdid;?>" <?php echo $state3;?> <?php echo $state4;?> />
<input name="AdmissionNo" type="text" id="AdmissionNo" value = "<?php echo $AdmissionNo;?>"    <?php echo $state3;?> <?php echo $state4;?>
title="Type here Admission Number" />
 
<?php echo $regno_error;?> </td>
</tr>
<tr>
<td nowrap="nowrap" class='formfield'>Campus:<span class="style2">*</span></td>
<td class='ztable'>
<select name="campus" <?php echo $state4;?> title="Select Campus">
<?php
if(!$campus)
{
echo"<option value=''>[Select Campus]</option>";
}
else
{
$query_campus1 = mysql_query("SELECT CampusID, Campus FROM campus where CampusID='$campus'");
$camp=mysql_fetch_array($query_campus1);
echo"<option value='$campus'>$camp[Campus]</option>";
} 
$query_campus = "SELECT CampusID, Campus FROM campus ORDER BY Campus ASC";
$nm=mysql_query($query_campus);
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[Campus]'>$show[Campus]</option>";      
}   
?>										                                        												 
</select>
<?php echo $campus_error;  ?></td>
  <td class='formfield'>Registration No:<span class="style2">*</span></td>
  <td class='ztable'>
  <input name="regno" type="text" id="regno" value = "<?php echo $regno;?>" <?php echo $state4;?> <?php echo $state;?> 
title="Type here Registration Number">
  <?php ?>
  </td>
</tr>




<tr>
<td nowrap="nowrap" class='formfield'></td> 
<td class='ztable'>
</td>  
<td nowrap="nowrap" class="formfield" >Academic History:</td>
<td class='ztable'>

<input type="text" name="history" value="<?php echo $history; ?>" />  </td>

</tr>










<tr>
<td nowrap="nowrap" class='formfield'>Program Registered:<span class="style2">*</span></td> 
<td class='ztable'>
<select name="degree" id="degree"  <?php echo $state3;?> <?php echo $state4;?> title="Select Program Registered">
<?php
if(!$degree)
{
echo"<option value=''>[Select Programme]</option>";
}else
{
$take=mysql_query("select * from programme where ProgrammeCode='$degree'")or die(mysql_error());
$t=mysql_fetch_array($take);
echo"<option value='$degree'>$t[ProgrammeName]</option>";
}  
$query_degree = "SELECT ProgrammeCode,ProgrammeName,Faculty FROM programme ORDER BY ProgrammeName";
$nm=mysql_query($query_degree);
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[ProgrammeCode]'>$show[ProgrammeName]</option>";      
     
}
?> 
</select>
<?php 
echo $degree_error;  
?></td>  
<td nowrap="nowrap" class="formfield" >Graduation Date:</td>
<td class='ztable'>
<input type="text" name="dtDate" value="<?php echo $gyear;?>" <?php echo $state4;?> title="Click the Calender icon to select Graduation Date" />
  <script type="text/javascript" src="./calendars.js"></script>
  <script language="JavaScript">
	new tcal ({'formname': 'admission','controlname': 'dtDate'});
	   </script>
  <?php echo $date_error;  ?> </td>

</tr>
<tr><td class='formfield'>Faculty:<span class="style2">*</span>
</td><td class='ztable'>
<select name="faculty" id="faculty" <?php echo $state4;?> title="Type faculty Name">
  <?php
if(!$faculty)
{
echo"<option value=''>[Select Faculty]</option>";
}else
{

echo"<option value='$faculty'>$faculty</option>";
}  
$query_faculty = "SELECT FacultyName FROM faculty ORDER BY FacultyName DESC";
$nm=mysql_query($query_faculty);
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[FacultyName]'>$show[FacultyName]</option>";      
        
}
?>
   </select>
       <?php 
echo $faculty_error;
?></td>
     <td nowrap="nowrap" class="formfield">Sponsorship:	 </td>
    <td class='ztable'>
	 <select name="txtSponsor" id="txtSponsor" <?php echo $state4;?> title="Select Sponsorship">
       <?php
if(!$sponsor)
{
echo"<option value=''>[Select Sponsor]</option>";
}else
{
echo"<option value='$sponsor'>$sponsor</option>";
}  
$query_sponsor = "SELECT Name FROM sponsors ORDER BY SponsorID ASC";
$nm=mysql_query($query_sponsor);
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[Name]'>$show[Name]</option>";      
    
}
?>
     </select>
       <?php 
echo $sponsor_error;
?></td>
   </tr>
<tr>
<td nowrap="nowrap" class="formfield">Level of Study Registered for:</td>
  <td class='ztable'>
 
<select name="studylevel" id="studylevel" <?php echo $state4;?> title="Select Study Level">
<?php
if(!$studylevel)
{
echo"<option value=''>[Select Level of Study]</option>";
}else
{
$take=mysql_query("select * from programmelevel where Code='$studylevel'");
$t=mysql_fetch_array($take);
echo"<option value='$studylevel'>$t[StudyLevel]</option>";
}  
$query_studylevel = "SELECT * FROM programmelevel";
$nm=mysql_query($query_studylevel);
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[Code]'>$show[StudyLevel]</option>";      
 
}
?>										                                        						 
</select>
<?php ?>
</td>
<td nowrap="nowrap"class="formfield">Manner of Entry:</td>
<td class='ztable'>
<select name="manner" id="manner"  title="Select Mannner of Entry" <?php echo $state4;?>>
<?php
if(!$manner)
{
echo"<option value=''>[Select Manner of Entry]</option>";
}else
{
$query_Manner =mysql_query("SELECT ID, MannerofEntry FROM mannerofentry where ID='$manner'");
$mana=mysql_fetch_array($query_Manner);
echo"<option value='$manner'>$mana[MannerofEntry]</option>";
}  
$query_MannerofEntry = "SELECT ID, MannerofEntry FROM mannerofentry ORDER BY MannerofEntry ASC";
$nm=mysql_query($query_MannerofEntry);
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[ID]'>$show[MannerofEntry]</option>";      
}       

?>
     </select>
<?php 
echo $manner_error;
?></td>  
  
</tr>
</table>



			</div>
	</div>
</div>
<!-- // End of Widget prog info -->

<!-- personal info -->

<!-- Intro message -->
<div class="widget" data-toggle="collapse-widget" data-collapse-closed="true">
	<div class="widget-head">
		<h4 class="heading glyphicons cardio">Personal Information</h4>
	</div>
	<div class="widget-body collapse in">
		<div id="chart_lines_fill_nopoints1" style="height: 480px; padding: 0px; position: relative;">
			
			<table align="center" cellspacing='2' >
			<tr>
			<td> 
			<?php echo $label_edit;?>&nbsp;
			</td>
			<td class='zatable'>
			<input name="actionupdate" type="<?php echo $state1;?>" value="Save Changes"  onmouseover="this.style.background='#DEFEDE'"
			onmouseout="this.style.background='#CFCFCF'" title="Click to Save Changes">
			<input name="save" type="<?php echo $state2;?>" value="Save Record"
			 onmouseover="this.style.background='#DEFEDE'"
			onmouseout="this.style.background='#CFCFCF'" title="Click to Save Record" >
			</td>
			</tr>
			</table>

<table>
  <tr>
    <td colspan="4" nowrap="nowrap" class="hseparator">
	Personal Information    </td>
    </tr>
    <tr><td class='formfield'>Surname:<span class="style2">*</span></td><td class='ztable'>
	<input name="surname" type="text" id="surname" value = "<?php echo $surname;?>" size="30"  <?php //echo $state3;?> 
<?php echo $state4;?>
title="Type here Surname"/>
      <?php echo $surname_error;  ?></td>
     <td class="formfield">Religion:     </td>
     <td class='ztable'>
<?php
 echo"<select name='denomination' id='denomination'  $state4  $state4  title='Select here Denomination'>";
if(!$denomination)
{
echo"<option value=''>[Select Sect of Religion ]</option>";
}else
{
?>
<option value="<?php echo $denomination;?>"><?php echo $denomination;?></option>
<?php
}  

$query_denomination2 = "SELECT * FROM religion";
$nr=mysql_query($query_denomination2);
while($l=mysql_fetch_array($nr))
{
//echo"<optgroup label='$l[Religion]'>";
//$query_denomination = "SELECT * FROM denomination where ReligionID='$l[ReligionID]' ORDER BY denomination ASC";
$query_denomination = "SELECT * FROM religion where ReligionID='$l[ReligionID]' ORDER BY Religion ASC";
$nm=mysql_query($query_denomination);
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[Religion]'>$show[Religion]</option>";      
}
//echo"</optgroup>";
}       
?>
      </select>
        <?php 
echo $denomination_error; 
?></td>
    </tr>
    
   <tr>
   <td class='formfield' norwap>Middlename:</td> 
  <td class='ztable'>
<input name="middlename" type="text" id="middlename" value="<?php echo $middlename;?>" size="15" maxlength="50"  <?php //echo $state3;?> <?php echo $state4;?> title="Type here Middle Name"/>
     <?php echo $middlename_error;  ?> </td>
  <td class="formfield">Marital Status:</td>
  <td class='ztable'>
   <select name="maritalstatus" id="maritalstatus" <?php echo $state4;?> title="Type here Marital Status">
     <?php
if($maritalstatus)
{
echo "<option value='$maritalstatus'>$maritalstatus</option>";
}else
{
echo "<option value=''>[Select Marital Status]</option>";
}
?>
     <option value="Single">Single</option>
     <option value="Married">Married</option>
     <option value="Divorced">Divorced</option>
     <option value="Widowed">Widowed</option>
   </select>
<?php    
echo $maritalstatus_error; 
?></td>
</tr>
<tr>
<td class='formfield'>Firstname:<span class="style2">*</span></td>
<td class='ztable'>
<input name="firstname" type="text" value="<?php echo $firstname;?>" id="firstname" size="30" <?php echo $state4;?>
title="Type here First Name"/>
<?php echo $firstname_error;  ?> 
</td>
<td class="formfield">Disability:</td>
<td class='ztable'>
<select name='disabilityCategory' <?php echo $state4;?> title="Select here Disability type">
     <?php
if($disabilityCategory)
{?>
     <option value="<?php echo $disabilityCategory;?>"> <?php echo $disabilityCategory;?></option>
     <?
}else
{
echo"<option value='None'>[Select Disability]</option>";
} 
$query_disability3 = "SELECT * FROM disability"; 
$nm3=mysql_query($query_disability3);
while($s= mysql_fetch_array($nm3))
{
echo"<optgroup label='$s[disability]'>";      
$query_disability2 = "SELECT * FROM disabilitycategory where DisabilityCode='$s[DisabilityCode]'";
$nm2=mysql_query($query_disability2);
while($show = mysql_fetch_array($nm2) )
{ 	 
echo"<option  value='$show[disabilityCategory]'>$show[disabilityCategory]</option>";      
}
echo"<optgroup>";
}       
?>
</select>
<?php 
echo $disability_error; 
?>
</td>
</tr>
   
<tr><td class='formfield' norwap>Sex:<span class="style2">*</span></td>
<td class='ztable'>
<select name="sex" id="sex" <?php echo $state4;?> title="Select Gender">
     <?php
if(!$sex)
{
echo"<option value=''>[Select Gender]</option>";
}else
{
if($sex=='F')
{
?>
     <option value="<?php echo $sex;?>">Female</option>
     <?php
}else
{
?>
     <option value="<?php echo $sex;?>">Male</option>
     <?php
}
}
?>
     <option value="M">Male</option>
     <option value="F">Female</option>
</select>
<?php 
echo $sex_error;
?>
</td>
<td nowrap="nowrap" class="formfield">Permanent Address:<span class="style2">*</span>  </td>
<td nowrap="nowrap" class="ztable">
<input name="paddress" type="text" id="paddress" size="30" value = "<?php echo $paddress;?>" <?php echo $state4;?> 
title="Type here Permanent Address"/>
<?php ?>
</td>
</tr>
<tr><td class='formfield'>Date of Birth:</td>
<td class='ztable'>
<input type="text" name="dtDOB" value="<?php echo $dtDOB;?>" <?php echo $state4;?> 
title="Click the Calender Icon to select Date of Birth "/>
<script language="JavaScript">
	new tcal ({'formname': 'admission','controlname': 'dtDOB'});
</script>
<?php echo $dbirth_error;?> 
</td>
<td class="formfield">Current Address:<span class="style2">*</span></td>
<td class='ztable'>
<input name="currentaddaress" type="text" id="currentaddaress" size="30" value = "<?php echo $currentaddaress;?>" <?php echo $state4;?> 
title="Type here Current Address"/>
<?php?>
</td>
</tr>

<tr>
<td class='formfield'>Home District:<span class="style2">*</span></td> 
<td class='ztable'>
<input name="district" type="text" id="district" value = "<?php echo $district;?>" size="30" <?php echo $state4;?> 
title="Type here District"/>
<?php echo $district_error;  ?> </td>
<td class="formfield">Phone:</td>
<td class='ztable'>
<input name="phone" type="text"  size="30" value = "<?php echo $phone1;?>" <?php echo $state4;?> 
title="Type here Phone Number"/>
<?php 
echo $phone1_error; 
?>
</td>
</tr>

<tr>
<td class='formfield'>Traditional Authority:<span class="style2">*</span></td> 
<td class='ztable'>
<input name="region" type="text" id="region" size="30" value = "<?php echo $region;?>" <?php echo $state4;?>
title="Type here T.A" />
<?php echo $region_error;?></td>
<td class="formfield">E-mail:</td>
<td class='ztable'>
<input name="email" type="text"  size="30" value = "<?php echo $email1;?>" <?php echo $state4;?> 
title="Type here Email"/>
<?php 
echo $email1_error; 
?>
</td>
</tr>


<tr> 
<td class="formfield">Home Village:<span class="style2">*</span></td>
<td class='ztable'>
<input name="village" type="text"  size="30" value = "<?php echo $village;?>" <?php echo $state4;?> 
title="Type here Village"/>
<?php 
echo $village_error; 
?>
</td>
<!-- <td class='formfield'>Home Village:<span class="style2">*</span></td> 
<td class='ztable'>

<select name="select" <?php echo $state4;?> title="Select here Country of Birth">
<?php
if($country)
{
echo "<option value='$country'>$country</option>";
}
else
{
echo "<option value='Malawi'>Malawi</option>";
}
$query_country = "SELECT szCountry FROM country ORDER BY szCountry";
$countrys = mysql_query($query_country) or die(mysql_error());
while ($row_country = mysql_fetch_array($countrys))
{
?>
  <option value="<?php echo $row_country['szCountry']?>"> <?php echo $row_country['szCountry']?></option>
  <?php
}
?>
</select>
  <?php 
echo $country_error;   ?></td> -->
<td class="formfield">Name of Bank:</td>
<td class='ztable'>
<input name="bank_name" size="30" value = "<?php echo $bank_name;?>" <?php echo $state4;?> title="Type here Bank Name"/>
<?php ?>
</td>
</tr>

<tr>
<td class='formfield'>Nationality:<span class="style2">*</span></td>
<td class='ztable'>
<select name="country" <?php echo $state4;?> title="Select Nationality">
  <?php
if($country)
{
echo "<option value='$country'>$country</option>";
}
else
{
echo "<option value='Malawi'>Malawi</option>";
}
$query_country = "SELECT szCountry FROM country ORDER BY szCountry";
$countrys = mysql_query($query_country) or die(mysql_error());
while ($row_country = mysql_fetch_array($countrys))
{
?>
  <option value="<?php echo $row_country['szCountry']?>"> <?php echo $row_country['szCountry']?></option>
  <?php
}
?>
</select>
  <?php 
echo $country_error;   ?></td>
<td class="formfield">Name of Branch:</td>
<td class='ztable'>
<input name="bank_branch_name" size="30" value = "<?php echo $bank_branch_name;?>" <?php echo $state4;?>
title="Type here Branch Name" />
<?php ?>
</td>
</tr> 

<tr><td class='formfield'>Student Status:<span class="style2">*</span></td>
<td class='ztable'>
<select name="status" id="status" <?php echo $state4;?> title="Select Student Status">
  <?php
if(!$status)
{
echo"<option value=''>[Select Status]</option>";
}else
{
$query_studentStatus1 = mysql_query("SELECT StatusID,Status FROM studentstatus where StatusID='$status'");
$stat=mysql_fetch_array($query_studentStatus1);
echo"<option value='$status'>$stat[Status]</option>";
}  
$query_studentStatus = "SELECT StatusID,Status FROM studentstatus ORDER BY StatusID";
$nm=mysql_query($query_studentStatus);
while($show = mysql_fetch_array($nm) )
{  										 
echo"<option  value='$show[StatusID]'>$show[Status]</option>";      
      
}
?>
</select>
  <?php 
echo $status_error; 
?></td>
<td class="formfield">Account Number:</td>
<td class='ztable'>
<input name="account_number" size="30" value = "<?php echo $account_number;?>"  <?php echo $state4;?>
title="Type here Account Number"/>
  <?php ?></td>
</tr>
</table>

			</div>
	</div>
</div>



<!-- // personal info END -->

<!-- Guardian info -->



<!-- Intro message -->
<div class="widget" data-toggle="collapse-widget" data-collapse-closed="true">
	<div class="widget-head">
		<h4 class="heading glyphicons cardio">Information about Parents/Guardian (If Applicable)</h4>
	</div>
	<div class="widget-body collapse in">
		<div id="chart_lines_fill_nopoints1" style="height: 100px; padding: 0px; position: relative;">
			
			<table align="center" cellspacing='2' >
			<tr>
			<td> 
			<?php echo $label_edit;?>&nbsp;
			</td>
			<td class='zatable'>
			<input name="actionupdate" type="<?php echo $state1;?>" value="Save Changes"  onmouseover="this.style.background='#DEFEDE'"
			onmouseout="this.style.background='#CFCFCF'" title="Click to Save Changes">
			<input name="save" type="<?php echo $state2;?>" value="Save Record"
			 onmouseover="this.style.background='#DEFEDE'"
			onmouseout="this.style.background='#CFCFCF'" title="Click to Save Record" >
			</td>
			</tr>
			</table>

<table>
<tr>
<td colspan="4" nowrap="nowrap" class="hseparator">

Information About your Parents/Guardian(If Applicable)

</td>
</tr>

<tr><td nowrap="nowrap" class='formfield'>Name:</td> 
<td class='ztable'>
<input name="kin" size="30" value = "<?php echo $kin;?>" <?php echo $state4;?> 
title="Type here Name"/>
<?php ?>
</td>
<td class="formfield">Relationship:</td>
<td class='ztable'>
<input name="kin_relationship" size="30" value = "<?php echo $kin_relationship;?>" <?php echo $state4;?>
title="Type here Relationship" />
<?php ?>
</td>
</tr>
<tr>
<td nowrap="nowrap" class='formfield'>Occupation:</td> 
<td class='ztable'>
<input name="kin_job" size="30" value = "<?php echo $kin_job;?>" <?php echo $state4;?>
title="Type here Occupation"/>
<?php ?></td>
<td class="formfield">Contact Address:</td>
<td class='ztable'>
<input name="kin_address" size="30" value = "<?php echo $kin_address;?>" <?php echo $state4;?>
title="Type here Contact Address" />
<?php ?>
</td>
</tr>
<tr><td nowrap="nowrap" class='formfield'>Email:</td> 
<td class='ztable'>
<input name="kin_email" size="30" value = "<?php echo $kin_email;?>" <?php echo $state4;?>
title="Type here Email" />
<?php ?>
</td>
<td class="formfield">Phone:</td>
<td class='ztable'>
<input name="kin_phone" size="30" value = "<?php echo $kin_phone;?>" <?php echo $state4;?>
title="Type here Phone Number" />
<?php ?>
</td>

</tr>
</table>

		
			</div>
	</div>
</div>





<!-- // Guardian info END -->

<!-- Entry Qualification Information -->


<!-- Intro message -->
<div class="widget" data-toggle="collapse-widget" data-collapse-closed="true">
	<div class="widget-head">
		<h4 class="heading glyphicons cardio">Entry Qualification Information</h4>
	</div>
	<div class="widget-body collapse" style="height: 0px;">
		<div id="chart_lines_fill_nopoints2" style="height: 100px; padding: 0px; position: relative;">
			
			<table align="center" cellspacing='2' >
			<tr>
			<td> 
			<?php echo $label_edit;?>&nbsp;
			</td>
			<td class='zatable'>
			<input name="actionupdate" type="<?php echo $state1;?>" value="Save Changes"  onmouseover="this.style.background='#DEFEDE'"
			onmouseout="this.style.background='#CFCFCF'" title="Click to Save Changes">
			<input name="save" type="<?php echo $state2;?>" value="Save Record"
			 onmouseover="this.style.background='#DEFEDE'"
			onmouseout="this.style.background='#CFCFCF'" title="Click to Save Record" >
			</td>
			</tr>
			</table>
<table>
<tr>
<td colspan="4" nowrap="nowrap" class="hseparator">
Entry Qualifications Information</td>
</tr>

<tr>
<!-- <td class="formfield">Form IV School Name:</td> 
<td class='ztable'>
<input name="form4name" type="text" id="form4name" size="30" value ="<?php echo $form4name;?>" <?php echo $state4;?> 
title="Type here Form Four School Name" />
<?php  ?>
</td>
<!--<td nowrap="nowrap" class="formfield">Form IV Examination No:<span class="style2">*</span></span></div></td> 
<td nowrap="nowrap" class='ztable' >
<input name="form4no" type="text" id="formfour3"  value ="<?php echo $form4no;?>" <?php echo $state4;?>
title="Type here Form Four Examination Number"/>
<?php
echo"<select name='f4year' $state4>";
if($f4year)
{
echo"<option value='$f4year'>$f4year</option>";
}
echo"<option value='None'>None</option>";
for($k=date('Y');$k>=1960;$k--)
{
echo"<option value='$k'>$k</option>";
}
echo"</select>";
?>
</td>
</tr> -->
<tr><td nowrap="nowrap" class='formfield'>Secondary School Name:<span class="style2"></span></td> 
<td class='ztable'>
<input name="form7name" type="text" id="diploma" size="30" value ="<?php echo $form7name;?>"  <?php echo $state4;?> 
title="Type here Secondary School Name"/>
<?php  ?>
</td>
<td nowrap="nowrap"  class="formfield">Examination No:</td>
<td nowrap="nowrap" class='ztable' >
<input name="form7no" type="text" id="diploma"  value ="<?php echo $form7no;?>" <?php echo $state4;?> title="Type here Examination Number"
/>
<?php
echo"Year Completed: <select name='f7year' $state4>";
if($f7year)
{

echo"<option value='$f7year'>$f7year</option>";
}
echo"<option value='None'>None</option>";
for($k=date('Y');$k>=1960;$k--)
{
echo"<option value='$k'>$k</option>";
}
echo"</select>";
?>
<?php echo $diploma_error;   ?></td>
</tr>
<!--
<tr>
  <td nowrap="nowrap" class='formfield'>Equivalent Institute Name:<span class="style2"></span>
<td class='ztable'>
<input name="form7name" type="text" id="formfour" size="30" value ="<?php echo $form7name;?>" <?php echo $state4;?> title="Type here Equivalent Instistution Name"/>
<?php ?>
</td> 
<td nowrap="nowrap" class="formfield"> Secondary School Name: </td>
<td nowrap="nowrap" class='ztable' >
<input name="form7name" type="text" id="diploma" value ="<?php echo $form7name;?>" <?php echo $state4;?> title="Type here Secondary School Information"/>
Examination No:<input name="form7no" type="text" id="diploma" value ="<?php echo $form7no;?>" <?php echo $state4;?> title="Type here Secondary School Information"/> -->
 <?php /*
echo"Year Completed: <select name='f7year' $state4>";
if($f7year)
{

echo"<option value='$f7year'>$f7year</option>";
}
echo"<option value='None'>None</option>";
for($k=date('Y');$k>=1960;$k--)
{
echo"<option value='$k'>$k</option>";
}
echo"</select>";
?>
<?php echo $diploma_error;   */?> 
</td>
</tr> 

<tr>
<td colspan="4" >
<div align="center">
 
<input name="actionupdate" type="<?php echo $state1;?>" value="Save Changes"   
onmouseover="this.style.background='#DEFEDE'" onmouseout="this.style.background='#CFCFCF'" title="Click to Save Changes">
<input name="save" type="<?php echo $state2;?>" value="Save Record" onmouseover="this.style.background='#DEFEDE'" onmouseout="this.style.background='#CFCFCF'" title="Click to Save Record" > 
</div>
</td>
</td>
</tr>
</table>
</fieldset>
		
			</div>
	</div>
</div>



<!-- // Entry Qualification Info END -->
    


<?php 
}


function admino_o()
{	
?>

<!-- Stats Widgets -->
<div class="row-fluid widget-stats-group">

	<div class="span1 center hidden-phone">
		<a class="btn disabled btn-small btn-default glyphicons standard chevron-left"><i></i></a>
	</div>
	
	<div class="span2">
	
		<!-- Stats Widget -->
		<a data-toggle="collapse" href="#menu_PolicySetup" class="widget-stats">
			<span class="glyphicons cogwheels"><i></i></span>
			<span class="txt">Policy Setup</span>
			<div class="clearfix"></div>
			<span class="count label label-important">6</span>
		</a>
		<!-- // Stats Widget END -->
		
	</div>
	<div class="span2">
	
		<!-- Stats Widget -->
		<a data-toggle="collapse" href="#menu_administration" class="widget-stats">
			<span class="glyphicons user_add"><i></i></span>
			<span class="txt">Administration</span>
			<div class="clearfix"></div>
			<span class="count label">7</span>
		</a>
		<!-- // Stats Widget END -->
		
	</div>
	<div class="span2">
	
		<!-- Stats Widget -->
		<a data-toggle="collapse" href="#menu_admission" class="widget-stats">
			<span class="glyphicons paperclip"><i></i></span>
			<span class="txt">Admission Process</span>
			<div class="clearfix"></div>
			<span class="count label label-warning">7</span>
		</a>
		<!-- // Stats Widget END -->
		
	</div>
	<div class="span2">
	
		<!-- Stats Widget -->
		<a data-toggle="collapse" href="#menu_examination" class="widget-stats">
			<span class="glyphicons pencil"><i></i></span>
			<span class="txt">Examination</span>
			<div class="clearfix"></div>
			<span class="count label label-primary">12</span>
		</a>
		<!-- // Stats Widget END -->
		
	</div>
	<div class="span2">
	
		<!-- Stats Widget -->
		<a data-toggle="collapse" href="#menu_elearning" class="widget-stats">
			<span class="glyphicons book"><i></i></span>
			<span class="txt">E-Learning</span>
			<div class="clearfix"></div>
			<span class="count label label-success">2</span>
		</a>
		<!-- // Stats Widget END -->
		
	</div>
	
	
	<div class="span1 center hidden-phone">
		<a class="btn btn-small btn-default glyphicons standard chevron-right"><i></i></a>
	</div>
	
</div>
<div class="separator bottom"></div>
<!-- // Stats Widgets END -->


<?php	
}

function studentindex($username)
{
	
	$sql = "SELECT FullName, Email, Position, UserName, LastLogin FROM security WHERE UserName = '$username'";
	$query = mysql_query($sql) or die("Cannot query the database.<br>" . mysql_error());
	echo "<table border='1'>";
	
	echo "<tr><td> Name </td><td> Login ID </td><td> Status </td><td> E-Post </td><td> Last Login </td></tr>";
	while($result = mysql_fetch_array($query)) {
			$Name = stripslashes($result["FullName"]);
			$username = stripslashes($result["UserName"]);
			$position = stripslashes($result["Position"]);
			$email = stripslashes($result["Email"]);
			$registered = stripslashes($result["LastLogin"]);
				echo "<tr><td>$Name</td>";
				echo "<td>$username</td>";
				echo "<td>$position</td>";
				echo "<td>$email</td>";
				echo "<td>$registered</td></tr>";
			}
	echo "</table>";
	#Store Login History	
	$browser  =  $_SERVER["HTTP_USER_AGENT"];   
	$ip  =  $_SERVER["REMOTE_ADDR"];
	$jina = $username." - Visited the Student Page";   
	//$username = $username." "."Visited ".$szTitle;
	$sql="INSERT INTO stats(ip,browser,received,page) VALUES('$ip','$browser',now(),'$jina')";   
	$result = mysql_query($sql) or die("error data.<br>" . mysql_error());
	
	
	
}



?>


	

	
	
	
	
	
	