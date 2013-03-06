<? class ajxAddPress{

function post(){

$title = $_POST['title'];
$url = $_POST['url'];
$description = $_POST['description'];

$press = new projectPress();

$params = array(
'projectID' => $_POST['projectID'],
'title' => $_POST['title'],
'url' => $_POST['url'],
'description' => $_POST['description']
	);

$press = new projectPress();
$press->insert($params);

?>
<li><a href='<?= $press->url ?>'><b><?= $press->title ?></b></a> - <?= $press->description ?></li>
<?

}

}