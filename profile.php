<?php
    include('UtilsForm.php');
    include('validateForm.php');
    include('UtilsDB.php');

    $className = "profile";
    include('header.php');
    
    if(isset($_SESSION['USER_ID'])){
        $e = $_SESSION['USER_ID'];    
    } else {
        header('Location: index.php');
    }
    

    list($fn,$email,$password,$sn,$id,$birth,$gender,$description,$city,$country) = DB::getUserById($e);

    $booked_flights = DB::getBookedFlights($e);
?>
                
<div id="user-info">

    <div id="user-name"><?=$fn?><img id="endSession" style="margin-left: 5px;" src="imgs/remove.png"/></div>
    
    <div id="user-pic">
        <img id="profile-pic" src="imgs/profile.jpg">
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
        <p><b>Aboot Myself</b><br/>
            <span class="gray"><em><?= UtilsForm::sec($description) ?></em></span>
        </p>
        <p><b>I live in... </b><br/>
            <em>
                <?= UtilsForm::sec($city)." (".UtilsForm::sec($country).")"  ?>
            </em>
        </p>
        <button id="usrRmv">Remove my account!</button>
    </div>

</div>

<div id="my-flights-container">
    <h2 class="section-header-light">My Flights</h2>
<?php foreach ($booked_flights as $flight) { ?>
    <div class="flight light-shadow">
        <div class="f-preview">
            <img class="flight-preview" src="imgs/sm-moscow.jpg">
        </div>
        <div class="f-info">
            <b><?=$flight[3]." (".$flight[1].") "?> - <?=" ".$flight[4]." (".$flight[2].")"?></b>
        </div>
        <div class="f-price">
            <h3 class="flight-price"><?=$flight[7]?>$</h3>
        </div>
    </div>
<?php } ?>
</div>
            
<?php include('footer.php'); ?>