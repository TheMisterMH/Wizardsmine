tinymce.init({
    selector: '#forum-reply-text',
    menu: {
        edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
        format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
        table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
        tools: {title: 'Tools', items: 'spellchecker code'},
        insert: {title: 'Insert', items: 'insertdatetime link'},
        font: {title: 'Fonts', items: 'fontselect fontsizeselect'}
    },
    toolbar: ['undo, redo, alignleft, aligncenter, alignright, alignjustify, cut, copy, paste, bullist, numlist, outdent, indent, blockquote, emoticons | fontselect, fontsizeselect forecolor backcolor'],
    plugins: 'code, table link insertdatetime emoticons textcolor colorpicker',
    height: 300,
    width: 700,
    max_height: 500,
    fontsize_formats: '12pt 14pt 18pt 24pt 36pt'
});

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
     $("#thread_reply").submit(function(){
         var post = tinyMCE.get('forum-reply-text').getContent();
         var thread_id = getQueryVariable("thread_id");
         alert(post);
         $.post('../php/forum.php', { type: "new_post", thread_id: thread_id , post: post }, function(data){
             alert(data);

             var jsonObj = $.parseJSON(data);

             if(jsonObj.status == "true"){
                 alert("Succesfuly post submitted");
                 location.href = "threads.html?thread_id=" + thread_id;
             } else {
                 alert("failed to upload post: " + jsonObj.error);
             }
         });
         return false;
     });

    $("#create_thread").submit(function(){
        var post = tinyMCE.get('forum-reply-text').getContent();
        var topic_id = getQueryVariable("topic_id");
        var thread_name = $("#thread_name").val();

        $.post('../php/forum.php', { type: "new_thread", topic_id: topic_id, name: thread_name, post: post }, function(data){
            alert(data);

            var jsonObj = $.parseJSON(data);
            alert(jsonObj);

            if(jsonObj.status == "true"){
                alert("Succesfuly thread created");
                location.href = "threads.html?thread_id=" + jsonObj.thread_id;
            } else {
                alert("Failed to create thread: " + jsonObj.error);
            }
        });
        return false;
    });

    $("#update_post").submit(function(){
        var post = tinyMCE.get('forum-reply-text').getContent();
        var post_id = getQueryVariable("post_id");

        $.post('../php/forum.php', { type: "update_editor_post", post: post, post_id: post_id }, function(data){
            alert(data);
        });
        return false;
    });
});












