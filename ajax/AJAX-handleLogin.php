<?php 

include('../UtilsDB.php');
include('../UtilsForm.php');

$idUser = DB::getUserId(UtilsForm::getParam('email'));

session_start();
$_SESSION['USER_ID'] = $idUser;

?>