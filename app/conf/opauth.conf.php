<?php
/**
 * Opauth basic configuration file to quickly get you started
 * ==========================================================
 * To use: rename to opauth.conf.php and tweak as you like
 * If you require advanced configuration options, refer to opauth.conf.php.advanced
 */

$opconfig = array(
/**
 * Path where Opauth is accessed.
 *  - Begins and ends with /
 *  - eg. if Opauth is reached via http://example.org/auth/, path is '/auth/'
 *  - if Opauth is reached via http://auth.example.org/, path is '/'
 */
	'path' => '/auth/',

/**
 * Callback URL: redirected to after authentication, successful or otherwise
 */
	'callback_url' => '/authCallback',
	
/**
 * A random string used for signing of $auth response.
 */
	'security_salt' => '8b8618549439abbe3b8bc70167e15b323e9f3c779740cd270171ae22ad4679a1',
		
/**
 * Strategy
 * Refer to individual strategy's documentation on configuration requirements.
 * 
 * eg.
 * 'Strategy' => array(
 * 
 *   'Facebook' => array(
 *      'app_id' => 'APP ID',
 *      'app_secret' => 'APP_SECRET'
 *    ),
 * 
 * )
 *
 */
	'Strategy' => array(

'Facebook' => array(
       'app_id' => FACEBOOK_APP_ID,
       'app_secret' => FACEBOOK_SECRET
     ),
'Twitter' => array(
    'key' => TWITTER_CONSUMER_KEY,
    'secret' => TWITTER_CONSUMER_SECRET
)
)
);