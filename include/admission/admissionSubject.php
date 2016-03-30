<?php
$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>
		<div id="content" "="">
	<h2>Programme Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Programme Form</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
			<div class="span6" style="width: 50px;">
	
	<!-- subject form -->

<?php

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInst")) {

 
$code = $_POST['txtCode'];
if(strlen($code)>13){
echo "Too Long Course Code, Please revise!";
exit;
}elseif(strlen($code)<6) {
echo "Too Short Course Code, Please revise!";
exit;
}
#check if username exist
$sql ="SELECT course.CourseCode 			
	  FROM course WHERE (course.CourseCode  = '$code')";
$result = mysql_query($sql) or die("mysql failed<br>");
$coursecodeFound = mysql_num_rows($result);


if ($coursecodeFound) {
          $coursefound   = mysql_result($result,0,'CourseCode');
			print " This Course Code: '".$coursefound."' Do Exists!!"; 
            
           
            
			exit;
            
            
            
}else{
	   				   $insertSQL = sprintf("INSERT INTO course (CourseCode, CourseName, Units, Department, Faculty) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['txtCode'], "text"),
                       GetSQLValueString($_POST['txtTitle'], "text"),
                       GetSQLValueString($_POST['txtUnit'], "text"),
                       GetSQLValueString($_POST['cmbFac'], "text"),
                       GetSQLValueString($_POST['cmbInst'], "text"));

  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
  }
  
                       echo '<meta http-equiv = "refresh" content ="0; 
url = /?page=Subject&section=Policy&pageNum_inst=0">';
exit;
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmInstEdit")) {
///charlie chingwalu and msosa edits

 $cha_id = GetSQLValueString($_POST['id'], "int");
 $cha_newcode = GetSQLValueString($_POST['txtCode'], "text");
            $coursename =GetSQLValueString($_POST['txtTitle'], "text");
            $unit=GetSQLValueString($_POST['txtUnit'], "text");
            $dept=GetSQLValueString($_POST['cmbFac'], "text");
            $fac=GetSQLValueString($_POST['cmbInst'], "text");

 
 $sql1="select CourseCode from course where Id = '$cha_id'";

    $result=mysql_query($sql1);
    $rowa = mysql_num_rows($result);
 while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
            {
                                                      
             $cha_oldcode  = $line["CourseCode"];
                
                }
                
 ///charlie chingwalu and msosa edits
 
$chasql = "update examresult set CourseCode = $cha_newcode WHERE CourseCode = '$cha_oldcode'";
//die("cha anadutsa = ". $chasql);
//die("cha anadutsa = ".$updateSQL);
  $Result2 = mysql_query($chasql);
  $chasqlb = "update examregister set CourseCode = $cha_newcode WHERE CourseCode = '$cha_oldcode'";
//die("cha anadutsa = ". $chasql);
//die("cha anadutsa = ".$updateSQL);
  $Result2b = mysql_query($chasqlb);
  //die("cha anadutsa = ". $chasql);
 //;

 					   $updateSQL = "UPDATE course SET CourseName=$coursename, Units=$unit, Department=$dept, Faculty=$fac, CourseCode=$cha_newcode WHERE Id=$cha_id";
                       
                      $Result1 = mysql_query($updateSQL); 
  

 
  
                       echo '<meta http-equiv = "refresh" content ="0; 
url = /?page=Subject&section=Policy&pageNum_inst=0">';
exit;
  
  
 }
 

//control the display table
@$new=2;

mysql_select_db($database_cha, $cha);
$query_campus = "SELECT FacultyName FROM faculty ORDER BY FacultyName ASC";
$campus = mysql_query($query_campus, $cha) or die(mysql_error());
$row_campus = mysql_fetch_assoc($campus);
$totalRows_campus = mysql_num_rows($campus);

mysql_select_db($database_cha, $cha);
$query_faculty = "SELECT DeptName FROM department ORDER BY DeptName ASC";
$faculty = mysql_query($query_faculty, $cha) or die(mysql_error());
$row_faculty = mysql_fetch_assoc($faculty);
$totalRows_faculty = mysql_num_rows($faculty);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$maxRows_inst = 10;
$pageNum_inst = 0;
if (isset($_GET['pageNum_inst'])) {
  $pageNum_inst = $_GET['pageNum_inst'];
}
$startRow_inst = $pageNum_inst * $maxRows_inst;

mysql_select_db($database_cha, $cha);
if (isset($_GET['course'])) {
  $key=$_GET['course'];
  $query_inst = "SELECT * FROM course WHERE CourseCode Like '%$key%' ORDER BY CourseCode ASC";
}else{
$query_inst = "SELECT * FROM course ORDER BY CourseCode ASC";
}
//$query_inst = "SELECT * FROM course ORDER BY CourseCode ASC";
$query_limit_inst = sprintf("%s LIMIT %d, %d", $query_inst, $startRow_inst, $maxRows_inst);
$inst = mysql_query($query_limit_inst, $cha) or die(mysql_error());
$row_inst = mysql_fetch_assoc($inst);

if (isset($_GET['totalRows_inst'])) {
  $totalRows_inst = $_GET['totalRows_inst'];
} else {
  $all_inst = mysql_query($query_inst);
  $totalRows_inst = mysql_num_rows($all_inst);
}
$totalPages_inst = ceil($totalRows_inst/$maxRows_inst)-1;
?>


<div class="tabsbar" style="width: 196px;">
	<ul>
<li class="glyphicons circle_plus active" >
	<?php echo "<a href='/?page=Subject&section=Policy&new=1'>";?>
		<i></i>
	 Add New Institution</a> 
 </li>
 
</ul>
</div>
<div style="width: 100px;">
	
	
<?php
@$new= htmlspecialchars($_GET['new']);
if (@$new<>1){
?>
<form name="form1" method="get" action="<?php echo $editFormAction; ?>">
<div class="widget-body collapse in" style="width: 500px;">
	<input type="hidden" name="page" value="Subject">   
	<input type="hidden" name="section" value="Policy">   
	<input name="course"  type="text" placeholder="Search by Course Code ..">
	<input type="submit" name="Submit" value="Search">   
</div>	  
 
       </form>
	   
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>Department</strong></td>
    <td><strong>Course</strong></td>
	<td><strong>Description</strong></td>
	<td><strong>Units</strong></td>
  </tr>
  <?php do { ?>
  <tr>
    <td nowrap><?php $id = $row_inst['Id']; echo $row_inst['Department']; ?>
	</td>
    <td nowrap><?php $name = $row_inst['CourseCode']; echo "<a href=\"/?page=Subject&section=Policy&edit=$id\">$name</a>"?></td>
	 <td><?php echo $row_inst['CourseName'] ?></td>
	 <td><?php echo $row_inst['Units']; ?></td>
  </tr>
  <?php } while ($row_inst = mysql_fetch_assoc($inst)); ?>
</table>

<!-- navigation -->

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
			
<?php }else{?>
<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInst" id="frmInst">
  <table width="200" border="1" cellpadding="0" cellspacing="0" bordercolor="#006600">
    <tr >
      <th scope="row"><div align="right">Faculty:</div></th>
<td><select name="cmbInst" id="cmbInst" title="<?php echo $row_campus['FacultyName']; ?>">
  <?php
do {  
?>
  <option value="<?php echo $row_campus['FacultyName']?>"><?php echo $row_campus['FacultyName']?></option>
  <?php
} while ($row_campus = mysql_fetch_assoc($campus));
  $rows = mysql_num_rows($campus);
  if($rows > 0) {
      mysql_data_seek($campus, 0);
	  $row_campus = mysql_fetch_assoc($campus);
  }
?>
      </select></td>
    </tr>
    <tr >
      <th scope="row"><div align="right">Department:</div></th>
      <td><select name="cmbFac" id="cmbFac" title="<?php echo $row_faculty['DeptName']; ?>">
        <?php
do {  
?>
        <option value="<?php echo $row_faculty['DeptName']?>"><?php echo $row_faculty['DeptName']?></option>
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
    <tr >
      <th nowrap scope="row"><div align="right">Course Code:</div></th>
      <td><div class="controls"> <input name="txtCode" type="text" id="txtCode" class="span122"></div></td>
    </tr>
    <tr >
      <th nowrap scope="row"><div align="right">Course Title:</div></th>
      <td><div class="controls"> <input name="txtTitle" type="text" id="txtTitle" class="span122"></div></td>
    </tr>
    <tr >
      <th nowrap scope="row"><div align="right">Units:</div></th>
      <td><div class="controls"> <input name="txtUnit" type="text" id="txtUnit" class="span122"></div></td>
    </tr>
    <tr >
      <th scope="row">&nbsp;</th>
      <td><div align="center">
        <input type="submit" name="Submit" value="Add Record">
      </div></td>
    </tr>
  </table>
    <input type="hidden" name="MM_insert" value="frmInst">
</form>
<?php } 
if (isset($_GET['edit'])){
#get post variables
$key = $_GET['edit'];

mysql_select_db($database_cha, $cha);
$query_instEdit = "SELECT * FROM course WHERE Id ='$key'";
$instEdit = mysql_query($query_instEdit, $cha) or die(mysql_error());
$row_instEdit = mysql_fetch_assoc($instEdit);
$totalRows_instEdit = mysql_num_rows($instEdit);

$queryString_inst = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_inst") == false && 
        stristr($param, "totalRows_inst") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_inst = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_inst = sprintf("&totalRows_inst=%d%s", $totalRows_inst, $queryString_inst);

?>
<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInstEdit" id="frmInstEdit">
 <table width="200" border="1" cellpadding="0" cellspacing="0" bordercolor="#006600">
    <tr >
      <th scope="row"><div align="right">Faculty:</div></th>
<td><select name="cmbInst" id="cmbInst" title="<?php echo $row_campus['FacultyName']; ?>">
<option value="<?php echo $row_instEdit['Faculty']?>"><?php echo $row_instEdit['Faculty']?></option>
  <?php
do {  
?>
<option value="<?php echo $row_campus['FacultyName']?>"><?php echo $row_campus['FacultyName']?></option>
  <?php
} while ($row_campus = mysql_fetch_assoc($campus));
  $rows = mysql_num_rows($campus);
  if($rows > 0) {
      mysql_data_seek($campus, 0);
	  $row_campus = mysql_fetch_assoc($campus);
  }
?>
      </select></td>
    </tr>
    <tr >
      <th scope="row"><div align="right">Department:</div></th>
      <td><select name="cmbFac" id="cmbFac" title="<?php echo $row_faculty['DeptName']; ?>">
	  <option value="<?php echo $row_instEdit['Department']?>"><?php echo $row_instEdit['Department']?></option>
        <?php
do {  
?>
        <option value="<?php echo $row_faculty['DeptName']?>"><?php echo $row_faculty['DeptName']?></option>
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
    <tr >
      <th nowrap scope="row"><div align="right">Course Code:</div></th>
      <td><div class="controls"> <input name="txtCode" type="text" id="txtCode" value="<?php echo $row_instEdit['CourseCode']; ?>" class="span122"></div></td>
    </tr>
    <tr >
      <th nowrap scope="row"><div align="right">Course Title:</div></th>
      <td><div class="controls"> <input name="txtTitle" type="text" id="txtTitle" value="<?php echo $row_instEdit['CourseName']; ?>" class="span122"></div></td>
    </tr>
    <tr >
      <th nowrap scope="row"><div align="right">Units:</div></th>
      <td><div class="controls"> <input name="txtUnit" type="text" id="txtUnit" value="<?php echo $row_instEdit['Units']; ?>" class="span122"></div></td>
    </tr>
    <tr >
      <th scope="row"><input name="id" type="hidden" id="id" value="<?php echo $key ?>"></th>
      <td><div align="center">
        <input type="submit" name="Submit" value="Edit Record">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="frmInstEdit">
</form>
<?php
}
	

@mysql_free_result($inst);

@mysql_free_result($instEdit);

@mysql_free_result($faculty);

@mysql_free_result($campus);
?>

	<!-- //subject form -->
	
	
	
	
</div>
	
	
	

</div>
			</div>
	</div>
</div>
</div>