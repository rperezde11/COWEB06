<?php   
    if(isset($_COOKIE['ZXVF'])){
        $_COOKIE['PHPSESSID'] = $_COOKIE['ZXVF'];
    }
    
    session_start();

    $isUserLogged = isset($_SESSION['USER_ID']);
?>