<?php 
    $className = "login";

    include('session.php');
    
    if($isUserLogged){
        header('Location: profile.php');    
    }

    include('header.php');
    
?>

<h2 class="section-header-light">Login</h2>
<div id="login-box" class="light-shadow">  
    <form id="form-login" action="profile.php" method="post">            
        <p class="field-header-dark">E-mail</p>
        <input id="email-input" class="general-input val-input" type="text" placeholder="john.doe@gmail.com" required="required" name="email">
        <br/>
        <p class="field-header-dark">Password</p>
        <input id="password-input" class="general-input val-input" type="password" required="required" name="password">
    </form>
    <br/><br/>
    <button id="submit-login" class="dark-submit">Login</button>
    
</div>

<?php include('footer.php'); ?>