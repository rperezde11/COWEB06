<?php

include('UtilsDB.php');
include('utils-form.php');

$id = UtilsForm::getParam("id");

$array = DB::getAdditionalInfoJSON($id);

// We print JSON
echo json_encode($array);