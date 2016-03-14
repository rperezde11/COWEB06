<?php 

    include('utils-form.php');
    include('UtilsDB.php');
    
    $frm = UtilsForm::getParam('frm','login');

    if ($frm === 'register'){
        
        $name = UtilsForm::getPostParam('firstName');
        $email = UtilsForm::getPostParam('email');
        $password = UtilsForm::getPostParam('password');
        
        DB::createUser($name,$email,$password);
        
    }elseif($frm === 'login'){
        
        $email = UtilsForm::getPostParam('email');
        $password = UtilsForm::getPostParam('password');
        $exist = DB::existsUser($email,$password);

        if ($exist) {
            header('Location: profile.php');
        } else {
            header('Location: login.php');
        }
        
    }
    
?>