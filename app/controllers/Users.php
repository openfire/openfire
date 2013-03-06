<? class Users{

function get($username){

global $dbh;

	$sth = $dbh->prepare("SELECT id FROM users where username = '$username' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$displayUser = new User($result['id']);

$displayUser->getProjects();
$displayUser->getBackedGoals();

$template = new Templater();

$template->load('header');
$template->title = "Users | " . $displayUser->username;
$template->breadcrumbs = array("/users" => "Users", "/users/" . $displayUser->username => $displayUser->username);
$template->publish();

$template->load('user');
$template->embedly = new Embedly(array(
						'key' => EMBEDLYKEY,
						'user_agent' => $_SERVER['HTTP_USER_AGENT']
						));
$template->displayUser = $displayUser;

$template->publish();

$template->load('footer');
$template->publish();


}


}