<? class WePayException extends Exception {
	public function __construct($description = '', $http_code = FALSE, $response = FALSE, $code = 0, $previous = NULL)
	{
		$this->response = $response;

		if (!defined('PHP_VERSION_ID')) {
			$version = explode('.', PHP_VERSION);
			define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
		}

		if (PHP_VERSION_ID < 50300) {
			parent::__construct($description, $code);
		} else {
			parent::__construct($description, $code, $previous);
		}
	}
}