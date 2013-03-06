<? class Fund{

function get($uuid){

include($_SERVER['DOCUMENT_ROOT'] . "/app/libraries/Stripe.php");

// if (!empty($_GET['error'])) {
//     // user did not grant permissions
// }
// elseif (empty($_GET['code'])) {
//     // set $scope and $redirect_uri before doing this
//     // this will send the user to WePay to authenticate
//     $uri = WePay::getAuthorizationUri($scope, $redirect_uri);
//     header("Location: $uri");
//     exit;
// }
// else {
//     $info = WePay::getToken($_GET['code'], $redirect_uri);
//     if ($info) {
//         // YOUR ACCESS TOKEN IS HERE
//         $access_token = $info->access_token;
//     }
//     else {
//         // Unable to obtain access token
//     }
// }

// WePay::useProduction('WEPAY_CLIENT_ID', 'WEPAY_CLIENT_SECRET');

global $user;
global $dbh;
$sth = $dbh->prepare("select id from goals where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);
$project = new Project($goal->projectID);

$template = new Templater();
$template->load('header');
$template->scripts = array("https://js.stripe.com/v1/");
$template->title = "Fund Goal | " . $goal->name;
$template->breadcrumbs = array("/projects" => "Projects", "/projects/" . $project->slug => $project->title, "/goals/" . $goal->uuid => $goal->name, "/goals/" . $goal->uuid . "/fund" => "Fund");
$template->publish();

if(empty($user->id)){

$template->load('alert');
$template->alertType = "error";
$template->message = "You must be logged in to do this.";
$template->publish(); 

}else{

$template->load('fund');
$template->goal = $goal;
if(!empty($_GET['amount'])) $template->amount = $_GET['amount'];
$template->publish(); 

}


}

function post(){

	include($_SERVER['DOCUMENT_ROOT'] . "/app/libraries/Stripe.php");


Stripe::setApiKey(STRIPE_SECRET_KEY);







	global $user;
	global $dbh;
	// All the CC stuff will be added here. For now this just pretends the amount has been updated.


$goalUUID = $_POST['goalUUID'];
$sth = $dbh->prepare("select id from goals where uuid='$goalUUID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);

$goalID = $goal->id;
$amount = $_POST['amount'];
$userID = $user->id;

$updatedAmount = $goal->currentAmount + $amount;

$card = $_POST['stripeToken'];
$description = "For goal: " . $goal->name . " | " . $user->fullname . "(" . $user->email . ") | $" . number_format($amount,2);

$customer = Stripe_Customer::create(array(
	"email" => $user->email,
  "description" => $description,
  "card" => $card // obtained with Stripe.js
));


$query = "insert into backers (userID,goalID,amount,stripeCustomerID,dateAdded) values ('$userID','$goalID','$amount','$customer->id','" . time() . "')";
$sth = $dbh->prepare($query);
$sth->execute();



$params = array("currentAmount" => $updatedAmount);
$goal->update($params);


// This handles the actual charging, if the goal is a "partially funded one".

if($goal->targetType == "partial"){


try{
	Stripe_Charge::create(array(
  "amount" => $amount * 100,
  "currency" => "usd",
  "customer" => $customer->id, // obtained with Stripe.js
  "description" => "Charge for $user->email for goal: $goal->name"
));

} catch (Stripe_Error $e){

echo $e->message;
die();

// Error handling code goes here.

}

addActivity("$user->fullname ($user->email) funded $goal->name for $" . number_format($amount,2));

}else{
	addActivity("$user->fullname ($user->email) future-funded $goal->name for $" . number_format($amount,2));

}

$template = new Templater();
$template->load('header');
$template->title = "Fund Goal | " . $goal->name;
$template->publish();



$template->load('alert');
$template->alertType = "message";
$template->message = "Thanks!";
if($goal->targetType = "complete"){ 
	$template->message .= " Your card will be charged only if this goal meets its target amount in time.";}
	else{
		$template->message .= " Your card has been charged " . number_format($amount,2) . ".";
	}
	$template->message .= " <a href='/goals/" . $goal->uuid . "'>Return to goal</a>";
$template->publish(); 

$template->load('footer');
$template->publish();

}

}