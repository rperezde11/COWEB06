<?php 

    include('../UtilsDB.php');
    session_start();

    if(isset($_SESSION['USER_ID'])){
        $id = $_SESSION['USER_ID'];
        DB::removeUserById($id);
        session_destroy();
        echo "OK";
    } else {
        echo "NOK";
    }
?>