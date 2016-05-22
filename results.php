<?php
    
    include('UtilsDB.php');
    include('UtilsForm.php');

    $depCountry = UtilsForm::getGetParam('departure-country');
    $depDate = UtilsForm::getGetParam('departure-date');
    $arrCountry = UtilsForm::getGetParam('arrival-country');
    $arrDate = UtilsForm::getGetParam('arrival-date');

    if(!$depCountry and !$depDate and !$arrCountry and !$arrDate){
        header("HTTP/1.1 400 Bad Request");
    }

    include('session.php');

    $className = 'results';
    include('header.php');
?>

<h2 class="section-header-light">Results</h2>

<div id="filter-here" class="searcher">
    <form action="" method="get">
        <div class="searcher-wrapper">
            <input id="city-filter-input" class="search-input" name="search" placeholder="Search..." type="search" value="">
        </div>
    </form>
    <button id="city-filter-button" class="search-button" ></button>
</div>

<div id="search-google" class="searcher">
    <form target="_blank" action="http://www.google.com" method="get">
        <div class="searcher-wrapper">
            <input class="search-input" name="q" placeholder="Search On Google..." type="search">
            <input class="search-button" type="submit" value="">
        </div>
    </form>
</div>

<div id="query-container" class="country-info-container ">
    <p id="departure" class="flight-country-info"><?=$depCountry?></p> - <p id="arrival" class="flight-country-info"><?=$arrCountry?></p>
    <div class="spacer"></div>
    <p id="departure" class="flight-country-info"><?=$depDate?> /</p><p id="arrival" class="flight-country-info">/ <?=$arrDate?></p>
</div>

<div id="my-flights-container">

</div>

<?php include('footer.php'); ?>