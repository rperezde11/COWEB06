<?php include('handleErrors.php'); ?>

<!DOCTYPE html>

<html>
    
    <head>
        <title>eFlights</title>
        <meta name="author" content="krakosky">
        <meta name="description" content="Where flights are born">
        <meta name="keywords" content="cheap, flights, flight, non-expensive, 
                                       travel, enjoy, good, fine, wonderful,
                                       great, Rome, New York, Paris, London ">
        <link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/<?=$className?>.css" media="screen">
        <link href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript">var jq = $.noConflict();</script>
        <script type="text/javascript" src="js/jQueryRotate.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/<?=$className?>.js"></script>
        
    </head>
    
    <body>
        
        <div id="header">
            
            <div id="header-logo">
                <a href="index.php">
                    <img src="imgs/logo.png" alt="Logo of the website." >
                </a>
            </div>
            
            <?php if(!$isUserLogged){?>
            <div id="header-prof">
                <a href="login.php">
                    <div class="prof-info">Log In |</div>
                </a>
                <a href="register.php">
                    <div class="prof-info">Register</div>
                </a>
            </div>
            <?php } else { ?>
            <div id="header-prof">
                <a href="profile.php">
                    <img class="profile-pic" src="imgs/avatar.png">
                </a>
            </div>
            <?php } ?>

            
            <div id="header-nav">
                <ul>
                    <li class="nav-list-item">
                        <a href="#">
                            <div class="hnav-elem">Book a flight<span class="hnav-image"></span></div>
                            <div class="hnav-list-wrapper ">
                                <div class="hnav-list-item">Book Option #1</div>
                                <div class="hnav-list-item">Book Option #2</div>
                                <div class="hnav-list-item">Book Option #3</div>
                                <div class="hnav-list-item">Book Option #4</div>
                            </div>
                        </a>
                    </li><!--
                --><li class="nav-list-item">
                        <a href="#">
                            <div class="hnav-elem">Modify your booking<span class="hnav-image"></span></div>
                            <div class="hnav-list-wrapper ">
                                <div class="hnav-list-item">Modify Booking Option #1</div>
                                <div class="hnav-list-item">Modify Booking Option #2</div>
                                <div class="hnav-list-item">Modify Booking Option #3</div>
                                <div class="hnav-list-item">Modify Booking Option #4</div>
                            </div>
                        </a>
                    </li><!--
                --><li class="nav-list-item">
                        <a href="#">
                            <div class="hnav-elem">Help & FAQ<span class="hnav-image"></span></div>
                            <div class="hnav-list-wrapper ">
                                <div class="hnav-list-item">Help Option #1</div>
                                <div class="hnav-list-item">Help Option #2</div>
                                <div class="hnav-list-item">FAQ Option #3</div>
                                <div class="hnav-list-item">FAQ Option #4</div>
                            </div>
                        </a>
                    </li><!--
                --><li class="nav-list-item">
                        <a href="#">
                            <div class="hnav-elem">Contact Us<span class="hnav-image"></span></div>
                            <div class="hnav-list-wrapper">
                                <div class="hnav-list-item">Contact Option #1</div>
                                <div class="hnav-list-item">Contact Option #2</div>
                                <div class="hnav-list-item">Contact Option #3</div>
                                <div class="hnav-list-item">Contact Option #4</div>
                            </div>
                        </a>
                    </li><!--
                --></ul>
            </div>
            
        </div>
        
        <div id="content">