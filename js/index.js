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

});