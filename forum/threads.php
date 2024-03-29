<!DOCTYPE html>
<html>
    <head>
        <script src="../js/jquery.js"></script>
        <script src="../js/forum/forum-navigation.js"></script>

        <script src="../js/forum/thread-script.js"></script>

        <script src="../js/menu-bar.js"></script>
        <script src="../js/main-menu.js"></script>

        <title>Forum - Wizardsmine</title>
        <link rel="shortcut icon" type="image/png" href="http://localhost/wizardsmine/img/icon.png">
        <link rel="stylesheet" type="text/css" href="../css/style.css">

        <style>
            .post {
                display: none;
            }
            .edit-button {
                display: none;
            }
        </style>
    </head>

    <body>
        <div id="user-menu"></div>
        <div id="main-menu"></div>

        <div id="forum-navigation">
            <ul>
                <li><a id="forum-nav-main" href="http://localhost/wizardsmine/forum/home.php">Forum</a></li>
                <li><a id="forum-nav-categorie"></a></li>
                <li><a id="forum-nav-topic"></a></li>
                <li><a id="forum-nav-thread"></a></li>
            </ul>
        </div>

        <button onclick="location.href = 'http://localhost/wizardsmine/forum/reply.php?thread_id=' + getQueryVariable('thread_id')">Reply</button>

        <div id="thread">
            <div class="post" id="post-0">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-0"><button id="edit_button-0">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-1">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-1"><button id="edit_button-1">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-2">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-2"><button id="edit_button-2">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-3">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-3"><button id="edit_button-3">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-4">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-4"><button id="edit_button-4">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-5">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-5"><button id="edit_button-5">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-6">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-6"><button id="edit_button-6">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-7">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-7"><button id="edit_button-7">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-8">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-8"><button id="edit_button-8">Edit</button></li>
                </ul>
            </div>
            <div class="post" id="post-9">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="edit-button" id="edit-button-9"><button id="edit_button-9">Edit</button></li>
                </ul>
            </div>
        </div>
    </body>
</html>