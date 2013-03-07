<? class manageGoal{


function get($uuid){

	global $user;
	global $dbh;

$sth = $dbh->prepare("SELECT id FROM goals where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);
$project = new Project($goal->projectID);

$template = new Templater();
$template->load('header');
$template->title = "Manage Goal | " . $goal->name;
$template->publish();

$template->load('managegoal');
$template->goal = $goal;

$template->project = $project;
$template->goalCompletion = array(
	"month" => date("m", $goal->targetDate),
	"day" => date("d", $goal->targetDate),
	"year" => date("Y", $goal->targetDate),

	);
$template->publish();

$template->load('footer');
$template->publish();

	}

function post(){

	global $user;
	global $dbh;

$sth = $dbh->prepare("SELECT id FROM goals where uuid='" . $_POST['goalUUID'] . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);
$project = new Project($goal->projectID);

switch($_POST['action']){

	case("updateGoal"):

	$goalTarget = strtotime($_POST['targetMonth'] . "/" . $_POST['targetDay'] . "/" . $_POST['targetYear']);

$params = array(
	"projectID" => $project->id,
	"userID" => $user->id,
	"name" => $_POST['goalName'],
	"mediaEmbed" => $_POST['mediaEmbed'],
	"summary" => $_POST['summary'],
	"description" => $_POST['description'],
	"targetAmount" => $_POST['targetAmount'],
	"targetDate" => $goalTarget,
	"targetType" => $_POST['targetType'],
	"status" => $_POST['status']
	);

$goal->update($params);

if($goal->status == "draft"){$msg = "Your goal has been updated."; 
}else{
$msg = "Your goal has been published. <a href='/goals/" . $goal->uuid . "'>View goal</a>";
}

				addActivity("$user->username ($user->email) updated the goal, &quot;$goal->title&quot; to the project &quot;$project->title&quot;");

	break;

	case("postUpdate"):

	$params = array(
		"userID" => $user->id,
		"uuid" => md5(microtime()),
		"goalID" => $goal->id,
		"projectID" => $project->id,
		"title" => $_POST['title'],
		"slug" => slugify($_POST['title']),
		"body" => $_POST['body'],
		"public" => $_POST['public']);

	$update = new Update();
	$update->insert($params);

$sth = $dbh->prepare("SELECT id FROM goals where uuid='" . $_POST['goalUUID'] . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);

	$msg = "Your update has been posted";

	break;

}
$template = new Templater();

$template->load('header');
$template->title = $project->title ." | Add Goal";
$template->publish();

$template->load('alert');
$template->alertType = "message";
$template->message = $msg;
$template->publish();

$template->load('managegoal');
$template->goal = $goal;

$template->project = $project;
$template->goalCompletion = array(
	"month" => date("m", $goal->targetDate),
	"day" => date("d", $goal->targetDate),
	"year" => date("Y", $goal->targetDate),

	);
$template->publish();

$template->load('footer');
$template->publish();

}

}