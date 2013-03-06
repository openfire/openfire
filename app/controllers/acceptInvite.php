<? class acceptInvite{

function get($uuid){

	global $dbh;
	global $user;

$template = new Templater();

$template->load('header');
$template->title = "Accept Invite";
$template->publish();


$sth = $dbh->prepare("SELECT id FROM projectInvitations where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

if(!empty($result['id'])){
$invite = new projectInvitation($result['id']);

$invitedUser = new User($invite->inviteeID);
$inviter = new User($invite->inviterID);

if($invitedUser->active == 0){

	$msg = "Thanks! You're just one step away from getting started!";

$template->load('alert');
$template->type='message';
$template->message = $msg;
$template->publish();

$template->load('acceptinvitesignup');
$template->user = $invitedUser;
$template->invite = $invite;
$template->project = new Project($invite->projectID);

$template->publish();

}else{

	$project = new Project($invite->projectID);

	$params = array("dateAccepted" => time());
	$invite->update($params);

$sth = $dbh->prepare("SELECT * FROM projectUsers where projectID='$project->id' and userID='$invitedUser->id' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
if(!empty($result['id'])){
		$msg = "You're already a member of this project! <a href='/projects/$project->slug'>Click here to go to project.</a>";
}else{

$sth = $dbh->prepare("insert into projectUsers(projectID, userID, type, dateAdded) values('$project->id','$invitedUser->id','2','" . time() . "')");
$sth->execute();

				addActivity("$invitedUser->username ($invitedUser->email) joined the project &quot;$project->title&quot;");


	$msg = "Thanks! You've joined the project <b>" . $project->title . "</b>. <a href='/projects/$project->slug'>Click here to get started.</a>";


$email = new emailMessage();

$email->to = $inviter->email;
$email->subject = $invitedUser->fullName . " has joined your project!";
$email->body = $invitedUser->fullName . " has joined your openfire project '" . $project->title . "'. You can update their profile and view their info at http://" . $_SERVER['SERVER_NAME'] . "/manageProject/" . $project->uuid . "#team

Thanks!
Openfire
";

$email->send();
}
$template->load('alert');
$template->type='message';
$template->message = $msg;
$template->publish();


}


}else{

$error = "Sorry, that invitation was not found.";

$template->load('alert');
$template->type='error';
$template->message = $error;
$template->publish();

}

$template->load('footer');
$template->publish();

}


function post(){

	global $dbh;

$user = new User($_POST['userID']);
$invite = new projectInvitation($_POST['inviteID']);
$project = new Project($invite->projectID);

$pwdHasher = new PasswordHash(8, FALSE);
$password = $pwdHasher->HashPassword( $_POST['password'] );

$params = array(

"username" => $_POST['username'],
"password" => $password,
"active" => 1,
"firstName" => $_POST['firstName'],
"lastName" => $_POST['lastName']
	);

$user->update($params);

$params = array("dateAccepted" => time());
$invite->update($params);

$sth = $dbh->prepare("insert into projectUsers(projectID, userID, type,dateAdded) values('$project->id','$user->id','2','" . time() . "')");
$sth->execute();

$template = new Templater();

$template->load('header');
$template->title = "You're In";
$template->publish();

?>Thanks for signing up! You can <a href='/login'>login</a> now and view your new project under My Projects.<?


$template->load('footer');
$template->publish();


}

}