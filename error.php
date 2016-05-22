<?php

    $className = "error";
    include('session.php');
    include('UtilsErrors.php');

    if(isset($_COOKIE['CODE'])){
        $errorCode = htmlspecialchars($_COOKIE['CODE']);
        $error = UtilsErrors::getError($errorCode);
        unset($_COOKIE['CODE']);
        setcookie('CODE', "", time()-1);
    } else {
        header('Location: index.php');
    }
    
    include('header.php');
?>

<div id="error-wrapper">
    <h1 id="error-num"><?= $errorCode ?></h1>
    <p id="error-text">
        <b><?= $error['title'] ?></b> 

        <br/><br/>

        <em><?= $error['message'] ?></em>    
    </p>
</div>
        
<?php include('footer.php'); ?>