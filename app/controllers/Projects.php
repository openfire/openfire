<? class Projects{
	

function get($slug){

	    setcookie("user[lastPage]", $_SERVER['REQUEST_URI'], time()+60*60*24*30, "/","openfi.re");


global $dbh;

$sth = $dbh->prepare("SELECT id FROM projects where slug='$slug' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
$project->getUpdates(0,5);
$project->getBackers();


$template = new Templater();

$template->load('header');
$template->title = $project->title;
$template->bodyClass = "project";
$template->breadcrumbs = array("/projects" => "Projects", "/projects/" . $project->slug => $project->title);
$template->publish();

$template->load('project');
$template->project = $project;
$template->currentGoal = new Goal($project->currentGoalID);
$template->embedly = new Embedly(array(
						'key' => EMBEDLYKEY,
						'user_agent' => $_SERVER['HTTP_USER_AGENT']
						));
$template->publish();

$template->load('footer');
$template->publish();


}



}