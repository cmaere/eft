<?php

$lastpage =0;
$totalPages_inst = 0;
$totalPages_inst =0;
$pageNum_inst=0; 

$pageNum_inst=0;


// set template directory
$template = new HTML_Template_IT("./include/templates");
// load template
$template->loadTemplateFile("skin_header.tpl");
// parse header block
//$template->setCurrentBlock("head");
//$template->setVariable("LOGINNAME", $_SESSION['loginName']);
//$template->parseCurrentBlock();
//$template->parse("head");
//$template->parse("start");

//die("still here");

$sql = "SELECT DISTINCT sectionpage, sectionname, icon FROM `functions` 
INNER JOIN cha_rights ON (functions.id = cha_rights.functionid)
INNER JOIN sectionsName ON (functions.sectionpage = sectionsName.id)
WHERE cha_rights.RegNo = '$RegNo'";
$result = mysqli_query($cha, $sql) or die("query error contrller<br>");
$noFound = mysqli_num_rows($result);
	$template->setCurrentBlock("sections");
	while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) 
	{		
                        $sectionname= $line["sectionname"];  
   		     	$sectionpage= $line["sectionpage"]; 
			$icon= $line["icon"]; 
			if($noFound <> 0)
   		 	{
				
		       	   	$sql2="SELECT functionName FROM `functions`
			   	INNER JOIN functionName ON (functions.function = functionName.id)
			   	WHERE functions.sectionpage = '$sectionpage'";
		       		$result2 = mysqli_query($cha,$sql2) or die("query error functionname controller<br>".$sql2);
		       	 	$noFound2 = mysqli_num_rows($result2);
				$template->setCurrentBlock("loop");
	               	 	while ($line2 = mysqli_fetch_array($result2, MYSQL_ASSOC)) 
	                	{
					
					$buttonname= $line2["functionName"]; 
					//die("here ".$sectionname." ".$buttonname);
					$link = "./?page=$buttonname&section=$sectionname";
					$template->setVariable("LINK", $link);
					$template->setVariable("BUTTONNAME", $buttonname);
					$template->parseCurrentBlock();
					
				 }
				 $template->parse("outer");
				 
 				$template->setCurrentBlock("sections");
 				$template->setVariable("ICON", $icon);
 				$template->setVariable("SECTIONNAME", $sectionname);
 				$template->parseCurrentBlock();
				
		       	   	
				 
				 
			 }
	}
	

$template->parse("nav");
	
mysqli_free_result($result);
//mysql_free_result($result2); 
//welcome message	 	
$template->setCurrentBlock("note");	
$template->setVariable("LOGINNAME", $_SESSION['loginName']);
if($page != "")
{
	$template->setVariable("WELCOME", "<p>Welcome to <b>$page page</b> for Student Academic Record Information System</p>");
 
}
else
{
	$template->setVariable("WELCOME", "<p>Welcome to Student Academic Record Information System</p>");

}
$template->parseCurrentBlock();	
require_once("include/profile/breadcrumb.php");
$template->loadTemplateFile("skin_header.tpl");
//$template->touchBlock("news");		
$template->show();

// content
// all saris modules
//die("am here");
switch($page)
{
	case "Institution" :
		require_once("include/admission/institution.php");
		break;
	case "Faculty" :
		require_once("include/admission/admissionFaculty.php");
		break;
	case "Department" :
		require_once("include/admission/admissionDepartment.php");
		break;
	case "Programme" :
		require_once("include/admission/admissionProgramme.php");
		break;
	case "Subject" :
		require_once("include/admission/admissionModule.php");
		break;
	case "Sponsor" :
		require_once("include/admission/admissionSponsor.php");
		break;
	case "RegistrationForm" :
		require_once("include/admission/registration_form.php");
		break;
	case "GoogleSpeardSheetReg" :
		require_once("include/admission/googlespeardsheetreg.php");
		break;
	case "NorminalRoll" :
		require_once("include/admission/admissionNorminalRoll.php");
		break;
	case "DashBoard" :
		require_once("include/dashboard.php");
		break;
	case "CourseRoster" :
		require_once("include/student/studentCourselist.php");
		break;
	case "StudentCourseRegister" :
		require_once("include/student/studentcourseregister.php");
		break;
	case "ExamRegistered" :
		require_once("include/student/studentacademic.php");
		break;
	case "ExamResults" :
		require_once("include/student/studentexamresults.php");
		break;
	case "CheckInbox" :
		require_once("include/student/admissionCheckMessage.php");
		break;
	case "NewsEvents" :
		require_once("include/student/news.php");
		break;	
	case "ElectionVoting" :
		require_once("include/student/admissionVoting.php");
		break;	
	case "ElectionPost" :
		require_once("include/admission/admissionElectionpost.php");
		break;
	case "GradeBook" :
		require_once("include/academic/lecturerGradebook.php");
		break;
	case "GradeBookAdd" :
		require_once("include/academic/lecturerGradebookAdd.php");
		break;	
	case "resultDel" :
		require_once("include/academic/lecturerexalresultdelete.php");
		break;
	case "UserManagement" :
		require_once("include/admission/usermanagement.php");
		break;											
	default :
		require_once("include/profile/default.php");
		break;
}

// end content
//die("am here too");
// news
$template->loadTemplateFile("footer.tpl");

$template->setCurrentBlock("news");
$template->setVariable("NEWS", "Intranet News");
//$template->parseCurrentBlock();	

$json = getJson($url_json);
//die($url_json);
//var_dump($json);
//die($json);
$arr = json_decode($json);	
//var_dump($arr);
$template->setCurrentBlock("article");

foreach ($arr as $obj) {
	 //die$obj->guid;
	$template->setVariable("NEWSLINK", $obj->guid);	
	$template->setVariable("NEWSTITLE", $obj->post_title);	
	$template->setVariable("NEWSCONTENT", limit_text($obj->post_content,15));
	$template->setVariable("NEWSDATE", $obj->post_date);
	$template->setVariable("NEWSAUTHOR", $obj->user_nicename);
	$template->parseCurrentBlock();	
    
        
}
$template->parse("newsinner");
$template->show();

 ?>
				

 
