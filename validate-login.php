<?php 

include('UtilsDB.php');
include('utils-form.php');

$email = UtilsForm::getParam('email');
$password = UtilsForm::getParam('password');

$response = DB::validateUser($email,$password);

echo ((int)$response);
?>