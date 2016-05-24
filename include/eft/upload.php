


<?php



$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];
require('twilio-php/Services/Twilio.php');
include "emailClass.php";

$sid = "ACd5d53455218578f6c3d4ce3c3b0bc841"; // Your Account SID from www.twilio.com/user/account
$token = "1638e6090ec3b8cce3c250129f76c679"; // Your Auth Token from www.twilio.com/user/account
$hostnumber = '+19804042807';
	

// upload form action processing
if ((isset($_POST["submit"])) && ($_POST["submit"] == "upload"))	
	{
		//check if encryption file and csv file has been attached
		if(!empty($_FILES['encry']['name'])&& !empty($_FILES['csv']['tmp_name']))
		{
									
				$testEmail=new email;

				$sendTo= $_POST['email'];
				
				//directory to keep temporary files
				$dir = "images/";
				
				$attNametmp = $_FILES['encry']['tmp_name'];
				$attName = $_FILES['encry']['name'];
				$directory=$dir.$attName;
				
				move_uploaded_file($attNametmp,$directory);
																		
					 
					$file = $_FILES['csv']['tmp_name'];
					$handle = fopen($file,"r");
					
						$tesEmail=new email;
						
						while (($fileop = fgetcsv($handle, 1000, ",")) !== FALSE)
						{
								$FirstName= $fileop[0];
								$LastName=$fileop[1];
								//to get only last 9 digits
								$phoneNumber= substr($fileop[2],-9);
								$purpose= $fileop[3];
								$amount= $fileop[4];
								$emailAdd=$fileop[5];
								$count++;


							//Phone number validation
							if(!(preg_match("/^[0-9]{9}$/", $phoneNumber))) {							
								$ErrorMessage = $FirstName."'s".' '."phone number is invalid, try again";
								echo	'<script language="javascript">';
								echo 'alert("'.$ErrorMessage.'");'; 
								echo	'</script>';
							}else{
								
								//format number for sending using twilio api
								$phoneNum='+265'.$phoneNumber;
								
								$client = new Services_Twilio($sid, $token);
								$message = $client->account->messages->sendMessage(
								$hostnumber, // From a valid Twilio number
								$phoneNum, // Text this number
								$purpose	//message
								); 

								//send email
								$tesEmail->emailWithoutAttach($name,$purpose,$emailAdd);
							
							$sql=mysqli_query($cha,"INSERT INTO sms_list (fname,lname,phone_number,purpose,amount,email)
							VALUES ('$FirstName','$LastName','$phoneNumber','$purpose','$amount','$emailAdd')");
							}
						}
						
				//check if email has been sent successfully
				if($testEmail->emailWithAttach($directory,$sendTo))
				{															   	
							
							echo	'<script language="javascript">';
							echo	'	alert("emails and messages sent successfully")';
							echo	'</script>';
 
				}
				else
				{
					echo	'<script language="javascript">';
					echo	'	alert("email not sent, check that you have entered the right email address")';
					echo	'</script>';
				}
						
		}
		else
		{
					echo	'<script language="javascript">';
					echo	'	alert("make sure you upload both an encryption file and a CSV file")';
					echo	'</script>';
		}
	}	
	
// display to common template	
	
$template->loadTemplateFile("common_header.tpl");
$template->setCurrentBlock("heading");
$template->setVariable("PAGENAME", "EFT");	
$template->setVariable("LINK", "./?page=$page&section=$section&new=1");
$template->setVariable("BUTTONNAME", "Add New Institution");		
$template->parseCurrentBlock();	
$template->show();

	
?>


