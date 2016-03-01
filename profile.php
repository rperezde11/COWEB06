<!DOCTYPE html>

<html>
    
    <head>
        <title>eFlights - Profile</title>
        <meta name="description" content="Book Flights, save money traveling.">
        <meta name="author" content="Raul Perez">
        <meta name="keywords" content="Flights,cheap,travel,enjoy,fast,easy,bargain">
        <link rel="stylesheet"  type="text/css" href="css/main.css">
        <link rel="stylesheet"  type="text/css" href="css/index.css">
    </head>
    
    <body id="bod">
	
		<?php
		
			$name = null;
			
			if($_SERVER["REQUEST_METHOD"] == 'POST')
			{
				$name = $_POST["FirstName"];
			}
			
		?>
        
        <div id="header">

            <div id="whole-logo">
                <img id="logo"  alt="Logo image"  src="imgs/logo.png"></img>
            </div>
            
            <div id="header-profile">
                <a href="register.html">
                    <img id="img-avatar" alt="Profile image" src="imgs/avatar.png"></img>
                </a>
            </div>

        </div>
        
        <div id="header-options">
		  <ul class="nav-hor-options">
			<li><a href="index.html"><div class="h-nav-element">Book a flight</div></a></li>
			<li><a href="index.html"><div class="h-nav-element">Change a booked flight</div></a></li>
			<li><a href="index.html"><div class="h-nav-element">Flight calendar</div></a></li>
			<li><a href="index.html"><div class="h-nav-element">Contact us</div></a></li>
		  </ul>
        </div>
        
        <div id="offer">
            <img id="img-offer" src="imgs/rome.jpg"></img>
        </div>
    
        <div id="index-content">
            
            <div id="dummy-selector">

                <div id="flight-selector">


                </div>
                
            </div>
        
            <div id="container">
			
				<?php 
					if($name != null)
						echo "<h1>$name</h1>";
				?>

            </div>
			
        </div>
        
        <div id="footer"></div>
    
    </body>
    
</html>