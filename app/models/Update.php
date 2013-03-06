<? class Update extends Thingy{

    protected $table = 'updates';
    var $goal;
    var $user;
    var $project;
    
    
        function __construct($id = null) {
        parent::__construct($id);

        global $dbh;
        $sth = $dbh->prepare("SELECT id FROM goals where uuid='$this->goalID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$this->goal = new Goal($result['id']);

        $sth = $dbh->prepare("SELECT id FROM projects where id='" . $this->goal->projectID . "' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$this->project = new Project($result['id']);

        $sth = $dbh->prepare("SELECT id FROM users where id='$this->userID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$this->user = new User($result['id']);



    }

}