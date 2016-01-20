<?php

class session {

    function __construct(){
        session_start();
        if(isset($_POST['sesstype'])){
            switch($_POST['sesstype']){

                case "check":
                    echo $this->check_session();
                    break;

                case "logout":
                    echo $this->logout();
                    break;

            }
        }
    }

    public function check_session(){
        if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
            return true;
        } else {
            return false;
        }
    }

    public function logout(){
        if($this->check_session()){
            session_unset();
            session_destroy();
            return true;
        } else {
            return false;
        }
    }

    public function get_name(){
        if ($this->check_session()){
            return $_SESSION['login_name'];
        }
    }

    public function get_user_id(){
        if ($this->check_session()){
            return $_SESSION['user_id'];
        }
        return -1;
    }

}
if (isset($_POST['create_session']) && $_POST['create_session']){
    new session();
}
?>