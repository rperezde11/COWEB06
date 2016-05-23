<?php

    $code = http_response_code();

    if($code >= 400){
        setcookie("CODE", $code);
        header('Location: error.php');
        exit();
    }