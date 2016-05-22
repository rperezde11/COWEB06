<?php 

include('../UtilsDB.php');
include('../UtilsForm.php');

$email = UtilsForm::getParam('email');
$remember = UtilsForm::getParam('remember');
$idUser = DB::getUserId($email);

session_start();
$_SESSION['USER_ID'] = $idUser;
$_SESSION['REMEMBER'] = $remember;
