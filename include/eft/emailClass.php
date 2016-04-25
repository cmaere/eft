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
}

?>