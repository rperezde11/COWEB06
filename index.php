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
                
                <form action="results.php" method="get">
                    
                    <div class="selection-node"> 
                        <h4 class="insection-header-dark">Departure</h4>
                        <p class="field-header-dark">Country</p>
                        <div id="departure">
                            <input id="country-departure" class="general-input" type="text" placeholder="BCN..." name="departure-country" autocomplete="off">
                            <div id="suggestion-dep"></div>
                        </div>
                        <p class="field-header-dark">Date</p>
                        <input class="general-input" type="date" name="departure-date">
                    </div>
                    
                    <br/><br/>
                    
                    <div class="selection-node"> 
                        <h4 class="insection-header-dark">Arrival</h4>
                        <p class="field-header-dark">Country</p>
                        <div id="arrival">
                            <input id="country-arrival" class="general-input" type="text" placeholder="Moscow..." name="arrival-country" autocomplete="off">
                            <div id="suggestion-arr"></div>
                        </div>
                        <p class="field-header-dark">Date</p>
                        <input class="general-input" type="date" name="arrival-date">
                        
                        <br/><br/><br/><br/>
                        
                        <input id="search-index" class="dark-submit" type="submit" value="submit">
                        
                    </div>
                
                </form>
                
            </div>
        
            <div id="content-offers">
                <?php
                    $offers = DB::getOffers(4);
                ?>
                <h2 class="section-header-light">Offers you may like...</h2>
                <?php
                    foreach($offers as $offer) {
                        $flight = DB::getFlightById($offer);
                ?>
                <a href="booking.php?id=<?=$offer?>">
                    <table class="flights-table">
                        <caption class="capt-light"><?=$flight[3]."(".$flight[1].") "?> - <?=" ".$flight[4]."(".$flight[2].")" ?></caption>
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
                        <tfoot>
                            <tr>
                              <td colspan="6">&copy; eFlights 2016 - Spain</td>
                            </tr>
                        </tfoot>
    
                    </table>
                </a>
                <?php } ?>
                <!--
                    <br/><br/><br/>
                -->
            </div>

<?php include('footer.php'); ?>