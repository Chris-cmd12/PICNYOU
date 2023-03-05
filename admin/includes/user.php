<?php

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('user_username','user_password','user_role','user_firstname','user_lastname', 'user_image', 'user_randsalt');
    public $user_id;
    public $user_username;
    public $user_password;
    public $user_role;
    public $user_firstname;
    public $user_lastname;
    public $user_image;
    public $user_randsalt;
    public $upload_directory = "images";
    public $tmp_path = "images";
    public $errors = array();
    public $upload_errors_array = array(

        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceds the upload_max_filesize directory",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    
    
    );

    // CHECK IF USER PUT A FILE WHILE CREATING ACCOUNT
    public function set_file($file) {
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif($file['error'] !=0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    // UPLOAD USER IMAGE IN THE DIRECTORY
    public function upload_user_image() {
        if(!empty($this->errors)) {
            return false;
        }
        if(empty($this->user_image) || empty($this->tmp_path)){
            $this->errors[] = "the file was not available";
            return false;
        }
        $target_path = 'images/'. $this->user_image;
        if(file_exists($target_path)) {
            $this->errors[] = "The file {$this->user_image} already exists";
            return false;
        }
        if(move_uploaded_file($this->tmp_path, $target_path)) {
                unset($this->tmp_path);
                return true;
        } else {
            $this->errors[] = "the file directory probably does not have permission";
            return false;
        }
    }

    // SELECT THE USER IMAGE
    public function user_image(){
        return $this->upload_directory.DS.$this->user_image;
    }

    // VERIFY IF USER EXIST IN THE DATABASE
    public static function verify_user($user_username, $user_password){
        global $database;
        $user_username = $database->escape_string($user_username);
        $user_password = $database->escape_string($user_password);
        $sql = "SELECT * FROM ". self::$db_table . "  WHERE user_username = '{$user_username}' AND user_password = '{$user_password}' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    // CRUD

    // CREATE USER
    public function create(){
        global $database;
        $properties = $this->clean_properties();
        $sql = "INSERT INTO " .static::$db_table ."(" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('". implode("','", array_values($properties)) ."') ";
        if($database->query($sql)) {
            $this->user_id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }  
    }

    // UPDATE USER
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
        $sql .= " WHERE user_id= " . $database->escape_string($this->user_id);
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    // IF USER ALREADY EXIST WE EDIT IT OTHERWISE WE CREATE IT
    public function save(){
        return isset($this->user_id) ? $this->update() : $this->create();
    }

    // DELETE USER
    public function delete(){
        global $database;
        $sql = "DELETE FROM " . static::$db_table ." ";
        $sql .= " WHERE user_id = " . $database->escape_string($this->user_id);
        $database->query($sql);
    }

    // END OF CRUD

    // FIND USER BY ID
    public static function find_by_id($user_id){
        global $database;
        $the_result_array = static::find_by_query("SELECT * FROM ". static::$db_table . "  WHERE user_id = $user_id");
        // TERNARY BEHAVIOR 
        // HOW IT WORK 
        // IF CONDITION IS RESPECTED THEN WE EXECUTE THE CODE ELSE WE DO THIS 
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


    

}

?>
