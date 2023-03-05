<?php
class Session {

    private $signed_in = false; // VAR called PROPERTIES INSIDE A CLASS
    public $user_id;
    public $user_role;
    public $message;
    public $count;

    // CALL THIS METHOD EACH TIME THERE IS A NEW INSTANCE
    function __construct() 
    {
        session_start();
        $this->check_the_login();
        $this->check_the_role();
        $this->check_the_password();
        $this->visitor_count();
        $this->check_message();
    }

    // COUNT THE NUMBER OF REFRESH ON A PAGE
    public function visitor_count(){
        if(isset($_SESSION['count'])){
            return $this->count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 1;
        }
    }

    // DISPLAY A MESSAGE
    public function message($msg=""){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    // VERIFY A MESSAGE
    private function check_message(){
        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    // VERIFY IF THE USER IS CONNECTED
    public function is_signed_in(){
        return $this->signed_in;
    }

    // SET THE SESSION AND GIVE THE USER HIS ID
    public function login($password) {
        if($password){
            $this->user_password = $_SESSION['user_password'] = $password->user_password;
            $this->signed_in = true;
        }
    }

    // lOGOUT THE USER AND UNSET THE SESSION
    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }

    // VERIFY THE USER ID
    private function check_the_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    // VERIFY THE USER ROLE
    private function check_the_role(){
        if(isset($_SESSION['user_role'])){
            $this->user_role = $_SESSION['user_role'];
            $this->signed_in = true;
        } else {
            unset($this->user_role);
            $this->signed_in = false;
        }
    }

    private function check_the_password(){
        if(isset($_SESSION['user_password'])){
            $this->user_role = $_SESSION['user_password'];
            $this->signed_in = true;
        } else {
            unset($this->user_password);
            $this->signed_in = false;
        }
    }


}

$session = new Session();


?>