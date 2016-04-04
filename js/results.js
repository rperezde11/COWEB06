document.observe("dom:loaded",function(){
    
    loadFlights();
    
    $('city-filter-button').onclick = function() {
        loadFlights();    
    }

});

// AJAX FUNCTIONS

function loadFlights() {
    new Ajax.Request("flights-results.php",{
        method:"get",
        parameters:"countryA="+$('departure').innerHTML+"&countryB="+$('arrival').innerHTML+"&search="+$('city-filter-input').value,
        asynchronous: true,
        onComplete: 
        function(e){
            $('my-flights-container').innerHTML = "";
            $('my-flights-container').innerHTML = e.responseText;
            
            $$('.flight-preview').each(function(element){
                element.onmouseover = function(){
                    new Effect.Opacity(element,{duration:1.5,to:0.7,from:1.0});
                }
                element.onmouseout = function(){
                    new Effect.Opacity(element,{duration:0.7,to:1.0,from:0.7});
                }
    });
        }
    });
}