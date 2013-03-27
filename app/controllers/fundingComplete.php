<? class fundingComplete{


function get($goalUUID, $userUUID, $rewardUUID, $amount){

	global $dbh;

$checkoutID = $_GET['checkout_id'];

$sth = $dbh->prepare("SELECT id FROM goals where uuid='$goalUUID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);

$sth = $dbh->prepare("SELECT id FROM users where uuid='$userUUID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$user = new User($result['id']);

if($rewardUUID != 0){

$sth = $dbh->prepare("SELECT id FROM rewards where uuid='$rewardUUID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$reward = new Reward($result['id']);

}

$backer = new Backer();

$params = array(

"userID" => $user->id,
"goalID" => $goal->id,
"amount" => $amount,
"WePayCheckoutID" => $checkoutID
	);
if($rewardUUID != 0 ) $params['rewardID'] = $reward->id;

$backer->insert($params);

$goal->update(array("currentAmount" => ($goal->currentAmount + $amount)));

if($goal->currentAmount >= $goal->targetAmount) $goal->update(array("status" => 'goal met'));

if($rewardUUID != 0 ){
if($reward->numTotal != 0) $reward->update(array("numStillAvailable" => ($reward->numTotal - 1)));
}

// Load page

$project = new Project($goal->projectID);
$template = new Templater();
$template->load('header');
$template->title = $project->title . " | " . $goal->name;
$template->breadcrumbs = array("/projects" => "Projects", "/projects/" . $project->slug => $project->title, "/projects/" . $project->slug . "/goals/" => "Goals","/projects/" . $project->slug . "/goals/" . $goal->uuid => $goal->name, "/projects/" . $project->slug . "/goals/" . $goal->uuid . "/fund" => "Fund","" => "Funding Complete!");
$template->publish();

$template->load('fundingthanks');
$template->project = $project;
$template->amount = $amount;
$template->goal = $goal;
$template->publish();

$template->load('footer');
$template->publish();


}


}