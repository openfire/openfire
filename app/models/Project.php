<? class Project extends Thingy{

    protected $table = 'projects';
    var $goals = array();
    var $creator;
    var $team = array();
    var $updates = array();
    var $backers = array();
    var $messages = array();
    var $urls = array();
    var $press = array();
    var $currentGoalID;
    var $category;
    var $facebook;
    
    
        function __construct($id = null) {
        parent::__construct($id);

        $this->creator = new User($this->creatorID);

       if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/projects/" . $this->uuid . ".png")){
        	$this->icon = "http://assets.openfi.re/images/projects/" . $this->uuid . ".png";
        }else{
        	$this->icon = "http://assets.openfi.re/images/projects/openfire_default_project.png";
        }

 global $dbh;
$query = "SELECT id, name, subcategoryOf FROM projectCategories where id='" . $this->categoryID . "'";
        $sth = $dbh->prepare($query);
$sth->execute();
$c = $sth->fetch(PDO::FETCH_ASSOC);
    $this->category = array(
    'id' => $c['id'],
    "name" => $c['name'],
    "subcategoryOf" => $c['subcategoryOf']
    );



// This will retrieve project goals
        $sth = $dbh->prepare("SELECT id FROM goals where projectID='" . $this->id . "' order by isCurrent desc, dateAdded asc");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $goal){
    $goal = new Goal($goal['id']);
    if($goal->isCurrent == 1) $this->currentGoalID = $goal->id;
	$this->goals[] = $goal;
}

$query = "SELECT userID, role, isAdmin FROM projectUsers where projectID='" . $this->id . "' order by isAdmin desc, dateAdded asc";
        $sth = $dbh->prepare($query);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $nuser){
	$ruser = new User($nuser['userID']);
    $ruser->role = $nuser['role'];
    $ruser->isAdmin = $nuser['isAdmin'];
    $this->team[] = $ruser;
}


        $sth = $dbh->prepare("SELECT id FROM projectURLs where projectID='" . $this->id . "' order by dateAdded desc");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $n){
    $url = new projectURL($n['id']);
    if($url->type == "facebook") $this->facebook = $url;
    if($url->type == "twitter") $this->twitter = $url;
    if($url->type == "linkedin") $this->linkedin = $url;
    if($url->type == "github") $this->github = $url;


    $this->urls[] = $url;
}

        $sth = $dbh->prepare("SELECT id FROM projectPress where projectID='" . $this->id . "' order by dateAdded desc");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $p){
    $this->press[] = new projectPress($p['id']);
}


$sth = $dbh->prepare("SELECT currentAmount FROM goals where projectID ='" . $this->id . "'");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $u){
$this->totalFunding += $u['currentAmount'];
}


    }

function getUpdates($offset = 0, $num = 10){

        global $dbh;

$sth = $dbh->prepare("SELECT id FROM updates where projectID='$this->id' and deleted='0'  order by dateAdded desc limit $offset, $num");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $u){
$this->updates[] = new Update($u['id']);
}



}

function getMessages($offset = 0, $num = 10){

        global $dbh;

$sth = $dbh->prepare("SELECT id FROM messages where projectID='$this->id'  order by dateAdded desc limit $offset, $num");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $u){
$this->messages[] = new Message($u['id']);
}



}

function getBackers($offset = 0, $num = 999){

        global $dbh;

        $inarray = array();

$sth = $dbh->prepare("SELECT userID, amount, goalID, rewardID, status FROM backers where goalID in (select id from goals where projectID='$this->id') limit $offset, $num");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $b){
    if(!in_array($b['userID'], $inarray)){
   $tuser = new User($b['userID']);
   $tuser->goal = new Goal($b['goalID']);
    $tuser->amount = $b['amount'];
    $tuser->reward = new Reward($b['rewardID']);
    $tuser->rewardStatus = $b['status'];
$this->backers[] = $tuser;
    $inarray[] = $b['userID'];
    }
}


}




function isAdmin($user){

        global $dbh;

$sth = $dbh->prepare("SELECT isAdmin FROM projectUsers where projectID ='$this->id' and userID = '" . $user->id . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

if($result['isAdmin'] == '0'){
    return false;
}else{
    return true;
}

}


function isMember($user){

        global $dbh;

$sth = $dbh->prepare("SELECT count(*) FROM projectUsers where projectID='$this->id' and userID = '" . $user->id . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

if($result['count(*)'] == '0'){
    return false;
}else{
    return true;
}

}

function isBacker($user){

        global $dbh;

$sth = $dbh->prepare("SELECT count(*) FROM backers where goalID in (select id from goals where projectID='$this->id') and userID = '" . $user->id . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

if($result['count(*)'] == '0'){
    return false;
}else{
    return true;
}

}


}