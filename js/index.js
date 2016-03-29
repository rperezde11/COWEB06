document.observe("dom:loaded",function(){ 
    
    $("search-index").onmouseover = function(){
        new Effect.Scale(this,105,{scaleFromCenter:false,duration:0.1});
    };
    
    $("search-index").onmouseout = function(){
        new Effect.Scale(this,95,{scaleFromCenter:false,duration:0.1});
    };
    
     $("search-index").onclick = function(){
        new Effect.MoveBy(this,{x:10,y:10,duration:2});
    };
});