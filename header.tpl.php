<?php

    /*
        Template file : header.tpl.php
    */
    
    session_start(); 
    /*
        **  session_start() - To start new or resume existing session
        
        **  SESSION is another way to store and get data like GET, POST etc.
            A super global variable $_SESSION is used for that 

        **  It saves the data in server side not in the client side.    

        **  Unlike COOCKIE, is removes all the informations in it as soon as the browser is closed.
        
        **  We are using this in order to determine if a user is logged in or not across different pages.
    */    
    
    include 'inc/notific.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav >
        <span id='site_logo'>LOGO</span>
        <span>
        <a href="" class='nav_link'>Sample Page</a>
        <a href="" class='nav_link'>About</a>
        <a href="" class='nav_link'>Contact</a>   
        <?php 
            if(logged_in()){
                echo "<a class='nav_link'>Logged in as: ".$_SESSION['username']."</a>";
            }
        ?>
        <?php if(logged_in()){ ?>
            <a href="inc/logout.inc.php"class='button'>LOG OUT</a>
        <?php }else{ ?>
            <a href="index.php?login=1"class='button'>LOG IN</a>
        <?php } ?>
    </nav>
    <div class='container'>

 