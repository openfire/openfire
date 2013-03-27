<? class Auth{

function get(){

	include($_SERVER['DOCUMENT_ROOT'] . '/app/libraries/Opauth/Opauth.php');
	include($_SERVER['DOCUMENT_ROOT'] . '/app/libraries/Opauth/OpauthStrategy.php');

	include($_SERVER['DOCUMENT_ROOT'] . '/app/conf/opauth.conf.php');


	global $opconfig;

	$Opauth = new Opauth( $opconfig );



}


}