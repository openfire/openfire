<? class About{
	

function get(){
	$template = new Templater();
	$template->load('header');
	$template->breadcrumbs = array("/about" => "About");

	$template->title = "About Us";
	$template->publish();
	$template->load('about');
	$template->publish();
	$template->load('footer');
	$template->publish();

}

}