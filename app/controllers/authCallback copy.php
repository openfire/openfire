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


switch($response['auth']['provider']){

	case("Twitter"):

$token = $response['auth']['credentials']['token'];
$secret = $response['auth']['credentials']['secret'];

$username = $response['auth']['info']['nickname'];
$avatar = $response['auth']['info']['image'];
$location = $response['auth']['info']['location'];
$bio = $response['auth']['info']['description'];
$name = explode(" ", $response['auth']['info']['name']);
$firstName = $name[0];
$lastName = $name[count($name) - 1];

if(empty($user->id)){

	$sth = $dbh->prepare("select id from users where twitterAuthToken='$token' and twitterAuthSecret = '$secret' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if(!empty($result['id'])){

		$user = new User($result['id']);

		setcookie("user[username]", $user->username, time()+60*60*24*30, "/","openfi.re");
		setcookie("user[key]", $user->uuid, time()+60*60*24*30, "/","openfi.re");

		$params = array("lastLogin" => time());
		$user->update($params);

		addActivity("$user->username ($user->email) logged in");
		$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
		$sth->execute();

if(empty($user->email)){ 
	header("Location: /completeProfile");
	}else{
		header("Location: /");
	}

	}else{

	$sth = $dbh->prepare("select count from users where username='$username'");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	if($result['count(*)'] > 1){
		$username = $username . $result['count(*)'];
		}

	$params = array(
		"username" => $username,
		"uuid" => md5(microtime()),
		"firstName" => $firstName,
		"lastName" => $lastName,
		"twitterAuthToken" => $token,
		"twitterAuthSecret" => $secret,
		"location" => $location,
		"bio" => $bio,
		"active" => 1
		);

	$user = new User();
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

				$params = array("lastLogin" => time());
				$user->update($params);

				addActivity("$user->username ($user->email) logged in");

				global $dbh;

				$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
				$sth->execute();

				header("Location: /completeProfile");


	}





}else{


	$params = array(
		"twitterAuthToken" => $token,
		"twitterAuthSecret" => $secret
		);

$user->update($params);


setcookie("user[username]", $user->username, time()+60*60*24*30, "/","openfi.re");
		setcookie("user[key]", $user->uuid, time()+60*60*24*30, "/","openfi.re");

		$params = array("lastLogin" => time());
		$user->update($params);

		addActivity("$user->username ($user->email) logged in");
		$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
		$sth->execute();

if(empty($user->email)){ 
	header("Location: /completeProfile");
	}else{
		header("Location: /");
	}

}





break;

case("Facebook"):

$token = $response['auth']['credentials']['token'];

$username = $response['auth']['info']['nickname'];
$avatar = $response['auth']['info']['image'];
$location = $response['auth']['info']['location'];
$bio = $response['auth']['raw']['bio'];

$firstName = $response['auth']['info']['first_name'];
$lastName = $response['auth']['info']['last_name'];

if(empty($user->id)){

	$sth = $dbh->prepare("select id from users where facebookToken='$token' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if(!empty($result['id'])){

		$user = new User($result['id']);

		setcookie("user[username]", $user->username, time()+60*60*24*30, "/","openfi.re");
		setcookie("user[key]", $user->uuid, time()+60*60*24*30, "/","openfi.re");

		$params = array("lastLogin" => time());
		$user->update($params);

		addActivity("$user->username ($user->email) logged in");
		$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
		$sth->execute();

if(empty($user->email)){ 
	header("Location: /completeProfile");
	}else{
		header("Location: /");
	}

	}else{

	$sth = $dbh->prepare("select count from users where username='$username'");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	if($result['count(*)'] > 0){
		$username = $username . $result['count(*)'];
		}

	$params = array(
		"username" => $username,
		"uuid" => md5(microtime()),
		"firstName" => $firstName,
		"lastName" => $lastName,
		"facebookToken" => $token,
		"location" => $location,
		"bio" => $bio,
		"active" => 1
		);

	$user = new User();
	$user->insert($params);

	$saveto = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/avatars/".$user->uuid.".png";
    $ch = curl_init ($avatar);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
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

				$params = array("lastLogin" => time());
				$user->update($params);

				addActivity("$user->username ($user->email) logged in");

				global $dbh;

				$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
				$sth->execute();

				header("Location: /completeProfile");


	}





}else{


	$params = array(
		"facebookToken" => $token
		);

$user->update($params);


setcookie("user[username]", $user->username, time()+60*60*24*30, "/","openfi.re");
		setcookie("user[key]", $user->uuid, time()+60*60*24*30, "/","openfi.re");

		$params = array("lastLogin" => time());
		$user->update($params);

		addActivity("$user->username ($user->email) logged in");
		$sth = $dbh->prepare("insert into userLogins (userID, loginTime, ipAddress) values('" . $user->id . "','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')");
		$sth->execute();

if(empty($user->email)){ 
	header("Location: /completeProfile");
	}else{
		header("Location: /");
	}

}


break;

}


}


}

?>