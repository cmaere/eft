<?php
 require_once('include/connection/chaconnect.php');
 require_once("include/functions.php");
 
$lastpage =0;
$totalPages_inst = 0;
$totalPages_inst =0;
$pageNum_inst=0;
$pageNum_inst=0;
 ?>

<html class=" js no-touch csstransforms3d csstransitions">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Cha Student Academic Record Information System</title>
	
	<!-- Bootstrap -->
	<link href="cha_files/bootstrap.css" rel="stylesheet">
	<link href="cha_files/responsive.css" rel="stylesheet">
	
	<!-- Glyphicons Font Icons -->
	<link href="cha_files/glyphicons.css" rel="stylesheet">
	
	<!-- Uniform Pretty Checkboxes -->
	<link href="cha_files/uniform.css" rel="stylesheet">
	
	
	
	<!-- Bootstrap Extended -->
	<link href="cha_files/jasny-bootstrap.css" rel="stylesheet">
	<link href="cha_files/jasny-bootstrap-responsive.css" rel="stylesheet">
	<link href="cha_files/bootstrap-wysihtml5-0.css" rel="stylesheet">
	<link href="cha_files/bootstrap-select.css" rel="stylesheet">
	<link href="cha_files/bootstrap-toggle-buttons.css" rel="stylesheet">
	
	<!-- Select2 Plugin -->
	<link href="cha_files/select2.css" rel="stylesheet">
	
	<!-- DateTimePicker Plugin -->
	<link href="cha_files/datetimepicker.css" rel="stylesheet">
	
	<!-- JQueryUI -->
	<link href="cha_files/jquery-ui-1.css" rel="stylesheet">
	
	<!-- MiniColors ColorPicker Plugin -->
	<link href="cha_files/jquery_004.css" rel="stylesheet">
	
	<!-- Notyfy Notifications Plugin -->
	<link href="cha_files/jquery_002.css" rel="stylesheet">
	<link href="cha_files/default.css" rel="stylesheet">
	
	<!-- Gritter Notifications Plugin -->
	<link href="cha_files/jquery_003.css" rel="stylesheet">
	
	<!-- Easy-pie Plugin -->
	<link href="cha_files/jquery.css" rel="stylesheet">

	<!-- Google Code Prettify Plugin -->
	<link href="cha_files/prettify.css" rel="stylesheet">

	<!-- Bootstrap Image Gallery -->
	<link href="cha_files/bootstrap-image-gallery.css" rel="stylesheet">
	
	<!-- Main Theme Stylesheet :: CSS -->
	<link href="cha_files/style-light.css" rel="stylesheet">
	<!-- cha date javascript -->
	<script src="cha_files/chadate.js" charset="UTF-8" type="text/javascript"></script>
	<script language="JavaScript">

	function doquery()
	{
	 var coursecode = document.frmCourse.course.value

	    self.location='/?page=GradeBook&section=Examination&coursecode=' + coursecode;

	}

	function category(course)
	{

	var cat = document.frmCourse.examcat.value
	var examdate = document.frmCourse.examdate.value
	self.location='/?page=GradeBook&section=Examination&coursecode=' + course +'&cat=' + cat +'&examdate=' + examdate;
	}

	function msgbox(msg1,msg2)
	{

	alert('This is '+ msg1 +' Course please select on '+ msg2 +' to proceed');

	}
	function normalcat(catid,catedisplay,coursecode,examdate)
	{
	    self.location='/?page=GradeBook&section=Examination&catb=' + catid +'&catedisplay=' + catedisplay +'&coursecode=' + coursecode +'&examdate=' + examdate;

	}


	</script>
	<!-- LESS.js Library -->
	<script src="cha_files/less.js"></script>
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style><style type="text/css" id="holderjs-style">.holderjs-fluid {font-size:16px;font-weight:bold;text-align:center;font-family:sans-serif;margin:0}</style><script src="cha_files/l.js" charset="UTF-8" type="text/javascript"></script></head>
<body class="">
	
		<!-- Main Container Fluid -->
	<div class="container-fluid fixed menu-left">
		
		<!-- Top navbar (note: add class "navbar-hidden" to close the navbar by default) -->
		<div class="navbar main hidden-print">
		
			<!-- Wrapper -->
			<div class="wrapper">
			
							
								<!-- Menu Toggle Button -->
				<button type="button" class="btn btn-navbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<!-- // Menu Toggle Button END -->
								
								<!-- Top Menu -->
				<ul class="topnav pull-left tn1 hidden-phone">
				
										
										
						<!--  Notifications -->				
										
					<li class="dropdown dd-1 dd-2">
						<a href="" data-toggle="dropdown">Notifications <span class="count"></span></a>
						<ul class="dropdown-menu pull-left">
							<li><a href="#" class="glyphicons envelope"><i></i> New Email</a></li>
                            <li><a href="#" class="glyphicons chat"><i></i> 5 Messages</a></li>
                            <li><a href="#" class="glyphicons conversation"><i></i> 1 New Reply</a></li>
						</ul>
					</li>
					<!-- end notifications -->
					
				</ul>
				<!-- // Top Menu END -->
								
				<!-- Top Menu Right -->
				<ul class="topnav pull-right">
				
				
					<!-- Dropdown -->
					<li class="dropdown dd-1 visible-desktop">
						<a href="" data-toggle="dropdown" class="glyphicons shield"><i></i>Get Help <span class="caret"></span></a>
						<ul class="dropdown-menu pull-right">
							
							<li class="dropdown submenu">
	                    		<a href="#" class="dropdown-toggle glyphicons bell" data-toggle="dropdown"><i></i>Level 2 » </a>
								<ul class="dropdown-menu submenu-show submenu-hide pull-left">
			                        <li class="dropdown submenu">
			                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Level 2.1 » </a>
										<ul class="dropdown-menu submenu-show submenu-hide pull-left">
											<li><a href="#">Level 2.1.1</a></li>
	                                    	<li><a href="#">Level 2.1.2</a></li>
	                                    	<li><a href="#">Level 2.1.3</a></li>
	                                    	<li><a href="#">Level 2.1.4</a></li>
			                            </ul>
			                        </li>
			                        <li class="dropdown submenu">
			                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Level 2.2 » </a>
			                            <ul class="dropdown-menu submenu-show submenu-hide pull-left">
											<li><a href="#">Level 2.2.1</a></li>
			                                <li><a href="#">Level 2.2.2</a></li>
			                            </ul>
			                        </li>
			                    </ul>
			                </li>
			                
			                <li><a href="" class="glyphicons settings"><i></i>Some option</a></li>
							<li><a href="" class="glyphicons bell"><i></i>Some other option</a></li>
							<li><a href="" class="glyphicons bell"><i></i>Other option</a></li>
			                
						</ul>
					</li>
					<!-- // Dropdown END -->
					
					<!-- Profile / Logout menu -->
					<li class="account dropdown dd-1">
												<a data-toggle="dropdown" href="#" class="glyphicons logout lock"><span class="hidden-phone"><?php echo $chauser; ?></span><i></i></a>
						<ul class="dropdown-menu pull-right">
							<li><a href="#" class="glyphicons cogwheel">Settings<i></i></a></li>
							<li><a href="#" class="glyphicons camera">My Photos<i></i></a></li>
							<li class="profile">
								<span>
									<span class="heading">Profile <a href="#" class="pull-right">edit</a></span>
									<span class="img"></span>
									<span class="details">
										<a href="#"><?php echo $chauser; ?></a>
										<?php echo $chaemail; ?>
									</span>
									<span class="clearfix"></span>
								</span>
							</li>
							<li>
								<span>
									<a class="btn btn-default btn-mini pull-right" href="#">Sign Out</a>
								</span>
							</li>
						</ul>
											</li>
					<!-- // Profile / Logout menu END -->
					
				</ul>
				<!-- // Top Menu Right END -->
				
								
				<div class="clearfix"></div>
			</div>
			<!-- // Wrapper END -->
			
			<span class="toggle-navbar"></span>
		</div>
		<!-- Top navbar END -->
		
				<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">
		
		<!-- Sidebar Menu -->
		<div id="menu" class="hidden-print">
		
			<!-- Brand -->
			<a href="#" class="appbrand">Cha Saris <span>version 0.1 </span></a>
		
			<!-- Scrollable menu wrapper with Maximum height -->
			<div style="position: relative; overflow: hidden; width: auto; height: 1547px;" class="slimScrollDiv"><div style="overflow: hidden; width: auto; height: 1547px;" class="slim-scroll" data-scroll-height="800px">
			
			<!-- Sidebar Profile -->
			<span class="profile">
				<p>Welcome <a href="#"><?php echo $chauser; ?></a></p>
				<a class="img" href="#"><img src="cha_files/avatar-style-light.jpg" alt="Avatar"></a>
				<span>
					<ul>
						<li><a href="" class="glyphicons lock"><i></i>Account</a></li>
						<li><a href="" class="glyphicons keys"><i></i>Password</a></li>
						<li><a href="/?page=Logout" class="glyphicons eject"><i></i>Logout</a></li>
					</ul>
				</span>
			</span>
			<!-- // Sidebar Profile END -->
			
			<!-- Regular Size Menu -->
			<ul class="menu-0">
			
								
								<!-- Menu Regular Item -->
				<li class="glyphicons display active"><a href="/?page=DashBoard"><i></i><span>Dashboard</span></a></li>
				
				<!-- Components Submenu Level 1 -->
				<?php 
				
				cha_activesection("Policy",$section,"menu_PolicySetup","Policy Setup","cogwheels",$module); 
				
						
						//<!-- Components Submenu Regular Items -->
						cha_activebutton("Institution",$page,"/?page=Institution&section=Policy","Institution",$module);
						cha_activebutton("Faculty",$page,"/?page=Faculty&section=Policy","Faculty",$module);
						cha_activebutton("Department",$page,"/?page=Department&section=Policy","Department",$module);
						cha_activebutton("Programme",$page,"/?page=Programme&section=Policy","Programme",$module);
						cha_activebutton("Subject",$page,"/?page=Subject&section=Policy","Subject/Course",$module);
						cha_activebutton("Sponsor",$page,"/?page=Sponsor&section=Policy","Sponsor",$module);
						// Components Submenu Regular Items END -->
						
						
					closemenu("Policy",$module);
						
				
				
					//academic records menu
			 cha_activesection("AcademicRecords",$section,"menu_AcademicRecords","Academic Records","cogwheels",$module); 
			 
			 cha_activebutton("CourseRoster",$page,"/?page=CourseRoster&section=AcademicRecords","Course Roster",$module);
			 cha_activebutton("ExamRegistered",$page,"/?page=ExamRegistered&section=AcademicRecords","Exam Registered",$module);
			 cha_activebutton("ExamResults",$page,"/?page=ExamResults&section=AcademicRecords","Exam Results",$module);
			 
				 
				 
				 closemenu("AcademicRecords",$module);
				 
				
				 //end academic records menu
				
				cha_activesection("Admission",$section,"menu_admission","Admission Process","paperclip",$module);
				
			
			 cha_activebutton("RegistrationForm",$page,"/?page=RegistrationForm&section=Admission","Registration Form",$module);
			 cha_activebutton("GoogleSpeardSheetReg",$page,"/?page=GoogleSpeardSheetReg&section=Admission","GoogleSpreadSheet Reg",$module);
			 cha_activebutton("NorminalRoll",$page,"/?page=NorminalRoll&section=Admission","Norminal Roll",$module);
			 cha_activebutton("AdminStatus",$page,"/?page=AdminStatus&section=Admission","Admin Status",$module);
			 cha_activebutton("SearchStudent",$page,"/?page=SearchStudent&section=Admission","Search Student",$module);
			 cha_activebutton("DeleteStudent",$page,"/?page=DeleteStudent&section=Admission","Delete Student",$module);
			 cha_activebutton("Admission Books",$page,"/?page=AdmissionBooks&section=Admission","Admission Books",$module);
			 cha_activebutton("Course Books",$page,"/?page=CourseBooks&section=Admission","Course Books",$module);
			 
			 closemenu("Admission",$module);
				
 			//<!-- examination Submenu Level 1 -->
 			cha_activesection("Examination",$section,"menu_examination","Examination","pencil",$module);
			
				
 				cha_activebutton("Search",$page,"/?page=Search&section=Examination","Search",$module);
 				cha_activebutton("GradeBook",$page,"/?page=GradeBook&section=Examination","Grade Book",$module);
 				cha_activebutton("ExcelImport",$page,"/?page=ExcelImport&section=Examination","Excel Import",$module);
 				cha_activebutton("CourseResults",$page,"/?page=CourseResults&section=Examination","Course Results",$module);
 				cha_activebutton("FacultyExamAssessment",$page,"/?page=FacultyExamAssessment&section=Examination","Faculty Exam Assessment",$module);	
 				cha_activebutton("AnnualReport",$page,"/?page=AnnualReport&section=Examination","Annual Report",$module);
 				cha_activebutton("SemesterReport",$page,"/?page=SemesterReport&section=Examination","Semester Report",$module);
 				cha_activebutton("CandTranscript",$page,"/?page=CandTranscript&section=Examination","Cand. Transcript",$module);	
 				cha_activebutton("CandStatement",$page,"/?page=CandStatement&section=Examination","Cand. Statement",$module);	
 				cha_activebutton("CumulativePoints",$page,"/?page=CumulativePoints&section=Examination","Cumulative Points",$module);
 				cha_activebutton("ElectiveCourses",$page,"/?page=ElectiveCourses&section=Examination","Elective Courses",$module);
 				cha_activebutton("ExamTimeTable",$page,"/?page=ExamTimeTable&section=Examination","Exam Time Table",$module);	
					
					
 				closemenu("Examination",$module);
							
				//<!-- Administration Submenu Level 1 -->
				cha_activesection("Administration",$section,"menu_administration","Administration","user_add",$module);
				
					 cha_activebutton("StudentRegister",$page,"/?page=StudentRegister&section=Administration","Student Register",$module);
					 cha_activebutton("StudentRemarks",$page,"/?page=StudentRemarks&section=Administration","Student Remarks",$module);
					cha_activebutton("ExamMarker",$page,"/?page=ExamMarker&section=Administration","Exam Marker",$module);	
				    cha_activebutton("PublishExam",$page,"/?page=PublishExam&section=Administration","Publish Exam",$module);
					cha_activebutton("ChangeSemester",$page,"/?page=ChangeSemester&section=Administration","Change Semester",$module);
					cha_activebutton("CourseAllocation",$page,"/?page=CourseAllocation&section=Administration","Course Allocation",$module);
					cha_activebutton("RoomAllocation",$page,"/?page=RoomAllocation&section=Administration","Room Allocation",$module);
						
						
			closemenu("Administration",$module);
			
				//<!-- // Administration Submenu Level 1 END -->
			
			//<!-- Elearning Submenu Level 1 -->
			cha_activesection("E-Learning",$section,"menu_elearning","E-Learning","book",$module);
			
				cha_activebutton("MoodleIntegration",$page,"/?page=MoodleIntegration&section=E-Learning","Moodle Integration",$module);
				cha_activebutton("MoodleCourses",$page,"/?page=MoodleCourses&section=E-Learning","Moodle Courses",$module);
					
				
			closemenu("E-Learning",$module);
				
			//<!-- Communication Submenu Level 1 -->
			cha_activesection("Finance",$section,"menu_finance","Financial Records","coins",$module);
			
				cha_activebutton("TuitionFee",$page,"/?page=TuitionFee&section=Finance","Tuition Fee",$module);
				
					
				
					
				
				
				closemenu("Finance",$module);
				cha_activesection("E-voting",$section,"menu_E-voting","E-voting","random",$module);
			
					cha_activebutton("ElectionVoting",$page,"/?page=ElectionVoting&section=E-voting","Election Voting",$module);
					cha_activebutton("ElectionPost",$page,"/?page=ElectionPost&section=E-voting","Election Post",$module);
					cha_activebutton("SetCandidates",$page,"/?page=SetCandidates&section=E-voting","Set Candidates",$module);
				
					
				
					
				
				
					closemenu("E-voting",$module);
			//<!-- // Communication Submenu Level 1 END -->
				
			
			//<!-- Communication Submenu Level 1 -->
			cha_activesection("Communication",$section,"menu_communication","Communication","envelope",$module);
			
				cha_activebutton("CheckInbox",$page,"/?page=CheckInbox&section=Communication","Check Inbox",$module);
				cha_activebutton("NewsEvents",$page,"/?page=NewsEvents&section=Communication","Suggestion Box ",$module);
					
				
					
				
				
				closemenu("Communication",$module);
			//<!-- // Communication Submenu Level 1 END -->
			
			?>
		</ul>
			<div class="clearfix"></div>
			<!-- // Regular Size Menu END -->
			
			
			<div class="clearfix"></div>
			<div class="separator bottom"></div>
			
						
			
			
			
			<div class="widget-sidebar-stats">
				<h5>Layout Orientation</h5>
				<p>Tick/Untick the boxes below to alter the Layout Orientation to your preference </p>
			</div>
						
						<!-- Menu Position Change -->
			<div class="separator top uniformjs menu_js hidden-phone">
				<div class="innerLR">
					<label for="toggle-menu-position" class="checkbox">
						<div id="uniform-toggle-menu-position" class="checker"><span><input style="opacity: 0;" class="checkbox" id="toggle-menu-position" type="checkbox"></span></div> 
						right menu
					</label>
				</div>
			</div>
			<!-- // Menu Position Change END -->
						
						<!-- Layout Type Change -->
			<div class="uniformjs layout_js hidden-phone">
				<div class="innerLR">
					<label for="toggle-layout" class="checkbox">
						<div id="uniform-toggle-layout" class="checker"><span class="checked"><input style="opacity: 0;" class="checkbox" id="toggle-layout" checked="checked" type="checkbox"></span></div> 
						fixed layout
					</label>
				</div>
			</div>
			<!-- // Layout Type Change END -->
						
			</div>
			<div style="background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px 7px 7px 7px; z-index: 99; right: 1px; height: 1547px;" class="slimScrollBar ui-draggable"></div>
			<div style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px 7px 7px 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;" class="slimScrollRail"></div>
		</div>
			<!-- // Scrollable Menu wrapper with Maximum Height END -->
			
		</div>
		<!-- // Sidebar Menu END -->
				
		<!-- Content -->
		<?php
		
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
				require_once("include/admission/admissionSubject.php");
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
			default :
				require_once("include/dashboard.php");
				break;
		}
		
		
		
		?>



		<!-- // Content END -->
		
				</div>
		
		<!-- // Sidebar menu & content wrapper END -->
				
		<div id="footer" class="hidden-print">
			
			<!--  Copyright Line -->
			<div class="copy">©2013 - Charlie Maere  - Cha-Saris Current version: v0.1 </div>
			<!--  End Copyright Line -->
	
		</div>
		<!-- // Footer END -->
		
	</div>
	<!-- // Main Container Fluid END -->
	

<!-- Themer -->
<div id="themer" class="collapse">
	<div class="wrapper">
		<span class="close2">× close</span>
		<h4>Themer <span>color options</span></h4>
		<ul>
			<li>Theme: <select id="themer-theme" class="pull-right"><option selected="selected" value="0">Default</option><option value="1">Brown</option><option value="2">Purple-Gray</option><option value="3">Purple-Wine</option><option value="4">Blue-Gray</option><option value="5">Green Army</option><option value="6">Black &amp; White</option></select><div class="clearfix"></div></li>
			<li>Primary Color: <span class="minicolors minicolors-position-left"><input value="#8ec657" class="minicolors-hidden" maxlength="7" size="7" data-type="minicolors" data-default="#8ec657" data-slider="hue" data-textfield="false" data-position="left" id="themer-primary-cp" type="text"><span class="minicolors-swatch"><span style="background-color: rgb(142, 198, 87);"></span></span><span class="minicolors-panel minicolors-slider-hue"><span class="minicolors-slider"><span style="top: 112.387px;" class="minicolors-picker"></span></span><span class="minicolors-opacity-slider"><span class="minicolors-picker"></span></span><span style="background-color: rgb(128, 255, 0);" class="minicolors-grid"><span class="minicolors-grid-inner"></span><span style="top: 33px; left: 85px;" class="minicolors-picker"><span></span></span></span></span></span><div class="clearfix"></div></li>
			<li>
				<span class="link" id="themer-custom-reset">reset theme</span>
				<span class="pull-right"><label>advanced <input value="1" id="themer-advanced-toggle" type="checkbox"></label></span>
			</li>
		</ul>
		<div id="themer-getcode" class="hide">
			<hr class="separator">
			<button class="btn btn-primary btn-small pull-right btn-icon glyphicons download" id="themer-getcode-less"><i></i>Get LESS</button>
			<button class="btn btn-inverse btn-small pull-right btn-icon glyphicons download" id="themer-getcode-css"><i></i>Get CSS</button>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- // Themer END -->

	<!-- Modal Gallery -->
	<div id="modal-gallery" class="modal modal-gallery hide fade hidden-print" tabindex="-1">
	    <div class="modal-header">
	        <a class="close" data-dismiss="modal">×</a>
	        <h3 class="modal-title"></h3>
	    </div>
	    <div class="modal-body"><div class="modal-image"></div></div>
	    <div class="modal-footer">
	        <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
	        <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
	        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
	        <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
	    </div>
	</div>
	<!-- // Modal Gallery END -->
	
	<!-- JQuery -->
	<script src="cha_files/jquery_007.js"></script>
	
	<!-- JQueryUI -->
	<script src="cha_files/jquery-ui-1.js"></script>
	
	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="cha_files/jquery_012.js"></script>
	
	
	<!-- Modernizr -->
	<script src="cha_files/modernizr.js"></script>
	
	<!-- Bootstrap -->
	<script src="cha_files/bootstrap.js"></script>
	
	<!-- SlimScroll Plugin -->
	<script src="cha_files/jquery_003.js"></script>
	
	<!-- Common Demo Script -->
	<script src="cha_files/common.js"></script>
	
	<!-- Holder Plugin -->
	<script src="cha_files/holder.js"></script>
	
	<!-- Uniform Forms Plugin -->
	<script src="cha_files/jquery.js"></script>

	<!-- Global -->
	<script>
	var basePath = '../common/';
	</script>
	
	<!-- Bootstrap Extended -->
	<script src="cha_files/bootstrap-select.js"></script>
	<script src="cha_files/jquery_006.js"></script>
	<script src="cha_files/twitter-bootstrap-hover-dropdown.js"></script>
	<script src="cha_files/jasny-bootstrap.js"></script>
	<script src="cha_files/bootstrap-fileupload.js"></script>
	<script src="cha_files/bootbox.js"></script>
	<script src="cha_files/wysihtml5-0.js"></script>
	<script src="cha_files/bootstrap-wysihtml5-0.js"></script>
	
	<!-- Google Code Prettify -->
	<script src="cha_files/prettify.js"></script>
	
	<!-- Gritter Notifications Plugin -->
	<script src="cha_files/jquery_015.js"></script>
	
	<!-- Notyfy Notifications Plugin -->
	<script src="cha_files/jquery_002.js"></script>
	
	<!-- MiniColors Plugin -->
	<script src="cha_files/jquery_016.js"></script>
	
	<!-- DateTimePicker Plugin -->
	<script src="cha_files/bootstrap-datetimepicker.js"></script>

	<!-- Cookie Plugin -->
	<script src="cha_files/jquery_008.js"></script>
	
	<!-- Colors -->
	<script>
	var primaryColor = '#8ec657',
		dangerColor = '#b55151',
		successColor = '#609450',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	</script>
	
	<!-- Themer -->
	<script>
	var themerPrimaryColor = primaryColor;
	</script>
	<script src="cha_files/themer.js"></script>

	
	<!-- Easy-pie Plugin -->
	<script src="cha_files/jquery_017.js"></script>
	
	<!-- Sparkline Charts Plugin -->
	<script src="cha_files/jquery_011.js"></script>
	
	<!-- Ba-Resize Plugin -->
	<script src="cha_files/jquery_005.js"></script>
	
	<!-- Dashboard Demo Script -->
	<script src="cha_files/index.js"></script>
	
	
	<!-- Google JSAPI -->
	<script type="text/javascript" src="cha_files/jsapi.js"></script>
		
	<!--  Flot Charts Plugin -->
	<script src="cha_files/jquery_018.js"></script>
	<script src="cha_files/jquery_014.js"></script>
	<script src="cha_files/jquery_013.js"></script>
	<script src="cha_files/jquery_004.js"></script>
	<script src="cha_files/jquery_010.js"></script>
	<script src="cha_files/jquery_009.js"></script>
	
	<!-- Charts Helper Demo Script -->
	<script src="cha_files/charts.js"></script>
	
	
	<!-- Bootstrap Image Gallery -->
	<script src="cha_files/load-image.html"></script>
	<script src="cha_files/bootstrap-image-gallery.js" type="text/javascript"></script>


<div style="display: none; position: absolute; left: 558px; top: 348px;" id="flotTip"></div></body></html>