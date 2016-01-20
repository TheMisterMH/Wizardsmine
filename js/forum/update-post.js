
var post;

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
    post= jsonObj.post
});

$(document).ready(function(){
    $("#forum-reply-text").val(post);
});