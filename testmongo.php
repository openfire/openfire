<? require_once('app/conf/global.php');
  try {
    // connect to MongoHQ assuming your MONGOHQ_URL environment
    // variable contains the connection string
    $connection_url = "mongodb://jzellis:Dookie187!@linus.mongohq.com:10036/app13484854";
 
    // create the mongo connection object
    $m = new Mongo($connection_url);
 
    // extract the DB name from the connection path
    $url = parse_url($connection_url);
    $db_name = preg_replace('/\/(.*)/', '$1', $url['path']);
    echo $db_name;
 
    // use the database we connected to
    $db = $m->selectDB($db_name);

    $collection = $db->selectCollection('users');

    global $dbh;

$sth = $dbh->prepare("SELECT id FROM users");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $u){

$user = new User($u['id']);

$muser = array(
"username" => $user->username,
"email" => $user->email,
"password" => $user->password,
"name" => array("firstName" => $user->firstName, "lastName" => $user->lastName),
"location" => $user->location,
"bio" => $user->bio,
"address" => array("address1" => $user->address1, "address2" => $user->address2, "city" => $user->city, "state" => $user->state, "country" => $user->country, "postal" => $user->postalCode),
"auth" => array(
"fb" => $user->facebookToken,
"tw" => array("token" => $user->twitterAuthToken, "secret" => $user->twitterAuthSecret),
        ),
"active" => "1",
"adminUser" => $user->adminUser,
"dateAdded" => new MongoDate($user->dateAdded),
"lastLogin" => new MongoDate($user->lastLogin)
  );

echo "<pre>";
print_r($muser);
echo "</pre>";
// $collection->insert($muser);
}


 
    // echo "<h2>Collections</h2>";
    // echo "<ul>";
 
    // // print out list of collections
    // $cursor = $db->listCollections();
    // $collection_name = "";
    // foreach( $cursor as $doc ) {
    //   echo "<li>" .  $doc->getName() . "</li>";
    //   $collection_name = $doc->getName();
    // }
    // echo "</ul>";
 
    // // print out last collection
    // if ( $collection_name != "" ) {
    //   $collection = $db->selectCollection('users');
    //   echo "<h2>Documents in ${collection_name}</h2>";
 
    //   // only print out the first 5 docs
    //   $cursor = $collection->find();
    //   $cursor->limit(5);
    //   echo $cursor->count() . ' document(s) found. <br/>';
    //   foreach( $cursor as $doc ) {
    //     echo "<pre>";
    //     var_dump($doc);
    //     echo "</pre>";
    //   }
    // }
 
    // disconnect from server
    $m->close();
  } catch ( MongoConnectionException $e ) {
    die('Error connecting to MongoDB server');
  } catch ( MongoException $e ) {
    die('Mongo Error: ' . $e->getMessage());
  } catch ( Exception $e ) {
    die('Error: ' . $e->getMessage());
  }
?>