<?php

class Db_object {

    // FIND ALL ELEMENT INSIDE A TABLE
    public static function find_all(){
        return static::find_by_query("SELECT * FROM ". static::$db_table . " "); 
        }

    // VERIFY IF IT HAS THE ATTRIBUTE
    private function has_the_attribute($the_attribute){
        // GET ALL ATTRIBUTES FROM THE CLASS = GET_OBJECT_VARS
        $object_properties =  get_object_vars($this);
    //   VERIFY IF THE ATTRIBUTE IS IN THE OBJECT_PROPERTIES
        return array_key_exists($the_attribute, $object_properties);
    }

    // GET ALL DATA INSIDE A TABLE
    public static function instantation($the_record){
        $calling_class = get_called_class(); // RETURN THE CLASS NAME 
        $the_object = new $calling_class;
        foreach ($the_record as $the_attribute => $value) {
            if($the_object->has_the_attribute($the_attribute)){
                $the_object-> $the_attribute = $value;
            }
        }
        return $the_object;
    }

    // FIND AN ELEMENT WITH A QUERY
    public static function find_by_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = static::instantation($row); 
        }
        return $the_object_array;
    }

    // VALUE SEND BY THE USER
    protected function properties(){
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    // ESCAPE THE VALUE BEFORE SENDING IT IN THE DDB
    protected function clean_properties(){
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    // COUNT EVERY ROW INSIDE A TABLE
    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        return array_shift($row);
    }


    
}