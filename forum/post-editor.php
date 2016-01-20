<?php
require '../php/session.php';

$sess = new session();
if(!$sess->check_session()){
    header("Location: http://localhost/wizardsmine/login/login.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery.js"></script>
        <script src="../js/forum/update-post.js"></script>

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

        <form id="update_post" class="post-editor" method="post">
            <textarea id="forum-reply-text">Hello world!</textarea>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>