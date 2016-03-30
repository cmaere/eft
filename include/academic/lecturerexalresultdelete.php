		<div id="content" "="">
	<h2>Lecturer Grades Input <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Lecturer Grades Input Form</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
			
<?php
$regno=$_GET['RegNo'];
$ayear=$_GET['ayear'];
$key=$_GET['key'];
$examcat=$_GET['examcat'];


if ((isset($_GET['RegNo'])) && ($_GET['RegNo'] != "")) {
  #delete in examregister 
  $deleteSQL = "DELETE FROM examregister WHERE  (RegNo='$regno') AND (CourseCode = '$key') AND (AYear = '$ayear')";                   
  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($deleteSQL, $cha) or die(mysql_error());
  
  #delete in examresult
  $deleteSQL2 = "DELETE FROM examresult WHERE  (RegNo='$regno') AND (CourseCode = '$key') AND (AYear = '$ayear')";                    
  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($deleteSQL2, $cha) or die(mysql_error());


  $deleteGoTo = "lecturerCourseAllocation.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $deleteGoTo));
  echo $regno.' --> Deleted Successfuls';
}
?>

</div>
			</div>
	</div>
</div>
</div>
