<?php

$list = array("Book1","Book2","Book3","Book4","Book5");
$response = "<div id='header-list'>";

foreach($list as $value){
    $response .= "<div class='header-list-item'>".$country."</div>";
}

$response .= "</div>";

echo $response;
?>