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
            
            jq('.flight-preview').mouseenter(function(){
                jq(this).animate({opacity: 0.85}, 200);
            });
            
            jq('.flight-preview').mouseleave(function(){
                jq(this).animate({opacity: 1.00}, 300);
            });
            
            jq('#sortable-flights').sortable(
                                                {
                                                    axis: 'y',
                                                    opacity: 0.80,
                                                    containment: '#my-flights-container'
                                                }
                                            );
        }
    });
}