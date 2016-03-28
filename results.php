<?php

    $className = 'results';
    include('header.php');
    include('UtilsDB.php');
    include('utils-form.php');
    include('mock.php');
    
    $depCountry = UtilsForm::getGetParam('departure-country');
    $depDate = UtilsForm::getGetParam('departure-date');
    $arrCountry = UtilsForm::getGetParam('arrival-country');
    $arrDate = UtilsForm::getGetParam('arrival-date');

    $db = DB::connect('eFlights');

    $cc_1 = DB::getCC2($db,$depCountry);
    $cc_2 = DB::getCC2($db,$arrCountry);

    $nameExists = (!empty($cc_1) && !empty($cc_2));
    $flights  = array();

    if($nameExists) {
        $url1 = "http://www.crwflags.com/fotw/images/".$cc_1[0]."/".substr($cc_1,0,2).".gif";
        $url2 = "http://www.crwflags.com/fotw/images/".$cc_2[0]."/".substr($cc_2,0,2).".gif";
        
        $flights = DB::getFlightsBetweenCountries($depCountry,$arrCountry);
    }
?>

<h2 class="section-header-light">Results</h2>

<div class="searcher">
    <form action="" method="get">
        <input name="search" placeholder="Search..." type="search">
        <span></span><input class="search-button" type="submit">
    </form>
</div>

<div class="searcher">
    <form target="_blank" action="http://www.google.com" method="get">
        <input name="q" placeholder="Search On Google..." type="search">
        <span></span><input class="search-button" type="submit">
    </form>
</div>

<div id="my-flights-container">

    <?php
    
        if (!$nameExists) {
            echo "<h1 class=\"grey centered\">Some country name don't match :(</h1>";
        }
        
        $counter = 0;
        
        foreach($flights as $id) {
            
            if($counter > 11){
                break;
            }
            
            $flight = DB::getFlightById($id);
    ?>
    
    <a href="<?="booking.php?id=$id"?>" >
        <div class="flight light-shadow">
            <div class="f-preview">
                <img class="flight-preview" alt="Flag from destination country" src="<?= $url1 ?>">
                <img class="flight-preview" alt="Flag from arrival country" src="<?= $url2 ?>">
            </div>
            <div class="f-info">
                <h4 class="flight-info"><?= $flight[3] ?> - <?= $flight[4] ?>  </h4>
            </div>
            <div class="f-price">
                <h3 class="flight-price"><?= $flight[7] ?>$</h3>
            </div>
        </div>
    </a>
    <?php
            $counter++;
        }
    ?>
    
</div>

<?php include('footer.php'); ?>