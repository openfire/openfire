<? class listProjects{

function get(){

	global $dbh;

	$projects = array();
	$categories = array();

$sth = $dbh->prepare("SELECT id FROM projects order by dateAdded desc");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){

$projects[] = new Project($p['id']);

}

$sth = $dbh->prepare("SELECT id FROM projectCategories order by name");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){

$cat = new projectCategory($p['id']);
if($cat->numProjects != 0) $categories[] = $cat;

}

$template = new Templater();

$template->load('header');
$template->title = "Projects";
$template->breadcrumbs = array("/projects" => "Projects");
$template->publish();

$template->load('projects');
$template->embedly = new Embedly(array(
						'key' => EMBEDLYKEY,
						'user_agent' => $_SERVER['HTTP_USER_AGENT']
						));
$template->projects = $projects;
$template->categories = $categories;

$template->publish();

$template->load('footer');
$template->publish();


}


}