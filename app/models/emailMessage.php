<? class emailMessage {

    var $to;
    var $subject;
    var $body;

     
    
        function __construct() {


    }


    function send(){


$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.sendgrid.net';
	$mail->Port = 465; 
	$mail->Username = OUTGOINGEMAIL;  
	$mail->Password = OUTGOINGEMAILPASS;           
	$mail->SetFrom(OUTGOINGEMAIL, OUTGOINGEMAILNAME);

	$mail->Subject = $this->subject;
	$mail->Body = $this->body;
	if(is_array($this->to)){
		foreach($this->to as $recipient) $mail->AddAddress($recipient);
	}else{
		$mail->addAddress($this->to);
	}
	if(!empty($this->from)) $mail->setFrom($this->from['email'],$this->from['name']);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		//echo 'Message sent!';
		return true;
	}


    }


}