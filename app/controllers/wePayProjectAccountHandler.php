<? class wePayProjectAccountHandler{

function get($uuid){

	global $dbh;

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$uuid' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$project = new Project($result['id']);
$redirect_uri = "http://" . $_SERVER['SERVER_NAME'] . "/wePayProjectAccountHandler/" . $project->uuid;

WePay::useStaging(WEPAY_CLIENT_ID, WEPAY_CLIENT_SECRET);

if (!empty($_GET['error'])) {
    // user did not grant permissions
}
elseif (empty($_GET['code'])) {
    // set $scope and $redirect_uri before doing this
    // this will send the user to WePay to authenticate
    $uri = WePay::getAuthorizationUri(array("manage_accounts","collect_payments","refund_payments","preapprove_payments","view_balance"), $redirect_uri);
    header("Location: $uri");
    exit;
}
else {
    $info = WePay::getToken($_GET['code'], $redirect_uri);
    if ($info) {
        // YOUR ACCESS TOKEN IS HERE
        $token = $info->access_token;
        $wepay = new WePay($token);

        $response = $wepay->request('account/create/', array(
        'name'          => $project->title,
        'description'   => 'Openfire account for ' . $project->title
    ));

$params = array("wePayAccountID"=>$response->account_id, "wePayAccessToken" => $token);


       $project->update($params);
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/finishProject/" . $project->uuid);
    }
    else {
        // Unable to obtain access token
    }
}



}


}