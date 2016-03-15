<?php 

    include('utils-form.php');
    include('validateForm.php');
    include('UtilsDB.php');

    $id = UtilsForm::getParam('idn');

    DB::removeUserById($id);

    //header('Location: index.html');
    
?>