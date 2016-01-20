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
    <head lang="en">
        <script src="../js/jquery.js"></script>
        <script src="../js/tinymce/tinymce.min.js"></script>
        <script src="../js/forum/post-editor.js"></script>
        <script src="../js/menu-bar.js"></script>
        <script src="../js/main-menu.js"></script>
        <title>Forum - Wizardsmine</title>
        <link rel="shortcut icon" type="image/png" href="http://localhost/wizardsmine/img/icon.png">
        <link rel="stylesheet" type="text/css" href="../css/style.css">

        <script>
            function getdata(){
                alert(tinyMCE.get('forum-reply-text').getContent());
            }
        </script>

    </head>
    <body>
        <div id="user-menu"></div>
        <div id="main-menu"></div>
        <a href="categories.html">Forum</a>
        <form id="thread_reply" class="post-reply" method="post">
            <textarea id="forum-reply-text">Hello world!</textarea>
            <input type="submit" value="Submit">
        </form>
        <button onclick="getdata()">Get data</button>
    </body>
</html>