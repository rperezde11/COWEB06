// EFFECTS
document.observe("dom:loaded",function(){ 
    
    $("search-index").onmouseover = function(){
        new Effect.Scale(this,110,{scaleFromCenter:true,duration:0.01});
    };
    
    $("search-index").onmouseout = function(){
        new Effect.Scale(this,90.5,{scaleFromCenter:true,duration:0.01});
    };
    
     $("search-index").onclick = function(){
        new Effect.MoveBy(this,{x:10,y:10,duration:2});
    };
    
    $("search-index").onclick = function(){
        new Effect.MoveBy(this,{x:10,y:10,duration:2});
    };
    
    $("country-departure").onkeyup = function(){updateSuggestions($(this))};
    $("country-arrival").onkeyup = function(){updateSuggestions($(this))};

});

function updateSuggestions(elem){
    
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(xhttp.readyState==4 && xhttp.status==200){
            $("suggestion-departure").innerHTML = xhttp.responseText;
        }
    }
    xhttp.open("GET","suggestion-country.php?q="+elem.value,true);
    xhttp.send();
}