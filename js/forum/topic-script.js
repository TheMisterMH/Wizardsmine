
$(document).ready(function(){
    var topic = getQueryVariable("topic_id");
    $.post('../php/forum.php', { type: "topics", topic_id: topic }, function(data){
        //alert(data);

        var jsonObj = $.parseJSON(data);

        for(i = 0; i < jsonObj.threads.length; i++){

            $("#thread-"+i).css({
                display: "inline"
            });

            var name = $("#thread-"+i+" ul li a");
            $("#thread-"+i+" ul li:eq(0)").html(jsonObj.threads[i].id);
            name.html(jsonObj.threads[i].name);
            $("#thread-"+i+" ul li:eq(2)").html(jsonObj.threads[i].user_id);
            $("#thread-"+i+" ul li:eq(3)").html(jsonObj.threads[i].post_date);
            $("#thread-"+i+" ul li:eq(4)").html(jsonObj.threads[i].web_name);

            name.attr("href", "http://localhost/wizardsmine/forum/threads.php?thread_id=" + jsonObj.threads[i].id);

            if (jsonObj.labels[i].got_label == "true"){
                for (loop = 0; loop < jsonObj.labels[i][i].length; loop++){

                    var label_type = jsonObj.labels[i][i][loop].label_type;

                    $("#thread-"+i+" ul .labels .label-"+label_type).css({
                        display: "inline"
                    });

                    //alert(jsonObj.labels[i][i][loop].label_type + "\n" + jsonObj.labels[i][i][loop].thread_id);
                }
            }
        }
    });
});






