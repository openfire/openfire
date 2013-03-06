<? class listProjectGoals{

function get($slug){

global $dbh;

	$sth = $dbh->prepare("SELECT id FROM projects where slug='$slug' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);


$template = new Templater();

$template->load('header');
$template->title = $project->title . " | Goals";
$template->breadcrumbs = array("/projects" => "Projects", "/projects/" . $project->slug => $project->title, "/projects/" . $project->slug . "/goals/" => "Goals");
$template->publish();

$template->load('projectgoals');
$template->project = $project;
$template->currentGoal = new Goal($project->currentGoalID );
$template->embedly = new Embedly(array(
						'key' => EMBEDLYKEY,
						'user_agent' => $_SERVER['HTTP_USER_AGENT']
						));
$template->publish();

$template->load('footer');
$template->publish();


}


}