
<?php

$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];

	//control the display table
	@$new=2;
	if (isset($_SERVER['QUERY_STRING'])) 
	{
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInst")) 
	{
	  $insertSQL = sprintf("INSERT INTO campus (Campus, Location, Address, Tel, Email) VALUES (%s, %s, %s, %s, %s)",
	                       GetSQLValueString($_POST['txtName'], "text"),
	                       GetSQLValueString($_POST['txtPhyAdd'], "text"),
	                       GetSQLValueString($_POST['txtAdd'], "text"),
	                       GetSQLValueString($_POST['txtTel'], "text"),
	                       GetSQLValueString($_POST['txtEmail'], "text"));

	  mysql_select_db($database_cha, $cha);
	  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
                       echo '<meta http-equiv = "refresh" content ="0; 
url = ./?page=$page&section$section&pageNum_inst=0">';
exit;
	}
	
	
	if (array_key_exists('arr', $_GET)) 
	{
		
	         $arr = isset($_REQUEST['arr']) ? json_decode($_REQUEST['arr']) : array();
		 foreach( $arr as $i ) 
		 {
			 if ($i !="")
			 {
				 $sqldelete="DELETE FROM campus WHERE CampusID=$i";
				 mysql_select_db($database_cha, $cha);
				 $Result1 = mysql_query($sqldelete, $cha) or die(mysql_error());
				 
			 }
			 
		 }
		 echo"<script type='text/javascript'> alert('Records Deleted');</script>";
	}
	


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmInstEdit")) 
{
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
  if (isset($_SERVER['QUERY_STRING'])) 
  {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
                       echo '<meta http-equiv = "refresh" content ="0; 
url = ./?page=$page&section=$section&pageNum_inst=0">';
exit;
}

// page numbering of the list
$pageNum_inst = 0;
$maxRows_inst = 10;

if (isset($_GET['pageNum_inst'])) 
{
  $pageNum_inst = htmlspecialchars($_GET['pageNum_inst']);
}
$startRow_inst = $pageNum_inst * $maxRows_inst;


mysql_select_db($database_cha, $cha);
$query_inst = "SELECT `FullName` , `UserName` , `RegNo` , `AccpacID` , `Position` , `LastLogin`
FROM `security`";
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


// table heading
$column_titles = array('Full Name','UserName','RegNo','AccpacID','Position', 'LastLogin');
//die($totalPages_inst."here");

// display to common template	
	
$template->loadTemplateFile("common_header.tpl");
$template->setCurrentBlock("heading");
$template->setVariable("PAGENAME", "User Information");	
$template->setVariable("LINK", "./?page=$page&section=$section&new=1");
$template->setVariable("BUTTONNAME", "Add New User");		
$template->parseCurrentBlock();	
$template->show();
 
@$new= htmlspecialchars($_GET['new']);
if (array_key_exists('new', $_GET) && @$new==1)
{
	
	require_once("include/admission/user_new.php");
}
else if (isset($_GET['edit']))
{
	require_once("include/admission/user_edit.php");
}
else
{
	
	$template->loadTemplateFile("common_table_list.tpl");
	$template->setCurrentBlock("columns");
	$i=0;
	foreach ($column_titles as $column) 
	{
		
		
		if($i==0)
		{	$template->setVariable("OPTIONS", "data-toggle='class' class='th-sortable'");
			$template->setVariable("COLUMNTITLE", $column );
			$template->setVariable("SPINNER", spinner());
		}
		else
		{
				$template->setVariable("COLUMNTITLE", $column );
		}
		$template->parseCurrentBlock();	
		$i++;	
	}
	$i=0;
	do 
	{ 
	 	$id = $row_inst['RegNo']; 
		$name = $row_inst['FullName']; 
		$username = $row_inst['UserName'];
		$accpac = $row_inst['AccpacID'];
		$position = $row_inst['Position'];
		$lastlogin = $row_inst['LastLogin'];
		$template->setCurrentBlock("id");
		$template->setVariable("ID", $id);
		$template->parseCurrentBlock();	
		$template->setCurrentBlock("innercolumns");
		$template->setVariable("ROWDATA", $name);
		$template->parseCurrentBlock();	
		$template->setVariable("ROWDATA", $username);
		$template->parseCurrentBlock();	
		$template->setVariable("ROWDATA", $id);
		$template->parseCurrentBlock();
		$template->setVariable("ROWDATA", $accpac);
		$template->parseCurrentBlock();		
		$template->setVariable("ROWDATA", $position);
		$template->parseCurrentBlock();	
		$template->setVariable("ROWDATA", $lastlogin);
		$template->parseCurrentBlock();	
		$template->setCurrentBlock("edit");
		$template->setVariable("ID", "./?page=$page&section=$section&edit=$id");
		$template->parseCurrentBlock();	
		$template->parse("row");
		
		
		
		$i++;
		
		
	} while ($row_inst = mysql_fetch_assoc($inst));
	
	$template->setCurrentBlock("delete");
	$template->setVariable("FORM", $editFormAction );
	$template->parseCurrentBlock();	
	// page numbers
	$template->setCurrentBlock("pagenumstat");
 	if(($pageNum_inst - 1) < 0)
 	{
	 	if($totalRows_inst <= $maxRows_inst)
	 	{
	 		$template->setVariable("PAGENUMSTATUS", "showing 1 - $totalRows_inst of $totalRows_inst items" );
 	 	}
	 	else
	 	{
			$startpaging = 1;
			$endpaging = $startpaging + ($maxRows_inst - 1);
	 		$template->setVariable("PAGENUMSTATUS",  "showing 1 - $endpaging  of $totalRows_inst items");
	 	}
 	}
	else
	{
		$startpaging = ($pageNum_inst * $maxRows_inst) + 1;
		$endpaging = $startpaging + ($maxRows_inst - 1);
		$template->setVariable("PAGENUMSTATUS",  "showing $startpaging - $endpaging of $totalRows_inst items");
	}
	$template->parseCurrentBlock();	
	
	pagenumber($template,$pageNum_inst,$page,$section,$totalPages_inst,$queryString_inst);
	$template->show();
	//require_once("include/admission/institution_default.php");
}
@mysql_free_result($inst);

@mysql_free_result($instEdit);

@mysql_free_result($faculty);

@mysql_free_result($campus);	
?>


