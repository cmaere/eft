
<?php

$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];

	

// upload form action processing
if ((isset($_POST["submit"])) && ($_POST["submit"] == "upload")) 
	{
		
			$file = $_FILES['csv']['tmp_name'];
			$handle = fopen($file,"r");
			while (($fileop = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$FirstName= $fileop[0];
				$LastName=$fileop[1];
				$phoneNumber= $fileop[2];
				$purpose= $fileop[3];
				$amount= $fileop[4];
				
		       $sql=mysqli_query($cha,"INSERT INTO sms_list (fname,lname,phone_number,purpose,amount)
			   VALUES ('$FirstName','$LastName','$phoneNumber','$purpose','$amount')");
			}
		if($sql){
			 $query = "SELECT * FROM sms_list limit 3";
				 $list = mysqli_query($cha,$query);
				 
				 //push name purpose and phoneNumber into the array
				 while($rows = mysqli_fetch_array($list))
				 {
					 $list_array[] = array(
					       'fname' => $rows['fname'],
						   'purpose' => $rows['purpose'],
						   'phone_number'=>$rows['phone_number']
					 );
				 } 
				 
				 //
				foreach($list_array as $detail):
					$name = $detail['fname'];
					$purpose = $detail['purpose'];
					$phoneNumber = $detail['phone_number'];
					
					echo $name. '  '.$purpose.'		'.$phoneNumber;
				endforeach;	
				
				 } 
			
		}
			
	
		
			
	/* Send an SMS using Twilio. You can run this file 3 different ways:
     *
     * - Save it as sendnotifications.php and at the command line, run 
     *        php sendnotifications.php
     *
     * - Upload it to a web host and load mywebhost.com/sendnotifications.php 
     *   in a web browser.
     * - Download a local server like WAMP, MAMP or XAMPP. Point the web root 
     *   directory to the folder containing this file, and load 
     *   localhost:8888/sendnotifications.php in a web browser.
    
 
    // Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
    // and move it into the folder containing this file.
    require "twilio-php-master/Services/Twilio.php";
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "AC2ae7750dd060fb55405b80d626a048a5";
    $AuthToken = "4967af20455dacf0e39f6f00b27fc429";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    $people = array(
        "+265992227931" => "chiku haclin felix augustine phiri",
       // "+14158675310" => "Boots",
        //"+14158675311" => "Virgil",
    );
 
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    foreach ($people as $number => $name) {
 
        $sms = $client->account->messages->sendMessage(
 
        // Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the (deprecated) Sandbox number
            "+13343758476", 
 
            // the number we are sending to - Any phone number
            $number,
 
            // the sms body
            "Hey $name, Monkey Party at 6PM. Bring Bananas!"
        );
 
        // Display a confirmation message on the screen
        echo "Sent message to $name";
    } 
			
		}
			
	}
*/

// display to common template	
	
$template->loadTemplateFile("common_header.tpl");
$template->setCurrentBlock("heading");
$template->setVariable("PAGENAME", "EFT");	
$template->setVariable("LINK", "./?page=$page&section=$section&new=1");
$template->setVariable("BUTTONNAME", "Add New Institution");		
$template->parseCurrentBlock();	
$template->show();

	
?>


