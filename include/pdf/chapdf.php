<?php

require_once('include/connection/chaconnect.php');
//require_once("include/functions.php");
//start pdf
if (isset($_POST['printPDF']) && ($_POST['printPDF'] == "Print PDF")) {
	
	#get connected to the database and verfy current session
	
	include('include/pdf/PDF.php');
	
	#get post values
	$year = addslashes($_POST['cohot']);
	$degree = addslashes($_POST['degree']);
	$list = addslashes($_POST['list']);
	$faculty = addslashes($_POST['faculty']);
	$display = addslashes($_POST['display']);
	$ryear = addslashes($_POST['ayear']);
	#create report title
	if($display==1){
	$title = 'LIST OF ALL STUDENTS ACCEPTED IN '.$ryear.' ACADEMIC YEAR';
	}elseif($display==2){
	$title = 'LIST OF STUDENTS REGISTERED IN '.$ryear.' ACADEMIC YEAR';
	}else{
	$title = 'LIST OF STUDENTS NOT REGISTERED IN '.$ryear.' ACADEMIC YEAR';
	}
	#get programme name
	$qprogram = "SELECT ProgrammeName FROM programme WHERE ProgrammeCODE ='$degree'";
	$dbprogram = mysql_query($qprogram);
	$row_program = mysql_fetch_assoc($dbprogram);
	$pname = $row_program['ProgrammeName'];
	#create grouplist tiltes
	if($list==1){
	$listitle = 'OF ALL STUDENTS';
	}elseif($list==2){
	$listitle = $pname;
	}else{
	$listitle = $faculty;
	}
	if ($list ==1){
		$sql = "SELECT student.Id,
				   student.Name,
				   student.RegNo,
				   student.Sex,
				   student.Faculty,
				   student.EntryYear,
				   student.Sponsor,
				   student.Status,
				   student.ProgrammeofStudy
       
				FROM student
				WHERE 
  					 (
      					(student.EntryYear='$year') AND
						(student.ProgrammeofStudy <> '10103')
   					 )
								ORDER BY  student.Faculty, 
								student.ProgrammeofStudy, 
								student.Name";
	}elseif ($list ==2){
		$sql = "SELECT student.Id,
				   student.Name,
				   student.RegNo,
				   student.Sex,
				   student.Faculty,
				   student.EntryYear,
				   student.Sponsor,
				   student.Status,
				   student.ProgrammeofStudy
				FROM student
				WHERE 
  					 (
						(student.EntryYear='$year') AND 
						(student.ProgrammeofStudy = '$degree') AND
						(student.ProgrammeofStudy <> '10103')
   					 )
						ORDER BY  student.Faculty, 
						student.ProgrammeofStudy, student.Name";
		}else{
				$sql = "SELECT student.Id,
				   student.Name,
				   student.RegNo,
				   student.Sex,
				   student.Faculty,
				   student.EntryYear,
				   student.Sponsor,
				   student.ProgrammeofStudy,
				   student.Status
				FROM faculty, student
				WHERE 
  					 (
      					(student.faculty = faculty.FacultyName) AND
						(student.EntryYear=$year) AND 
						(student.faculty = '$faculty')AND
						(student.ProgrammeofStudy <> '10103')
   					 )
						ORDER BY  student.Faculty, 
						student.ProgrammeofStudy, student.Name";
		}

		$result = mysql_query($sql) or die("Cannot query the database.<br>" . mysql_error());
		$query = mysql_query($sql) or die("Cannot query the database.<br>" . mysql_error());
		//die($sql);
		$all_query = mysql_query($sql) or die("Cannot queryee the database.<br>" . mysql_error());
		$totalRows_query = mysql_num_rows($query);
		/* Printing Results in html */
		if (mysql_num_rows($query) > 0)
		{
				#Get Organisation Name
				$qorg = "SELECT * FROM organisation";
				$dborg = mysql_query($qorg);
				$row_org = mysql_fetch_assoc($dborg);
				$org = $row_org['Name'];
				$ptname = $row_org['ParentName'];
				$address = $row_org['Address'];
				$phone = $row_org['tel'];
				$fax = $row_org['fax'];
				$email = $row_org['email'];
				$website = $row_org['website'];
				$city = $row_org['city'];
				
				#get degree programme
				$qprogram = "SELECT ProgrammeName FROM programme WHERE ProgrammeCODE ='$degree'";
				$dbprogram = mysql_query($qprogram);
				$row_program = mysql_fetch_assoc($dbprogram);
				$degree = $row_program['ProgrammeName'];
				
				$pdf = &PDF::factory('p', 'a4');      // Set up the pdf object. 
				$pdf->open();                         // Start the document. 
				$pdf->setCompression(true);           // Activate compression. 
				$pdf->addPage();  
				#put page header
			
				$x=50;
				$y=200;
				$i=1;
				$pg=1;
				//$i=1;
				#count unregistered
				$j=0;
				#count sex
				$$fmcount = 0;
				$$mcount = 0;
				$$fcount = 0;
				#print header
				//$pdf->image('../images/logo.jpg', 260, 37);   
				$pdf->setFont('Arial', 'I', 8);     
				$pdf->text(530.28, 825.89, 'Page '.$pg);  
				if($display==1){
				$pdf->text(50, 825.89, 'Printed On '.$today = date("d-m-Y H:i:s"));   
				}else{
				$pdf->text(50, 825.89, 'Printed On '.$today = date("d-m-Y H:i:s"));   
				} 
				
				include 'include/pdf/orgheader.php';
				$pdf->setFillColor('rgb', 0, 0, 0);   
				$pdf->setFont('Arial', '', 13);     
				$pdf->text(80, 170, strtoupper($listitle).': '. $year.' - NOMINAL ROLL REPORT ('.$class.$sups.') YEAR STUDENTS'); 
				$pdf->setFillColor('rgb', 0, 0, 0);   
				
				$pdf->setFillColor('rgb', 0, 0, 0);   
				$pdf->setFont('Arial', 'B', 11);   
				$pdf->setFillColor('rgb', 0, 0, 0);   
		
				$pdf->text($x, $y, 'S/N'); 
				$pdf->text($x+40, $y, 'Name'); 
				$pdf->text($x+240, $y, 'RegNo'); 
				$pdf->text($x+405, $y, 'Sex'); 
				$pdf->text($x+427, $y, 'Programme'); 
				$pdf->setFont('Arial', '', 11);     
				
				$pdf->line($x, $y-15, 570.28, $y-15);       
				$pdf->line($x, $y+3, 570.28, $y+3);       
				$pdf->line($x, $y-15, $x, $y+3);              
				$pdf->line($x+25, $y-15, $x+25, $y+3);              
				$pdf->line($x+221, $y-15, $x+221, $y+3);             
				$pdf->line($x+402, $y-15, $x+402, $y+3);             
				$pdf->line($x+425, $y-15, $x+425, $y+3);             
				$pdf->line(570.28, $y-15, 570.28, $y+3);      
				$pdf->line($x, $y+19, 570.28, $y+19);      
				
				while($result = mysql_fetch_array($query)) {
					$id = stripslashes($result["Id"]);
					$Name = stripslashes($result["Name"]);
					$RegNo = stripslashes($result["RegNo"]);
					$sex = stripslashes($result["Sex"]);
					$degreecode = stripslashes($result["ProgrammeofStudy"]);
					$faculty = stripslashes($result["Faculty"]);
					$sponsor = stripslashes($result["Sponsor"]);
					
					#get study programe name
					$qprogram = "SELECT ProgrammeName FROM programme WHERE ProgrammeCODE ='$degreecode'";
					$dbprogram = mysql_query($qprogram);
					$row_program = mysql_fetch_assoc($dbprogram);
					$degree = $row_program['ProgrammeName'];
					#check if the candidate has registered to a course in this current year
					$qstatus = "SELECT DISTINCT RegNo FROM examresult WHERE RegNo='$RegNo' AND AYear='$ryear'";
					$dbstatus = mysql_query($qstatus);
					$statusvalue = mysql_num_rows($dbstatus);
					if($statusvalue>0){
					$status  = stripslashes($result["Status"]);
					}else{
					#check in examregister
						$qstatus = "SELECT DISTINCT RegNo FROM examregister WHERE RegNo='$RegNo' AND AYear='$ryear'";
						$dbstatus = mysql_query($qstatus);
						$statusvalue = mysql_num_rows($dbstatus);
						if($statusvalue>0){
							$status  = stripslashes($result["Status"]);
							}else{
							$status = 'Not Registered';
							$j=$j+1;
							}
					}
					#get line color
					$remainder = $i%2;
					if ($remainder==0){
						$linecolor = 1;
					}else{
					 $linecolor = 2;//'bgcolor="#FFFFFF"';
					}
					
					if($display==1){
						if($status === 'Not Registered'){
						$pdf->setFillColor('rgb', 1, 0, 0); 
                        $pdf->text($x+336, $y+15, '(NOT REG)'); 
						}else{
						$pdf->setFillColor('rgb', 0, 0, 0);  
						}
						
						$pdf->text($x, $y+15, $i); 
						$pdf->text($x+30, $y+15, $Name); 
						$pdf->text($x+226, $y+15, $RegNo); 
						$pdf->text($x+405, $y+15, $sex); 
						$pdf->text($x+427, $y+15, substr($degree,0,26)); 
			            $pdf->setFillColor('rgb', 0, 0, 0);
						$i=$i+1;
						if ($sex=='F'){
							$fcount = $fcount +1;
						}elseif($sex=='M'){
							$mcount = $mcount +1;
						}else{
							$fmcount = $fmcount +1;
						}
                        // cha edit nominal roll lines
						$x=$x;
						$y=$y+15;
						$pdf->line(50, $y-15, 50, $y);               
						$pdf->line($x, $y+3, 570.28, $y+3);     
						$pdf->line($x, $y-15, $x, $y+3);              
						$pdf->line($x+25, $y-15, $x+25, $y+3);               
						$pdf->line($x+221, $y-15, $x+221, $y+3);               
						$pdf->line($x+402, $y-15, $x+402, $y+3);  
                            //line on gender                        
						$pdf->line($x+425, $y-15, $x+425, $y+3);               
						$pdf->line(570.28, $y-15, 570.28, $y+3);      
					}elseif($display==2){
						if($status <>'Not Registered'){
						$pdf->text($x, $y+15, $i); 
						$pdf->text($x+30, $y+15, $Name); 
						$pdf->text($x+226, $y+15, $RegNo); 
						$pdf->text($x+405, $y+15, $sex); 
						$pdf->text($x+427, $y+15, substr($degree,0,26)); 
						
						$i=$i+1;
						if ($sex=='F'){
							$fcount = $fcount +1;
						}elseif($sex=='M'){
							$mcount = $mcount +1;
						}else{
							$fmcount = $fmcount +1;
						}
						$x=$x;
						$y=$y+15;
						$pdf->line(50, $y-15, 50, $y);               
						$pdf->line($x, $y+3, 570.28, $y+3);     
						$pdf->line($x, $y-15, $x, $y+3);              
						$pdf->line($x+35, $y-15, $x+35, $y+3);               
						$pdf->line($x+231, $y-15, $x+231, $y+3);               
						$pdf->line($x+340, $y-15, $x+340, $y+3);                
						$pdf->line($x+370, $y-15, $x+370, $y+3);               
						$pdf->line(570.28, $y-15, 570.28, $y+3);      
					  }
					}else{
						if($status === 'Not Registered'){
						$pdf->text($x, $y+15, $i); 
						$pdf->text($x+30, $y+15, $Name); 
						$pdf->text($x+226, $y+15, $RegNo); 
						$pdf->text($x+405, $y+15, $sex); 
						$pdf->text($x+427, $y+15, substr($degree,0,26));  
						$i=$i+1;
						if ($sex=='F'){
							$fcount = $fcount +1;
						}elseif($sex=='M'){
							$mcount = $mcount +1;
						}else{
							$fmcount = $fmcount +1;
						}
						$x=$x;
						$y=$y+15;
						$pdf->line(50, $y-15, 50, $y);               
						$pdf->line($x, $y+3, 570.28, $y+3);     
						$pdf->line($x, $y-15, $x, $y+3);              
						$pdf->line($x+35, $y-15, $x+35, $y+3);               
						$pdf->line($x+231, $y-15, $x+231, $y+3);               
						$pdf->line($x+340, $y-15, $x+340, $y+3);                
						$pdf->line($x+370, $y-15, $x+370, $y+3);               
						$pdf->line(570.28, $y-15, 570.28, $y+3);      
					  }
					}

			
					if ($y>800){
						#put page header
						//include('PDFTranscriptPageHeader.inc');
						$pdf->addPage();  
						$x=50;
						$y=50;
						$pg=$pg+1;
				
						$pdf->setFont('Arial', 'I', 11);     
						$pdf->text(530.28, 825.89, 'Page '.$pg);   
						if($display==1){
						$pdf->text(50, 825.89, 'Printed On '.$today = date("d-m-Y H:i:s"));   
						}else{
						$pdf->text(50, 825.89, 'Printed On '.$today = date("d-m-Y H:i:s"));   
						} 
						
						$pdf->setFillColor('rgb', 0, 0, 0);   
						$pdf->setFont('Arial', 'B', 11);   
						$pdf->setFillColor('rgb', 0, 0, 0);   

						$pdf->text($x, $y, 'S/N'); 
				$pdf->text($x+40, $y, 'Name'); 
				$pdf->text($x+240, $y, 'RegNo'); 
				$pdf->text($x+405, $y, 'Sex'); 
				$pdf->text($x+427, $y, 'Programme'); 
				$pdf->setFont('Arial', '', 11);     
				
				$pdf->line($x, $y-15, 570.28, $y-15);       
				$pdf->line($x, $y+3, 570.28, $y+3);       
				$pdf->line($x, $y-15, $x, $y+3);              
				$pdf->line($x+25, $y-15, $x+25, $y+3);              
				$pdf->line($x+221, $y-15, $x+221, $y+3);             
				$pdf->line($x+402, $y-15, $x+402, $y+3);             
				$pdf->line($x+425, $y-15, $x+425, $y+3);             
				$pdf->line(570.28, $y-15, 570.28, $y+3);      
				$pdf->line($x, $y+19, 570.28, $y+19);       
					}
			 }//ends while loop
					if ($y>763){
						#put page header
						//include('PDFTranscriptPageHeader.inc');
						$pdf->addPage();  
						$x=50;
						$y=50;
						$pg=$pg+1;
				
						$pdf->setFont('Arial', 'I', 11);     
						$pdf->text(530.28, 825.89, 'Page '.$pg);   
						if($display==1){
						$pdf->text(50, 825.89, 'Printed On '.$today = date("d-m-Y H:i:s"));   
						}else{
						$pdf->text(50, 825.89, 'Printed On '.$today = date("d-m-Y H:i:s"));   
						} 
						
						$pdf->setFillColor('rgb', 0, 0, 0);   
						$pdf->setFont('Arial', 'B', 11);   
						$pdf->setFillColor('rgb', 0, 0, 0);   

						$pdf->text($x, $y, 'S/N'); 
                        $pdf->text($x+50, $y, 'Name'); 
                        $pdf->text($x+250, $y, 'RegNo'); 
                        $pdf->text($x+415, $y, 'Sex'); 
                        $pdf->text($x+450, $y, 'Programme'); 
                        $pdf->setFont('Arial', '', 8);     
                        
                        $pdf->line($x, $y-15, 570.28, $y-15);       
                        $pdf->line($x, $y+3, 570.28, $y+3);       
                        $pdf->line($x, $y-15, $x, $y+3);              
                        $pdf->line($x+35, $y-15, $x+35, $y+3);              
                        $pdf->line($x+231, $y-15, $x+231, $y+3);             
                        $pdf->line($x+412, $y-15, $x+412, $y+3);             
                        $pdf->line($x+446, $y-15, $x+446, $y+3);             
                        $pdf->line(570.28, $y-15, 570.28, $y+3);      
                        $pdf->line($x, $y+19, 570.28, $y+19);      
					}
			$pdf->setFillColor('rgb', 0, 0, 0);
			$gt=$i-1;
			$pdf->text(50, $y+20, 'Grand Total: '.$gt);  

			if ($display==1){
			$pdf->setFillColor('rgb', 1, 0, 0);
			$pdf->text(50, $y+40, 'Total Unregistered Students  are: '.$j.'('.round($j/$gt*100,2).'%) - SEE THE RED LINES!');  
			$pdf->setFillColor('rgb', 0, 0, 0);
			}
			$pdf->text(50, $y+60, 'Total Female Students are: '.$fcount.'('.round($fcount/$gt*100,2).'%)');  
			$pdf->text(50, $y+80, 'Total Male Students are: '.$mcount.'('.round($mcount/$gt*100,2).'%)'); 
			if($fmcount<>0){
			$pdf->text(50, $y+100, 'Total Male/Female Unspecified Students are '.$fmcount.'('.round($fmcount/$gt*100,2).'%)'); 
			}

			//$pdf->text(200.28, 800.89, '.........................................................        ............................');   // Text at x=100 and y=100. 						
			//$pdf->text(200.28, 810.89, '          For Chief Academic Officer                    Date');   // Text at x=100 and y=100. 						
			$pdf->setFont('Arial', 'I', 8);     // Set font to arial bold italic 12 pt. 
			$pdf->output($year.'-nominalroll'.'.pdf');              // Output the 
		}else{echo "Sorry, No Records Found <br>";
	}
	exit;
	
}

?>