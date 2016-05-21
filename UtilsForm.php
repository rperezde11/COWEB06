<?php

class UtilsForm {
    
    
    function sec($str){
        return htmlspecialchars($str);
    }
    
    function getGetParam ($var,$default=null) {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if (isset($_GET[$var])) {
                return $_GET[$var];
            }
            return $default;
        }
    }
    
    function getPostParam ($var,$default=null) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST[$var])) {
                return $_POST[$var];
            }
            return $default;
        }
    }
    
    function getParam ($var,$default=null) {
        if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){
            if (isset($_POST[$var])) {
                return $_POST[$var];
            }
            if (isset($_GET[$var])) {
                return $_GET[$var];
            }
            return $default;
        }
    }
    
    function getAge($date){
        
        $today = date('Y-m-d');
        $today = date_create($today);
        $date = new DateTime($date);
        $date = $date->format('Y-m-d');
        $date = date_create($date);
        
        $diff = date_diff($today, $date);
        
        return $diff->format("%y");
    }
}

?>