<?php
	
	$currentPage = $_SERVER["PHP_SELF"];
	$editFormAction = $_SERVER['PHP_SELF'];
	
	
	
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	//control the display table
	@$new=2;
	
	//delete a record from the list
	if (array_key_exists('arr', $_GET)) 
	{
		
	         $arr = isset($_REQUEST['arr']) ? json_decode($_REQUEST['arr']) : array();
		 foreach( $arr as $i ) 
		 {
			 if ($i !="")
			 {
				 $sqldelete="DELETE FROM sponsors WHERE SponsorID=$i";
				 mysql_select_db($database_cha, $cha);
				 $Result1 = mysql_query($sqldelete, $cha) or die(mysql_error());
				 
			 }
			 
		 }
		 echo"<script type='text/javascript'> alert('Records Deleted');</script>";
	}

	mysql_select_db($database_cha, $cha);
	$query_campus = "SELECT CampusID, Campus FROM campus";
	$campus = mysql_query($query_campus, $cha) or die(mysql_error());
	$row_campus = mysql_fetch_assoc($campus);
	$totalRows_campus = mysql_num_rows($campus);
	
	mysql_select_db($database_cha, $cha);
	$query_faculty = "SELECT FacultyName,FacultyID FROM faculty";
	$faculty = mysql_query($query_faculty, $cha) or die(mysql_error());
	$row_faculty = mysql_fetch_assoc($faculty);
	$totalRows_faculty = mysql_num_rows($faculty);
	
	//head of department selection list
	
	mysql_select_db($database_cha, $cha);
	$query_lecturers = "SELECT `FullName` FROM `security` WHERE `PrivilegeID` = 3 ORDER BY FullName ASC";
	$lecturers = mysql_query($query_lecturers, $cha) or die(mysql_error());
	$row_lecturers = mysql_fetch_assoc($lecturers);
	$totalRows_lecturers = mysql_num_rows($lecturers);
	

	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	

	
	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmInstEdit")) {
	  $updateSQL = sprintf("UPDATE sponsors SET Name=%s, Address=%s, comment=%s WHERE SponsorID=%s",
	                       GetSQLValueString($_POST['txtName'], "text"),
			       GetSQLValueString($_POST['txtAddress'], "text"),
	                       GetSQLValueString($_POST['txtTel'], "text"),
	                       GetSQLValueString($_POST['id'], "int"));

	  mysql_select_db($database_cha, $cha);
	  $Result1 = mysql_query($updateSQL, $cha) or die(mysql_error());
                       echo '<meta http-equiv = "refresh" content ="0; 
url = ./?page='.$page.'&section='.$section.'&pageNum_inst=0">';
exit;
	}

	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInst")) {
	  $insertSQL = sprintf("INSERT INTO sponsors (Name, Address, comment) VALUES (%s, %s, %s)",
          		GetSQLValueString($_POST['txtName'], "text"),
       		 	GetSQLValueString($_POST['txtAddress'], "text"),
         	       	GetSQLValueString($_POST['txtTel'], "text"));

	  mysql_select_db($database_cha, $cha);
	  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
	  
                       echo '<meta http-equiv = "refresh" content ="0; 
url = ./?page='.$page.'&section='.$section.'&pageNum_inst=0">';
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
	if (isset($_GET['course'])) {
	  $key=$_GET['course'];
	  $query_inst = "SELECT * FROM sponsors WHERE ProgrammeName Like '%$key%' OR ProgrammeCode like '%$key%' ORDER BY ProgrammeName ASC";
	}else{
	$query_inst = "SELECT * FROM sponsors ORDER BY Name ASC";
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
	$totalPages_inst = ceil($totalRows_inst/$maxRows_inst);
	

	
	// table heading
	
	
	$column_titles = array('Sponsor Name','Address','Comment');
	
	

	// display to common template	
	
	$template->loadTemplateFile("common_header.tpl");
	$template->setCurrentBlock("heading");
	$template->setVariable("PAGENAME", "Sponsor Information");	
	$template->setVariable("LINK", "./?page=$page&section=$section&new=1");
	$template->setVariable("BUTTONNAME", "Add New Sponsor");		
	$template->parseCurrentBlock();	
	$template->show();
 
	@$new= htmlspecialchars($_GET['new']);
	if (array_key_exists('new', $_GET) && @$new==1)
	{
	
		require_once("include/admission/admissionSponsor_new.php");
	}
	else if (isset($_GET['edit']))
	{
		require_once("include/admission/admissionSponsor_edit.php");
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
		 	$id = $row_inst['SponsorID'];
			$sponsorname = $row_inst['Name'];
			$address = $row_inst['Address'];
			$comment = $row_inst['comment'];
			$template->setCurrentBlock("id");
			$template->setVariable("ID", $id);
			$template->parseCurrentBlock();	
			$template->setCurrentBlock("innercolumns");
			$template->setVariable("ROWDATA", $sponsorname);
			$template->parseCurrentBlock();	
			$template->setCurrentBlock("innercolumns");
			$template->setVariable("ROWDATA", $address);
			$template->parseCurrentBlock();	
			$template->setVariable("ROWDATA", $comment);
			$template->parseCurrentBlock();	
			$template->setCurrentBlock("edit");
			$template->setVariable("ID", "./?page=".$page."&section=".$section."&edit=".$id);
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
	
	<!-- Department form -->
	
	
	
	
	
