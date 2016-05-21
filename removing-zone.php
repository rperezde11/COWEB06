<?php 

    include('UtilsForm.php');
    include('validateForm.php');
    include('UtilsDB.php');

    if(isset($_COOKIE["ID"])){
        $id = $_COOKIE["ID"];
        DB::removeUserById($id);
        session_destroy();
        setcookie("user_id"); // specify only the name to destroy the cookie.
    }

    header('Location: index.php');
?>