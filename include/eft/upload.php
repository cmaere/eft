


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
		//check if encryption file has been attached
		if(!empty($_FILES['encry']['name']))
		{

				$testEmail=new email;

				$sendTo= $_POST['email'];
				
				//directory to keep temporary files
				$dir = "images/";
				
				$attNametmp = $_FILES['encry']['tmp_name'];
				$attName = $_FILES['encry']['name'];
				$directory=$dir.$attName;
				
				move_uploaded_file($attNametmp,$directory);
															
				//check if email has been sent successfully
				if($testEmail->emailWithAttach($directory,$sendTo))
				{
				
					 
					$file = $_FILES['csv']['tmp_name'];
					$handle = fopen($file,"r");
					
					//count to keep track of how many rows in a csv file
					$count=0;
						while (($fileop = fgetcsv($handle, 1000, ",")) !== FALSE)
						{
								$FirstName= $fileop[0];
								$LastName=$fileop[1];
								//to get only last 9 digits
								$phoneNumber= substr($fileop[2],-9);
								$purpose= $fileop[3];
								$amount= $fileop[4];
								$count++;
				
							$sql=mysqli_query($cha,"INSERT INTO sms_list (fname,lname,phone_number,purpose,amount)
							VALUES ('$FirstName','$LastName','$phoneNumber','$purpose','$amount')");
						}
						if($sql)
						{
					
							$query = "SELECT * FROM sms_list ORDER BY id DESC limit ".$count."";
			 
							$list = mysqli_query($cha,$query);
				 
							//push name purpose and phoneNumber into an array
							while($rows = mysqli_fetch_array($list))
							{
								$list_array[] = array(
									'fname' => $rows['fname'],
									'purpose' => $rows['purpose'],
									'phone_number'=>'+265'.$rows['phone_number']
								);
							} 
				 
				 
								foreach($list_array as $detail):
								$name = $detail['fname'];
								$purpose = $detail['purpose'];
								$phoneNumber = $detail['phone_number'];
					
		
								$client = new Services_Twilio($sid, $token);
								$message = $client->account->messages->sendMessage(
								$hostnumber, // From a valid Twilio number
								$phoneNumber, // Text this number
								$purpose	//message
								);
							endforeach;	
				
							echo "successful";
						}	
	
				}else
				{
					echo "email send failed";
				}		
		}
		else
		{
			echo "encryption file not attached";
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


