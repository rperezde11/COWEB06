jq(document).ready(function(){
    
    var dialog = "<div id='dialog-remove-user' class='ui-dialog' title='Removing Account'><p>Are you sure you want to remove your user account?</p></div>";
    
    jq("#user-name").click(function(){
        jq("#user-name").after(dialog);
    });
    
    jq("#user-name").mouseleave(function(){
        $( "#dialog-remove-user" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: [
                {
                    text: "Ok",
                    click: function(){ console.log("clicked Ok.");}   
                },                         
                {
                    text: "O'right then, just get me outta here mate",
                    click: function(){ console.log("clicked No.");}   
                },
            ]
        });
    });
    
});