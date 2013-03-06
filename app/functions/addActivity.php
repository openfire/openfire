<? function addActivity($message){

$activity = new Activity();

$params = array(
"uuid" => md5(microtime()),
"message" => $message
);

$activity->insert($params);

return $activity;
}