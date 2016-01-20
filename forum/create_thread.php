<?php
require '../php/session.php';

$sess = new session();
if(!$sess->check_session()){
    header("Location: http://localhost/wizardsmine/login/login.php");
    die;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="../js/jquery.js"></script>
        <script src="../js/tinymce/tinymce.min.js"></script>
        <script src="../js/forum/post-editor.js"></script>
        <script src="../js/menu-bar.js"></script>
        <script src="../js/main-menu.js"></script>
        <title>Forum - Wizardsmine</title>
        <link rel="shortcut icon" type="image/png" href="http://localhost/wizardsmine/img/icon.png">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div id="user-menu"></div>
        <div id="main-menu"></div>
        <a href="categories.html">Forum</a>
        <form id="create_thread">
            Name: <input type="text" id="thread_name">
            <textarea id="forum-reply-text">Hello world!</textarea>
            <input type="submit" value="Create thread!">
        </form>
    </body>
</html>
