<? include('app/conf/global.php'); echo md5(microtime()); echo "<br><br>"; echo time(); 

// $mail = new emailMessage;
// $mail->to = array("jzellis@gmail.com", "mmwggeis@sharklasers.com");
// $mail->subject = "Testing!";
// $mail->body = "Does this work?

// And does it work with formatting?";

// $mail->send();
// global $dbh;

// $sth = $dbh->prepare("SELECT id FROM messages");
// $sth->execute();
// $result = $sth->fetchAll(PDO::FETCH_ASSOC);

// foreach($result as $r){

// $m = new Message($r['id']);

// $params = array(
// "body" => "Hi there! Welcome to openfire! This is your project's first message."
// );

// $m->update($params);

// }

?>