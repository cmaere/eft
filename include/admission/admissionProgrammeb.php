<?php
$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
	
  $editFormAction .= "?". htmlentities($_SERVER['QUERY_STRING']);
  
} ?>
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
	
	<!-- programme form -->
	<?php
//control the display table
@$new=2;

mysql_select_db($database_cha, $cha);
$query_campus = "SELECT CampusID, Campus FROM campus";
$campus = mysql_query($query_campus, $cha) or die(mysql_error());
$row_campus = mysql_fetch_assoc($campus);
$totalRows_campus = mysql_num_rows($campus);

mysql_select_db($database_cha, $cha);
$query_faculty = "SELECT FacultyName FROM faculty";
$faculty = mysql_query($query_faculty, $cha) or die(mysql_error());
$row_faculty = mysql_fetch_assoc($faculty);
$totalRows_faculty = mysql_num_rows($faculty);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInst")) {
  $insertSQL = sprintf("INSERT INTO programme (ProgrammeCode, ProgrammeName, Title, Faculty) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['txtCode'], "text"),
					   GetSQLValueString($_POST['txtSname'], "text"),
                       GetSQLValueString($_POST['txtFname'], "text"),
                       GetSQLValueString($_POST['cmbFac'], "text"));

  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
                       echo '<meta http-equiv = "refresh" content ="0; 
url = /?page=Programme&section=Policy&pageNum_inst=0">';
exit;
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmInstEdit")) {
  $updateSQL = sprintf("UPDATE programme SET ProgrammeCode=%s, ProgrammeName=%s, Title=%s, Faculty=%s, CampusID=%s WHERE ProgrammeID=%s",
                       GetSQLValueString($_POST['txtCode'], "text"),
					   GetSQLValueString($_POST['txtSname'], "text"),
                       GetSQLValueString($_POST['txtFname'], "text"),
                       GetSQLValueString($_POST['cmbFac'], "text"),
                       GetSQLValueString($_POST['cmbInst'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($updateSQL, $cha) or die(mysql_error());
                       echo '<meta http-equiv = "refresh" content ="0; 
url = /?page=Programme&section=Policy&pageNum_inst=0">';
exit;
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
  $query_inst = "SELECT * FROM programme WHERE ProgrammeName Like '%$key%' OR ProgrammeCode like '%$key%' ORDER BY ProgrammeName ASC";
}else{
$query_inst = "SELECT * FROM programme ORDER BY ProgrammeName ASC";
}
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


<div class="tabsbar" style="width: 196px;">
	<ul>
<li class="glyphicons circle_plus active" >
	<?php echo "<a href='/?page=Programme&section=Policy&new=1'>";?>
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
	<input type="hidden" name="page" value="Programme">   
	<input type="hidden" name="section" value="Policy">   
	<input type="submit" name="Submit" value="Search">   
	<input name="course"  type="text" placeholder="Search by Programme Code ..">
	<input type="submit" name="Submit" value="Search">   
</div>	  
 
       </form>
	
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>Programme Code</strong></td>
    <td><strong>Degree </strong></td>
	<td><strong>Faculty</strong></td>
  </tr>
  <?php do { ?>
  <tr>
    <td nowrap><?php $id = $row_inst['ProgrammeID']; $name = $row_inst['ProgrammeCode'];
	echo "<a href=\"/?page=Programme&section=Policy&edit=$id\">$name</a>"?></td>
    <td nowrap><?php echo $row_inst['ProgrammeName']; ?></td>
	 <td><?php echo $row_inst['Faculty']; ?></td>
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
      <th scope="row"><div align="right">Institution:</div></th>
<td><select name="cmbInst" id="cmbInst" title="">
  <?php
do {  
?>
  <option value="<?php echo $row_campus['CampusID']?>"><?php echo $row_campus['Campus']?></option>
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
      <th scope="row"><div align="right">Faculty:</div></th>
      <td><select name="cmbFac" id="cmbFac">
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
    <tr >
      <th nowrap scope="row"><div align="right">Degree Code:</div></th>
      <td><div class="controls"> <input name="txtCode" type="text" id="txtCode" class="span122"></div></td>
    </tr>
    <tr >
      <th nowrap scope="row"><div align="right">Short  Name:</div></th>
      <td><div class="controls"> <input name="txtSname" type="text" id="txtSname" class="span122"></div></td>
    </tr>
	<tr >
      <th nowrap scope="row"><div align="right">Full Name:</div></th>
      <td><div class="controls"> <input name="txtFname" type="text" id="txtFname" class="span122"></div></td>
    </tr>
    <tr >
      <th scope="row">&nbsp;</th>
      <td><div align="center">
        <div class="controls"> <input type="submit" name="Submit" value="Add Record"></div>
      </div></td>
    </tr>
  </table>
    <div class="controls"> <input type="hidden" name="MM_insert" value="frmInst"></div>
</form>
<?php } 
if (isset($_GET['edit'])){
#get post variables
$key = $_GET['edit'];
mysql_select_db($database_cha, $cha);
$query_instEdit = "SELECT * FROM programme WHERE programmeID ='$key'";
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
      <th scope="row"><div align="right">Institution:</div></th>
<td><select name="cmbInst" id="cmbInst" title="<?php echo $row_instEdit['CampusID']; ?>"><?php echo $row_instEdit['CampusID']; ?>
  <?php
do {  
?>
  <option value="<?php echo $row_campus['CampusID']?>"><?php echo $row_campus['Campus']?></option>
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
      <th scope="row"><div align="right">Faculty:</div></th>
      <td><select name="cmbFac" id="cmbFac" title="<?php echo $row_instEdit['Faculty']; ?>"><?php echo $row_instEdit['Faculty']; ?>
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
    <tr >
      <th nowrap scope="row"><div align="right">Degree Code:</div></th>
      <td><div class="controls"> <input name="txtCode" type="text" id="txtCode" value="<?php echo $row_instEdit['ProgrammeCode']; ?>" class="span122"></div></td>
    </tr>
    <tr >
      <th nowrap scope="row"><div align="right">Short Name:</div></th>
      <td><div class="controls"> <input name="txtSname" type="text" id="txtSname" value="<?php echo $row_instEdit['ProgrammeName']; ?>" class="span122"></div></td>
    </tr>
	    <tr >
      <th nowrap scope="row"><div align="right">Full Name:</div></th>
      <td><div class="controls"> <input name="txtFname" type="text" id="txtFname" value="<?php echo $row_instEdit['Title']; ?>" class="span122"></div></td>
    </tr>
    <tr >
      <th scope="row"><div class="controls"> <input name="id" type="hidden" id="id" value="<?php echo $key ?>"></div></th>
      <td><div align="center">
        <div class="controls"> <input type="submit" name="Submit" value="Edit Record"></div>
      </div></td>
    </tr>
  </table>
  <div class="controls"> <input type="hidden" name="MM_update" value="frmInstEdit"></div>
</form>
<?php
}
	

@mysql_free_result($inst);

@mysql_free_result($instEdit);

@mysql_free_result($faculty);

@mysql_free_result($campus);
?>

	<!-- //programme form -->
	
	
	
	
	
	
	
	

</div>
			</div>
	</div>
</div>
</div>
