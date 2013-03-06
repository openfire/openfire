<? class confirmSignup{

function get($key){



	global $dbh;
$sth = $dbh->prepare("SELECT id FROM users where uuid='$key' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
if(!empty($result['id'])){

$user = new User($result['id']);
$params = array(
	"active" => "1"
	);
$user->update($params);

$msg = "Thanks! Your account is now confirmed, and you can <a href='/login'>login</a>.";


}else{

$msg = "Sorry, that account could not be confirmed.";

}

$template = new Templater();
$template->load('header');
$template->title = "Confirm Signup";
$template->publish();

echo $msg;


$template = new Templater();
$template->load('footer');
$template->publish();

}

function post(){




	}

} 

?>