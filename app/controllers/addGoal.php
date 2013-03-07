<? class addGoal{


function get($uuid){

	global $user;
	global $dbh;

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);

$template = new Templater();
$template->load('header');
$template->title = $project->title . " | Add Goal";
$template->breadcrumbs = array("/projects" => "Projects", "/manageProject/" + $project->uuid => "Manage Project: " . $project->title, "/addGoal" => "Add Goal");

$template->publish();

$template->load('addgoal');
$template->project = $project;
$template->publish();

$template->load('footer');
$template->publish();

	}

function post(){

if(!empty($_FILES['rewardimages'])) fixFilesArray($_FILES['rewardimages']);


	global $user;
	global $dbh;

$sth = $dbh->prepare("SELECT id FROM projects where uuid='" . $_POST['projectUUID'] . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);

	$goalTarget = strtotime($_POST['targetMonth'] . "/" . $_POST['targetDay'] . "/" . $_POST['targetYear']);

$params = array(
	"uuid" => md5(microtime()),
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

$goal = new Goal();
$goal->insert($params);


if(!empty($_POST['reward'])){
foreach($_POST['reward'] as $index=>$reward){

	$params = array(
		"uuid" => md5(microtime()),
		"goalID" => $goal->id,
		"name" => $reward['name'],
		"description" => $reward['description'],
		"minAmount" => $reward['minAmount'],
		"numTotal" => $reward['numTotal'],
		"numStillAvailable" => $reward['numTotal'],
		"status" => $reward['status']
		);

	$r = new Reward();
	$r->insert($params);

	if(!empty($_FILES['rewardimages'][$index]['name'])){

$destFile = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/rewards/".$r->uuid.".png";

$rewardpic = imageToPNG($_FILES['rewardimages'][$index]['tmp_name'],$destFile, 1024);

	}

}
}

				addActivity("$user->username ($user->email) added a goal, &quot;$goal->title&quot; to the project &quot;$project->title&quot;");

header("Location: /manageProject/" . $project->uuid . "#goals");
// $template = new Templater();

// $template->load('header');
// $template->title = $project->title ." | Add Goal";
// $template->publish();

// $template->load('alert');
// $template->alertType = "message";
// if($goal->status == "draft"){$template->message = "Your goal has been added. <a href='/manageGoal/" . $goal->uuid . "'>Click here to edit</a>"; 
// }else{
// $template->message = "Your goal has been published. <a href='/goals/" . $goal->uuid . "'>View goal</a>";

// }
// $template->publish();

// $template->load('footer');
// $template->publish();

}

}