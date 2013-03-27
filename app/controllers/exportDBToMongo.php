<? class exportDBToMongo{


function get(){

global $dbh;

$output = array();

$sth = $dbh->prepare("SELECT id from projects");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){

$project = new Project($p['id']);

$project->_id = $project->uuid;

$output['projects'][] = $project;

}

$sth = $dbh->prepare("SELECT id from users");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){

$a = new User($p['id']);

$a->_id = $project->uuid;

$output['users'][] = $a;

}

echo "<pre>" . json_encode($output);


}


} ?>