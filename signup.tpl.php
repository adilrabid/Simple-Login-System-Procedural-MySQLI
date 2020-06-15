<?php

    /*
        Template file : signup.tpl.php
    */

?>

<div id ='signup_section' class = 'col-2'>
    <aside>
        <h1>
        Welcome to the Simple Login System
        </h1>
        <p>
           Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci placeat earum perspiciatis cupiditate ab aperiam tempore, illum ducimus rem atque accusamus aspernatur sequi assumenda nesciunt totam rerum. Alias, unde culpa.
        </p>
        <button class = "button">Learn More</button>
    </aside>
    <form action="inc/signup.inc.php" method = 'post' class ='sign_up_form'>
        <h1>Sign up</h1>
        <?php 
            if (isset($_GET['err']) || isset($_GET['signup'])) {
                message_box($operation, $msg); 
            }
        ?>
        <input type="text" name='name' value = "<?= $typed_name;?>" placeholder = 'Your name'>
        <input type="email" name='email_signup' value ="<?= $typed_email;?>" placeholder = 'Your email'>
        <input type="password" name='pass_signup' placeholder = 'Type a password'>
        <input type="password" name='pass_repeat' placeholder = 'Confirm password'>
        <input type="submit" name='submit_signup' value = 'SIGN UP'>
    </form>
</div>
