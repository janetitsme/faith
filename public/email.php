<!--http://www.codingcage.com/2016/03/how-to-send-html-emails-in-php-with.html-->
<?php
function sendEmail($to,$subject,$body)
	{
		require('class.phpmailer.php');
		$from	="dsouzaj@mudfoot.doc.stu.mmu.ac.uk";
		$mail=new PHPMailer();
		$mail->IsSMTP(true);		//use SMTP
		//$email->IsHTML(true);
		$mail->SMTPDebug=0;			//enable SMTP authentication
		$mail->SMTPAuth=true;		
		$mail->SMTPSecure="ssl";
		$mail->Host="mudfoot.doc.stu.mmu.ac.uk";  //SMTP host
		$mail->Port=22;
		$mail->Username="dsouzaj";
		$mail->Password="grIshlam9";
		$mail->SetFrom($from,'Faith Hair & Beauty');
		$mail->AddReplyTo($from,'Faith Hair & Beauty');
		$mail->Subject=$subject;
		$mail->MsgHTML($body);
		$mail->addAddress($email,$to);
		
		if(!$mail->Send())
			echo "Mailer Error" . $mail->ErrorInfo;
		else
			echo "Message has been sent";
	}
	?>
