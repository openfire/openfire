<? class ajxUserActions{

function post(){

	global $dbh;
	global $user;


	$response = array();

switch($_POST['action']){

case "removeFromProject":



	$sth = $dbh->prepare("SELECT id FROM users where uuid='" . $_POST['userUUID'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	$tuser = new User($result['id']);

	$sth = $dbh->prepare("SELECT id FROM projects where uuid='" . $_POST['projectUUID'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	$tproject = new Project($result['id']);

	$query = "SELECT count(*) FROM projectUsers where projectID='$tproject->id' and userID='$user->id' and isAdmin='1'";
	$sth = $dbh->prepare($query);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if($result['count(*)'] == 0){
		$response['code'] = "500";
		$response['message'] = "You do not have admin privileges for this project.";
	}else{

	$sth = $dbh->prepare("delete from projectUsers where projectID='$tproject->id' and userID='$tuser->id' limit 1");
	$sth->execute();	
		$response['code'] = "200";
		$response['message'] = "The user has been removed from the project.";
	}

break;

case("updateUserRole"):

	$sth = $dbh->prepare("SELECT id FROM users where uuid='" . $_POST['userUUID'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	$tuser = new User($result['id']);

	$sth = $dbh->prepare("SELECT id FROM projects where uuid='" . $_POST['projectUUID'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	$tproject = new Project($result['id']);

	$query = "SELECT count(*) FROM projectUsers where projectID='$tproject->id' and userID='$user->id' and isAdmin='1'";
	$sth = $dbh->prepare($query);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if($result['count(*)'] == 0){
		$response['code'] = "500";
		$response['message'] = "You do not have admin privileges for this project.";
	}else{

	$sth = $dbh->prepare("update projectUsers set role='" . $_POST['role'] . "' where projectID='$tproject->id' and userID='$tuser->id' limit 1");
	$sth->execute();	
		$response['code'] = "200";
		$response['message'] = "The user's role has been updated'";
		$response['value'] = $_POST['role'];
	}



break;

case("makeUserAdmin"):

	$sth = $dbh->prepare("SELECT id FROM users where uuid='" . $_POST['userUUID'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	$tuser = new User($result['id']);

	$sth = $dbh->prepare("SELECT id FROM projects where uuid='" . $_POST['projectUUID'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	$tproject = new Project($result['id']);

	$query = "SELECT count(*) FROM projectUsers where projectID='$tproject->id' and userID='$user->id' and isAdmin='1'";
	$sth = $dbh->prepare($query);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if($result['count(*)'] == 0){
		$response['code'] = "500";
		$response['message'] = "You do not have admin privileges for this project.";
	}else{

	$sth = $dbh->prepare("update projectUsers set isAdmin ='1' where projectID='$tproject->id' and userID='$tuser->id' limit 1");
	$sth->execute();	
		$response['code'] = "200";
		$response['message'] = "The user has been made an admin.";

	}



break;

case("removeUserAdmin"):

	$sth = $dbh->prepare("SELECT id FROM users where uuid='" . $_POST['userUUID'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	$tuser = new User($result['id']);

	$sth = $dbh->prepare("SELECT id FROM projects where uuid='" . $_POST['projectUUID'] . "' limit 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	$tproject = new Project($result['id']);

	$query = "SELECT count(*) FROM projectUsers where projectID='$tproject->id' and userID='$user->id' and isAdmin='1'";
	$sth = $dbh->prepare($query);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	if($result['count(*)'] == 0){
		$response['code'] = "500";
		$response['message'] = "You do not have admin privileges for this project.";
	}else{

	$sth = $dbh->prepare("update projectUsers set isAdmin ='0' where projectID='$tproject->id' and userID='$tuser->id' limit 1");
	$sth->execute();	
		$response['code'] = "200";
		$response['message'] = "The user has been removed as an admin.";
	}



break;



}

echo json_encode($response);


}


}