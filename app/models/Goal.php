<? class Goal extends Thingy{

    protected $table = 'goals';
    var $project;
    var $daysUntilTarget;
    var $backers = array();
    var $rewards = array();
    var $percentComplete;


    
    
        function __construct($id = null) {
        parent::__construct($id);

        global $dbh;


        if($this->currentAmount > 0){
            $this->percentComplete = ($this->currentAmount / $this->targetAmount) * 100;
            }else{
                $this->percentComplete = 0;
            }
            if($this->percentComplete > 100) $this->percentComplete = 100;

        $this->daysUntilTarget = floor(($this->targetDate - time()) / 86400);
        if($this->daysUntilTarget < 0) $this->daysUntilTarget = 0;

$sth = $dbh->prepare("SELECT userID, amount, rewardID, status FROM backers where goalID='$this->id'");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

$inarray = array();
foreach($result as $b){
    $tuser = new User($b['userID']);
    $tuser->amount = $b['amount'];
    $tuser->reward = new Reward($b['rewardID']);
    $tuser->status = $b['status'];
$this->backers[] = $tuser;

}

$sth = $dbh->prepare("SELECT id FROM rewards where goalID='$this->id' and deleted='0' order by minAmount asc");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $b){

$this->rewards[] = new Reward($b['id']);

}


    }











function setCurrent(){

global $dbh;
$sth = $dbh->prepare("update goals set isCurrent='0' where projectID = '$this->projectID'");
$sth->execute();

$this->update(array("isCurrent" => "1"));

}

}