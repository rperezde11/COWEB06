<?php 

    include('utils-form.php');
    include('validateForm.php');
    include('UtilsDB.php');

    if(isset($_COOKIE["user_id"])){
        $id = $_COOKIE["user_id"];
        DB::removeUserById($id);
        setcookie("user_id"); // specify only the name to destroy the cookie.
    }

    header('Location: index.php');
    
?>