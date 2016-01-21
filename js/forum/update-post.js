
var post;

$.ajax({
    type: 'POST',
    url: '../php/forum.php',
    data: { type: "load_editor_post", post_id: getQueryVariable("post_id") },
    async: false
}).done(function(data){
    alert(data);
    var jsonObj = $.parseJSON(data);
    post = jsonObj.post;
});

$(document).ready(function(){
    //TODO check the status
    $("#forum-reply-text").val(post);
});