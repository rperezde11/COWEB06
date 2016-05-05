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
    
    
    // effect of the plane on submit
    jq("#search-field").click(function(){
        jq(this).after("<div id='plane-animation' style='height: 50px; width: 50px; background-image: url(imgs/airplane.png); background-size: cover; position: relative; z-index: 1;'></div>");
        jq("#plane-animation").animate({opacity: 0.0, top: "-=250",left: jq(window).width()-(50+250), width: "+=250", height: "+=250"}, 2500, "easeInCubic", function(){
            jq('.flights-table').rotate({
                angle: 0,
                animateTo: 280,
                duration: 2000,
                callback: function() {
                    jq('#search-flights-form').submit();
                }
            });
        });
    });
    
});

function updateSuggestions(elem){
    
    jq.get("suggestion-country.php",{ q: elem.value }).done(function(data, status, xhr) {
        elem.next().innerHTML = "";
        elem.next().insert(data);
    });
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