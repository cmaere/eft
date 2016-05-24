<?php
require_once('PHPMailer/class.phpmailer.php');
require 'PHPMailer/PHPMailerAutoload.php';

class email{
	
function emailWithAttach($attname,$sendTo){	
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'onlineuniversity.application@gmail.com';
$mail->Password = 'Bsc/74/10';
$mail->SMTPSecure = 'tls';
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->addAttachment($attname);
$mail->From = 'onlineuniversity.application@gmail.com';
$mail->FromName = 'chiku phiri';
$mail->addAddress($sendTo, 'bank');
$mail->addReplyTo('onlineuniversity.application@gmail.com', 'you');
 
$mail->WordWrap = 50;
$mail->isHTML(true);
 
$mail->Subject = 'Encryption file';
$mail->Body    = 'Please find the attached encryption file';
 
if($mail->send()) {
 
return true;			
				
	}
}

function emailWithoutAttach($name, $purpose, $email){

			$m = new PHPMailer;
			$m -> isSMTP();
			$m -> SMTPAuth = true;
			//$m -> SMTPDebug = 2;
			$m -> Host = 'smtp.gmail.com';
			$m -> Username = 'onlineuniversity.application@gmail.com';
			$m -> Password = 'Bsc/74/10';
			$m -> SMTPSecure = 'ssl';
			$m -> Port = 465;
  
			//include the parameters for sending email
			$m -> From = 'phirichiku@gmail.com';
			$m -> FromName = 'Kamuzu College of Nursing';
			$m -> addReplyTo('phirichiku@gmail.com','chiku');
			$m -> Subject = "Subsistence Allowance";
			
			//some fields e.g addCC have been removed/jumped
			$m -> addAddress($email,$name);

			//want to send an html email
			$m -> isHTML(true);
			$body = 'Dear <h2>'.$name.'</h2> <br />';
			$body .= $purpose;
			$m -> Body = $body;
		
			if ($m -> send()){
				return true;	
			}
	}


}

?>