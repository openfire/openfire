<? class Create{


	function get(){


$template = new Templater();
$template->load('header');
$template->title = "Create";
$template->breadcrumbs = array("/team" => "Create");
$template->publish();

$template->load('create');
$template->publish();

$template->load('footer');
$template->publish();

	}
}