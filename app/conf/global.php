<? 

date_default_timezone_set('America/Los_Angeles');

include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/password.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/randomString.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/slugify.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/trimtowcount.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/trimtopcount.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/imageToPNG.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/get_enum_values.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/addActivity.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/relativeTime.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions/fixFilesArray.php');



		define("SALT","MyDearSw33tBrotherNums3y666");
		define("OUTGOINGEMAIL","sendgrid@importantmedia.org");
		define("OUTGOINGEMAILPASS","s3ndgr1d99");
		define("OUTGOINGEMAILNAME","Openfire");

$server = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : 'www.openfi.re';

if (strstr($server, 'dev')) {

		$dsn = "mysql:dbname=development;host=localhost";
		$dbuser = "development";
		$dbpass = "californiaGold";









		define("EMBEDLYKEY", "92dd1679846943baa1f1a2c9611d36e0");


		define('TWITTER_CONSUMER_KEY','3wYy4j14iRIliRLqcf5A');
		define('TWITTER_CONSUMER_SECRET','auY88voEBWP6XfDlkeLo8J5IiEGyDdUnixKjtNAc');

		define('TWITTER_ACCESS_TOKEN', '565925798-BW7LiCCnT0AptesEQf18uRT6bPWx4l4anRWSQDyX');
		define('TWITTER_ACCESS_TOKEN_SECRET', 'wBvpKkTMJdNoEtJtsJXUHJFCwuiJxQnqDWdJuTwOMR4');

		define('FACEBOOK_APP_ID','132286753608939');
		define('FACEBOOK_KEY', '468309289847671');
		define('FACEBOOK_SECRET','11d605495d3f28a20fc776eb42afac6a');

		// This is for dev, switch to other for prod, will handle with server check
		define('WEPAY_CLIENT_ID','70362');
		define('WEPAY_CLIENT_SECRET', 'c0cdb5865d');
		define('WEPAY_ACCESS_TOKEN', 'STAGE_9672fc394c1470b2d9dce2340122f32177b5eb03a9e9de990626273cc0f80b76');
		define('WEPAY_ACCOUNT_ID', '155429649');

		// Production. Commented out for now.
		// define('WEPAY_CLIENT_ID','147593');
		// define('WEPAY_CLIENT_SECRET', '1e91d1ddc1');
		// define('WEPAY_ACCESS_TOKEN', '590b005d46dbbd3610e488898e778ac1f43b100dcf3ef2b6930ecd46a640cda4');
		// define('WEPAY_ACCOUNT_ID', '240546');




}else{

		$dsn = "mysql:dbname=production;host=localhost";
		$dbuser = "production";
		$dbpass = "californiaGold";









		define("EMBEDLYKEY", "92dd1679846943baa1f1a2c9611d36e0");


		define('TWITTER_CONSUMER_KEY','3wYy4j14iRIliRLqcf5A');
		define('TWITTER_CONSUMER_SECRET','auY88voEBWP6XfDlkeLo8J5IiEGyDdUnixKjtNAc');

		define('TWITTER_ACCESS_TOKEN', '565925798-BW7LiCCnT0AptesEQf18uRT6bPWx4l4anRWSQDyX');
		define('TWITTER_ACCESS_TOKEN_SECRET', 'wBvpKkTMJdNoEtJtsJXUHJFCwuiJxQnqDWdJuTwOMR4');

		define('FACEBOOK_APP_ID','132286753608939');
		define('FACEBOOK_KEY', '468309289847671');
		define('FACEBOOK_SECRET','11d605495d3f28a20fc776eb42afac6a');

		// This is for dev, switch to other for prod, will handle with server check
		define('WEPAY_CLIENT_ID','70362');
		define('WEPAY_CLIENT_SECRET', 'c0cdb5865d');
		define('WEPAY_ACCESS_TOKEN', 'STAGE_9672fc394c1470b2d9dce2340122f32177b5eb03a9e9de990626273cc0f80b76');
		define('WEPAY_ACCOUNT_ID', '155429649');
	
}

		try {
		$dbh = new PDO($dsn, $dbuser, $dbpass);
		} catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage();
		}



		function dbclean($data) {
			global $dbh;
		    return $dbh->quote(trim($data));
		}

		function my_autoloader($class) {
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/models/' . $class . '.php')){
		    include $_SERVER['DOCUMENT_ROOT'] . '/app/models/' . $class . '.php';
		}else{

			    include $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $class . '.php';

		}
		}

		spl_autoload_register('my_autoloader');


		$embedly = new Embedly(array(
								'key' => EMBEDLYKEY,
								'user_agent' => $_SERVER['HTTP_USER_AGENT']
								));


include_once($_SERVER['DOCUMENT_ROOT'] . '/auth/OpauthStrategy.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/auth/Strategy/TwitterStrategy.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/auth/Strategy/FacebookStrategy.php');

global $dbh;

?>