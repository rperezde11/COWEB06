<?php 

include('UtilsDB.php');
include('utils-form.php');

$max = 4;

$name = UtilsForm::getGetParam('q');
$suggestions = DB::getPossibleCountries($name,$max);
$response = "<ul style='list-style-type:none'>";

$limit = 4; $count = 0;

foreach($suggestions as $country){
    $response .= "<li>".$country."</li><br/>";
}

$response .= "</ul>";

echo $response;
?>