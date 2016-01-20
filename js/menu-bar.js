$(document).ready(function(){
//Get the user bar template and add it to the page
    $.post('http://localhost/wizardsmine/template/user-menu.html', function(data){
        $("#user-menu").html(data);

        get_session_data();

    });
});


//When the template has loaded get the php data from the database
function get_session_data(){
    $.post('http://localhost/wizardsmine/php/php-user-menu.php', function(data){

        var jsonObj = $.parseJSON(data);    //All the variable get from the php file
                                            /* List of variables:
                                             * - login      true if player has logged in and false if not
                                             *
                                             * When logged in also this variables:
                                             * - name       the username
                                             * - id         the users Id from the database
                                             */

        if (jsonObj.login == "true"){
/* The user is logged on
 * - Change css that the logged on part will show
 * - Edit the inner text: name etc.
 * - Trigger logout button function
 */
            $(".user-bar").css({
                display: "inline-block"
            });

            var name = $("#name");
            name.html(jsonObj.name);
            name.attr("href", "http://www.google.com/");

            $("#user_id").html("ID: " + jsonObj.web_id);

            add_logout_event();

        } else {

/* The user is NOT logged on
 * - Show the default user menu bar with the login and register button
 */
            $(".user-bar-login").css({
                display: "inline-block"
            });
        }
    });
}

function add_logout_event(){
    $("#logout-button").click(function(){
        $.post('http://localhost/wizardsmine/php/session.php', { create_session: "true", sesstype: "logout" }, function(data){
            if(data){
                location.href = "http://localhost/wizardsmine/"
            }
        });
    });
}
