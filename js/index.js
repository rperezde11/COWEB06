// EFFECTS
document.observe("dom:loaded",function(){ 
    
    var slider_init_values = [20, 300];
    var isSearchAnimationActive = false;
    
    // disable search button
    var searchButtonActive = false;
    jq("#search-index").prop("disabled",!searchButtonActive);
    
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
        if(!isSearchAnimationActive){
            isSearchAnimationActive ^= true;
            jq(this).after("<div id='plane-animation' style='height: 50px; width: 50px; background-image: url(imgs/airplane.png); background-size: cover; position: relative; z-index: 1;'></div>");
            jq("#plane-animation").animate({opacity: 0.0, top: "-=250",left: jq(window).width()-(50+250), width: "+=250", height: "+=250"}, 2500, "easeInCubic", function(){
                jq('.flights-table').rotate({
                    angle: 0,
                    animateTo: 345,
                    duration: 2000,
                    callback: function() {
                        jq('#search-flights-form').submit();
                    }
                });
            });
        }
    });
    
    jq('.slider-prices').slider({
        range: true, 
        min: 0,
        max: 500,
        values: slider_init_values,
        slide: function(event, ui){
            jq('#slider-left-value').text(ui.values[0]+"\u20AC");
            jq('#slider-right-value').text(ui.values[1]+"\u20AC");
        },
        change: function(event, ui){
            jq('.offer').remove();
            updateOffers(ui.values[0], ui.values[1], 4);
        },
        create: function(event, ui){
            updateOffers(slider_init_values[0], slider_init_values[1],  4);
            jq('#slider-left-value').text(slider_init_values[0]+"\u20AC");
            jq('#slider-right-value').text(slider_init_values[1]+"\u20AC");
        }
    });
    
    
    // search form disablement button
    jq('.general-input').change(function(){
        searchButtonActive = true;
        jq('.general-input').each(function(elem){
            searchButtonActive &= (jq(this).val().length != 0);
            jq("#search-index").prop("disabled",!searchButtonActive);
        });
    });
    
});

function updateOffers (minimum, maximum, num) {
    jq.get("getOffers.php",{ min: minimum, max: maximum, n: num})
        .done(function(data, status, xhr) {
            var JSONObjs = JSON.parse(data);
            JSONObjs.each(function(elem){
                createOffer(elem);
            });
        
            
        // Functions affecting offers
        jq('.flights-table').mouseenter(function(){
            var id = jq(this).attr('id');
            if(!jq('.sugg-flight-info').length){
                jq(this).parent().after(
                    " \
                        <div class='sugg-flight-info' id='"+id+"'> \
                            <table border='0'> \
                                <tr><th>Average Age</th><th>Gender Ratio</th><th>Seats Left</th></tr> \
                                <tr><td>34,5</td><td>35% F / 65% M</td><td> 10 / 200 </td></tr> \
                            </table> \
                        </div> \
                    "
                );
            }
        });
        
                // Functions affecting offers
        jq('.flights-table').mouseleave(function(){
            jq('.sugg-flight-info').remove();
        });
        
    });
}

function updateSuggestions(elem){
    
    jq.get("suggestion-country.php",{ q: elem.value }).done(function(data, status, xhr) {
        elem.next().innerHTML = "";
        elem.next().insert(data);
    });
}

function updateAdditionalFlightInfo () {
    
    jq.get("", {}).done(function(data, status, xhr){
        
    });
    
}

function createOffer (obj) {
    
     jq('#offer-data').append(
         "<a href='booking.php?id="+obj.id+"' class='offer'> \
            <table class='flights-table' id='"+obj.id+"'> \
                <thead> \
                    <tr> \
                        <th colspan='6'>"+obj.dep+" ("+obj.c_dep+") - "+obj.arr+" ("+obj.c_arr+")</th> \
                    </tr> \
                </thead> \
                <tbody> \
                    <tr> \
                        <th>Departure</th> \
                        <th>Time</th> \
                        <th>Arrival</th> \
                        <th>Time</th> \
                        <th>Duration</th> \
                        <th>Price</th> \
                    </tr> \
                    <tr> \
                        <td>"+obj.dep+"</td> \
                        <td>19:00</td> \
                        <td>"+obj.arr+"</td> \
                        <td>21:00</td> \
                        <td>2 hours</td> \
                        <td>"+obj.price+"&euro;</td> \
                    </tr> \
                    <tr> \
                        <td colspan='4'><b>Total</b></td> \
                        <td><b>2:00 hours</b></td> \
                        <td><b>"+obj.price+"&euro;</b></td> \
                    </tr> \
                </tbody> \
            </table><br><br> \
        </a>");
    
}

function createSuggestion (obj) {
    jq('#'+obj.id).parent().after(
        " \
            <div class='sugg-flight-info' id='"+id+"'> \
                <table border='0'> \
                    <tr><th>Average Age</th><th>Gender Ratio</th><th>Seats Left</th></tr> \
                    <tr><td>34,5</td><td>35% F / 65% M</td><td> 10 / 200 </td></tr> \
                </table> \
            </div> \
        "
    );
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