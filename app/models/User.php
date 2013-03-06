<? class User extends Thingy{

    protected $table = 'users';
    var $projects = array();
    var $backedGoals = array();
    
    
        function __construct($id = null) {
        parent::__construct($id);

        $this->fullName = $this->firstName . " " . $this->lastName;

        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/avatars/" . $this->uuid . ".png")){
        	$this->avatar = "http://assets.openfi.re/images/avatars/" . $this->uuid . ".png";
        }else{
        	$this->avatar = "http://assets.openfi.re/images/avatars/openfire_default_avatar.png";
        }
    }


    	function getProjects(){

    		global $dbh;

    		$sth = $dbh->prepare("SELECT projectID,type,isAdmin FROM projectUsers where userID='$this->id' order by dateAdded");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $p){
$project = new Project($p['projectID']);
$project->isAdmin = $p['isAdmin'];


    		$stg = $dbh->prepare("SELECT name from projectUserTypes where id='" . $p['type'] . "'");
$stg->execute();
$nresult = $stg->fetch(PDO::FETCH_ASSOC);
$project->userRole = $nresult['name'];

$this->projects[] = $project;

}

    	}


        function getBackedGoals(){

            global $dbh;

            $inarray = array();
$sth = $dbh->prepare("SELECT goalID from backers where userID='" . $this->id . "'");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $i){
if(!in_array($i['goalID'], $inarray)){
$this->backedGoals[] = new Goal($i['goalID']);
$inarray[] = $i['goalID'];
}

}






        }

}