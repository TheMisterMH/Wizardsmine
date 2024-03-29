<!DOCTYPE html>
<html>
    <head>
        <script src="../js/jquery.js"></script>
        <script src="../js/forum/forum-navigation.js"></script>

        <script src="../js/forum/topic-script.js"></script>

        <script src="../js/menu-bar.js"></script>
        <script src="../js/main-menu.js"></script>

        <title>Forum - Wizardsmine</title>
        <link rel="shortcut icon" type="image/png" href="http://localhost/wizardsmine/img/icon.png">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <style>
            .thread {
                display: none;
            }
            .label-sticky {
                display: none;
            }
            .label-locked {
                display: none;
            }
            .label-hot {
                display: none;
            }
            .label-staff_response {
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
            </ul>
        </div>

        <button onclick="location.href = 'http://localhost/wizardsmine/forum/create_thread.php?topic_id=' + getQueryVariable('topic_id')">New thread</button>

        <div id="threads">
            <div class="thread" id="thread-0">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-1">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-2">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-3">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-4">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-5">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-6">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-7">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-8">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
            <div class="thread" id="thread-9">
                <ul>
                    <li></li>
                    <li><a></a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <ul class="labels">
                        <li class="label-sticky">Sticky</li>
                        <li class="label-locked">Locked</li>
                        <li class="label-hot" >Hot</li>
                        <li class="label-staff_response">Staff repsonse</li>
                    </ul>
                </ul>
            </div>
        </div>
    </body>
</html>