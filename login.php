<?php 
    $className = "login";

    include('header.php');
?>

<h2 class="section-header-light">Login</h2>
<div id="login-box" class="light-shadow">  
    <form action="validation.php" method="post">            
        <p class="field-header-dark">E-mail</p>
        <input class="general-input" type="text" placeholder="john.doe@gmail.com" required="required" name="email">
        <br/>
        <p class="field-header-dark">Password</p>
        <input class="general-input" type="password" required="required" name="password">
        <br/><br/>
        <input class="dark-submit" type="submit" value="Login">
    </form>   
</div>

<?php include('footer.php'); ?>