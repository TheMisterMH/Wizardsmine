$(document).ready(function(){
    $.post('http://localhost/wizardsmine/template/main-menu.html', function(data){
        $("#main-menu").html(data);
    });
});