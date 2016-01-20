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
        //$("#thread").html(data);
        var jsonObj = $.parseJSON(data);

        for(i = 0; i < jsonObj.posts.length; i++){

            var post_id = jsonObj.posts[i].id;
            var post_text = jsonObj.posts[i].post_text;
            var user_id = jsonObj.posts[i].user_id;
            var post_date = jsonObj.posts[i].date;
            var user_name = jsonObj.posts[i].web_name;
            var session_id = jsonObj.user_id;

            $( "#thread" ).append( "<div><ul><li>Post id: " + post_id + "</li><li>" + post_text + "</li><li>User id: " + user_id + "</li><li>" + user_name + "</li><li>" + post_date + "</li><li id='edit_button-" + post_id + "'><button class='edit_button' onclick='send_to_editor(" + jsonObj.posts[i].id + ")'>Edit</button> </li></ul></div><br>" );

            if(user_id != session_id){
                //set button to hidden
                $("#edit_button-"+post_id).css({
                    display: "none"
                });
            }
        }
    });
});

function send_to_editor(id){
    location.href = 'http://localhost/wizardsmine/forum/post-editor.php?post_id=' + id;
}
