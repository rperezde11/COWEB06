// REGEX VALIDATION
function emailValid(email)
{
    var regex = /\b\w[^*^\/]*@[a-z]+.[a-z]{1,4}$/;
    var res = regex.test(email);
    return res;
}

function nameValid(name)
{
    var regex = /\b[a-zA-Z ]+$/;
    var res = regex.test(name);
    return res;
}

function idValid(id)
{
    var regex = /\b\d{8}[a-zA-Z]{1}$/;
    var res = regex.test(id);
    return res;
}

function passwordValid(password)
{
    var regex = /[0-9a-zA-Z]{5,20}/;
    var res = regex.test(password);
    return res;
}

function birthValid(birth)
{
    var regex = /\b(\d{4}[-\/]\d{2}[-\/]\d{2}$|\b\d{2}[-\/]\d{2}[-\/]\d{4})$/;
    var res = regex.test(birth);
    return res;
}

function cardNumberValid(number)
{
    var regex = /\b\d{4}-\d{4}-\d{4}-\d{4}$/;
    var res = regex.test(number);
    return res;
}
    
function validateFirstName() {
    var text = $("firstname").value;
    var valid = nameValid(text);
    if(valid){
        $("firstname").removeClassName("invalid");
        $("firstname").addClassName("valid");
    }else{
        $("firstname").removeClassName("valid");
        $("firstname").addClassName("invalid");
    }
}


function validateSecondName() {
    var text = $("secondname").value;
    var valid = nameValid(text);
    if(valid){
        $("secondname").removeClassName("invalid");
        $("secondname").addClassName("valid");
    }else{
        $("secondname").removeClassName("valid");
        $("secondname").addClassName("invalid");
    }
}

function validateId() {
    var text = $("id_number").value;
    var valid = idValid(text);
    if(valid){
        $("id_number").removeClassName("invalid");
        $("id_number").addClassName("valid");
    }else{
        $("id_number").removeClassName("valid");
        $("id_number").addClassName("invalid");
    }
}

function validateEmail() {
    var text = $("email").value;
    var valid = emailValid(text);
    if(valid){
        $("email").removeClassName("invalid");
        $("email").addClassName("valid");
    }else{
        $("email").removeClassName("valid");
        $("email").addClassName("invalid");
    }
}

function validatePassword() {
    var text = $("password").value;
    var valid = passwordValid(text);
    if(valid){
        $("password").removeClassName("invalid");
        $("password").addClassName("valid");
    }else{
        $("password").removeClassName("valid");
        $("password").addClassName("invalid");
    }
}

function validateBirth() {
    var text = $("birth").value;
    var valid = birthValid(text);
    if(valid){
        $("birth").removeClassName("invalid");
        $("birth").addClassName("valid");
    }else{
        $("birth").removeClassName("valid");
        $("birth").addClassName("invalid");
    }
}

function validateCardNumber() {
    var text = $("cardNumber").value;
    var valid = cardNumberValid(text);
    if(valid){
        $("cardNumber").removeClassName("invalid");
        $("cardNumber").addClassName("valid");
    }else{
        $("cardNumber").removeClassName("valid");
        $("cardNumber").addClassName("invalid");
    }
}


// EFFECTS
document.observe("dom:loaded",function(){ 
    
    jq(".hnav-list-wrapper").hide();
    
    var isInList = false;
    var isInButton = false;
    
    var inputs = $$('input');
    
    inputs.each(function(elem){
        elem.onclick=function(){
            new Effect.Shake(this,{duration: 0.2,distance: 0.7});
        }
    });
    
    jq("#header-logo").mouseenter(function(){
        jq(this).animate({left: "+=30px"}, 1000, 'easeInBack', function(){
                    jq(this).animate({left: "-=30px"}, 1000, 'easeOutBack');
        });
    });
    
    jq(".nav-list-item").mouseover(function(){
        jq(this).children().children().first().next().slideDown(350, 'easeInExpo');
    });
    
    
    jq(".nav-list-item").mouseleave(function(){
        jq(this).children().children().first().next().slideUp(350, 'easeInExpo');            
    });

});