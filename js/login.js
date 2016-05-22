document.observe("dom:loaded",function(){
    
    $("submit-login").onclick = function(){
        userValid( $('email-input').value, $('password-input').value );
    }
    $$('.val-input').each(function(elem){
        elem.onclick = function(){
            $$('.error-msg').each(function(e){e.remove();});
        }
    });
});

// AJAX FUNCTIONS
function userValid(email, pass) {
    new Ajax.Request("ajax/AJAX-validateLogin.php",{
        method:"post",
        parameters:"email="+email+"&password="+pass,
        asynchronous: true,
        onComplete: 
        function(e){
            if(e.responseText == "1"){
                jq.get('ajax/AJAX-handleLogin.php', {
                    email: email,
                    remember: jq('#checkbox-remember').prop("checked")
                }).done(function(data){
                    $("form-login").submit();
                });
            } else {
                if($('login-error') == undefined) {
                    $("password-input").insert({after:"<p id='login-error' class='error-msg' style='color:red'>Sorry, Invalid Log in...</p>"});
                }
            }
        }
    });
}