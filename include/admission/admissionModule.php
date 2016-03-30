<?php
$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInst")) 
{
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
                       GetSQLValueString($_POST['cmbDept'], "text"),
                       GetSQLValueString($_POST['cmbFac'], "text"));

  		     mysql_select_db($database_cha, $cha);
  		   $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
	   }
  
                       echo '<meta http-equiv = "refresh" content ="0; 
url = ./?page='.$page.'&section='.$section.'&pageNum_inst=0">';
	exit;
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmInstEdit")) {
///charlie chingwalu and msosa edits

	 $cha_id = GetSQLValueString($_POST['id'], "int");
 	 $cha_newcode = GetSQLValueString($_POST['txtCode'], "text");
            $coursename =GetSQLValueString($_POST['txtTitle'], "text");
            $unit=GetSQLValueString($_POST['txtUnit'], "text");
            $dept=GetSQLValueString($_POST['cmbDept'], "text");
            $fac=GetSQLValueString($_POST['cmbFac'], "text");

 
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
url = ./?page='.$page.'&section='.$section.'&pageNum_inst=0">';
exit;
  
  
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
			 $sqldelete="DELETE FROM  course WHERE Id=$i";
			 mysql_select_db($database_cha, $cha);
			 $Result1 = mysql_query($sqldelete, $cha) or die(mysql_error());
			 
		 }
		 
	 }
	 echo"<script type='text/javascript'> alert('Records Deleted');</script>";
}

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
$totalPages_inst = ceil($totalRows_inst/$maxRows_inst);



// table heading


$column_titles = array('Course','Description','Department','Units');



// display to common template	

$template->loadTemplateFile("common_header.tpl");
$template->setCurrentBlock("heading");
$template->setVariable("PAGENAME", "Module Information");	
$template->setVariable("LINK", "./?page=$page&section=$section&new=1");
$template->setVariable("BUTTONNAME", "Add New Module");		
$template->parseCurrentBlock();	
$template->show();

@$new= htmlspecialchars($_GET['new']);
if (array_key_exists('new', $_GET) && @$new==1)
{

	require_once("include/admission/admissionModule_new.php");
}
else if (isset($_GET['edit']))
{
	require_once("include/admission/admissionModule_edit.php");
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
	 	$id = $row_inst['Id'];
		$department = $row_inst['Department'];
		$coursename = $row_inst['CourseName'];
		$coursecode = $row_inst['CourseCode'];
		$units = $row_inst['Units'];
		$template->setCurrentBlock("id");
		$template->setVariable("ID", $id);
		$template->parseCurrentBlock();	
		$template->setCurrentBlock("innercolumns");
		$template->setVariable("ROWDATA", $coursecode);
		$template->parseCurrentBlock();	
		$template->setCurrentBlock("innercolumns");
		$template->setVariable("ROWDATA", $coursename);
		$template->parseCurrentBlock();	
		$template->setVariable("ROWDATA", $department);
		$template->parseCurrentBlock();	
		$template->setVariable("ROWDATA", $units);
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





