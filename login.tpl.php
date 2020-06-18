<?php

    /*
        Template file : login.tpl.php
    */
    
?>

<form action="inc/login.inc.php" method = 'post' class ='login_form'>
    <h1>Log in</h1>
    <?php 
        if ( isset($_GET['err']) ) {
            message_box($operation, $msg); 
        }
    ?>
    <input type="text" name='user_ids' value = "<?= $typed_uid;?>" placeholder = 'Email or username'>
    <input type="password" name='pass_login' placeholder = 'Password'>
    <input type="submit" name='submit_login' value = 'LOG IN'>
</form>

<p id='suggest_signup'>
    Don't have an account?
    <a href="index.php">Sign up</a>
</p>
