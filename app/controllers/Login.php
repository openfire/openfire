<? class Login{

function get(){

$template = new Templater();
$template->load('header');
$template->title = "Confirm Signup";
$template->publish();

?><div class='well well-small span4 offset4'>
	<form action='' method='post'>
		<legend>Login</legend>
		<fieldset>
			<input type='text' name='login' placeholder='Username or email'>
		</fieldset>
		<fieldset>
			<input type='password' name='password' placeholder='Password'>
		</fieldset>
		<fieldset>
			<button type='submit' class='btn'>Login</button>
	</form>
</div>
<? }

function post(){

global $dbh;

$login = $_POST['login'];



$sth = $dbh->prepare("SELECT id FROM users where username='$login' or email='$login' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

if(empty($result)){
	$error = "No user with that username or email found.";
}else{
$user = new User($result['id']);

$pwdHasher = new PasswordHash(8, FALSE);
$check = $pwdHasher->CheckPassword( $_POST['password'], $user->password);

if(empty($check)){
	$error = "Incorrect password.";
	}else{

		switch(true){

			case($user->active == 0):
				$error = "This account has not yet been activated. Did you get your confirmation email and click on the link?";
			break;
			case($user->deleted == 1):
				$error = "This account has been deleted.";
			break;

			case($user->active == 1 && $user->deleted == 0):
				
				setcookie("user[username]", $user->username, time()+60*60*24*30, "/","openfi.re");
				setcookie("user[key]", $user->uuid, time()+60*60*24*30, "/","openfi.re");

				$params = array("lastLogin" => time());
				$user->update($params);

				addActivity("$user->username ($user->email) logged in");

				global $dbh;

				$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
				$sth->execute();

				header("Location: /");

			break;

		}


}



}

if(!empty($error)){

	$template = new Templater();
$template->load('header');
$template->title = "Login Error";
$template->publish();

$template = new Templater();
$template->load('alert');
$template->type = "error"; $template->message = $error;
$template->publish();


$template = new Templater();
$template->load('footer');
$template->publish();
}


}

}