<?php

include_once 'inc/db.inc.php';
include_once 'inc/login-and-register.inc.php';

class user_handling {

    function __construct(){
        if(isset($_POST['type'])){

            switch ($_POST['type']){
                case "register-submit":
                    $register = new login_and_register();
                    $register->register($_POST['name'], $_POST['email'], $_POST['pass1'], $_POST['pass2'], $_POST['response']);
                    break;

                case "register-email-check":
                    $email_check = new login_and_register();
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        echo "No valid email address";
                        break;
                    }
                    if ($email_check->email_checker($_POST['email'])){
                        echo "That email is available";
                    } else {
                        echo "That email is already in use";
                    }
                    break;

                case "register-name-check":
                    $count = strlen(preg_replace('/\s+/', '', $_POST['name']));
                    if($count >= 3 && $count <= 20){
                        $name_check = new login_and_register();
                        if($name_check->name_checker($_POST['name'])){
                            echo "Available username!";
                        } else {
                            echo "That username is not available";
                        }
                    } else {
                        echo "That is not a valid username";
                    }
                    break;

                case "login-submit":
                    $login = new login_and_register();
                    $login->login($_POST['email'], $_POST['pass']);
                    break;

                default:
                    echo "no valid type";
            }
        } else {
            echo "no type set";
            die;
        }
    }

    public static function check_captcha($response){
        if(isset($response) && $response){
            $secret = "6LeZkBQTAAAAAMygfEoUkr7B99h_j7csCaHaGwNK";
            $ip = $_SERVER['REMOTE_ADDR'];
            $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
            $arr = json_decode($rsp, true);
            if ($arr['success'] == 1){
                return true;
            }
        }
        return false;
    }
}
new user_handling();
?>