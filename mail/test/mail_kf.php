<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = file_get_contents('contents.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = false;                  // enable SMTP authentication
	$mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       = ""; // SMTP server
	$mail->Username   = "";     // SMTP server username
	$mail->Password   = "";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("kafra.studio@gmail.com","Kafra-Studio.com");

	$mail->From       = "localhost";
	$mail->FromName   = "Kafra-Studio.com";

	$to = "nathe.cha@gmail.com";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>