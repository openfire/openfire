<? class Updates{
	

function get($updateUUID){


global $dbh;


$sth = $dbh->prepare("SELECT id FROM updates where uuid='$updateUUID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$update = new Update($result['id']);

$template = new Templater();

$template->load('header');
$template->title = $update->project->title . " | " . $update->title;
$template->publish();

$template->load('update');
$template->project = $update->project;
$template->update = $update;
$template->publish();

$template->load('footer');
$template->publish();


}



}