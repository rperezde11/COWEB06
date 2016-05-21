<?php 

include('../UtilsDB.php');
include('../UtilsForm.php');

$max = 4;

$email = UtilsForm::getParam('email');
$response = DB::existsUSer($email);

echo ((int)$response);
?>