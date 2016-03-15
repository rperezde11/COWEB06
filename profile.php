<?php
    include('utils-form.php');
    include('validateForm.php');
    include('UtilsDB.php');

    $className = "profile";
    include('header.php');
    
    $e = UtilsForm::getGetParam('idn');

    list($fn,$email,$password,$sn,$id,$birth,$gender,$description,$city,$country) = DB::getUserById($e);
    
?>
                
<div id="user-info">

    <div id="user-name"><?=$fn?></div>
    
    <form method="get" action="removing-zone.php?idn=<?= $e ?>">
        <input class="dark-submit" type="submit" value="Remove my account">
    </form>

    <div id="user-pic">
        <img id="profile-pic" src="imgs/logo.png">
    </div>

    <div id="user-data">
        <p class="top-nomargin">
            <b><?= UtilsForm::sec($fn) . " " . UtilsForm::sec($sn) ?></b>
        </p>
        <p>
            <em><?= UtilsForm::sec(UtilsForm::getAge($birth)) . ", " . UtilsForm::sec($gender) ?></em>
        </p>
        <p><b>E-mail</b><br/>
            <em><?= UtilsForm::sec($email) ?></em>
        </p>
        <p><b>About Myself</b><br/>
            <span class="gray"><em><?= UtilsForm::sec($description) ?></em></span>
        </p>
        <p><b>I live in... </b><br/>
            <em>
                <?= UtilsForm::sec($city)." (".UtilsForm::sec($country).")"  ?>
            </em>
        </p>
    </div>

</div>

<div id="my-flights-container">
    <h2 class="section-header-light">My Flights</h2>
<!--
    <div class="flight light-shadow">
        <div class="f-preview">
            <img class="flight-preview" src="imgs/sm-moscow.jpg">
        </div>
        <div class="f-info">
            <h4 class="flight-info">Barcelona (EP) - Moscow (I) </h4>
        </div>
        <div class="f-price">
            <h3 class="flight-price">50$</h3>
        </div>
    </div>
-->
</div>
            
<?php include('footer.php'); ?>