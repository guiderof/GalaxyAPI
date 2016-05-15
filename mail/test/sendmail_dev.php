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
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 587;                    // set the SMTP server port
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Username   = "kafra.studio@gmail.com";     // SMTP server username
	$mail->Password   = "gotoxkiN9uh";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("kafra.studio@gmail.com","Kafra-Studio Team");

	$mail->From       = "kafra.studio@gmail.com";
	$mail->FromName   = "Kafra-Studio Team";
/*
	$objConnect = mysql_connect("128.199.133.68","roparty","w,ji^hlbot8iy=");
    mysql_select_db('roparty');
	$sql = "SELECT DISTINCT a.email, userid FROM  `event_reward_log` a INNER JOIN `login` b ON a.account_id=b.account_id WHERE  `code` = 100";
	$rs = mysql_query($sql);
	while($rows = mysql_fetch_array($rs)){
		$to[$rows['email']] = $rows['userid'];
	}
	mysql_close();
*/
	$objConnect = mysql_connect("128.199.133.68","roparty","w,ji^hlbot8iy=");
    mysql_select_db('aegis_apps');
	$sql = "SELECT DISTINCT email, userid FROM  `apps_member` WHERE email != ''";
	$rs = mysql_query($sql);
	while($rows = mysql_fetch_array($rs)){
		$to[$rows['email']] = $rows['userid'];
	}
	mysql_close();
/*	
	$to = array(
		"nathe.cha@gmail.com" => "Nathe Cha",
		"beam45203@hotmail.com" => "BeaMu :D",
		"seraph_numfar@hotmail.com" => "Littlez AingAomm!!"
	);
*/
	print_r($to);
	
	foreach($to as $email => $name)
	{
   		$mail->AddAddress($email, $name);
	}

	$mail->Subject  = "=?UTF-8?B?".base64_encode("Kafra-Studio Apps Newsletter")."?=";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML
	if(isset($_POST['sendmail']) && $_POST['sendmail']=="kafrapartymail"){
		$mail->Send();
		echo 'Message has been sent to '.sizeof($to)." users";
	}
	
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>

<form action="" method="post">
<input type="password" name="sendmail" placeholder="password"/>
<input type="submit" value="send"/>
</form>