<?php

// ** When the user clicks the LOG OUT button, he/she will redirect here and their login information will be destroyed.

session_start();   
 // ** session_start() - Starts the session.

session_unset();
 // ** session_unset() - Unset the current session.

session_destroy();
 // ** session_destroy() - Destroys all the value in the session.

header('location: ../index.php');