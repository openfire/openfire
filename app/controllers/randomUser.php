<? class randomUser{

function get(){

global $dbh;


$sth = $dbh->prepare("SELECT username FROM users order by rand() limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

header("Location: /users/" . $result['username']);


}



}