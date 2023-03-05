<?php

class Photo extends Db_object { 

    protected static $db_table = "photos";
    protected static $db_table_fields = array('photo_id','photo_title','photo_filename','photo_type','photo_size', 'photo_u_id');
    public $photo_id;
    public $photo_title;
    public $photo_u_id;
    public $photo_filename;
    public $photo_type;
    public $photo_size;
    public $tmp_path;
    public $upload_directory = "images";
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

    // This is passing $_FILES['uploaded_file'] as an argument
    public function set_file($file) {
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif($file['error'] !=0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->photo_filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->photo_type = $file['type'];
            $this->photo_size = $file['size'];
        }
    }
    
    // PATH TO THE PICTURE
    public function picture_path() {
        return $this->upload_directory.'/'.$this->photo_filename;
    }

    // UPLOAD THE PHOTO IN THE DIRECTORY
    public function upload_photo() {
        if(!empty($this->errors)) {
            return false;
        }
        if(empty($this->photo_filename) || empty($this->tmp_path)){
            $this->errors[] = "the file was not available";
            return false;
        }
        $target_path = 'images/' . $this->photo_filename;
        if(file_exists($target_path)) {
            $this->errors[] = "The file {$this->photo_filename} already exists";
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

    // IT WILL VERIFY IF THE PHOTO IS ALREADY IN THE FOLDER
    public function save(){
        if($this->photo_id){
            $this->update();
        } else {
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->photo_filename) || empty($this->tmp_path)){
                $this->errors[] = "The file was not available";
                return false;
            }
            $target_path =  'images/' . $this->photo_filename;
            if(file_exists($target_path)){
                $this->errors[]= "The file {$this->photo_filename} already exists";
                return false;
            }
            if(move_uploaded_file($this->tmp_path, $target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->error[] = "The file directory probably does not have permission";
                return false;
            }
        }
    }

    // CRUD

    // CREATE PHOTO
    public function create(){
        global $database;
        $properties = $this->clean_properties();
        $sql = "INSERT INTO " .static::$db_table ."(" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('". implode("','", array_values($properties)) ."') ";
        if($database->query($sql)) {
            $this->photo_id = $database->the_insert_id();
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
            $sql .= " WHERE photo_id= " . $database->escape_string($this->photo_id);
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }
    

    // DELETE THE PHOTO
    public function delete(){
        global $database;
        $sql = "DELETE FROM " . static::$db_table ." ";
        $sql .= " WHERE photo_id = " . $database->escape_string($this->photo_id);
        $database->query($sql);
    }


    // FIND BY ID
    public static function find_by_id($photo_id){
        global $database;
        $the_result_array = static::find_by_query("SELECT * FROM ". static::$db_table . "  WHERE photo_id = $photo_id");
        // TERNARY BEHAVIOR 
        // HOW IT WORK 
        // IF CONDITION IS RESPECTED THEN WE EXECUTE THE CODE ELSE WE DO THIS 
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    // COUNT NUMBER OF PHOTO FOR A SPECIFIC USER
    public static function count_photo($session_id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table . " WHERE photo_u_id = {$session_id} ";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        return array_shift($row);
    }
}




?>