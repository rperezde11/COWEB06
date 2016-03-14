<?php
    include('utils-form.php');
    include('validateForm.php');

    $className = "profile";
    include('header.php');

    $fromLogin = (UtilsForm::getPostParam('firstName') == null);


    $fn = UtilsForm::getPostParam('firstName');
    $sn = UtilsForm::getPostParam('secondName');
    $id = UtilsForm::getPostParam('id');
    $email = UtilsForm::getPostParam('email');
    $birth = UtilsForm::getPostParam('birth');
    $gender = UtilsForm::getPostParam('gender');
    $description = UtilsForm::getPostParam('description');
    $hobbies = UtilsForm::getPostParam("hobbies");
    $country = UtilsForm::getPostParam('country');
    $city = UtilsForm::getPostParam('city');
    
    if(!$fromLogin){
        
        $isFNameValid = isNameValid($fn);
        $isSNameValid = isNameValid($sn);
        $isIdValid = isIdValid($id);
        $isEmailValid = isEmailValid($email);
        $isBirthValid = isDateOfBirthValid($birth);

        if(!($isFNameValid and $isSNameValid and
            $isIdValid and $isEmailValid and
            $isBirthValid))
        {
            header("Location: register.html");
        }
    
    }
     
?>
                
<div id="user-info">

    <div id="user-name"><?=$fn?></div>

    <div id="user-pic">
        <img id="profile-pic" src="imgs/logo.png">
    </div>

    <div id="user-data">
        <p class="top-nomargin">
            <b><?= ($fn === null) ? 'NOT SET':UtilsForm::sec($fn) . " " . ($sn === null) ? 'NOT SET':UtilsForm::sec($sn) ?></b>
        </p>
        <p><b>Age</b><br/>
            <em><?= ($birth === null) ? 'NOT SET':UtilsForm::sec(UtilsForm::getAge($birth)) ?></em>
        </p>
        <p><b>E-mail</b><br/>
            <em><?= UtilsForm::sec($email) ?></em>
        </p>
        <p><b>About Myself</b><br/>
            <span class="gray"><em><?= ($description === null) ? 'NOT SET':UtilsForm::sec($description) ?></em></span>
        </p>
        <p><b>I like...</b><br/>
            <span class="gray">
                <em>
                    <?php
                        $len = count($hobbies);
                        $str = '';
                        for($i=0; $i<$len; $i++){
                            $str .= UtilsForm::sec($hobbies[$i]);
                            $str .= ($i==($len-1)) ? ".":", ";
                        }
                        echo $str;
                    ?>
                </em>
            </span>
        </p>
        <p><b>I live in... </b><br/>
            <em>
                <?= ($city === null) ? 'NOT SET':UtilsForm::sec($city)." (".($country === null) ? 'NOT SET':UtilsForm::sec($country).")"  ?>
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