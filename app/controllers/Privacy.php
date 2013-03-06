<? class Privacy{


	function get(){


$template = new Templater();
$template->load('header');
$template->title = "Privacy Policy";
$template->breadcrumbs = array("/privacy" => "Privacy Policy");
$template->publish();

$template->load('privacy');
$template->publish();

$template->load('footer');
$template->publish();

	}
}