<?php

    /*
        Template file : main.tpl.php
    */

    if(function_exists('logged_in')){  
?>

<main>
    <div id="page_title">
        <h1>You Are Logged In Now</h1>
        <p>This is a sample and simple singn-up and login system using only PHP and MySQLI for beginners</p>
    </div>
    
    <div id='cards'>
        <div class ='card'>
            <div class ='card_icon'>🎲</div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus iure eaque omnis, modi quos fugiat?</p>
        </div>
        <div class ='card'>
            <div class ='card_icon'>🤍</div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus iure eaque omnis, modi quos fugiat?</p>
        </div>
        <div class ='card'>
            <div class ='card_icon'>🕔</div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus iure eaque omnis, modi quos fugiat?</p>
        </div>
    </div>
</main>  

<?php

} else {
    // ** Redirect if someone manually typed the url
    header('location: .');
}