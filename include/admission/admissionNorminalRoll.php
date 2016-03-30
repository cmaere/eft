
		<div id="content" "="">
	<h2>Norminal Roll Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Norminal Roll Generate Form</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 300px; padding: 0px; position: relative;">
				
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_select_db($database_cha, $cha);
$query_AcademicYear = "SELECT AYear FROM academicyear ORDER BY AYear DESC";
$AcademicYear = mysql_query($query_AcademicYear, $cha) or die(mysql_error());
$row_AcademicYear = mysql_fetch_assoc($AcademicYear);
$totalRows_AcademicYear = mysql_num_rows($AcademicYear);

mysql_select_db($database_cha, $cha);
$query_Hostel = "SELECT ProgrammeCode, ProgrammeName FROM programme ORDER BY ProgrammeName ASC";
$Hostel = mysql_query($query_Hostel, $cha) or die(mysql_error());
$row_Hostel = mysql_fetch_assoc($Hostel);
$totalRows_Hostel = mysql_num_rows($Hostel);

mysql_select_db($database_cha, $cha);
$query_faculty = "SELECT FacultyID, FacultyName FROM faculty ORDER BY FacultyName ASC";
$faculty = mysql_query($query_faculty, $cha) or die(mysql_error());
$row_faculty = mysql_fetch_assoc($faculty);
$totalRows_faculty = mysql_num_rows($faculty);

//Print Room Allocation Report
if (isset($_POST['print']) && ($_POST['print'] == "PreView")) {
#get post variables
$year = addslashes($_POST['cohot']);
$degree = addslashes($_POST['degree']);
$list = addslashes($_POST['list']);
$faculty = addslashes($_POST['faculty']);
$display = addslashes($_POST['display']);
$ryear = addslashes($_POST['ayear']);

	if ($list ==1){
		$sql = "SELECT student.Id,
				   student.Name,
				   student.RegNo,
				   student.Sex,
				   student.Faculty,
				   student.EntryYear,
				   student.Sponsor,
				   student.Status,
				   student.ProgrammeofStudy
       
				FROM student
				WHERE 
  					 (
      					(student.EntryYear='$year') AND
						(student.ProgrammeofStudy <> '10103')
   					 )
								ORDER BY  student.Faculty, 
								student.ProgrammeofStudy, 
								student.Name";
	}elseif ($list ==2){
		$sql = "SELECT student.Id,
				   student.Name,
				   student.RegNo,
				   student.Sex,
				   student.Faculty,
				   student.EntryYear,
				   student.Sponsor,
				   student.Status,
				   student.ProgrammeofStudy
				FROM student
				WHERE 
  					 (
						(student.EntryYear='$year') AND 
						(student.ProgrammeofStudy = '$degree') AND
						(student.ProgrammeofStudy <> '10103')
   					 )
						ORDER BY  student.Faculty, 
						student.ProgrammeofStudy, student.Name";
		}else{
				$sql = "SELECT student.Id,
				   student.Name,
				   student.RegNo,
				   student.Sex,
				   student.Faculty,
				   student.EntryYear,
				   student.Sponsor,
				   student.ProgrammeofStudy,
				   student.Status
				FROM faculty, student
				WHERE 
  					 (
      					(student.faculty = faculty.FacultyName) AND
						(student.EntryYear='$year') AND 
						(student.faculty = '$faculty')AND
						(student.ProgrammeofStudy <> '10103')
   					 )
						ORDER BY  student.Faculty, 
						student.ProgrammeofStudy, student.Name";
		}
	$result = @mysql_query($sql) or die("Cannot query the database.<br>" . mysql_error());
	$query = @mysql_query($sql) or die("Cannot query the database.<br>" . mysql_error());

	$all_query = mysql_query($sql);
	$totalRows_query = mysql_num_rows($query);
	/* Printing Results in html */
	if (mysql_num_rows($query) > 0){
		#Get Organisation Name
		$qorg = "SELECT Name FROM organisation";
		$dborg = mysql_query($qorg);
		$row_org = mysql_fetch_assoc($dborg);
		$org = $row_org['Name'];
		
		#get degree programme
		$qprogram = "SELECT ProgrammeName FROM programme WHERE ProgrammeCODE ='$degree'";
		$dbprogram = mysql_query($qprogram);
		$row_program = mysql_fetch_assoc($dbprogram);
		$degree = $row_program['ProgrammeName'];
		?>


		
		<table width="100%"  border="0">
          <tr>
            <td></td>
          </tr>
          <tr>
            <td><div align="center" class="style4">
              <h1><?php echo $org?></h1>
            </div></td>
          </tr>
		  <?php if ($faculty<> '0'){?>
          <tr>
            <td bgcolor="#FFFFFF"><div align="center">
              <h3><?php echo $faculty?></h3>
            </div></td>
          </tr>
		  <?php } ?>
          <tr>
            <td><div align="center">
              <h4>Cohot <?php echo $year?> Nominal Roll</h4>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div align="center">
              <h4>A <?php echo $ryear?> Status Report</h4>
            </div></td>
          </tr>
		  <?php if ($degree<> '0'){?>
          <tr>
            <td><div align="center">
              <h4><span class="style4"> <?php echo $degree?></span></h4>
            </div></td>
          </tr>
		   <?php } ?>
        </table>
		<table border='1' cellpadding='0' cellspacing='0'>
		<tr ><td> S/No </td><td> Name </td>
		<td> RegNo </td><td> Sex </td><td> Degree </td><td> Faculty </td><td> Sponsor </td><td> Status </td></tr>
		<?php
		$i=1;
		#count unregistered
		$j=0;
		#count sex
		$$fmcount = 0;
		$$mcount = 0;
		$$fcount = 0;
		while($result = mysql_fetch_array($query)) {
				$id = stripslashes($result["Id"]);
				$Name = stripslashes($result["Name"]);
				$RegNo = stripslashes($result["RegNo"]);
				$sex = stripslashes($result["Sex"]);
				$degreecode = stripslashes($result["ProgrammeofStudy"]);
				$faculty = stripslashes($result["Faculty"]);
				$sponsor = stripslashes($result["Sponsor"]);
				
				#get study programe name
				$qprogram = "SELECT ProgrammeName FROM programme WHERE ProgrammeCODE ='$degreecode'";
				$dbprogram = mysql_query($qprogram);
				$row_program = mysql_fetch_assoc($dbprogram);
				$degree = $row_program['ProgrammeName'];
				#check if the candidate has registered to a course in this current year
				$qstatus = "SELECT DISTINCT RegNo FROM examresult WHERE RegNo='$RegNo' AND AYear='$ryear'";
				$dbstatus = mysql_query($qstatus);
				$statusvalue = mysql_num_rows($dbstatus);
				if($statusvalue>0){
				$status  = stripslashes($result["Status"]);
				}else{
				#check in examregister
					$qstatus = "SELECT DISTINCT RegNo FROM examregister WHERE RegNo='$RegNo' AND AYear='$ryear'";
					$dbstatus = mysql_query($qstatus);
					$statusvalue = mysql_num_rows($dbstatus);
					if($statusvalue>0){
						$status  = stripslashes($result["Status"]);
						}else{
						$status = 'Not Registered';
						$j=$j+1;
						}
				}
				#get line color
				$remainder = $i%2;
				if ($remainder==0){
					$linecolor = 'bgcolor="#FFFFCC"';
				}else{
				 $linecolor = 'bgcolor="#FFFFFF"';
				}

				if($display==1){
					echo "<tr><td $linecolor><a href=\"admissionRegistrationForm.php?id=$id&RegNo=$RegNo\">$i</a></td>";
					?>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $Name?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $RegNo?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $sex?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $degree?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $faculty?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $sponsor?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $status?></td>
					<?php
					echo "</tr>";
				    $i=$i+1;
					if ($sex=='F'){
						$fcount = $fcount +1;
					}elseif($sex=='M'){
						$mcount = $mcount +1;
					}else{
						$fmcount = $fmcount +1;
					}
				}elseif($display==2){
					if($status <>'Not Registered'){
					echo "<tr><td $linecolor><a href=\"admissionRegistrationForm.php?id=$id&RegNo=$RegNo\">$i</a></td>";
					?>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $Name?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $RegNo?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $sex?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $degree?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $faculty?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $sponsor?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $status?></td>
					<?php
					echo "</tr>";
					$i=$i+1;
						if ($sex=='F'){
							$fcount = $fcount +1;
						}elseif($sex=='M'){
							$mcount = $mcount +1;
						}else{
							$fmcount = $fmcount +1;
						}
					}				
				}else{
					if($status === 'Not Registered'){
					echo "<tr><td $linecolor><a href=\"admissionRegistrationForm.php?id=$id&RegNo=$RegNo\">$i</a></td>";
					?>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $Name?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $RegNo?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $sex?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $degree?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $faculty?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $sponsor?></td>
					<td <?php echo $linecolor?> nowrap><?php echo ($status === 'Not Registered')?'<span class="style1">':'';?><?php echo $status?></td>
					<?php
					echo "</tr>";
						$i=$i+1;
							if ($sex=='F'){
								$fcount = $fcount +1;
							}elseif($sex=='M'){
								$mcount = $mcount +1;
							}else{
								$fmcount = $fmcount +1;
							}
					}
				}
				#end while loop
				}
			echo "</table>";
			#print statistics
			$gt=$i-1;
			echo 'Grand Total: '.$gt;
			echo '<hr>';
			if ($display==1){
				echo 'Total Unregistered Students  are: '.$j.'('.round($j/$gt*100,2).'%)';
			}
				echo '<hr> Total Female Students are: '.$fcount.'('.round($fcount/$gt*100,2).'%)';
				echo '<hr> Total Male Students are: '.$mcount.'('.round($mcount/$gt*100,2).'%)';
			if($fmcount<>0){
				echo '<hr> Total Male/Female Unspecified Students are '.$fmcount.'('.round($fmcount/$gt*100,2).'%)';
			}
			}else{
					echo "Sorry, No Records Found <br>";
				}
				
				
				
}else{

?>

				

<form action="<?php echo $editFormAction; ?>" method="POST" name="studentRoomApplication" id="studentRoomApplication">
            <table  border="1" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="5" nowrap><div align="center">PRINTING NOMINAL ROLL </div></td>
          </tr>
		  <tr>
			  <td rowspan="2" nowrap><div align="right">GROUP LIST:</div></td>
			  <td  nowrap><div align="center">All Students</div></td>
			  <td nowrap ><div align="center">Programme</div></td>
			  <td nowrap ><div align="center">Faculty</div></td>
	          <td nowrap >&nbsp;</td>
		  </tr>
		  <tr>
		    <td  nowrap><div align="center"><input name="list" type="radio" value="1"></div></td>
		    <td nowrap ><div align="center"><input name="list" type="radio" value="2" checked></div></td>
		    <td nowrap ><div align="center"><input name="list" type="radio" value="3"></div></td>
		    <td nowrap >&nbsp;</td>
		  </tr>
        <tr>
          <td nowrap><div align="right">REPORTING  YEAR: </div></td>
          <td colspan="4" ><select name="ayear" id="select2">
		 <option value="0">--------------------------------</option>
            <?php
do {  
?>
            <option value="<?php echo $row_AcademicYear['AYear']?>"><?php echo $row_AcademicYear['AYear']?></option>
            <?php
} while ($row_AcademicYear = mysql_fetch_assoc($AcademicYear));
  $rows = mysql_num_rows($AcademicYear);
  if($rows > 0) {
      mysql_data_seek($AcademicYear, 0);
	  $row_AcademicYear = mysql_fetch_assoc($AcademicYear);
  }
?>
          </select></td>
        </tr>
		  <tr>
			  <td rowspan="2" nowrap><div align="right">DISPLAY OPTIONS:</div></td>
			  <td  nowrap><div align="center">All Students</div></td>
			  <td nowrap ><div align="center">Registered</div></td>
			  <td nowrap ><div align="center">Not Registered </div></td>
	          <td nowrap >&nbsp;</td>
		  </tr>
		  <tr>
		    <td  nowrap><div align="center">
		      <input name="display" type="radio" value="1" checked>
		    </div></td>
		    <td nowrap ><div align="center"><input name="display" type="radio" value="2"></div></td>
		    <td nowrap ><div align="center"><input name="display" type="radio" value="3"></div></td>
		    <td nowrap >&nbsp;</td>
		  </tr>
        <tr>
          <td nowrap><div align="right">STUDENT COHORT: </div></td>
          <td colspan="4" ><select name="cohot" id="select2">
		  <option value="0">--------------------------------</option>
            <?php
do {  
?>
            <option value="<?php echo $row_AcademicYear['AYear']?>"><?php echo $row_AcademicYear['AYear']?></option>
            <?php
} while ($row_AcademicYear = mysql_fetch_assoc($AcademicYear));
  $rows = mysql_num_rows($AcademicYear);
  if($rows > 0) {
      mysql_data_seek($AcademicYear, 0);
	  $row_AcademicYear = mysql_fetch_assoc($AcademicYear);
  }
?>
          </select></td>
        </tr>
        <tr>
          <td nowrap><div align="right"> FACULTY/COLLEGE:</div></td>
          <td colspan="4" ><select name="faculty" id="select">
		  <option value="0">--------------------------------</option>
            <?php
do {  
?>
            <option value="<?php echo $row_faculty['FacultyName']?>"><?php echo $row_faculty['FacultyName']?></option>
            <?php
} while ($row_faculty = mysql_fetch_assoc($faculty));
  $rows = mysql_num_rows($faculty);
  if($rows > 0) {
      mysql_data_seek($faculty, 0);
	  $row_faculty = mysql_fetch_assoc($faculty);
  }
?>
          </select></td>
        </tr>
        <tr>
          <td nowrap><div align="right">  PROGRAMME:</div></td>
          <td colspan="4" ><select name="degree" id="select">
		   <option value="0">--------------------------------</option>
            <?php
do {  
?>
            <option value="<?php echo $row_Hostel['ProgrammeCode']?>"><?php echo $row_Hostel['ProgrammeName']?></option>
            <?php
} while ($row_Hostel = mysql_fetch_assoc($Hostel));
  $rows = mysql_num_rows($Hostel);
  if($rows > 0) {
      mysql_data_seek($Hostel, 0);
	  $row_Hostel = mysql_fetch_assoc($Hostel);
  }
?>
          </select></td>
        </tr>
        <tr>
          <td nowrap><div align="right"></div></td>
          <td >
		    <div align="right">
		      <input name="print" type="submit" id="print" value="PreView">
		        </div></td>
          <td >&nbsp;</td>
          <td >
            <div align="left">
              <input name="printPDF" type="submit" id="printPDF" value="Print PDF">
            </div></td>
          <td >&nbsp;</td>
        </tr>
      </table>
                    <input type="hidden" name="MM_insert" value="housingRoomApplication">
          </form>

	  
		  
<?php
}
mysql_free_result($AcademicYear);

mysql_free_result($Hostel);

?>

</div>
			</div>
	</div>
</div>
</div>	  
