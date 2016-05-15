<?php

/*
//include "connect_db.php";

$objConnect = mysql_connect("128.199.133.68","roparty","w,ji^hlbot8iy=");
mysql_select_db('aegis_apps');
mysql_query("SET NAMES UTF8");
if($objConnect)
{
  //echo "conntected";
} else {
	echo "Database Connect Failed.";
}

// Check Expired 

$sql = "SELECT *, DATEDIFF(`expired`, NOW()) FROM `apps_server` WHERE (DATEDIFF(`expired`, NOW())  > 0 AND DATEDIFF(`expired`, NOW())  <=7) OR (DATEDIFF(`feature_share_url`, NOW())  > 0 AND DATEDIFF(`feature_share_url`, NOW())  <=7)";
$rs = mysql_query($sql);

while($rows = mysql_fetch_array($rs)) {
	if($rows['feature_share_url'] != '0000-00-00 00:00:00'){
		$expired = $rows['feature_share_url'];
	} else {
		$expired = $rows['expired'];
	}
	echo $rows['server_name'].$expired."<br/>";
}
*/
?>


<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

//

	$objConnect = mysql_connect("128.199.133.68","roparty","w,ji^hlbot8iy=");
    mysql_select_db('aegis_apps');

    mysql_query("SET NAMES UTF8");
	
	/*for($i = 0; $i <=23; $i++){
		if($i < 10){
			$hr = '0'.$i;
		}
		$sql = "SELECT apps_logs.server_id, server_name, COUNT(id) as rating, COUNT(DISTINCT fb_id) as rating_fb FROM `apps_logs` INNER JOIN apps_server ON apps_logs.server_id=apps_server.server_id WHERE (share_time BETWEEN '2015-04-03 ".$hr.":00:00' AND '2015-04-03 ".$hr.":00:00') AND `share_status` = 'success' GROUP BY apps_logs.server_id ORDER BY rating DESC";
		$rs = mysql_query($sql);
		
		while($rows = mysql_fetch_array($rs)){
			echo $rows['server_id'];
		}
		echo "<br/>==============XXXXX================<br/>";
	}*/

	$sql = "SELECT *, DATEDIFF(`expired`, NOW()) as alert_expired, DATEDIFF(`feature_share_url`, NOW()) as alert_share_url  FROM `apps_server` WHERE (DATEDIFF(`expired`, NOW())  > 0 AND DATEDIFF(`expired`, NOW())  <=7) OR (DATEDIFF(`feature_share_url`, NOW())  > 0 AND DATEDIFF(`feature_share_url`, NOW())  <=7)";
	$rs = mysql_query($sql);
	
	while($rows = mysql_fetch_array($rs)) {
	
		if($rows['feature_share_url'] != '0000-00-00 00:00:00'){
			$expired = $rows['feature_share_url'];
			$alert = $rows['alert_share_url'];
		} else {
			$expired = $rows['expired'];
			$alert = $rows['alert_expired'];
		}
		if ( $alert == 1) {
			send_mail($rows['account_id'], $rows['server_id'], $rows['server_name'], $expired, '(วันสุดท้าย!!)');
		} else if ( $alert == 3 || $alert == 7) {
			send_mail($rows['account_id'], $rows['server_id'], $rows['server_name'], $expired, '');
		}
	}
	
	function send_mail($account_id, $server_id, $server_name, $expired, $alert_msg){
			$sql = "SELECT * FROM apps_member WHERE account_id = '".$account_id."'";
			$rs_member = mysql_query($sql);
			if(mysql_num_rows($rs_member)){
				$rows_member = mysql_fetch_array($rs_member);
				$expired_date = date('d-m-Y', strtotime($expired));
				$expired_time = date('H:i', strtotime($expired));
				$subject = "[เมลแจ้งเตือนการชำระเงิน".$alert_msg.": ".$server_name."]";
				$content = "สวัสดีค่ะ Kafra-Studio<br/><br/>";
				$content .= "ขอแจ้งให้ทราบว่า เซิฟเวอร์ <b>".$server_name."</b> ของคุณ กำลังจะหมดอายุ<br/><br/>";
				$content .= "กรุณาชำระค่าบริการ <span style=\"color:red;\">ภายในวันที่ ".$expired_date." เวลา ".$expired_time." น.</span>";
				$content .= "<br/><br/>ขอแสดงความนับถือ Kafra-Studio";
				echo $content;
				
				try {
						$mail = new PHPMailer(true); //New instance, with exceptions enabled

						$body             = $content; //file_get_contents('contents.html');
						$body             = preg_replace('/\\\\/','', $body); //Strip backslashes
						$body			  = '<html><body>'.$body."</body></html>"; // TEST HTML
						$mail->IsSMTP();                           // tell the class to use SMTP
						$mail->SMTPAuth   = true;                  // enable SMTP authentication
						$mail->Port       = 587;                    // set the SMTP server port
						$mail->Host       = "smtp.gmail.com:587"; // SMTP server
						$mail->Username   = "kafra.studio@gmail.com";     // SMTP server username
						$mail->Password   = "gotoxkiN9uh";            // SMTP server password

						$mail->IsSendmail();  // tell the class to use Sendmail

						$mail->AddReplyTo("kafra.studio@gmail.com","Kafra-Studio Team");
						$mail->From       = "kafra.studio@gmail.com";
						$mail->FromName   = "Kafra-Studio Team";
						
						$mail->AddAddress($rows_member['email'], $server_name);

						$mail->Subject  = "=?UTF-8?B?".base64_encode($subject)."?=";

						$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
						$mail->WordWrap   = 80; // set word wrap

						$mail->MsgHTML($body);

						$mail->IsHTML(true); // send as HTML

						$mail->Send();
			
					mysql_close();
				} catch (phpmailerException $e) {
					echo $e->errorMessage();
				}
			} else {
				echo "error member not found";
			}
	}
	
?>