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
        }
    });
}