<? class projectCategory extends Thingy{

    protected $table = 'projectCategories';
    var $numProjects;
    var $subcategories;
     
    
        function __construct($id = null) {
        parent::__construct($id);

        global $dbh;


$sth = $dbh->prepare("SELECT count(*) FROM projects where categoryID = '$this->id'");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$this->numProjects = $result['count(*)'];

$stg = $dbh->prepare("SELECT id FROM projectCategories where subcategoryOf = '" . $this->id . "' order by name");
$stg->execute();
$resultg = $stg->fetchAll(PDO::FETCH_ASSOC);

foreach($resultg as $p){
	$this->subcategories[] = new projectCategory($p['id']);
}


    }



}