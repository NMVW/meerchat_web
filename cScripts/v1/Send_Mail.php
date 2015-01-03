<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from = "team.meerchat@bafit.mobi";
$mail = new PHPMailer();
$mail->IsSMTP(true); // SMTP
$mail->SMTPAuth   = true;  // SMTP authentication
$mail->Mailer = "smtp";
$mail->Host       = "tls://email-smtp.us-west-2.amazonaws.com"; // Amazon SES server, note "tls://" protocol
$mail->Port       = 465;                    // set the SMTP port
$mail->Username   = "AKIAJYHTUAE6XWUFGWJA";  // SES SMTP  username
$mail->Password   = "AqbK9I/bIyOroeV9qmaAQEINwjPUXmUBtdBsT1l2kdcu";  // SES SMTP password
$mail->SetFrom($from, 'team meerchat');
$mail->AddReplyTo($from,'team meerchat');
$mail->Subject = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);

if(!$mail->Send())
return false;
else
return true;

}
?>
