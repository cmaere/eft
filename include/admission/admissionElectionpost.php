
		<div id="content" "="">
	<h2>Course Roster Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Course List Form</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
			
<?php
mysql_select_db($database_cha, $cha);
$query_ayear = "SELECT * FROM academicyear ORDER BY AYear DESC";
$ayear = mysql_query($query_ayear, $cha) or die(mysql_error());
$row_ayear = mysql_fetch_assoc($ayear);
$totalRows_ayear = mysql_num_rows($ayear);

$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInst")) {
$rawcode = $_POST['txtCode'];
$code = ereg_replace("[[:space:]]+", " ",$rawcode);
$rawname = $_POST['txtTitle'];
$name = ereg_replace("[[:space:]]+", " ",$rawname);

#check if subject name exist
$namesql ="SELECT Post 			
	  FROM electionpost WHERE (Post  = '$name')";
$nameresult = mysql_query($namesql) or die("Tunasikitika Kuwa Hatuwezi Kukuhudumia Kwa Sasa.<br>");
$coursenameFound = mysql_num_rows($nameresult);
if ($coursenameFound) {
          $namefound   = mysql_result($nameresult,0,'Post');
			print " This Post: '".$namefound."' Do Exists!!"; 
			exit;
 }
#insert records	   				   
 $insertSQL = sprintf("INSERT INTO electionpost (Post, Period, StartDate, EndDate) VALUES (%s, %s, %s, %s)",
   GetSQLValueString($_POST['txtTitle'], "text"),
   GetSQLValueString($_POST['ayear'], "text"),
   GetSQLValueString($_POST['startDate'], "text"),
   GetSQLValueString($_POST['endDate'], "text"));                   
  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmInstEdit")) {
 					   $updateSQL = sprintf("UPDATE electionpost SET Post=%s, Period=%s, StartDate=%s, EndDate=%s  WHERE Id=%s",
                       GetSQLValueString($_POST['txtTitle'], "text"),
                       GetSQLValueString($_POST['ayear'], "text"),
                       GetSQLValueString($_POST['startDate'], "text"),
                       GetSQLValueString($_POST['endDate'], "text"),                  
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($updateSQL, $cha) or die(mysql_error());
 }
 

//control the display table
@$new=2;

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
  $rawkey=$_GET['course'];
  $key = addslashes($rawkey);
  $query_inst = "SELECT * FROM electionpost WHERE Post Like '%$key%' ORDER BY Id ASC";
}else{
$query_inst = "SELECT * FROM electionpost ORDER BY Id ASC";
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
	<?php echo "<a href='/?page=ElectionPost&section=E-voting&new=1'>";?>
		<i></i>
	 Add New Election Post </a> 
 </li>
 
</ul>
</div>

<?php
echo "</a>";
if (@$new<>1)
{
?>
<form name="form1" method="get" action="<?php echo $editFormAction; ?>">
              Search by Post: 
                <input name="course" type="text" id="course" maxlength="50">
              <input type="submit" name="Submit" value="Search">
</form>
	   
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>S/No</strong></td>
	<td><div align="center"><strong>Post</strong></div></td>
	<td><div align="center"><strong>ElectionStartDate</strong></div></td>
	<td><div align="center"><strong>ElectionEndDate</strong></div></td>
  </tr>
  <?php do { ?>
  <tr>
     <td nowrap><?php $name = $row_inst['Id']; echo "<a href=\"/?page=ElectionPost&section=E-voting&edit=$name\">$name</a>"?></td>
	 <td><?php echo $row_inst['Post'] ?></td>
	 <td><?php echo $row_inst['StartDate'] ?></td>
	 <td><?php echo $row_inst['EndDate'] ?></td>
  </tr>
  <?php } while ($row_inst = mysql_fetch_assoc($inst)); ?>
</table>


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
<li><a href="<?php printf("/?page=ElectionPost&section=E-voting&pageNum_inst=%d%s", max(0, $pageNum_inst - 1), $queryString_inst); ?>">&laquo;</a></li>
<?php
 }
 //die($pageNum_inst);
 if($pageNum_inst <> 0)
 {
	 for($i=1; $i<=$pageNum_inst; $i++)
	 {
	 	?>
	 <li><a href="<?php printf("/?page=ElectionPost&section=E-voting&pageNum_inst=%d%s", min($totalPages_inst, $i - 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
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
<li><a href="<?php printf("/?page=ElectionPost&section=E-voting&pageNum_inst=%d%s", min($totalPages_inst, $pageNum_inst + 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
<?php
$lastpage = $lastpage + 1;
}

if($lastpage > $totalPages_inst || $pageNum_inst == 0 )
{
	?> 
	<li><a href="<?php printf("/?page=ElectionPost&section=E-voting&pageNum_inst=%d%s",min($totalPages_inst, $pageNum_inst + 1), $queryString_inst); ?>">&raquo;</a></li>
	<?php 

 }
 else
 {	
	 echo"<li class='disabled'><a href='#'>&raquo;</a></li>";
}
?>
       
	   
			
<?php
 }
 else{
 	
 ?>
<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInst" id="frmInst">
  <!-- A Separate Layer for the Calendar -->
  <script language="JavaScript" src="datepicker/Calendar1-901.js" type="text/javascript"></script>
  <table width="200" border="1" cellpadding="0" cellspacing="0" bordercolor="#006600">
    <tr bgcolor="#CCCCCC">
    </tr>
    <tr bgcolor="#CCCCCC">
      <th nowrap scope="row"><div align="right">Post Name:</div></th>
      <td><input name="txtTitle" type="text" id="txtTitle" size="40"></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th nowrap scope="row"><div align="right">Election Starts:</div></th>
      <td nowrap><input name="startDate" type="text" id="startDate" size="22">
      <input type="button" class="button" name="dtDate_button" value="Choose Date" onClick="show_calendar('frmInst.startDate', '','','YYYY-MM-DD', 'POPUP','AllowWeekends=Yes;Nav=No;SmartNav=Yes;PopupX=300;PopupY=300;')"></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th nowrap scope="row"><div align="right">Election Ends:</div></th>
      <td nowrap><input name="endDate" type="text" id="endDate" size="22">
      <input type="button" class="button" name="dtDate_button" value="Choose Date" onClick="show_calendar('frmInst.endDate', '','','YYYY-MM-DD', 'POPUP','AllowWeekends=Yes;Nav=No;SmartNav=Yes;PopupX=300;PopupY=300;')"></td>
    </tr>
	    <tr bgcolor="#CCCCCC">
      <th nowrap scope="row"><div align="right">Period:</div></th>
      <td><select name="ayear" id="ayear" title="<?php echo $row_ayear['AYear']; ?>">
        <?php
do {  
?>
        <option value="<?php echo $row_ayear['AYear']?>"><?php echo $row_ayear['AYear']?></option>
        <?php
} while ($row_ayear = mysql_fetch_assoc($ayear));
  $rows = mysql_num_rows($ayear);
  if($rows > 0) {
      mysql_data_seek($ayear, 0);
	  $row_ayear = mysql_fetch_assoc($ayear);
  }
?>
      </select></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      
    </tr>
    <tr bgcolor="#CCCCCC">
      <th scope="row">&nbsp;</th>
      <td>
        <div align="left">
          <input type="submit" name="Submit" value="Add Record">
        </div></td></tr>
  </table>
    <input type="hidden" name="MM_insert" value="frmInst">
</form>
<?php } 
if (isset($_GET['edit'])){
#get post variables
$key = $_GET['edit'];

mysql_select_db($database_cha, $cha);
$query_instEdit = "SELECT * FROM electionpost WHERE Id ='$key'";
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
  <!-- A Separate Layer for the Calendar -->
  <script language="JavaScript" src="datepicker/Calendar1-901.js" type="text/javascript"></script>
  <div align="left">
    <table width="200" border="1" cellpadding="0" cellspacing="0" bordercolor="#006600">
      <tr bgcolor="#CCCCCC">
        
    </tr>
      <tr bgcolor="#CCCCCC">
        <th nowrap scope="row"><div align="right">Post Code:</div></th>
        <td><input name="txtCode" type="hidden" id="txtCode" value="<?php echo $row_instEdit['Id']; ?>" size="40"><?php echo $row_instEdit['Id']; ?></td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <th nowrap scope="row"><div align="right">Post Name:</div></th>
        <td><input name="txtTitle" type="text" id="txtTitle" value="<?php echo $row_instEdit['Post']; ?>" size="40"></td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <th nowrap scope="row"><div align="right">Election Starts:</div></th>
        <td nowrap><input name="startDate" type="text" id="startDate" value="<?php echo $row_instEdit['StartDate']; ?>"size="22">
        <input type="button" class="button" name="dtDate_button" value="Choose Date" onClick="show_calendar('frmInstEdit.startDate', '','','YYYY-MM-DD', 'POPUP','AllowWeekends=Yes;Nav=No;SmartNav=Yes;PopupX=300;PopupY=300;')"></td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <th nowrap scope="row"><div align="right">Election Ends:</div></th>
        <td nowrap><input name="endDate" type="text" id="endDate" value="<?php echo $row_instEdit['EndDate']; ?>"size="22">
        <input type="button" class="button" name="dtDate_button" value="Choose Date" onClick="show_calendar('frmInstEdit.endDate', '','','YYYY-MM-DD', 'POPUP','AllowWeekends=Yes;Nav=No;SmartNav=Yes;PopupX=300;PopupY=300;')"></td>
      </tr>
		    <tr bgcolor="#CCCCCC">
      <th nowrap scope="row"><div align="right">Period:</div></th>
      <td><select name="ayear" id="ayear" title="<?php echo $row_ayear['AYear']; ?>">
	  	  	  <option value="<?php echo $row_instEdit['Period']?>"><?php echo $row_instEdit['Period']?></option>

        <?php
do {  
?>
        <option value="<?php echo $row_ayear['AYear']?>"><?php echo $row_ayear['AYear']?></option>
        <?php
} while ($row_ayear = mysql_fetch_assoc($ayear));
  $rows = mysql_num_rows($ayear);
  if($rows > 0) {
      mysql_data_seek($ayear, 0);
	  $row_ayear = mysql_fetch_assoc($ayear);
  }
?>
      </select></td>
    </tr>
      <tr bgcolor="#CCCCCC">
        
    </tr>
      <tr bgcolor="#CCCCCC">
        <th scope="row"><input name="id" type="hidden" id="id" value="<?php echo $key ?>"></th>
        <td>
          <div align="left">
            <input type="submit" name="Submit" value="Edit Record">
          </div></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="frmInstEdit">
  </div>
</form>
<?php
}
	

@mysql_free_result($inst);

@mysql_free_result($instEdit);

@mysql_free_result($faculty);

@mysql_free_result($campus);
?>

</div>
			</div>
	</div>
</div>
</div>
