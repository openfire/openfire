<? class authCallback{

function get(){


include($_SERVER['DOCUMENT_ROOT'] . '/auth/Opauth.php');

	include($_SERVER['DOCUMENT_ROOT'] . '/app/conf/opauth.conf.php');

global $opconfig;
global $user;
global $dbh;

$Opauth = new Opauth( $opconfig, false );


/**
* Fetch auth response, based on transport configuration for callback
*/
$response = null;


switch($Opauth->env['callback_transport']) {
	case 'session':
		session_start();
		$response = $_SESSION['opauth'];
		unset($_SESSION['opauth']);
		break;
	case 'post':
		$response = unserialize(base64_decode( $_POST['opauth'] ));
		break;
	case 'get':
		$response = unserialize(base64_decode( $_GET['opauth'] ));
		break;
	default:
		echo '<strong style="color: red;">Error: </strong>Unsupported callback_transport.'."<br>\n";
		break;
}

/**
 * Check if it's an error callback
 */
if (array_key_exists('error', $response)) {
	echo '<strong style="color: red;">Authentication error: </strong> Opauth returns error auth response.'."<br>\n";
}

/**
 * Auth response validation
 * 
 * To validate that the auth response received is unaltered, especially auth response that 
 * is sent through GET or POST.
 */
else{
	if (empty($response['auth']) || empty($response['timestamp']) || empty($response['signature']) || empty($response['auth']['provider']) || empty($response['auth']['uid'])) {
		//echo '<strong style="color: red;">Invalid auth response: </strong>Missing key auth response components.'."<br>\n";
	} elseif (!$Opauth->validate(sha1(print_r($response['auth'], true)), $response['timestamp'], $response['signature'], $reason)) {
		//echo '<strong style="color: red;">Invalid auth response: </strong>'.$reason.".<br>\n";
	} else {
		//echo '<strong style="color: green;">OK: </strong>Auth response is validated.'."<br>\n";

		/**
		 * It's all good. Go ahead with your application-specific authentication logic
		 */
	}
}


/**
* Auth response dump
*/

// echo $response['auth']['info']['name'];

// echo "<pre>";
//  print_r($response);

$params = array();
$update = array();

switch($response['auth']['provider']){

	case("Twitter"):
	
		$params['type'] = "twitter";
		$params['token'] = $response['auth']['credentials']['token'];
		$params['secret'] = $response['auth']['credentials']['secret'];

		$params['username'] = $response['auth']['info']['nickname'];
		$params['avatar'] = $response['auth']['info']['image'];
		$params['location'] = $response['auth']['info']['location'];
		$params['bio'] = $response['auth']['info']['description'];
		$name = explode(" ", $response['auth']['info']['name']);
		$params['firstName'] = $name[0];
		$params['lastName'] = $name[count($name) - 1];

		$update['twitterAuthToken'] = $response['auth']['credentials']['token'];
		$update['twitterAuthSecret'] = $response['auth']['credentials']['secret'];

		$query = "select id from users where twitterAuthToken='" . $params['token'] . "' and twitterAuthSecret = '" . $params['secret'] . "' limit 1";



	break;

	case("Facebook"):

		$params['type'] = "facebook";
		$params['token'] = $response['auth']['credentials']['token'];

		$params['username'] = $response['auth']['info']['nickname'];
		$params['avatar'] = $response['auth']['info']['image'];
		$params['location'] = $response['auth']['info']['location'];
		$params['bio'] = $response['auth']['raw']['bio'];

		$params['firstName'] = $response['auth']['info']['first_name'];
		$params['lastName'] = $response['auth']['info']['last_name'];

		$update['facebookToken'] = $response['auth']['credentials']['token'];
		$query = "select id from users where facebookToken='" . $params['token'] . "' limit 1";




	break;

}

// Check to see if the user is logged in. If so, log them in and update them.

if(!empty($user->id)){

	$user->update($update);

		if(empty($user->email)){ 
		header("Location: /completeProfile");
		}else{
			header('Location: /profile');
		}

}else{

	$sth = $dbh->prepare($query);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if(!empty($result['id'])){
		$user = new User($result['id']);


		setcookie("user[username]", $user->username, time()+60*60*24*30, "/","openfi.re");
		setcookie("user[key]", $user->uuid, time()+60*60*24*30, "/","openfi.re");

		$newparams = array("lastLogin" => time());
		$user->update($newparams);

		addActivity("$user->username ($user->email) logged in");
		$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
		$sth->execute();

		if(empty($user->email)){ 
		header("Location: /completeProfile");
		}else{
		header("Location: /");
		}
	


	}

}


	$sth = $dbh->prepare("select id from users where username='". $params['username'] ."'");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);


	$sth = $dbh->prepare("select count(*) from users where username='". $params['username'] ."'");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	if($result['count(*)'] > 0){
		$params['username'] = $params['username'] . $result['count(*)'];
		$params['doesExist'] = "true";
		}

$template = new Templater();
$template->load('header');
$template->title = "Create Profile";
$template->publish();


$template = new Templater();
$template->load('createProfile');
$template->params = $params;
$template->publish();

$template = new Templater();
$template->load('footer');
$template->publish();

}

function post(){

	global $dbh;

$pwdHasher = new PasswordHash(8, FALSE);
$password = $pwdHasher->HashPassword( $_POST['password'] );

$user = new User();

$avatar = $_POST['avatar'];

$params = array(
"username" => $_POST['username'],
"email" => $_POST['email'],
"password" => $password,
"lastName" => $_POST['lastName'],
"firstName" => $_POST['firstName'],
"location" => $_POST['location'],
"bio" => $_POST['bio'],
"uuid" => MD5(microtime()),
"active" => 0
	);

if($_POST['type'] == "twitter"){
	$params['twitterAuthToken'] = $_POST['token'];
	$params['twitterAuthSecret']  = $_POST['secret'];

}

if($_POST['type'] == "facebook"){
	$params['facebookToken'] = $_POST['token'];
	
}

$user->insert($params);


	$saveto = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/avatars/".$user->uuid.".png";
    $ch = curl_init ($avatar);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $raw=curl_exec($ch);
    curl_close ($ch);
    if(file_exists($saveto)){
        unlink($saveto);
    }
    $fp = fopen($saveto,'x');
    fwrite($fp, $raw);
    fclose($fp);
	$newavatar = imageToPNG($saveto,$saveto, 256);

		setcookie("user[username]", $user->username, time()+60*60*24*30, "/","openfi.re");
		setcookie("user[key]", $user->uuid, time()+60*60*24*30, "/","openfi.re");

		addActivity("$user->username ($user->email) created an account");
		$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
		$sth->execute();

		if(empty($user->email)){ 
		header("Location: /completeProfile");
		}else{
		header("Location: /");
		}


}




}

?>