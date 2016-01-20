
$(document).ready(function(){

    $.post('../php/forum.php', { type: "navigation" , thread_id: getQueryVariable("thread_id"), topic_id: getQueryVariable("topic_id") }, function(data){

        var jsonObj = $.parseJSON(data);

        var topic_ref;

        if (jsonObj.thread != "false"){

            var thread_ref = $("#thread");
            topic_ref = $("#topic");

            thread_ref.html(jsonObj.thread.thread[0].name);
            topic_ref.html(jsonObj.thread.topic[0].name);

            thread_ref.attr("href", "http://localhost/wizardsmine/forum/threads.html?thread_id=" + jsonObj.thread.thread[0].id);
            topic_ref.attr("href", "http://localhost/wizardsmine/forum/topics.html?topic_id=" + jsonObj.thread.topic[0].topic_id);
        }

        if (jsonObj.topic != "false"){

            topic_ref = $("#topic");

            topic_ref.html(jsonObj.topic[0].name);

            topic_ref.attr("href", "http://localhost/wizardsmine/forum/topics.html?topic_id=" + jsonObj.topic[0].id);
        }


        /*if(jsonObj.topic)
        var thread_ref = $("#thread");
        var topic_ref = $("#topic");

        thread_ref.html(thread.name);
        topic_ref.html(topic.name);

        thread_ref.attr("href", "http://localhost/wizardsmine/forum/threads.html?thread_id=" + thread.thread_id);
        topic_ref.attr("href", "http://localhost/wizardsmine/forum/topics.html?topic_id=" + topic.topic_id);*/
    });


});