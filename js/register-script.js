var global_response = '';
var onloadCallbackCaptcha = function() {
    grecaptcha.render('captcha', {
        'sitekey': '6LeZkBQTAAAAAH8VGuJnbXhnew1c1tpa21ONsOQu',
        'callback': function (response) {
            global_response = response;
        }
    });
};

$(document).ready(function(){

    $("#login-form").submit(function(){
        var email = $("#login-email").val();
        var password = $("#login-pass").val();
        $.post('../php/user-handling.php', { type: "login-submit", email: email, pass: password}, function(data){
            if(data == true){
                alert("Succesfully logged in!");
                location.href = 'http://localhost/wizardsmine/';
            } else {
                $("#login-feedback").html(data);
            }
        });
        return false;
    });

    $("#register-form").submit(function(){
        var name = $("#register-name").val();
        var email = $("#register-email").val();
        var pass1 = $("#register-pass1").val();
        var pass2 = $("#register-pass2").val();
        $.post('../php/user-handling.php', { type: "register-submit", name: name, email: email, pass1: pass1, pass2: pass2, response: global_response } , function(data){
            if (data == true){
                alert("Succesfully registered!");
                $.post('../php/user-handling.php', { type: "login-submit", email: email, pass: pass1}, function(data) {
                    if (data == true) {
                        location.href = 'http://localhost/wizardsmine/';
                    }
                });
            } else {
                $("#feedback-box").html(data);
                grecaptcha.reset('captcha');
            }
        });
        return false;
    });

    $("#register-name").keyup(function(){
        var name = $("#register-name").val();
        if(name.length < 3 || name.length > 20){
            $("#name-check-box").html("Your name needs to be between 3 and 20 characters");
        } else {
            $("#name-check-box").html("<button id='name-check-button' onclick='register_name_checker()'>Check name</button>");

        }
    });

    $("#register-email").keyup(function(){
        var email = $("#register-email").val();
        $.post('../php/user-handling.php', { type: "register-email-check", email: email } , function(data){
            $("#feedback-box").html(data);
        })
    });

    $("#register-pass1").keyup(function(){
        register_pass_checker();
    });

    $("#register-pass2").keyup(function(){
        register_pass_checker();
    });
});

function register_pass_checker(){
    var pass = $("#register-pass1").val();
    if (pass.length < 8 || pass.length > 40){
        $("#pass-check").html("Password need to between 8 and 40 characters");
    } else {
        if(pass === $("#register-pass2").val()){
            $("#pass-check").html("Passwords match");
        } else {
            $("#pass-check").html("Passwords dont match!");
        }
    }
}

function register_name_checker(){
    var name = $("#register-name").val();
    $.post('../php/user-handling.php', { type: "register-name-check", name: name } , function(data){
        $("#feedback-box").html(data);
    });
}