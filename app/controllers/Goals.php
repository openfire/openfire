<? class Goals{

function get($uuid){

	    setcookie("user[lastPage]", $_SERVER['REQUEST_URI'], time()+60*60*24*30, "/","openfi.re");


global $dbh;
        $sth = $dbh->prepare("SELECT id FROM goals where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$goal = new Goal($result['id']);
$project = new Project($goal->projectID);

$template = new Templater();

$template->load('header');
$template->bodyClass = "goal";
$template->title = $project->title . " | " . $goal->name;
$template->breadcrumbs = array("/projects" => "Projects", "/projects/" . $project->slug => $project->title, "/projects/" . $project->slug . "/goals/" => "Goals","/projects/" . $project->slug . "/goals/" . $goal->uuid => $goal->name);
$template->publish();

$template->load('goal');
$template->embedly = new Embedly(array(
						'key' => EMBEDLYKEY,
						'user_agent' => $_SERVER['HTTP_USER_AGENT']
						));
$template->project = $project;

$template->goal = $goal;
$template->publish();

$template->load('footer');
$template->publish();


}

}