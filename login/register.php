<?php
require '../php/session.php';

$sess = new session();
if($sess->check_session()){
    header("Location: ../");
    die;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register - Wizardsmine</title>
        <script src="../js/jquery.js"></script>
        <script src="../js/register-script.js"></script>
        <script src="../js/menu-bar.js"></script>
        <script src="../js/main-menu.js"></script>
        <link rel="shortcut icon" type="image/png" href="http://localhost/wizardsmine/img/icon.png">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div id="user-menu"></div>
        <div id="main-menu"></div>
        <a href="../">Home</a>
        <div>
            Sign up now!<br>
            <form id="register-form" method="post">
                Name: <input type="text" id="register-name"><br>
                Email: <input type="email" id="register-email"><br>
                Password: <input type="password" id="register-pass1"><br>
                Confirm password: <input type="password" id="register-pass2"><br>
                <div id="captcha"></div>
                <input type="submit" value="Register!">
            </form>
        </div>
        <div id="name-check-box"></div>
        <div id="pass-check">pass check</div>
        <div id="feedback-box">feedback</div>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackCaptcha&render=explicit" async defer></script>
    </body>
</html>