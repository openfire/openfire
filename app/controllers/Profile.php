<? class Profile{


function get(){

global $user;

$user->getProjects();

$template = new Templater();
$template->load('header');
$template->title = $user->fullName;
$template->scripts = array('/js/dropzone.js');
//$template->css = array('/css/dropzone.css');

$template->breadcrumbs = array("/profile" => "My Profile");

$template->publish();

$template = new Templater();
$template->load('profile');
$template->user = $user;
$template->publish();

$template->load('footer');
$template->publish();

}

function post(){

global $user;

$params = array(
"email" => $_POST['email'],
"firstName" => $_POST['firstName'],
"lastName" => $_POST['lastName'],
"location" => $_POST['location'],
"bio" => $_POST['bio']

	);

$user->update($params);

addActivity("$user->fullname ($user->email) updated their profile");


if(!empty($_FILES['avatar']['tmp_name'])){

$destFile = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/avatars/".$user->uuid.".png";

$newavatar = imageToPNG($_FILES['avatar']['tmp_name'],$destFile, 256);

global $user;

}

$user->getProjects();

$template = new Templater();
$template->load('header');
$template->title = $user->fullName;
$template->publish();

$template->load('alert');
$template->type = 'message';
$template->message = "Profile updated";
$template->publish();

$template->load('profile');
$template->user = $user;
$template->publish();

$template->load('footer');
$template->publish();

}


}