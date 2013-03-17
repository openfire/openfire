<? require_once('app/conf/global.php'); 

require_once('app/conf/opauth.conf.php'); 

$user = new User();

ToroHook::add("404",  function() {

$template = new Templater();

$template->load('404');
$template->publish();


});


ToroHook::add("before_handler", function() {

global $user;
global $dbh;

if(!empty($_COOKIE['user']['username'])){
$sth = $dbh->prepare("SELECT id FROM users where username='" . $_COOKIE['user']['username'] . "' and uuid='" . $_COOKIE['user']['key'] . "' order by dateAdded desc limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

if(!empty($result['id'])) $user = new User($result['id']);

}

});

 
Toro::serve(array(
    "/" => "Home",
    "/authCallback" => "authCallback",
    "/completeProfile" => "completeProfile",
    "about" => "About",
    "create" => "Create",
    "privacy" => "Privacy",
    "team" => "Team",
    "contactus" => "ContactUs",
    "signup" => "Signup",
    "confirmSignup/:alpha" => "confirmSignup",
    "login" => "Login",
    "logout" => "Logout",
    "profile" => "Profile",
    "projects" => "listProjects",
    "projects/categories/:alpha" => "listProjectsByCategory",
    "projects/:alpha" => "Projects",
    "projects/:alpha/goals" => "listProjectGoals",
    "updates/:alpha" => "Updates",
    "goals/:alpha" => "Goals",
    "goals/:alpha/fund" => "Fund",
    "createProject" => "createProject",
    "finishProject/:alpha" => "finishProject",
    "finishProject/:alpha/finishGoal" => "finishGoal",
    "manageProject/:alpha" => "manageProject",
	"manageProject/:alpha/addGoal" => "addGoal",
	"manageProject/:alpha/addUpdate" => "addUpdate",
    "manageGoal/:alpha" => "manageGoal",
	"ajax/inviteUser" => "ajxInviteUser",
    "ajax/projectMessages" => "ajxProjectMessages",
    "ajax/postMessage" => "ajxPostMessage",
    "ajax/checkEmail" => "ajxCheckEmail",
    "ajax/addPress" => "ajxAddPress",
    "ajax/addReward" => "ajxAddReward",
    "ajax/editReward" => "ajxEditReward",
    "ajax/userActions" => "ajxUserActions",
    "ajax/addUpdate" => "ajxAddUpdate",
	"acceptInvite/:alpha" => "acceptInvite",
    "users" => "randomUser",
    "users/:alpha" => "Users",
    "wePayProjectAccountHandler/:alpha" => "wePayProjectAccountHandler",
    "fundingRedirect" => "fundingRedirect",
    "fundingComplete/:alpha/:alpha/:alpha/:alpha" => "fundingComplete",
    "exportDBToMongo" => "exportDBToMongo"
));

?>