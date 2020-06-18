<?php 

    /*
        Template file : index.php
    */

include 'header.tpl.php';

if(logged_in()){
    // If logged in then route to the main.tpl.php
    include 'main.tpl.php';
}elseif (isset($_GET['login'])) {
     // If clicked the login button, then route to the login.tpl.php
    include 'login.tpl.php';
}
else{
    // By Default includes the signup.tpl.php
    include 'signup.tpl.php';
}

include 'footer.tpl.php';