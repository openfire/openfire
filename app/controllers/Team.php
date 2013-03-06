<? class Team{


	function get(){


$template = new Templater();
$template->load('header');
$template->title = "Team";
$template->breadcrumbs = array("/team" => "Team");
$template->publish();

$template->load('team');
$template->publish();

$template->load('footer');
$template->publish();

	}
}