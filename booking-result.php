<?php
    $className = "booking-result";

    include('header.php');
    include('validateForm.php');
    include('utils-form.php');
?>

<h2 class="section-header-light">Flight Booking</h2>

<div id="flight-info-header">
    <div class="info-text">
        <div class="unique-flight-text">BCN - Londres</div>
        <div class="unique-flight-text">Londres - Berlin</div>
        <div class="unique-flight-text">Berlin - Moscow</div>
    </div>
</div>

<div id="booking-form-container">
    
    <?php
        $fn = UtilsForm::getPostParam('firstName');
        $sn = UtilsForm::getPostParam('secondName');
        $id = UtilsForm::getPostParam('id');
        $email = UtilsForm::getPostParam('email');
        $class = UtilsForm::getPostParam('class');
        $pref = UtilsForm::getPostParam('position-preference');
        $card = UtilsForm::getPostParam('creditCard');
        $number = UtilsForm::getPostParam('cardNumber');
    
        $isFNameValid = isNameValid($fn);
        $isSNameValid = isNameValid($sn);
        $isIdValid = isIdValid($id);
        $isEmailValid = isEmailValid($email);
        $isCardNumberValid = isCardNumberValid($number);
    ?>
    
    <p><b>Name: </b>
        <span class="<?= $isFNameValid ? "green":"red"?>"> <em><?= ($fn !== "") ? UtilsForm::sec($fn) : 'NOT SET' ?></em></span>
        <span class="<?= $isSNameValid ? "green":"red"?>"><em><?= ($sn !== "") ? UtilsForm::sec($sn) : 'NOT SET' ?></em></span>
    </p>
    <p><b>ID: </b>
        <span class="<?= $isIdValid ? "green":"red"?>"><em><?= ($id !== "") ? UtilsForm::sec($id) : 'NOT SET' ?></em></span>
    </p>
    <p><b>E-mail: </b>
        <span class="<?= $isEmailValid ? "green":"red"?>"><em><?= ($email !== "") ? UtilsForm::sec($email) : 'NOT SET' ?></em></span>
    </p>
    <p><b>Class: </b>
        <span class="green"><em><?= ($class !== "") ? UtilsForm::sec($class) : 'NOT SET' ?></em></span>
    </p>
    <p><b>Sitting Preference: </b>
        <span class="green"><em><?= ($pref !== "") ? UtilsForm::sec($pref) : 'NOT SET' ?></em></span>
    </p>
    <p><b>Card Type: </b>
        <span class="green"><em><?= ($card !== "") ? UtilsForm::sec($card) : 'NOT SET' ?></em></span></p>
    <p><b>Card Number: </b>
        <span class="<?= $isCardNumberValid ? "green":"red"?>"><em><?= ($number !== "") ? UtilsForm::sec($number) : 'NOT SET' ?></em></span>
    </p>
    
    <hr/>

    <h1 class="form-result-info">
        <?php
            $isOK = ($isFNameValid and $isSNameValid and $isEmailValid and $isIdValid and $isCardNumberValid);
            if ($isOK) {
                echo "<span style=\"color: green;\">Booking submitted successfully!</span>";
            } else {
                echo "<span style=\"color: red;\">Ooooops! Something went wrong...</span>";
            }
        ?>
    </h1>
    
</div>


<?php include('footer.php'); ?>