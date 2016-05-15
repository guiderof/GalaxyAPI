
<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {

	$mail = new PHPMailer(true); //New instance, with exceptions enabled
	$customer_email = $_GET['customer_email'];
	$body             = "SKU: " .$_GET['sku'] ."<br/>";
	$body			  .= "Customer Name: ". $_GET['customer_name'] . "<br/>";
	$body			  .= "Order Id: ". $_GET['order_id'] . "<br/>";
	$body             .= "Total Price : " . $_GET['price'] ." THB";
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes
	$body			  = '<html><body>'.$body."</body></html>"; // TEST HTML
	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 587;                    // set the SMTP server port
	$mail->Host       = "smtp.gmail.com:587"; // SMTP server
	$mail->Username   = "nathe.cha@gmail.com";     // SMTP server username
	$mail->Password   = "";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("kwanradee@readyplanet.com","ReadyGalaxy Team");
	$mail->From       = "kwanradee@readyplanet.com";
	$mail->FromName   = "ReadyGalaxy Team";
	$mail->AddAddress($_GET['customer_email'], $_GET['customer_name']);

	$mail->Subject  = "=?UTF-8?B?".base64_encode("PRODUCT ORDER DETAIL!!")."?=";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML
	$mail->Send();
	echo 'Message has been sent to '.$_GET['customer_email']."<br/>";
	//http://chaos.aegisthai.net:8880/readygalaxy/phpmail/test/sendmail.php?customer_email=nathe.cha@gmail.com&price=50&order_id=001&sku=1234&price=50&customer_name=nathebot

} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>
