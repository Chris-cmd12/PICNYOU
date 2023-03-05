<?php

class Comment extends Db_object {

    protected static $db_table = "comments";
    protected static $db_table_fields = array('comment_id','comment_author','comment_body','comment_u_id','comment_p_id');
    public $comment_id;
    public $comment_author;
    public $comment_body;
    public $comment_u_id;
    public $comment_p_id;



    // CRUD

    // ADD A COMMENT RELATED TO A SPECIFIC IMAGE
    public function create(){
        global $database;
        $properties = $this->clean_properties();
        $sql = "INSERT INTO " .static::$db_table ."(" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('". implode("','", array_values($properties)) ."') ";
        if($database->query($sql)) {
            $this->comment_id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }  
    }

        // UPDATE COMMENT
        public function update(){
            global $database;
            $properties = $this->clean_properties();
            $properties_pairs = array();
            foreach ($properties as $key => $value) {
                $properties_pairs[] = "{$key}='{$value}' ";
            }
            // INT DOESN'T REQUIRE A SINGLE QUOTE
            $sql = "UPDATE " .static::$db_table ." SET ";
            $sql .= implode(", ", $properties_pairs);
            $sql .= " WHERE comment_id= " . $database->escape_string($this->comment_id);
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }

        // IF USER ALREADY EXIST WE EDIT IT OTHERWISE WE CREATE IT
        public function save(){
            return isset($this->user_id) ? $this->update() : $this->create();
        }



        // DELETE COMMENT
        public function delete(){
            global $database;
            $sql = "DELETE FROM " . static::$db_table ." ";
            $sql .= " WHERE comment_id = " . $database->escape_string($this->comment_id);
            $database->query($sql);
        }

    // DELETE THE COMMENT
    public function delete_comment() {
        if($this->delete()){
        } else {
            return false;
        }
    }

    // END OF CRUD
    
    // FIND THE COMMENTS FROM A SPECIFIC IMAGE
    public static function find_the_comment($photo_id) {
		global $database;
		$sql = "SELECT * FROM " . self::$db_table;
		$sql .= " WHERE comment_p_id = " . $database->escape_string($photo_id);
		$sql .= " ORDER BY comment_p_id DESC LIMIT 3";
		return self::find_by_query($sql);
    }

        // FIND COMMENT BY ID
        public static function find_by_id($comment_id){
            global $database;
            $the_result_array = static::find_by_query("SELECT * FROM ". static::$db_table . "  WHERE comment_id = $comment_id");
            // TERNARY BEHAVIOR 
            // HOW IT WORK 
            // IF CONDITION IS RESPECTED THEN WE EXECUTE THE CODE ELSE WE DO THIS 
            return !empty($the_result_array) ? array_shift($the_result_array) : false;
        }

    // COUNT NUMBER OF COMMENT FOR A SPECIFIC USER
    public static function count_comment($session_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table . " WHERE comment_u_id = {$session_id} ";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        return array_shift($row);
    }
}

?>
