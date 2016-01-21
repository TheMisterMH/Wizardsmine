/**
 * The div id:  forum-navigation
 * Main:        forum-nav-main
 * Categorie:   forum-nav-categorie
 * Topic:       forum-nav-topic
 * Thread:      forum-nav-thread
 *
 * home.php                     main
 * topics.php?topic_id          main, categorie, topic
 * create_thread.php?topic_id   main, categorie, topic
 * threads.php?thread_id        main, categorie, topic, thread
 * reply.php?thread_id          main, categorie, topic, thread
 * update-post.php?post_id      main, categorie, topic, thread
 *
 */
function getQueryVariable(variable){
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}

$(document).ready(function(){

    var navigation_type;
    var navigation_value;

    if (getQueryVariable("topic_id") != false){
        //alert("topic id");
        navigation_type = "topic";
        navigation_value = getQueryVariable("topic_id");

    } else if (getQueryVariable("thread_id") != false){
        //alert("thread id");
        navigation_type = "thread";
        navigation_value = getQueryVariable("thread_id");

    } else if (getQueryVariable("post_id") != false){
        //alert("post id");
        navigation_type = "post";
        navigation_value = getQueryVariable("post_id");

    } else {
        //alert("home");
        return;
    }

    $.post('../php/forum.php', { type: "navigation", nav_type: navigation_type, nav_value: navigation_value }, function(data){
        //alert(data);
        var jsonObj = $.parseJSON(data);

        var forum_nav_categorie = $("#forum-nav-categorie");
        var forum_nav_topic = $("#forum-nav-topic");
        var forum_nav_thread = $("#forum-nav-thread");

        switch (navigation_type){
            case "topic":
                //{"status":"true","result":{"categorie":[{"id":"1","0":"1","name":"General","1":"General"}],"topic":[{"id":"3","0":"3","name":"Rules","1":"Rules"}]}}
                forum_nav_categorie.html(jsonObj.result.categorie[0].name);
                forum_nav_categorie.attr("href", "http://localhost/wizardsmine/forum/home.php");

                forum_nav_topic.html(jsonObj.result.topic[0].name);
                forum_nav_topic.attr("href", "http://localhost/wizardsmine/forum/topics.php?topic_id="+jsonObj.result.topic[0].id);
                break;
            case "thread":
                //{"status":"true","result":{"categorie":[{"id":"1","0":"1","name":"General","1":"General"}],"topic":[{"topic_id":"1","0":"1","name":"General discussions","1":"General discussions"}],"thread":[{"id":"3","0":"3","name":"BUTIFULL NEW THREAD","1":"BUTIFULL NEW THREAD"}]}}
                forum_nav_categorie.html(jsonObj.result.categorie[0].name);
                forum_nav_categorie.attr("href", "http://localhost/wizardsmine/forum/home.php");

                forum_nav_topic.html(jsonObj.result.topic[0].name);
                forum_nav_topic.attr("href", "http://localhost/wizardsmine/forum/topics.php?topic_id="+jsonObj.result.topic[0].topic_id);

                forum_nav_thread.html(jsonObj.result.thread[0].name);
                forum_nav_thread.attr("href", "http://localhost/wizardsmine/forum/threads.php?thread_id="+jsonObj.result.thread[0].id);
                break;
            case "post":
                //{"status":"true","result":{"categorie":[{"id":"1","0":"1","name":"General","1":"General"}],"topic":[{"topic_id":"3","0":"3","name":"Rules","1":"Rules"}],"thread":[{"thread_id":"5","0":"5","name":"New rules","1":"New rules"}]}}
                forum_nav_categorie.html(jsonObj.result.categorie[0].name);
                forum_nav_categorie.attr("href", "http://localhost/wizardsmine/forum/home.php");

                forum_nav_topic.html(jsonObj.result.topic[0].name);
                forum_nav_topic.attr("href", "http://localhost/wizardsmine/forum/topics.php?topic_id="+jsonObj.result.topic[0].topic_id);

                forum_nav_thread.html(jsonObj.result.thread[0].name);
                forum_nav_thread.attr("href", "http://localhost/wizardsmine/forum/threads.php?thread_id="+jsonObj.result.thread[0].thread_id);
                break;
        }
    });


});