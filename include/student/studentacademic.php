
		<div id="content" "="">
	<h2>Exam Registered Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Exam Registered</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
			<div class="span6" style="width: 50px;">

<?php
if ((isset($_GET['CourseCode'])) && ($_GET['CourseCode'] != "")) {
  $coursecode = addslashes($_GET['CourseCode']);
  $regno = addslashes($_GET['RegNo']);
  $deleteSQL = "DELETE FROM examregister WHERE CourseCode='$coursecode' AND checked=0 AND RegNo='$regno'";
                    
  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($deleteSQL, $cha) or die('This Records is Locked by the Examination Officer');

  
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
 // header(sprintf("Location: %s", $deleteGoTo));
  }
?>

<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_coursecandidate = 13;
$pageNum_coursecandidate = 0;
if (isset($_GET['pageNum_coursecandidate'])) {
  $pageNum_coursecandidate = $_GET['pageNum_coursecandidate'];
}
$startRow_coursecandidate = $pageNum_coursecandidate * $maxRows_coursecandidate;

$colname_coursecandidate = "1";
if (isset($_COOKIE['RegNo'])) {
  $colname_coursecandidate = (get_magic_quotes_gpc()) ? $_COOKIE['RegNo'] : addslashes($_COOKIE['RegNo']);
}
mysql_select_db($database_cha, $cha);
$query_coursecandidate = "SELECT 
								examregister.CourseCode, 
								course.Units, 
								course.CourseName, 
								examregister.RegNo,
								examregister.AYear
						FROM course INNER JOIN examregister ON course.CourseCode = examregister.CourseCode
							WHERE (((examregister.RegNo)='$RegNo')) ORDER BY AYear DESC, CourseCode ASC";
$query_limit_coursecandidate = sprintf("%s LIMIT %d, %d", $query_coursecandidate, $startRow_coursecandidate, $maxRows_coursecandidate);
$coursecandidate = mysql_query($query_limit_coursecandidate, $cha) or die(mysql_error());
$row_coursecandidate = mysql_fetch_assoc($coursecandidate);

if (isset($_GET['totalRows_coursecandidate'])) {
  $totalRows_coursecandidate = $_GET['totalRows_coursecandidate'];
} else {
  $all_coursecandidate = mysql_query($query_coursecandidate);
  $totalRows_coursecandidate = mysql_num_rows($all_coursecandidate);
}
$totalPages_coursecandidate = ceil($totalRows_coursecandidate/$maxRows_coursecandidate)-1;

$queryString_coursecandidate = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_coursecandidate") == false && 
        stristr($param, "totalRows_coursecandidate") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_coursecandidate = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_coursecandidate = sprintf("&totalRows_coursecandidate=%d%s", $totalRows_coursecandidate, $queryString_coursecandidate);

@$CourseCode = $_GET['CourseCode'];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmCourseRegister")) {
  $insertSQL = sprintf("INSERT INTO coursecandidate (RegNo, CourseCode) VALUES (%s, %s)",
                       GetSQLValueString($_POST['regno'], "text"),
                       GetSQLValueString($_POST['coursecode'], "text"));

  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($insertSQL, $cha) or die("You have already registered for this course, <br>duplicate Records are not allowed");

  $insertGoTo = "/?page=DashBoard";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  echo '<meta http-equiv = "refresh" content ="0; 
						url = $insertGoTo">';
  
}
?>

<div class="tabsbar" style="width: 196px;">
	<ul>
<li class="glyphicons circle_plus active" >
	<?php echo "<a href='?page=CourseRoster&section=AcademicRecords'>";?>
		<i></i>
	 Add New Course</a> 
 </li>
 
</ul>
</div>



<table width="200" border="1" cellpadding="0" cellspacing="0">
            <tr>
            <td nowrap></td>
			<td nowrap>Year</td>
			  <td nowrap>Course</td>
			    <td nowrap>Units</td>
			  <td nowrap>Course Title</td>
            </tr>
            <?php do { ?>
            <tr>
                <td nowrap><?php
                // $CourseCode = $row_coursecandidate['CourseCode']; echo "<a href=\"studentAcademic.php?CourseCode=$CourseCode&RegNo=$RegNo\"> Drop </a>"; ?></td> 
				<td nowrap><?php echo $row_coursecandidate['AYear']; ?></td>
				<td nowrap><?php echo $row_coursecandidate['CourseCode']; ?></td>
				<td nowrap><div align="center"><?php echo $row_coursecandidate['Units']; ?></div></td>
				<td nowrap><?php echo $row_coursecandidate['CourseName']; ?></td>
            </tr>
            <?php } while ($row_coursecandidate = mysql_fetch_assoc($coursecandidate)); ?>
</table>
          
<br/>
<div class="pagination margin-none" style="width: 400px;">
<ul>
<?php


if(($pageNum_inst - 1) < 0)
{
  echo "<li class='disabled'><a href='#'>&laquo;</a></li>";
 }
 else
 {		 
?> 
<li><a href="<?php printf("/?page=Programme&section=Policy&pageNum_inst=%d%s", max(0, $pageNum_inst - 1), $queryString_inst); ?>">&laquo;</a></li>
<?php
 }
 //die($pageNum_inst);
 if($pageNum_inst <> 0)
 {
	 for($i=1; $i<=$pageNum_inst; $i++)
	 {
	 	?>
	 <li><a href="<?php printf("/?page=Programme&section=Policy&pageNum_inst=%d%s", min($totalPages_inst, $i - 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
	 <?php
	 //$lastpage = $lastpage + 1;
	 }
	
 }

 
 ?>
<li class="active"><a href="#"><?php echo $pageNum_inst+1; ?></a></li>
<?php

$lastpage = $pageNum_inst;

for($i=$pageNum_inst+2; $i<=$totalPages_inst; $i++)
{
	?>
<li><a href="<?php printf("/?page=Programme&section=Policy&pageNum_inst=%d%s", min($totalPages_inst, $pageNum_inst + 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
<?php
$lastpage = $lastpage + 1;
}

if($lastpage > $totalPages_inst || $pageNum_inst == 0 )
{
	?> 
	<li><a href="<?php printf("/?page=Programme&section=Policy&pageNum_inst=%d%s",min($totalPages_inst, $pageNum_inst + 1), $queryString_inst); ?>">&raquo;</a></li>
	<?php 
 
 }
 else
 {	
	 echo"<li class='disabled'><a href='#'>&raquo;</a></li>";
}
?>
</ul>
</div>

<!-- end navigation -->
				
				
			</div>
						</div>
				</div>
			</div>
			</div>


          
			 