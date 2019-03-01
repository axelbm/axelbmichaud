
$(document).ready(function(){
    $("#register-btn").click(function(){
        $("#register-box").show();
        $("#login-box").hide();
    });
    
    $("#login-btn").click(function(){
        $("#register-box").hide();
        $("#login-box").show();
    });
});