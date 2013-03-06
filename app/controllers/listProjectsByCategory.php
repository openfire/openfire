<? class listProjectsByCategory{

function get($slug){

	global $dbh;

	$sth = $dbh->prepare("SELECT name FROM projectCategories where slug='$slug' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$catName = $result['name'];

	$sth = $dbh->prepare("SELECT id FROM projects where categoryID in (select id from projectCategories where slug='$slug') order by dateAdded desc");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

$projects = array();

foreach($result as $i){ $projects[] = new Project($i['id']); }

$categories = array();

$sth = $dbh->prepare("SELECT id FROM projectCategories order by name");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $p){

$cat = new projectCategory($p['id']);
if($cat->numProjects != 0) $categories[] = $cat;

}


$template = new Templater();

$template->load('header');
$template->title = "Projects | Category |" . $catName;
$template->breadcrumbs = array("/projects" => "Projects", "/projects/" . $slug => $catName);

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