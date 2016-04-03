<?php 

include('UtilsDB.php');
include('utils-form.php');

$max = 4;

$email = UtilsForm::getParam('email');
$response = DB::existsUSer($email);

echo ((int)$response);
?>