
var post;
var thread;
var topic;

function getQueryVariable(variable){
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}

$.ajax({
    type: 'POST',
    url: '../php/forum.php',
    data: { type: "load_editor_post", post_id: getQueryVariable("post_id") },
    async: false
}).done(function(data){
    alert(data);
    var jsonObj = $.parseJSON(data);
    post = jsonObj.post;
    topic = jsonObj.topic[0];
    thread = jsonObj.thread[0];
});

$(document).ready(function(){
    $("#forum-reply-text").val(post);
    var thread_ref = $("#thread");
    var topic_ref = $("#topic");

    thread_ref.html(thread.name);
    topic_ref.html(topic.name);

    thread_ref.attr("href", "http://localhost/wizardsmine/forum/threads.html?thread_id=" + thread.thread_id);
    topic_ref.attr("href", "http://localhost/wizardsmine/forum/topics.html?topic_id=" + topic.topic_id);
});