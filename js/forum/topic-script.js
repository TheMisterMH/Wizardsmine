function getQueryVariable(variable){
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}
var threads = ['0'];

$(document).ready(function(){
    var topic = getQueryVariable("topic_id");
    $.post('../php/forum.php', { type: "topics", topic_id: topic }, function(data){
        //alert(data);

        var jsonObj = $.parseJSON(data);

        for(i = 0; i < jsonObj.threads.length; i++){

            var thread_id = jsonObj.threads[i].id;

            if (check_sticky(jsonObj, i)){

                var counter = threads.length-1;

                add_thread(jsonObj, i, counter);

                threads[counter] = thread_id;
                threads[counter+1] = '0';
            }
        }

        for(i = 0; i < jsonObj.threads.length; i++){

            thread_id = jsonObj.threads[i].id;

            if (!check_array(thread_id)){

                counter = threads.length-1;

                add_thread(jsonObj, i, counter);

                threads[counter] = thread_id;
                threads[counter+1] = '0';

            } else {
                alert("NOPE"+ i);
            }
        }
    });
});

function add_thread(jsonObj, i, el_id){
    $("#thread-"+el_id).css({
        display: "inline"
    });

    var name = $("#thread-"+el_id+" ul li a");
    $("#thread-"+el_id+" ul li:eq(0)").html(jsonObj.threads[i].id);
    name.html(jsonObj.threads[i].name);
    $("#thread-"+el_id+" ul li:eq(2)").html(jsonObj.threads[i].user_id);
    $("#thread-"+el_id+" ul li:eq(3)").html(jsonObj.threads[i].post_date);
    $("#thread-"+el_id+" ul li:eq(4)").html(jsonObj.threads[i].web_name);

    name.attr("href", "http://localhost/wizardsmine/forum/threads.html?thread_id=" + jsonObj.threads[i].id);

    if (jsonObj.labels[i].got_label == "true"){
        for (loop = 0; loop < jsonObj.labels[i][i].length; loop++){

            var label_type = jsonObj.labels[i][i][loop].label_type;

            $("#thread-"+el_id+" ul .labels .label-"+label_type).css({
                display: "inline"
            });

            //alert(jsonObj.labels[i][i][loop].label_type + "\n" + jsonObj.labels[i][i][loop].thread_id);
        }
    }
}

function check_array(thread_id) {
    for(loop = 0; loop < threads.length; loop++){

        if(threads[loop] == thread_id){
            return true;
        }
    }
    return false;
}

function check_sticky(jsonObj, i){

    if (jsonObj.labels[i].got_label == "true") {
        for (loop = 0; loop < jsonObj.labels[i][i].length; loop++) {

            var label_type = jsonObj.labels[i][i][loop].label_type;

            if (label_type == "sticky") {
                return true;
            }
        }
    }
    return false;
}






