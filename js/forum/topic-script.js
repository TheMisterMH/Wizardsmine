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
    var topic = getQueryVariable("topic_id");
    $.post('../php/forum.php', { type: "topics", topic_id: topic }, function(data){
        alert(data);

        var jsonObj = $.parseJSON(data);

        for(i = 0; i < jsonObj.threads.length; i++){

            $( "#threads" ).append( "<ul><li>Thread id: " + jsonObj.threads[i].id +"</li><li><a href='threads.html?thread_id=" + jsonObj.threads[i].id + "'>" + jsonObj.threads[i].name +"</a></li><li>" + jsonObj.threads[i].user_id +"</li><li>" + jsonObj.threads[i].post_date +"</li><li>" + jsonObj.threads[i].web_name +"</li></ul>" );

        }
        //$("#threads").html(data);
    });


});