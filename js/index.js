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
    
    new Effect.Opacity($("prom-img"),{duration:8,from:1.0,to:0.3});
    
});

function updateSuggestions(elem){
    
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        
        if(xhttp.readyState==4 && xhttp.status==200){
            elem.next().innerHTML = "";
            elem.next().insert(xhttp.responseText);
        }
    }
    xhttp.open("GET","suggestion-country.php?q="+elem.value,true);
    xhttp.send();
}


var images = ["rome.jpg","prague.jpg","venice.jpg","london.jpg"];
var counter= 1;
setInterval(function(){
                $("prom-img").src = "imgs/"+images[counter]; 
                if(counter<(images.length-1)){
                    counter++;
                } else {
                    counter=0;
                }
            },
            10000);
var fade = false;
setInterval(function(){
                if (fade) {
                    new Effect.Opacity($("prom-img"),{duration:8,from:1.0,to:0.3});
                } else {
                    new Effect.Opacity($("prom-img"),{duration:8,from:0.3,to:1.0});
                }
                fade ^= true;
            },
            10000);