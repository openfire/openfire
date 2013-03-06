<? class Logout{

function get(){

global $user;
setcookie ("user[username]", "", time() - 3600,"/","openfi.re");
setcookie ("user[key]", "", time() - 3600,"/","openfi.re");

				addActivity("$user->username ($user->email) logged out");

header("Location: /");

}

}