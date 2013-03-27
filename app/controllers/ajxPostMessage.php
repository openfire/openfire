<? class ajxPostMessage{

function post(){

	global $dbh;
	global $user;

$projectUUID = $_POST['projectID'];
$sth = $dbh->prepare("SELECT id FROM projects where uuid='$projectUUID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$project = new Project($result['id']);


$params = array(
"userID" => $user->id,
"projectID" => $project->id,
"uuid" => md5(microtime()),
"body" => $_POST['body']
);

if(!empty($_POST['replyTo'])) $params['replyTo'] = $_POST['replyTo'];

$m = new Message();
$m->insert($params);

echo "Hello";

}


}

?>