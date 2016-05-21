jq(document).ready(function(){
    
    var dialog = "<div id='dialog-remove-user' class='ui-dialog' style='display: none;' title='Removing Account'><p>Are you sure you want to remove your user account?</p></div>";
    jq('body').append(dialog);
    
    jq("#usrRmv").click(function(){
        jq( "#dialog-remove-user" ).dialog({
            autoOpen: true,
            height: 450,
            width: 550,
            modal: true,
            buttons: [
                {
                    text: "Yes",
                    click: function(){
                        window.location.href ='removing-zone.php';
                    }   
                },                         
                {
                    text: "No",
                    click: function(){ 
                        jq( "#dialog-remove-user" ).dialog( "close" );
                    }   
                },
            ]
        });
    });
    
    jq('#endSession').click(function(){
        killSession(null);
    });
    
});