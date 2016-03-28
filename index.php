<?php 
    $className = "index";
    include('header.php');
    include('UtilsDB.php');

    DB::createEFlightsDB();
?>
            <div id="prom-wrapper">
                <div id="prom">
                    <img src="imgs/rome.jpg" alt="Image of a place in the world.">
                </div>
            </div>
            
            <div id="flight-chooser">
                
                <h2 class="section-header-dark">Select your flight!</h2>
                
                <form action="results.php" method="get">
                    
                    <div class="selection-node"> 
                        <h4 class="insection-header-dark">Departure</h4>
                        <p class="field-header-dark">Country</p>
                        <input class="general-input" type="text" placeholder="BCN..." name="departure-country">
                        <p class="field-header-dark">Date</p>
                        <input class="general-input" type="date" name="departure-date">
                    </div>
                    
                    <br/><br/>
                    
                    <div class="selection-node"> 
                        <h4 class="insection-header-dark">Arrival</h4>
                        <p class="field-header-dark">Country</p>
                        <input class="general-input" type="text" placeholder="Moscow..." name="arrival-country">
                        <p class="field-header-dark">Date</p>
                        <input class="general-input" type="date" name="arrival-date">
                        
                        <br/><br/><br/><br/>
                        
                        <input class="dark-submit" type="submit" value="submit">
                        
                    </div>
                
                </form>
                
            </div>
        
            <div id="content-offers">
                <h2 class="section-header-light">Offers you may like...</h2>
                <a href="booking.php">
                    <table class="flights-table">
                        <caption class="capt-light">Barcelona - Moscow</caption>
                        <tr>
                            <th>Departure</th>
                            <th>Time</th>
                            <th>Arrival</th>
                            <th>Time</th>
                            <th>Duration</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td>Barcelona (B)</td>
                            <td>19:00</td>
                            <td>London (Gatw)</td>
                            <td>21:00</td>
                            <td>2 hours</td>
                            <td>34$</td>
                        </tr>
    
                        <tr>
                            <td>London (Gatw)</td>
                            <td>22:00</td>
                            <td>Berlin (Ausch)</td>
                            <td>00:00</td>
                            <td>2 hours</td>
                            <td>64$</td>
                        </tr>
                        <tr>
                            <td>Berlin (Ausch)</td>
                            <td>00:00</td>
                            <td>Moscow (Pl)</td>
                            <td>3:30</td>
                            <td>3:30 hours</td>
                            <td>34$</td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Total</b></td>
                            <td><b>7:30 hours</b></td>
                            <td><b>132$</b></td>
                        </tr>
                        <tfoot>
                            <tr>
                              <td colspan="6">&copy; eFlights 2016 - Spain</td>
                            </tr>
                        </tfoot>
    
                    </table>
                </a>
                <!--
                    <br/><br/><br/>
                -->
            </div>

<?php include('footer.php'); ?>