<?php 
    $className = "booking";

    include('header.php'); 
?>

<h2 class="section-header-light">Flight Booking</h2>

<div id="flight-info-header">
    <div class="info-text">
        <div class="unique-flight-text">BCN - Londres</div>
        <div class="unique-flight-text">Londres - Berlin</div>
        <div class="unique-flight-text">Berlin - Moscow</div>
    </div>
    <!--<div class="info-price"></div>-->
</div>

<div id="booking-form-container">

    <div id="wrapper">

    <h1 class="light-main-title">Book the flight</h1>

    <hr/><br/>

    <form id="booking-form" name="booking" action="booking-result.php" method="post">

        <div class="input-section">
            <h2>Personal</h2>
            <div class="input-container">
                <p class="light-field-header">First Name</p>
                <input class="reg-input light-shadow" placeholder="Bryan" type="text" required="required" name="firstName">
                <p class="light-field-header">Second Name</p>
                <input class="reg-input light-shadow" placeholder="Johnson" type="text" required="required" name="secondName">
                <p class="light-field-header">Your ID Number</p>
                <input class="reg-input light-shadow" placeholder="11111111A" type="text" required="required" name="id">
                <p class="light-field-header">Email</p>
                <input class="reg-input light-shadow" placeholder="example@domain.foo" type="text" name="email">             
            </div>
        </div>
        <br/><br/>
        <div class="input-section">
            <h2>On the plane</h2>
            <div class="input-container">
                <p class="light-field-header">Class</p>
                <select class="reg-input light-shadow" name="class">
                    <option selected>First Class</option>
                    <option>Second Class</option>
                    <option>Third Class</option>
                </select>
                <p class="light-field-header">Position</p>
                <select class="reg-input light-shadow" name="position-preference">
                    <option selected>Front</option>
                    <option>Middle</option>
                    <option>Back</option>
                </select>
            </div>
        </div>
        <br/><br/>
        <div class="input-section">
            <h2>Payment</h2>
            <div class="input-container">
                <p class="light-field-header">Credit Card</p>
                <select class="reg-input light-shadow" required="required" name="creditCard">
                    <option selected>Visa</option>
                    <option>Mastercard</option>
                    <option>Electron</option>
                    <option>Visa Premium</option>
                    <option>La caixa</option>
                </select>
                <p class="light-field-header">Credit Card Number</p>
                <input class="reg-input light-shadow" placeholder="XXXX-XXXX-XXXX-XXXX" type="text" required="required" name="cardNumber">
            </div>
        </div>

        <br/><br/><br/>

        <input class="dark-submit" type="submit" value="Book this flight!">

    </form>

    </div>

</div>


<?php include('footer.php'); ?>