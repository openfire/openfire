<?php
abstract class Thingy {

    // The main database table associated with this class
    protected $table = null;

    // This assigns a dynamic method when a user tries to set an undeclared property.
    function __set($name, $value) {
        $this->$name = $value;
    }

    // This just returns an unknown property when a user tries to get an unset property.
    function __get($value) {
        return false;
    }

    function __construct($id=null) {
        global $dbh;
        if(isset($id)) {
            $this->retrieve($id);
        } else {
            // TODO: Probably better to explicitly construct the properties
            // DESCRIBE is nice and dynamic but if the item structure doesn't change much
            // then this puts unnecessary load on the server, however small.. it adds up
            // with lots of users accessing the site at once
            if($this->table != null){
            $query = "DESCRIBE " . $this->table;
            $result = $dbh->query($query);
            if(!empty($result)){
                foreach($result as $fieldinfo) {
                $this->$fieldinfo['Field'] = '';
                }
            }
        }
}
    }

    function retrieve($id) {
        global $dbh;
		$dbh->query('SET CHARACTER SET utf8');
        $query  = "SELECT *";
        $query .= " FROM " . $this->table . "";
        $query .= " WHERE id = " . intval($id) . "";
        $query .= " LIMIT 1";
        $query .= ";";
        $result = $dbh->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) > 0) foreach($rows[0] as $key=>$value) $this->$key = $value; 

    }


    function insert($vars = array()) {
global $dbh;

array_walk($vars, function(&$string, $x) { $string = addSlashes($string); });

        $query  = "INSERT INTO " . $this->table . "";
        $query .= " (" . implode(',', array_keys($vars)) . ", dateAdded)";
        $query .= " VALUES";
        $query .= " (\"" . implode("\",\"", $vars)             . "\", UNIX_TIMESTAMP())";
        $query .= ";";

        $sth = $dbh->prepare($query);
        $sth->execute();

        // $arr = $sth->errorInfo();
        // print_r($arr);
        $lid = $dbh->lastInsertId();
        $this->retrieve($lid);
    }


    function update($vars = array()) {
        global $dbh;
array_walk($vars, function(&$string, $x) { $string = addSlashes($string); });
        $query = "UPDATE " . $this->table . " SET ";
        $i = 1;
        foreach($vars as $key => $val) {
            $query .= "" . $key . " = '" . $val . "'";
            if($i < count($vars)) $query .= ", ";
            $i++;
        }
        $query .= " WHERE id = '" . intval($this->id);
        $query .= "' LIMIT 1";
        $query .= ";";

        $sth = $dbh->prepare($query);
        $sth->execute();
        $this->retrieve($this->id);
    }



    function delete(){
        $query  = "DELETE FROM " . $this->table . "";
        $query .= " WHERE id = " . intval($this->id);
        $query .= " LIMIT 1";
        $query .= ";";
        $result = $dbh->query($query);
    }
}