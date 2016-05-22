<?php 
    $className = "register";
    include('session.php');
    include('header.php');
?>
            
            <div id="wrapper">
                
                <h1 class="light-main-title">Register</h1>

                <hr/><br/>

                 <form id="registration-form" name="registration" action="validation.php?frm=register" method="post">

                    <div class="input-section">

                        <h2>Personal</h2>

                        <div class="input-container">

                            <p class="light-field-header">First Name</p>
                            <input id="firstname" class="reg-input light-shadow val-input" onkeyup="validateFirstName(event)" placeholder="Bryan" type="text" required="required" name="firstName" autocomplete="off">
                            <p class="light-field-header">Second Name</p>
                            <input id="secondname" class="reg-input light-shadow val-input" onkeyup="validateSecondName(event)" placeholder="Johnson" type="text" required="required" name="secondName" autocomplete="off">
                            <p class="light-field-header">Your ID Number</p>
                            <input id="id_number" class="reg-input light-shadow val-input" onkeyup="validateId(event)" placeholder="11111111A" type="text" required="required" name="id" autocomplete="off">
                            <p class="light-field-header">Email</p>
                            <input id="email" class="reg-input light-shadow val-input" onkeyup="validateEmail(event)" placeholder="example@domain.foo" value="" type="text" required="required" name="email" autocomplete="off">
                            <p class="light-field-header">Password</p>
                            <input id="password" class="reg-input light-shadow val-input" onkeyup="validatePassword(event)" type="password" required="required" name="password" autocomplete="off">
                            <p class="light-field-header">Date of Birth</p>
                            <input id="birth" class="reg-input light-shadow val-input" onkeyup="validateBirth(event)" type="date" required="required" name="birth" autocomplete="off">
                            
                            <p id="gender" class="light-field-header">Gender</p>
                            <input class="general-input" id="Male" type="radio" name="gender" value="Male" checked >
                            <label for="Male">Male</label>
                            <input class="general-input" id="Female" type="radio" name="gender" value="Female"  >
                            <label for="Female">Female</label>
                            
                            <p id="description" class="light-field-header">Describe yourself... (250 characters)</p>
                            <textarea class="reg-input light-shadow" cols="20" rows="3" placeholder="Explain how do you are..." maxlength="250" name="description"></textarea>

                            <p class="light-field-header">Hobbies</p>
                            <input class="general-input" id="Books" type="checkbox" name="hobbies[]" value="Books"  >
                            <label for="Female">Books</label>
                            <input class="general-input" id="Travel" type="checkbox" name="hobbies[]" value="Travel"  >
                            <label for="Female">Travel</label>
                            <input class="general-input" id="Series" type="checkbox" name="hobbies[]" value="Series"  >
                            <label for="Series">Series</label>
                            <input class="general-input" id="Movies" type="checkbox" name="hobbies[]" value="Movies"  >
                            <label for="Movies">Movies</label>
     
                        </div>

                    </div>

                    <br/><br/>

                    <div class="input-section">
                        <h2>Location</h2>
                        <div class="input-container">
                            <p class="light-field-header">Country</p>
                            <input id="country" class="reg-input light-shadow" placeholder="England" type="text" required="required" name="country">
                            <p class="light-field-header">City</p>
                            <input id="city" class="reg-input light-shadow" placeholder="Birmingham" type="text" required="required" name="city">
                        </div>
                    </div>

                </form>
                
                <br/><br/><br/>

                <button id="submit-register" class="dark-submit">Register now!</button>

            </div>
            
<?php include('footer.php'); ?>
