<?php

require_once 'db.inc.php';

class login_and_register {

    private $db_connection;

    function __construct(){
        $db = new database();
        $db->web_db_connect();
        $this->db_connection = $db->web_db_connection;
    }

    public function register($name, $email, $pass1, $pass2, $response){
        $name_check = $this->name_checker($name);
        $email_check = $this->email_checker($email);
        $pass = $this->pass_checker($pass1, $pass2);
        $captcha = user_handling::check_captcha($response);

        $name_char = strlen(preg_replace('/\s+/', '', $name));

        if(!$name_check){
            echo "That user already exists in the database<br>";
        } elseif ($name_char < 3 || $name_char > 20){
            echo "Name must be between 3 and 20 characters<br>";
        }
        if(!$email_check){
            echo "That email is already in use<br>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "No valid email address<br>";
        }
        if(!$pass){
            echo "The passwords doesnt match or isnt between 8 and 40 characters<br>";
        }
        if(!$captcha){
            echo "invalid captcha<br>";
        }
        if($name_check && $email_check && $pass && $captcha && filter_var($email, FILTER_VALIDATE_EMAIL) && $name_char >= 3 && $name_char <= 21){
            $password = sha1($pass1);

            $stmt = $this->db_connection->prepare("INSERT INTO users (email, password, web_name) VALUES (:email, :password, :web_name)");
            $stmt -> bindParam(':email', $email);
            $stmt -> bindParam(':password', $password);
            $stmt -> bindParam(':web_name', $name);

            $stmt -> execute();

            echo true;

        } else {
            echo "Couldnt register succesfully";
        }
    }

    public function login($email, $password){
        $num_rows = $this->db_connection->query("SELECT count(*) FROM users WHERE email='$email'")->fetchColumn();
        if($num_rows != 0){
            //account exists
            $stmt = $this->db_connection->prepare("SELECT id,web_name,password FROM users WHERE email=:email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            while ($row = $stmt->fetch()){
                $web_id = $row['id'];
                $web_name = $row['web_name'];
                $db_pass = $row['password'];
            }
            $password = sha1($password);
            if($db_pass == $password){
                echo true;
                session_start();
                $_SESSION['user_id'] = $web_id;
                $_SESSION['login_name'] = $web_name;
            } else {
                echo "You used the wrong password";
            }
        } else {
            echo "That account doesnt exist";
        }
    }

    public function name_checker($name){
        if(isset($name) && $name){
            $num_rows = $this->db_connection->query("SELECT count(*) FROM users WHERE web_name='$name'")->fetchColumn();
            if($num_rows == 0){
                return true;
            }
        }
        return false;
    }

    public function email_checker($email){
        if(isset($email) && $email){
            $num_rows = $this->db_connection->query("SELECT count(*) FROM users WHERE email='$email'")->fetchColumn();
            if ($num_rows == 0) {
                return true;
            }
        }
        return false;
    }

    private function pass_checker($pass1, $pass2){
        if ($pass1 && $pass2){
            if ($pass1 == $pass2){
                if(strlen($pass1) >= 8 && strlen($pass1) <= 40){
                    return true;
                }
            }
        }
        return false;
    }


}
?>