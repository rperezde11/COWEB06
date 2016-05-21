document.observe("dom:loaded",function(){
    
    $("submit-register").onclick = function(){userExistsInDB();}
    $$('.val-input').each(function(elem){
        elem.onclick = function(){
            $$('.error-msg').each(function(e){e.remove();});
        }
    });
    
    
});

// AJAX FUNCTIONS

function userExistsInDB(){
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function(){
        
        if(xhttp.readyState==4 && xhttp.status==200){
            
            var isFirstnameValid = nameValid($("firstname").value);
            var isSecondnameValid = nameValid($("secondname").value);
            var isEmailValid = emailValid($("email").value);
            var isIdnValid = idValid($("id_number").value);
            var isPasswordValid = passwordValid($("password").value);
            var isBirthValid = birthValid($("birth").value);
            
            if(!isFirstnameValid){
                $("firstname").insert({after:"<p id='firstname-syntax-error' class='error-msg' style='color:red'>First name must only contain letters</p>"});  
            }       
            if(!isSecondnameValid){
                $("secondname").insert({after:"<p id='secondname-syntax-error' class='error-msg' style='color:red'>Lastname must only contain letters</p>"});  
            }
            if(!isEmailValid){
                $("email").insert({after:"<p id='email-syntax-error' class='error-msg' style='color:red'>Your email must follow the foo@domain.xxx pattern</p>"});  
            }
            if(!isIdnValid){
                $("id_number").insert({after:"<p id='idn-syntax-error' class='error-msg' style='color:red'>Your identification number must be 8 numbers and a final letter</p>"});  
            }    
            if(!isPasswordValid){
                $("password").insert({after:"<p id='password-syntax-error' class='error-msg' style='color:red'>Password must consist on between 3 and 20 alfanumeric characters</p>"});  
            }    
            if(!isBirthValid){
                $("birth").insert({after:"<p id='birth-syntax-error' class='error-msg' style='color:red'>Birth incorrect.</p>"});  
            }
            if (xhttp.responseText != "0"){
                $("email").insert({after:"<p id='email-error' class='error-msg' style='color:red'>Email already exists on the database!!</p>"});      
            }
            
            var isSyntaxCorrect = isFirstnameValid && isSecondnameValid && isEmailValid &&
                                    isIdnValid && isPasswordValid && isBirthValid;
            
            if(xhttp.responseText == "0" && isSyntaxCorrect){
                $("registration-form").submit();
            } 
        }
    }
    
    xhttp.open("GET","ajax/AJAX-userValidation.php?email="+$("email").value,true);
    xhttp.send();
}