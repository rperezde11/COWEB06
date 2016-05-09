<?php 
    $className = "index";
    include('header.php');
    include('UtilsDB.php');

    DB::createEFlightsDB();
?>
            <div id="prom-wrapper">
                <div id="prom">
                    <img id="prom-img" src="imgs/rome.jpg" alt="Image of a place in the world.">
                </div>
            </div>
            
            <div id="flight-chooser">
                
                <h2 class="section-header-dark">Select your flight!</h2>
                
                <form id="search-flights-form" action="results.php" method="get">
                    <div class="selection-node"> 
                        <h4 class="insection-header-dark">Departure</h4>
                        <p class="field-header-dark">Country</p>
                        <div id="departure" class="input-wrapper">
                            <input id="country-departure" class="general-input" type="text" placeholder="BCN..." name="departure-country" autocomplete="off">
                            <div id="suggestion-dep"></div>
                        </div>
                        <p class="field-header-dark">Date</p>
                        <div class="input-wrapper">
                            <input class="general-input" type="date" name="departure-date">
                        </div>
                    </div>
                    <br/><br/>
                    <div class="selection-node"> 
                        <h4 class="insection-header-dark">Arrival</h4>
                        <p class="field-header-dark">Country</p>
                        <div id="arrival"  class="input-wrapper">
                            <input id="country-arrival" class="general-input" type="text" placeholder="Moscow..." name="arrival-country" autocomplete="off">
                            <div id="suggestion-arr"></div>
                        </div>
                        <p class="field-header-dark">Date</p>
                        <div class="input-wrapper">
                            <input class="general-input" type="date" name="arrival-date">
                        </div>
                    </div>
                </form>
                <div style="height: 60px;"></div>
                <div id="search-field" class="input-wrapper">
                    <button id="search-index" class="dark-submit">Fly away!</button>
                </div>
                
            </div>
            <div id="content-offers">
                <div id="offer-data">
                    <?php
                        $offers = DB::getArrayJSONOffers(0, 250, 4);
                        var_dump($offers);
                    ?>
                    <div id="offers-header">Offers you may like</div>
                    
                </div>
                
                <!-- OFFER MODIFIER -->
                <div id="offer-modifier">
                    <h2 class="section-header-dark">Modify offers!</h2>
                    <hr/>
                    <div class="selection-node">
                        <br/><br/>
                        <h4 class="insection-header-dark">Price Range</h4>
                        <div class="slider-prices" ></div>
                        <div class="slider-values">
                            <div id="slider-left-value">0&euro;</div>
                            <div id="slider-right-value">250&euro;</div>
                        </div>
                    </div>
                </div>
                
            </div>

<?php include('footer.php'); ?>
        <!--
            <div id="content-offers">
                <?php
                    $offers = DB::getOffers(4);
                ?>
                <div id="offers-header">Offers you may like</div>
                <?php
                    foreach($offers as $offer) {
                        $flight = DB::getFlightById($offer);
                ?>
                <a href="booking.php?id=<?=$offer?>">
                    <table class="flights-table">
                        <thead>
                            <tr>
                                <th colspan="6"><?=$flight[3]."(".$flight[1].") "?> - <?=" ".$flight[4]."(".$flight[2].")" ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Departure</th>
                                <th>Time</th>
                                <th>Arrival</th>
                                <th>Time</th>
                                <th>Duration</th>
                                <th>Price</th>
                            </tr>
                            <tr>
                                <td><?=$flight[3]?></td>
                                <td>19:00</td>
                                <td><?=$flight[4]?></td>
                                <td>21:00</td>
                                <td>2 hours</td>
                                <td><?=$flight[7]?>$</td>
                            </tr>
                            <tr>
                                <td colspan="4"><b>Total</b></td>
                                <td><b>2:00 hours</b></td>
                                <td><b><?=$flight[7]?>$</b></td>
                            </tr>
                        </tbody>
                    </table>
                </a>
                <br/><br/>
                <?php } ?>
                
                    <br/><br/><br/>
                
            </div> -->