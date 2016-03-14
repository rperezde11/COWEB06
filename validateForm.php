<?php 

function isNameValid($name) {
    return 0 < preg_match("/[a-zA-Z ]+/" , $name);
}

function isEmailValid($email) {
    $nMatches = preg_match("/\b\w[^*^\/]*@[a-z]+.[a-z]{1,4}$/" , $email, $matches);  
    if (!$nMatches) {
        return false;
    } else {
        foreach($matches as $match) {
            if ($match === $email){
                return true;
            }
        }
    }  
    return false;
}

function isIdValid($usr_id) {
    return 0 < preg_match("/\b\d{8}[a-zA-Z]{1}$/" , $usr_id);
}

function isDateOfBirthValid($date_of_birth) {
    $isSyntaxCorrect =  0 < preg_match("/\b(\d{4}[-\/]\d{2}[-\/]\d{2}$|\b\d{2}[-\/]\d{2}[-\/]\d{4})$/" , $date_of_birth);
    
    $today = date('Y-m-d');
    $date_of_birth = new DateTime($date_of_birth);
    $date_of_birth = $date_of_birth->format('Y-m-d');
    
    return ($isSyntaxCorrect and strtotime($today) >= strtotime($date_of_birth));
}

function isCardNumberValid($card) {
    return 0 < preg_match("/\b\d{4}-\d{4}-\d{4}-\d{4}$/" , $card);
}

?>