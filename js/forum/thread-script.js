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
    var thread = getQueryVariable("thread_id");
    $.post('../php/forum.php', { type: "thread", thread_id: thread }, function(data){
        //alert(data);

        var jsonObj = $.parseJSON(data);

        var topic = $("#topic_ref");
        topic.html(jsonObj.topic[0].name);
        topic.attr("href", "http://localhost/wizardsmine/forum/topics.html?topic_id=" + jsonObj.topic[0].topic_id);

        for(i = 0; i < jsonObj.posts.length; i++){

            var post_id = jsonObj.posts[i].id;
            var user_id = jsonObj.posts[i].user_id;
            var session_id = jsonObj.user_id;

            $("#post-"+i+" ul li:eq(0)").html(jsonObj.posts[i].id);
            $("#post-"+i+" ul li:eq(1)").html(jsonObj.posts[i].post_text);
            $("#post-"+i+" ul li:eq(2)").html(user_id);
            $("#post-"+i+" ul li:eq(3)").html(jsonObj.posts[i].date);
            $("#post-"+i+" ul li:eq(4)").html(jsonObj.posts[i].web_name);
            $("#post-"+i+" ul li:eq(5)").html(session_id);

            $("#post-"+i).css({
                display: "inline"
            });

            //$( "#thread" ).append( "<div><ul><li>Post id: " + post_id + "</li><li>" + post_text + "</li><li>User id: " + user_id + "</li><li>" + user_name + "</li><li>" + post_date + "</li><li id='edit_button-" + post_id + "'><button class='edit_button' onclick='send_to_editor(" + jsonObj.posts[i].id + ")'>Edit</button> </li></ul></div><br>" );

            //alert(user_id +"<br>"+ session_id);

            if(user_id == session_id) {

                $("#edit-button-"+i).css({
                    display: "inline"
                });

                $("#edit_button-"+i).attr("onclick", "to_post(" + post_id + ")");

            }
        }
    });
});
function to_post(post_id){
    location.href = "http://localhost/wizardsmine/forum/post-editor.php?post_id=" + post_id;
}
