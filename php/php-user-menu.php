<?php

require 'session.php';

class user_menu {

    function __construct(){
        $sess = new session();
        if ($sess->check_session()){
            $arr = array('login' => 'true', 'name' => $sess->get_name(), 'web_id' => $sess->get_user_id());
            echo json_encode($arr);
        } else {
            $arr = array('login' => 'false');
            echo json_encode($arr);
        }
    }
}
new user_menu();
?>