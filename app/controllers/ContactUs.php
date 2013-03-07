<? class ContactUs{

	function get(){

global $user;

$template = new Templater();
$template->load('header');
$template->title = "Contact Us";
$template->publish();

$template->load('contactus');
$template->userEmail = $user->email;
$template->publish();

$template->load('footer');
$template->publish();

	}

	function post(){

$from = array('name'=>$_POST['name'],'email'=>$_POST['email']);
$subject = "From Openfire Contact Form";
$body = wordwrap($_POST['body'], 70);

$mail = new emailMessage();
$mail->to = "contact@openfi.re";
$mail->subject = $subject;
$mail->from = $from;
$mail->body = $body;
$mail->send();


$template = new Templater();
$template->load('header');
$template->title = "Contact Us";
$template->publish();

?><div class='span8'>Thanks! Your message has been sent.</div><?

$template->load('footer');
$template->publish();

	}

}