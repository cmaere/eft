
<section class="panel"> 
	<header class="panel-heading font-bold"> New Faculty </header> 
	<div class="panel-body"> 
		<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInst" id="frmInst" class="form-horizontal"> 
			<div class="form-group"> <label class="col-sm-2 control-label">Faculty</label> 
				<div class="col-sm-10"> <input type="text" name="txtName" class="form-control rounded"> </div> 
			</div> 
			<div class="line line-dashed line-lg pull-in"></div> 
			<div class="form-group"> <label class="col-sm-2 control-label">Address</label> 
			 	<?php Wysiwyg('txtAdd'); ?>
			 </div>
	   	         <div class="line line-dashed line-lg pull-in"></div> 
			 <div class="form-group"> <label class="col-sm-2 control-label">Physical Address</label> 
			 	<?php Wysiwyg('txtPhyAdd'); ?>
			 </div>
			 <div class="line line-dashed line-lg pull-in"></div> 
 			<div class="form-group"> <label class="col-sm-2 control-label">Telephone</label> 
 				<div class="col-sm-10"> <input type="text" name="txtTel" class="form-control rounded"> </div> 
 			</div>
			<div class="line line-dashed line-lg pull-in"></div> 
			<div class="form-group"> <label class="col-sm-2 control-label">Email</label> 
				<div class="col-sm-10"> <input type="text" name="txtEmail" class="form-control rounded"> </div> 
			</div>
	    	     	<div class="line line-dashed line-lg pull-in"></div> 
    		    	<div class="form-group"> <div class="col-sm-4 col-sm-offset-2">  
	    		    <button class="btn btn-primary" type="submit">Add Record</button> 
			    <input type="hidden" name="MM_insert_faculty" value="frmInst">
    	    		</div> 

		</form> 
	</div> 
</section>
</section>	
</div>



<?php
	
/*
	$currentPage = $_SERVER["PHP_SELF"];
	$editFormAction = $_SERVER['PHP_SELF'];
	
	
	?>
		<div id="content" "="">
	<h2>Faculty Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Faculty Form</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
			<div class="span6" style="width: 50px;">
	
	<!-- faculty form -->
	
	<?php
	$currentPage = $_SERVER["PHP_SELF"];

	
	//control the display table
	@$new=2;

	mysql_select_db($database_cha, $cha);
	$query_campus = "SELECT CampusID, Campus FROM campus";
	$campus = mysql_query($query_campus, $cha) or die(mysql_error());
	$row_campus = mysql_fetch_assoc($campus);
	$totalRows_campus = mysql_num_rows($campus);

	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	if ((isset($_POST["MM_insert_faculty"])) && ($_POST["MM_insert_faculty"] == "frmInst")) {
	  $insertSQL = sprintf("INSERT INTO faculty (CampusID, FacultyName, Location, Address, Tel, Email) VALUES (%s, %s, %s, %s, %s, %s)",
	                       GetSQLValueString($_POST['cmbInst'], "text"),
						   GetSQLValueString($_POST['txtName'], "text"),
	                       GetSQLValueString($_POST['txtPhyAdd'], "text"),
	                       GetSQLValueString($_POST['txtAdd'], "text"),
	                       GetSQLValueString($_POST['txtTel'], "text"),
	                       GetSQLValueString($_POST['txtEmail'], "text"));

	  mysql_select_db($database_cha, $cha);
	  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
                       echo '<meta http-equiv = "refresh" content ="0; 
url = /?page=Faculty&section=Policy&pageNum_inst=0">';
	}

	if ((isset($_POST["MM_update_faculty"])) && ($_POST["MM_update_faculty"] == "frmInstEdit")) {
	  $updateSQL = sprintf("UPDATE faculty SET CampusID=%s, FacultyName=%s, Location=%s, Address=%s, Tel=%s, Email=%s WHERE FacultyID=%s",
	                       GetSQLValueString($_POST['cmbInst'], "text"),
						   GetSQLValueString($_POST['txtName'], "text"),
	                       GetSQLValueString($_POST['txtPhyAdd'], "text"),
	                       GetSQLValueString($_POST['txtAdd'], "text"),
	                       GetSQLValueString($_POST['txtTel'], "text"),
	                       GetSQLValueString($_POST['txtEmail'], "text"),
	                       GetSQLValueString($_POST['id'], "int"));

	  mysql_select_db($database_cha, $cha);
	  $Result1 = mysql_query($updateSQL, $cha) or die(mysql_error());

	  $updateGoTo = "/";
	  if (isset($_SERVER['QUERY_STRING'])) {
	    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
	    $updateGoTo .= $_SERVER['QUERY_STRING'];
	  }
                       echo '<meta http-equiv = "refresh" content ="0; 
url = '.$updateGoTo.'">';
	}

	$maxRows_inst = 10;
	$pageNum_inst = 0;
	if (isset($_GET['pageNum_inst'])) {
	  $pageNum_inst = $_GET['pageNum_inst'];
	}
	$startRow_inst = $pageNum_inst * $maxRows_inst;

	mysql_select_db($database_cha, $cha);
	$query_inst = "SELECT * FROM faculty ORDER BY FacultyName ASC";
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
	<div class="tabsbar" style="width: 178px;">
		<ul>
	<li class="glyphicons circle_plus active" >
		<?php echo "<a href='/?page=Faculty&section=Policy&new=1'>";?>
			<i></i>
		 Add New Faculty</a> 
	 </li>
 
	</ul>
	</div>
	
	<?php @$new=$_GET['new'];
	if (@$new<>1){
	?>

	<table border="1" cellpadding="0" cellspacing="0">
	  <tr>
	    <td><strong>Faculty</strong></td>
	    <td><strong>Location</strong></td>
	    <td><strong>Address</strong></td>
	    <td><strong>Tel</strong></td>
	    <td><strong>Email</strong></td>
	  </tr>
	  <?php do { ?>
	  <tr>
	    <td nowrap><?php $id = $row_inst['FacultyID']; $name = $row_inst['FacultyName'];
		echo "<a href=\"/?page=Faculty&section=Policy&edit=$id\">$name</a>"?></td>
	    <td><?php echo $row_inst['Location']; ?></td>
	    <td><?php echo $row_inst['Address']; ?></td>
	    <td><?php echo $row_inst['Tel']; ?></td>
	    <td><?php echo $row_inst['Email']; ?></td>
	  </tr>
	  <?php } while ($row_inst = mysql_fetch_assoc($inst)); ?>
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
	<li><a href="<?php printf("/?page=Faculty&section=Policy&pageNum_inst=%d%s", max(0, $pageNum_inst - 1), $queryString_inst); ?>">&laquo;</a></li>
	<?php
	 }
	 //die($pageNum_inst);
	 if($pageNum_inst <> 0)
	 {
		 for($i=1; $i<=$pageNum_inst; $i++)
		 {
		 	?>
		 <li><a href="<?php printf("/?page=Faculty&section=Policy&pageNum_inst=%d%s", min($totalPages_inst, $i - 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
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
	<li><a href="<?php printf("/?page=Faculty&section=Policy&pageNum_inst=%d%s", min($totalPages_inst, $pageNum_inst + 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
	<?php
	$lastpage = $lastpage + 1;
	}

	if($lastpage > $totalPages_inst || $pageNum_inst == 0 )
	{
		?> 
		<li><a href="<?php printf("/?page=Faculty&section=Policy&pageNum_inst=%d%s",min($totalPages_inst, $pageNum_inst + 1), $queryString_inst); ?>">&raquo;</a></li>
		<?php 
 
	 }
	 else
	 {	
		 echo"<li class='disabled'><a href='#'>&raquo;</a></li>";
	}
	?>
	</ul>
	</div>




	<?php }else{?>
		<br>
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
	      <td><div class="controls"> <input name="txtName" type="text" id="txtName" class="span122"></td>
	    </tr>
	    <tr >
	      <th scope="row"><div align="right">Address:</div></th>
	      <td><div class="controls"> <input name="txtAdd" type="text" id="txtAdd" class="span122"></td>
	    </tr>
	    <tr >
	      <th nowrap scope="row">Physical Address: </th>
	      <td><div class="controls"> <input name="txtPhyAdd" type="text" id="txtPhyAdd" class="span122"></td>
	    </tr>
	    <tr >
	      <th scope="row"><div align="right">Telephone:</div></th>
	      <td><div class="controls"> <input name="txtTel" type="text" id="txtTel" class="span122"></td>
	    </tr>
	    <tr >
	      <th scope="row"><div align="right">Email:</div></th>
	      <td><div class="controls"> <input name="txtEmail" type="text" id="txtEmail" class="span122"></td>
	    </tr>
	    <tr >
	      <th scope="row">&nbsp;</th>
	      <td><div align="center">
	        <input type="submit" name="Submit" value="Add Record">
	      </div></td>
	    </tr>
	  </table>
	    <input type="hidden" name="MM_insert_faculty" value="frmInst">
	</form>
	<?php } 
	if (isset($_GET['edit'])){
	#get post variables
	$key = $_GET['edit'];
	mysql_select_db($database_cha, $cha);
	$query_instEdit = "SELECT * FROM faculty WHERE FacultyID ='$key'";
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
	      <td><div class="controls"> <input name="txtName" type="text" id="txtName" value="<?php echo $row_instEdit['FacultyName']; ?>" class="span122" ></td>
	    </tr>
	    <tr >
	      <th scope="row"><div align="right">Address:</div></th>
	      <td><div class="controls"> <input name="txtAdd" type="text" id="txtAdd" value="<?php echo $row_instEdit['Address']; ?>" class="span122" ></td>
	    </tr>
	    <tr >
	      <th nowrap scope="row">Physical Address: </th>
	      <td><div class="controls"> <input name="txtPhyAdd" type="text" id="txtPhyAdd" value="<?php echo $row_instEdit['Location']; ?>" class="span122" ></td>
	    </tr>
	    <tr >
	      <th scope="row"><div align="right">Telephone:</div></th>
	      <td><div class="controls"> <input name="txtTel" type="text" id="txtTel" value="<?php echo $row_instEdit['Tel']; ?>" class="span122" ></td>
	    </tr>
	    <tr >
	      <th scope="row"><div align="right">Email:</div></th>
	      <td><div class="controls"> <input name="txtEmail" type="text" id="txtEmail" value="<?php echo $row_instEdit['Email']; ?>" class="span122" ></td>
	    </tr>
	    <tr >
	      <th scope="row"><div class="controls"> <input name="id" type="hidden" id="id" value="<?php echo $key ?>"></th>
	      <td><div align="center">
	          <input type="submit" name="edit" value="Edit Record">
	      </div></td>
	    </tr>
	  </table>
	  <input type="hidden" name="MM_update_faculty" value="frmInstEdit">
	</form>
	<?php<?php
$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];

	//control the display table
	@$new=10;
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInst")) {
	  $insertSQL = sprintf("INSERT INTO campus (Campus, Location, Address, Tel, Email) VALUES (%s, %s, %s, %s, %s)",
	                       GetSQLValueString($_POST['txtName'], "text"),
	                       GetSQLValueString($_POST['txtPhyAdd'], "text"),
	                       GetSQLValueString($_POST['txtAdd'], "text"),
	                       GetSQLValueString($_POST['txtTel'], "text"),
	                       GetSQLValueString($_POST['txtEmail'], "text"));

	  mysql_select_db($database_cha, $cha);
	  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
                       echo '<meta http-equiv = "refresh" content ="0; 
url = ./?page=Institution&section=Policy&pageNum_inst=0">';
exit;
	}

	


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmInstEdit")) {
  $updateSQL = sprintf("UPDATE campus SET Campus=%s, Location=%s, Address=%s, Tel=%s, Email=%s WHERE CampusID=%s",
                       GetSQLValueString($_POST['txtName'], "text"),
                       GetSQLValueString($_POST['txtPhyAdd'], "text"),
                       GetSQLValueString($_POST['txtAdd'], "text"),
                       GetSQLValueString($_POST['txtTel'], "text"),
                       GetSQLValueString($_POST['txtEmail'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($updateSQL, $cha) or die(mysql_error());

  $updateGoTo = "./";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
                       echo '<meta http-equiv = "refresh" content ="0; 
url = '.$updateGoTo.'">';
exit;
}
$maxRows_inst = 10;
$pageNum_inst = 0;
if (isset($_GET['pageNum_inst'])) {
  $pageNum_inst = htmlspecialchars($_GET['pageNum_inst']);
}
$startRow_inst = $pageNum_inst * $maxRows_inst;

mysql_select_db($database_cha, $cha);
$query_inst = "SELECT CampusID, Campus, Location, Address, Tel, Email FROM campus ORDER BY Campus ASC";
$query_limit_inst = sprintf("%s LIMIT %d, %d", $query_inst, $startRow_inst, $maxRows_inst);
$inst = mysql_query($query_limit_inst, $cha) or die(mysql_error());
$row_inst = mysql_fetch_assoc($inst);

if (isset($_GET['totalRows_inst'])) {
  $totalRows_inst = $_GET['totalRows_inst'];
} else {
  $all_inst = mysql_query($query_inst);
  $totalRows_inst = mysql_num_rows($all_inst);
}
$totalPages_inst = ceil($totalRows_inst/$maxRows_inst);

//die($totalPages_inst."here");
	
	
?>

	


<div class="col-lg-8">	
<section class="panel"> 
	<header class="panel-heading">Institution Information </header> 
	<div class="row text-sm wrapper"> 
		<div class="col-sm-5 m-b-xs">
			<a href="./?page=Institution&section=Policy&new=1">
				<button class="btn btn-sm btn-white">Add New Institution</button>
			</a> 
		</div> 
		<div class="col-sm-4 m-b-xs"> </div> 
		<div class="col-sm-3"> 
			<div class="input-group"> 
				<input type="text" placeholder="Search" class="input-sm form-control"> 
				<span class="input-group-btn"> 
					<button type="button" class="btn btn-sm btn-white">Go!</button> 
				</span> 
			</div> 
		</div> 
	</div> 
<?php
 
@$new= htmlspecialchars($_GET['new']);
if (array_key_exists('new', $_GET) && @$new==1)
{
	require_once("include/admission/institution_new.php");
}
else
{
	require_once("include/admission/institution_default.php");
}
	
?>
</section>	
</div>














<?php
/*


<?php


if(($pageNum_inst - 1) < 0)
{
  echo "<li class='disabled'><a href='#'>&laquo;</a></li>";
 }
 else
 {		 
?> 
<li><a href="<?php printf("/?page=Institution&section=Policy&pageNum_inst=%d%s", max(0, $pageNum_inst - 1), $queryString_inst); ?>">&laquo;</a></li>
<?php
 }
 //die($pageNum_inst);
 if($pageNum_inst <> 0)
 {
	 for($i=1; $i<=$pageNum_inst; $i++)
	 {
	 	?>
	 <li><a href="<?php printf("/?page=Institution&section=Policy&pageNum_inst=%d%s", min($totalPages_inst, $i - 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
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
<li><a href="<?php printf("/?page=Institution&section=Policy&pageNum_inst=%d%s", min($totalPages_inst, $pageNum_inst + 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
<?php
$lastpage = $lastpage + 1;
}

if($lastpage > $totalPages_inst || $pageNum_inst == 0 )
{
	?> 
	<li><a href="<?php printf("/?page=Institution&section=Policy&pageNum_inst=%d%s",min($totalPages_inst, $pageNum_inst + 1), $queryString_inst); ?>">&raquo;</a></li>
	<?php 
 
 }
 else
 {	
	 echo"<li class='disabled'><a href='#'>&raquo;</a></li>";
}
?>
</ul>
</div>
</div> 
<?php }else{?>
		
<!-- default form -->
	
<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInst" id="frmInst">
  <table width="200" border="1" cellpadding="0" cellspacing="0" bordercolor="#006600">
    <tr >
      <th scope="row"><div align="right">Institution:</div></th>
      <td><div class="controls"> <div class="controls"> <input name="txtName" type="text" id="txtName" class="span122"></div></td>
    </tr>
    <tr >
      <th scope="row"><div align="right">Address:</div></th>
      <td><div class="controls"> <div class="controls"> <input name="txtAdd" type="text" id="txtAdd" class="span122"></div></td>
    </tr>
    <tr >
      <th nowrap scope="row">Physical Address: </th>
      <td><div class="controls"> <div class="controls"> <input name="txtPhyAdd" type="text" id="txtPhyAdd" class="span122"></div></td>
    </tr>
    <tr >
      <th scope="row"><div align="right">Telephone:</div></th>
      <td><div class="controls"> <div class="controls"> <input name="txtTel" type="text" id="txtTel" class="span122"></div></td>
    </tr>
    <tr >
      <th scope="row"><div align="right">Email:</div></th>
      <td><div class="controls"> <div class="controls"> <input name="txtEmail" type="text" id="txtEmail" class="span122"></div></td>
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
<!-- //end default form -->
</div>
<?php 
} 
if (isset($_GET['edit'])){
#get post variables
$key = htmlspecialchars($_GET['edit']);
mysql_select_db($database_cha, $cha);

$query_instEdit = "SELECT * FROM campus WHERE CampusID ='$key'";
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
<br>
<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInstEdit" id="frmInstEdit">
  <table width="200" border="1" cellpadding="0" cellspacing="0" bordercolor="#006600">
    <tr >
      <th scope="row"><div align="right">Institution:</div></th>
      <td><div class="controls"> <input name="txtName" type="text" id="txtName" value="<?php echo $row_instEdit['Campus']; ?>" class="span122" ></td>
    </tr>
    <tr >
      <th scope="row"><div align="right">Address:</div></th>
      <td><div class="controls"> <input name="txtAdd" type="text" id="txtAdd" value="<?php echo $row_instEdit['Address']; ?>" class="span122" ></td>
    </tr>
    <tr >
      <th nowrap scope="row">Physical Address: </th>
      <td><div class="controls"> <input name="txtPhyAdd" type="text" id="txtPhyAdd" value="<?php echo $row_instEdit['Location']; ?>" class="span122" ></td>
    </tr>
    <tr >
      <th scope="row"><div align="right">Telephone:</div></th>
      <td><div class="controls"> <input name="txtTel" type="text" id="txtTel" value="<?php echo $row_instEdit['Tel']; ?>" class="span122" ></td>
    </tr>
    <tr >
      <th scope="row"><div align="right">Email:</div></th>
      <td><div class="controls"> <input name="txtEmail" type="text" id="txtEmail" value="<?php echo $row_instEdit['Email']; ?>" class="span122" ></td>
    </tr>
    <tr >
      <th scope="row"><div class="controls"> <input name="id" type="hidden" id="id" value="<?php echo $key ?>"></th>
      <td><div align="center">
        <input type="submit" name="edit" value="Edit Record">
      </div></td>
    </tr>
  </table>
      <input type="hidden" name="MM_update" value="frmInstEdit">
</form>
</div>
  <?php
}
	
@mysql_free_result($inst);

@mysql_free_result($instEdit);
?>

</div>
			</div>
	</div>
</div>
</div> 
?>
	}
		

	@mysql_free_result($inst);

	@mysql_free_result($instEdit);

	@mysql_free_result($campus);
	?>
	
	
	<!-- faculty form -->
	
	
	
	
	
	
	
	

</div>
			</div>
	</div>
</div>
</div>
*/
