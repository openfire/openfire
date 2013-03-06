<? global $dbh;

$response = array();

$email = $_GET['email'];
	$sth = $dbh->prepare("SELECT count(*) from users where email='$email'");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
if($result['count(*)'] == 0){
echo "1";
}else{
$response['error'] = "Sorry, this email address is already in use.";
echo json_encode($response);
}