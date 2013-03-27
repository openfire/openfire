<? class manageProject{

function get($uuid){

global $user;
global $dbh;



$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
$project->getBackers();
if(empty($user->id)){$error = "Sorry, you must be logged in to manage this project.";}else{
$sth = $dbh->prepare("SELECT * FROM projectUsers where projectID='$project->id' and userID='$user->id' and isAdmin='1' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
//if(count($result) == 0) $error = "Sorry, you do not have admin privileges for this project.";

}

$template = new Templater();

$template->load('header');
$template->scripts = array("/js/wysihtml5.min.js","/js/wysihtml5_parser_rules/advanced.js", "/js/bootstrap.wysihtml5.min.js", "/js/jquery.wordcounter.js");
$template->css = array("/css/bootstrap.wysihtml5.css");
$template->title = "Manage Project | " . $project->title;
$template->publish();

if(isset($error)){

	$template->load('alert');
$template->type = "error"; $template->message = $error;
$template->publish();
}else{

$template->load('manageproject');
$template->project = $project;
$template->publish();

}

$template = new Templater();
$template->load('footer');
$template->publish();

}

function post(){

global $user;
global $dbh;

	$uuid = $_POST['uuid'];
	if(!empty($_POST['title'])) $title = $_POST['title'];
$subtitle = $_POST['subtitle'];
$description = $_POST['description'];
$summary = $_POST['summary'];

$mediaEmbed = $_POST['mediaEmbed'];

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
$project->getBackers();
if(empty($user->id)){$error = "Sorry, you must be logged in to manage this project.";}else{
$sth = $dbh->prepare("SELECT * FROM projectUsers where projectID='$project->id' and userID='$user->id' and isAdmin='1' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
//if(count($result) == 0) $error = "Sorry, you do not have admin privileges for this project.";

$params = array(
	"subtitle" => $subtitle,
	"description" => $description,
	"summary" => $summary,
	"lastUpdated" => time(),
	"mediaEmbed" => $mediaEmbed
	);

if(!empty($title)){ 
	$params['title'] = $title;
	$params['slug'] = slugify($title);
}
if(!empty($_POST['action']) && $_POST['action'] == "publish") $params['status'] = "published";
$project->update($params);

if(!empty($_FILES['icon']['name'])){

$destFile = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/projects/".$project->uuid.".png";

$newavatar = imageToPNG($_FILES['icon']['tmp_name'],$destFile, 256);

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);

}

$template = new Templater();

$template->load('header');
$template->scripts = array("/js/wysihtml5.min.js","/js/wysihtml5_parser_rules/advanced.js", "/js/bootstrap.wysihtml5.min.js");
$template->css = array("/css/bootstrap.wysihtml5.css");
$template->title = "Manage Project | " . $project->title;
$template->publish();


$template = new Templater();
	$template->load('alert');
$template->type = "message"; $template->message = "Your project has been updated.";
$template->publish();


$template->load('manageproject');
$template->project = $project;
$template->publish();



$template = new Templater();
$template->load('footer');
$template->publish();

}




}

}