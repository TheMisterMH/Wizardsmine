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
        <title>Login - Wizardsmine</title>
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
            <h1>Please login!</h1>
            <form id="login-form" method="post">
                Email: <input type="email" id="login-email"><br>
                Password: <input type="password" id="login-pass"><br>
                <input type="submit" value="Login!"><br>
            </form>
        </div>
        <div id="login-feedback"></div>
    </body>
</html>