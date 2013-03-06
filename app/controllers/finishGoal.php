<? class finishGoal{


function get($uuid){

	global $user;
	global $dbh;

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
$goal = new Goal($project->currentGoalID);

$template = new Templater();
$template->load('header');
$template->title = "Complete Initial Goal Details | " . $goal->name;
$template->publish();

$template->load('finishgoal');
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


if(!empty($_FILES['rewardimages'])) fixFilesArray($_FILES['rewardimages']);

	global $user;
	global $dbh;

$sth = $dbh->prepare("SELECT id FROM goals where uuid='" . $_POST['goalUUID'] . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);
$project = new Project($goal->projectID);

	$goalTarget = strtotime($_POST['targetMonth'] . "/" . $_POST['targetDay'] . "/" . $_POST['targetYear']);


$params = array(
	"projectID" => $project->id,
	"userID" => $user->id,
	"name" => $_POST['goalName'],
	"mediaEmbed" => $_POST['mediaEmbed'],
	"description" => $_POST['description'],
	"targetAmount" => $_POST['targetAmount'],
	"targetDate" => $goalTarget,
	"targetType" => $_POST['targetType'],
	"status" => "published"
	);

	$goal->update($params);

if(!empty($_POST['reward'])){
foreach($_POST['reward'] as $index=>$reward){

	$params = array(
		"uuid" => md5(microtime()),
		"goalID" => $goal->id,
		"name" => $reward['name'],
		"description" => $reward['description'],
		"minAmount" => $reward['minAmount'],
		"numTotal" => $reward['numTotal'],
		"numStillAvailable" => $reward['numTotal']
		);

	$r = new Reward();
	$r->insert($params);

	if(!empty($_FILES['rewardimages'][$index]['name'])){

$destFile = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/rewards/".$r->uuid.".png";

$rewardpic = imageToPNG($_FILES['rewardimages'][$index]['tmp_name'],$destFile, 1024);

	}

}
}

$project->update(array("status" => $_POST['action']));


$template = new Templater();

$template->load('header');
$template->title = "Thanks!";
$template->publish();

$template->load('alert');
$template->type = "success";
$template->message = "Awesome! Your project is now live! You can view it <a href='/projects/$project->slug'>here</a>.";
$template->publish();

$template->load('footer');
$template->publish();

}

}