$(document).ready(function(){

//Get the categories and topics from the database

    $.post('../php/forum.php', { type: "categories" }, function(data){

        //$("#categories").html(data);

        var jsonObj = $.parseJSON(data);
        //$("#categories").html(jsonObj.categories.length);

        for(cat_loop = 0; cat_loop < jsonObj.categories.length; cat_loop++){

            $( "#categorie-list" ).append( "<li><div><h3>" + jsonObj.categories[cat_loop].name + "<br>" + jsonObj.categories[cat_loop].description + "</h3><ul id='categorie-"+cat_loop+"'></ul></div></li>" );

            for(top_loop = 0; top_loop < jsonObj.topics.length; top_loop++){
                if (jsonObj.topics[top_loop].cat_id == jsonObj.categories[cat_loop].id){
                    $("#categorie-"+cat_loop).append( "<li><p><a href='topics.html?topic_id=" + jsonObj.topics[top_loop].id + "'>" + jsonObj.topics[top_loop].name + "</a></p>" + jsonObj.topics[top_loop].description + "<br>Discussions: <b>" + jsonObj.topic_count.discussions[top_loop] +"</b> Posts: <b>"+ jsonObj.topic_count.posts[top_loop] + "</b><br></li>" );
                }
            }
        }

        //var cat = 0;
        //$("#categories").html(jsonObj[cat].id + "<br>" + jsonObj[cat].name + "<br>" + jsonObj[cat].description);
    });
});