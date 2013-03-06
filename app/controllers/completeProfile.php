<? class completeProfile{


function get(){

global $user;
global $dbh;

		$template = new Templater();
$template->load('header');
$template->title = "Complete Profile";
$template->breadcrumbs = array("/completeProfile" => "Complete Profile");
$template->publish();

$template->load('completeprofile');
$template->user = $user;
$template->publish();

$template->load('footer');
$template->publish();


}


function post(){

global $user;
global $dbh;

if(!empty($_POST['email'])) $params['email'] = $_POST['email'];
if(!empty($_POST['firstName'])) $params['firstName'] = $_POST['firstName'];
if(!empty($_POST['lastName'])) $params['lastName'] = $_POST['lastName'];

if(!empty($_POST['password'])){
$pwdHasher = new PasswordHash(8, FALSE);
$params['password'] = $pwdHasher->HashPassword( $_POST['password'] );
}

$user->update($params);

header("Location: /");


}


}