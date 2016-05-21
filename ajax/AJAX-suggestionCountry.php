<script>
$$(".suggestion-item").each(function(elem){
    elem.onclick = function(){applySuggestion($(this),$(this).up(1).previous())};
});
    
function applySuggestion(item,to){
    to.value = item.innerHTML;
    item.up('div',1).innerHTML="";
}  
</script>

<?php 

include('../UtilsDB.php');
include('../UtilsForm.php');

$max = 4;

$name = UtilsForm::getGetParam('q');
$suggestions = DB::getPossibleCountries($name,$max);
$response = "<div id='suggestion-list'>";

$limit = 4; $count = 0;

foreach($suggestions as $country){
    $response .= "<div class='suggestion-item'>".$country."</div>";
}

$response .= "</div>";

echo $response;
?>