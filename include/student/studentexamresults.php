		<div id="content" "="">
	<h2>Student Exam Results Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Exam results Sheet</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
			
				
				
<?php
$editFormAction = $_SERVER['PHP_SELF'];



#check if has blocked
$qstatus = "SELECT Status FROM student  WHERE (RegNo = '$RegNo')";
$dbstatus = mysql_query($qstatus);
$row_status = mysql_fetch_array($dbstatus);
$status = $row_status['Status'];
if ($status=='Blocked')
{
	echo "Your Examination Results are Currently Blocked<br>";
	echo "Please Contact the Faculty Office to Resolve this Issue<br>";
	exit;
}

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$sn=0;
#print name and degree
//select student
	$qstudent = "SELECT Name, RegNo, EntryYear, ProgrammeofStudy from student WHERE RegNo = '$RegNo'";
	$dbstudent = mysql_query($qstudent); 
	$row_result = mysql_fetch_array($dbstudent);
	$name = $row_result['Name'];
	$regno = $row_result['RegNo'];
	$degree = $row_result['ProgrammeofStudy'];
	$entryyear = $row_result['EntryYear'];
	$entryyear = substr($entryyear,0,4);
	
	//get degree name
	$qdegree = "Select Title from programme where ProgrammeCode = '$degree'";
	$dbdegree = mysql_query($qdegree);
	$row_degree = mysql_fetch_array($dbdegree);
	$programme = $row_degree['Title'];
	
	echo  '<b>Name and -  RegNo: </b>'.$name.' - '.$regno.'<br><b>Study Programme : </b> '.$programme;	
	
#query academeic year
$qayear = "SELECT DISTINCT AYear from examresult WHERE RegNo = '$RegNo' ORDER BY examresult.AYear ASC";
$dbayear = mysql_query($qayear);

//query exam results sorted per years
while($rowayear = mysql_fetch_object($dbayear)){
	$currentyear = $rowayear->AYear;
	
	#initialise
	$totalunit=0;
	$unittaken=0;
	$sgp=0;
	$totalsgp=0;
	$totalcourse=0;
	$jtmarks=0;
	$gpa=0;
	
	# get all courses for this candidate
	$qcourse="SELECT DISTINCT course.CourseName, 
							  course.Units, 
							  course.Department, 
							  course.StudyLevel,
							  examresult.CourseCode, 
							  examresult.Status 
			  FROM 
					course INNER JOIN examresult ON (course.CourseCode = examresult.CourseCode)
			  WHERE (examresult.RegNo='$RegNo') AND 
					(examresult.AYear = '$currentyear') AND (examresult.Checked='1') 
			  ORDER BY examresult.AYear DESC";	
			  
			  //die($qcourse);
        
	$dbcourse = mysql_query($qcourse) or die("No Exam Results for the Candidate - $RegNo ");
	$total_rows = mysql_num_rows($dbcourse);

?>

<table width="100%" height="100%" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td scope="col"><?php echo $rowayear->AYear;?></td>
	<td width="350" nowrap scope="col">Course</td>
    <td width="30" nowrap scope="col">Unit</td>
	
    <td width="30" nowrap scope="col">Grade</td>
	<td width="30" nowrap scope="col">Remarks</td>
	<td width="30" nowrap scope="col">Status</td>
    <td width="30" nowrap scope="col">AVG</td>
  </tr>
  <?php
		while($row_course = mysql_fetch_array($dbcourse)){
				$course= $row_course['CourseCode'];
				$unit= $row_course['Units'];
				$coursename= $row_course['CourseName'];
				$coursefaculty = $row_course['Department'];
				if($row_course['Status']==1){
				$status ='Core';
				}else{
				$status = 'Elective';
				}
				$sn=$sn+1;
				$remarks = 'remarks';
				$RegNo = $RegNo;
				include '../academic/includes/choose_studylevel.php';
							$totalcourse = $totalcourse + 1;
                            $marks= $aescore;
							$jtmarks = $jtmarks + $marks;
				#display results
				?>
	<tr>
     <td scope="col" nowrap scope="col"><div align="left"><?php echo $course;?></div></td>
     <td width="350" nowrap scope="col"><div align="left"><?php echo $coursename;?></div></td>
     <td width="30" nowrap scope="col"><div align="center"><?php echo $row_course['Units']?></div></td>
	
     <td width="30" nowrap scope="col"><div align="center"><?php echo $marks;?></div></td>
	 <td width="30" nowrap scope="col"><div align="center"><?php echo $remark;?></div></td>
	 <td width="30" nowrap scope="col"><div align="center"><?php echo $status;?></div></td>
    <td width="30" nowrap scope="col"></td>
  </tr>
  <?php }?>
  	<tr>
     <td scope="col"></td>
     <td width="350" nowrap scope="col"></td>
     <td width="30" nowrap scope="col"><div align="center"><?php echo $totalcourse;?></div></td>
     <td width="30" nowrap scope="col"></td>
	 <td width="30" nowrap scope="col"></td>
	 <td width="30" nowrap scope="col"></td>
	 <td width="30" nowrap scope="col"></td>
    <td width="30" nowrap scope="col"><div align="center"><?php echo @number_format($jtmarks/$totalcourse, 1);?></div></td>
  </tr>
</table>
<?php  
		}//else{ 
		if(!@$reg[$c]){}else{
		echo "$c". ".Sorry, No Records Found for '$reg[$c]'<br><hr>";
		}
			//}
	//}//ends while rowayear	

mysql_close($cha);
?>

</div>
			</div>
	</div>
</div>
</div>
