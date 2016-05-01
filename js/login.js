document.observe("dom:loaded",function(){
    
    $("submit-login").onclick = function(){userValid();}
    $$('.val-input').each(function(elem){
        elem.onclick = function(){
            $$('.error-msg').each(function(e){e.remove();});
        }
    });
});

// AJAX FUNCTIONS
function userValid() {
    new Ajax.Request("validate-login.php",{
        method:"post",
        parameters:"email="+$('email-input').value+"&password="+$('password-input').value,
        asynchronous: true,
        onComplete: 
        function(e){
            if(e.responseText == "1"){
                $("form-login").submit();
            } else {
                if($('login-error') == undefined) {
                    $("password-input").insert({after:"<p id='login-error' class='error-msg' style='color:red'>Sorry, Invalid Log in...</p>"});
                }
            }
        }
    });
}