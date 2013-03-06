<? class Message extends Thingy{

    protected $table = 'messages';
    var $user;
    var $replies = array();

        function __construct($id = null) {
        parent::__construct($id);

        $this->user = new User($this->userID);

        global $dbh;

        $sth = $dbh->prepare("SELECT id FROM messages where replyTo='$this->id'  order by dateAdded desc");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $u){
$this->replies[] = new Message($u['id']);
}

    }


}