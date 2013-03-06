<? 	

	include($_SERVER['DOCUMENT_ROOT'] . '/app/conf/global.php');


include('Opauth.php');

	include($_SERVER['DOCUMENT_ROOT'] . '/app/conf/opauth.conf.php');


	global $opconfig;

	$Opauth = new Opauth( $opconfig );