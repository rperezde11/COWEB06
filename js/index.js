// EFFECTS
document.observe("dom:loaded",function(){ 
    
    jq("#search-index").mouseenter(function(){
        jq(this).animate({width: "+=20px", height: "+=5px"}, 300, 'easeOutBack');
    });
    
    jq("#search-index").mouseleave(function(){
        jq(this).animate({width: "-=20px", height: "-=5px"}, 100, 'easeOutBack');
    });
    
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