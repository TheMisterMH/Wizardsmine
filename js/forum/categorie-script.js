$(document).ready(function(){

    $.post('../php/forum.php', { type: "categories" }, function(data){
        var jsonObj = $.parseJSON(data);

        $("#categories").css({
            display: "inline"
        });

        for(cat_loop = 0; cat_loop < jsonObj.categories.length; cat_loop++){

            $("#categorie-"+cat_loop+" h3").html(jsonObj.categories[cat_loop].name + "<br>" + jsonObj.categories[cat_loop].description);

        }

        for(top_loop = 0; top_loop < jsonObj.topics.length; top_loop++){

            var topicname = $("#topic-"+top_loop+" p a");
            topicname.html(jsonObj.topics[top_loop].name);
            topicname.attr("href", "http://localhost/wizardsmine/forum/topics.php?topic_id=" + jsonObj.topics[top_loop].id);

            $("#topic-"+top_loop+" p:eq(1)").html(jsonObj.topics[top_loop].description + "<br>Discussions: <b>" + jsonObj.topic_count.discussions[top_loop] +"</b> Posts: <b>"+ jsonObj.topic_count.posts[top_loop] + "</b>");
        }
    });
});