<?php 

    include('utils-form.php');
    include('validateForm.php');
    include('UtilsDB.php');

    $frm = UtilsForm::getParam('frm','login');

    if ($frm === 'register'){
        
        $fn = UtilsForm::getPostParam('firstName');
        $sn = UtilsForm::getPostParam('secondName');
        $id_number = UtilsForm::getPostParam('id');
        $email = UtilsForm::getPostParam('email');
        $password = UtilsForm::getPostParam('password');
        $birthday = UtilsForm::getPostParam('birth');
        $gender = UtilsForm::getPostParam('gender');
        $description = UtilsForm::getPostParam('description');
        $country = UtilsForm::getPostParam('country');
        $city = UtilsForm::getPostParam('city');
        
        $isFNameValid = isNameValid($fn);
        $isSNameValid = isNameValid($sn);
        $isIdValid = isIdValid($id_number);
        $isEmailValid = isEmailValid($email);
        $isBirthValid = isDateOfBirthValid($birthday);
        
        if(($isFNameValid and $isSNameValid and
            $isIdValid and $isEmailValid and
            $isBirthValid))
        {
             $ret = DB::createUser($fn,$sn,$id_number,$email,$password,
                      $birthday,$gender,$description,$country,$city);
            
            if($ret){
                $id = DB::getUser($email);
                var_dump($id);
                setcookie("user_id", $id, time() + 86400); // 1 day
                header('Location: login.php');
            } else {
                header('Location: register.html');
            }
        }
        else {
            header('Location: register.html');
        }
        
        
    }elseif($frm === 'login'){
        
        $email = UtilsForm::getPostParam('email');
        $password = UtilsForm::getPostParam('password');
        $valid = DB::validateUser($email,$password);
        
        $id = DB::getUser($email);

        if ($valid) {
            setcookie("user_id", $id, time() + 86400); // 1 day
            header("Location: profile.php");
        } else {
            header('Location: login.php');
        }
        
    } else {
        
    }
    
?>