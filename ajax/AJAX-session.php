<?php
    include('../UtilsForm.php');
    $start = UtilsForm::getParam("start", "true");

    session_start();

    if($start == 'false') {
        session_unset();
        session_destroy();
    }