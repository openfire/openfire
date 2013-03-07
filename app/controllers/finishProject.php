<? class finishProject{

function get($uuid){

	WePay::useStaging(WEPAY_CLIENT_ID, WEPAY_CLIENT_SECRET);

global $user;
global $dbh;



$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
// switch(true){

// case(empty($user->id)):
// $error = "Sorry, you must be logged in to manage this project.";
// break;
// case($user->id != $project->creatorID):
// $error = "Sorry, you must be this project's creator to finish setting it up.";
// break;
// case($project->status == "pending approval"):
// $error = "Sorry, this project is still pending approval.";
// break;
// case($project->status == "rejected"):
// $error = "Sorry, this project has been rejected.";
// break;
// }


$template = new Templater();

$template->load('header');
$template->scripts = array("/js/wysihtml5.min.js","/js/wysihtml5_parser_rules/advanced.js", "/js/bootstrap.wysihtml5.min.js");
$template->css = array("/css/bootstrap.wysihtml5.css");
$template->title = "Complete Project Setup | " . $project->title;
$template->publish();

if(isset($error)){

	$template->load('alert');
$template->type = "error"; $template->message = $error;
$template->publish();
}else{

$template->load('finishproject');
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
$mediaEmbed = $_POST['mediaEmbed'];

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);



$params = array(
	"subtitle" => $subtitle,
	"summary" => $_POST['summary'],
	"description" => $description,
	"lastUpdated" => time(),
	"mediaEmbed" => $mediaEmbed,
	"status" => "draft"
	);

if(!empty($title)){ 
	$params['title'] = $title;
	$params['slug'] = slugify($title);
}
$project->update($params);


if(!empty($_POST['facebook'])){

$params = array(
"projectID" => $project->id,
"type" => "facebook",
"url" => $_POST['facebook']
	);

$url = new projectURL();
$url->insert($params);

}

if(!empty($_POST['twitter'])){

$params = array(
"projectID" => $project->id,
"type" => "twitter",
"url" => $_POST['twitter']
	);

$url = new projectURL();
$url->insert($params);

}

if(!empty($_POST['linkedin'])){

$params = array(
"projectID" => $project->id,
"type" => "linkedin",
"url" => $_POST['linkedin']
	);

$url = new projectURL();
$url->insert($params);

}

if(!empty($_POST['github'])){

$params = array(
"projectID" => $project->id,
"type" => "github",
"url" => $_POST['github']
	);

$url = new projectURL();
$url->insert($params);

}

if(!empty($_POST['homepage'])){

$params = array(
"projectID" => $project->id,
"type" => "url",
"url" => $_POST['homepage']
	);

$url = new projectURL();
$url->insert($params);

}

if(!empty($_FILES['icon']['name'])){

$destFile = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/projects/".$project->uuid.".png";

$newavatar = imageToPNG($_FILES['icon']['tmp_name'],$destFile, 256);

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);

}

// Handles goddamn tags

if(!empty($_POST['tags'])){
	$tagarray = explode(",", $_POST['tags']);
	foreach($tagarray as $tag){
		$tag = trim($tag);

		$sth = $dbh->prepare("INSERT IGNORE INTO tags (name) VALUES('$tag')");
		$sth->execute();

$sti = $dbh->prepare("SELECT id FROM tags where name='$tag' limit 1");
$sti->execute();
$result = $sti->fetch(PDO::FETCH_ASSOC);
$tagID = $result['id'];

$inquery = "insert into tagMap (uuid,tagID) select * from (select '$project->uuid','$tagID') as tmp where not exists(select uuid, name from tagMap where uuid='$project->uuid' and tagID='$tagID') limit 1";
echo $inquery;
		$stg = $dbh->prepare($inquery);
		$stg->execute();


	}
}


if($_POST['action'] == "update"){

$template = new Templater();

$template->load('header');
$template->scripts = array("/js/wysihtml5.min.js","/js/wysihtml5_parser_rules/advanced.js", "/js/bootstrap.wysihtml5.min.js");
$template->css = array("/css/bootstrap.wysihtml5.css");
$template->title = "Manage Project | " . $project->title;
$template->publish();


$template = new Templater();
	$template->load('alert');
$template->type = "message"; $template->message = "Your draft has been saved.";
$template->publish();


$template->load('finishproject');
$template->project = $project;
$template->publish();



$template = new Templater();
$template->load('footer');
$template->publish();

}else{

header("Location: /finishProject/" . $project->uuid . "/finishGoal");

}






}

}