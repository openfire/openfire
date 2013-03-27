<? class ajxAddUpdate{



function post(){

global $user;



$project = new Project($_POST['projectID']);



$params = array(
	"uuid" => md5(microtime()),
"title" => $_POST['title'],
"slug" => slugify($_POST['title']),
"projectID" => $project->id,
"body" => $_POST['body'],
"userID" => $user->id,
"lastModified" => time()
);

$update = new Update();
$update->insert($params);

$recipients = array();

foreach($project->team as $tuser){
	$recipients[] = $tuser->email;
}

foreach($project->backers as $tuser){
	$recipients[] = $tuser->email;
}

$recipients = array_unique($recipients);

$emailBody = "A update has been posted to the openfire project '$project->title' by $user->username!

---

" . wordwrap($update->body, 70) ."


You are receiving this message because you are either a backer of the openfire project '$project->title' or a member of the project's team.";

$mail = new emailMessage();
$mail->to = $recipients;
$mail->subject = "Openfire Project '" . $project->title . "' Update: ". $update->title;
$mail->body = $emailBody;
$mail->send();


				addActivity("$user->username ($user->email) added an update titled &quot;$update->title&quot; to the project &quot;$project->title&quot;");

?>
<div class='update well well-small'>
			<h3><?= $update->title ?></h3>
			<div>Posted by <?= $update->user->username ?> on <?= date("m-d-Y", $update->dateAdded) ?> at <?= date("h:ia", $update->dateAdded) ?></div>
			<div><?= nl2br($update->body) ?></div>
		</div>
<?

}


}