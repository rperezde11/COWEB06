<?php

include('UtilsDB.php');
include('utils-form.php');

$min = UtilsForm::getParam("min");
$max = UtilsForm::getParam("max");
$num = UtilsForm::getParam("n");

$array = DB::getArrayJSONOffers($min, $max, $num);

// We print JSON
echo json_encode($array);