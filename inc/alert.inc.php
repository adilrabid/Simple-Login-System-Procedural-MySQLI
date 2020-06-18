<?php

$msg = '';
$operation ='';
$typed_email = '';
$typed_name = '';
$typed_uid = '';
// ** These are the default values. Otherwise PHP will through a warning message.

if (isset($_GET['err'])) {
    // ** Checks if there is any error information is the url.

    $operation = 'error';

    if ($_GET['err'] == 'empty-field') {
        $msg = 'Please fill up all the fields!';
    } elseif ($_GET['err'] == 'invalid-name-email') {
        $msg = 'Please enter a valid username and emai!';
    } elseif ($_GET['err'] == 'invalid-name') {
        $msg = 'Please enter a valid username!';
    } elseif ($_GET['err'] == 'invalid-email') {
        $msg = 'Please enter a valid email!';
    } elseif ($_GET['err'] == 'pass-unmatched') {
        $msg = 'Password did not matched';
    } elseif ($_GET['err'] == 'query-failed') {
        $msg = 'Something went wrong, please try again!';
    } elseif ($_GET['err'] == 'email-taken') {
        $msg = 'Already signed up with this email!';
    } elseif ($_GET['err'] == 'wrong-password') {
        $msg = 'Wrong password, try again!';
    } elseif ($_GET['err'] == 'user-not-found') {
        $msg = 'User not found!';
    } else{
        $msg = '';
    }

}elseif (isset($_GET['signup'])) {
    // ** Checks if there is any signup related information is the url.

    $operation = 'success';
    $msg = 'You have successfully signed up!';

}else {
    $operation = '';
}

if (isset($_GET['email'])) {
     // ** Checks if a user already typed an email in the email field.

    $typed_email = $_GET['email'];
}

if (isset($_GET['name'])) {
    // ** Checks if a user already typed an username in the username field.

    $typed_name = $_GET['name'];
}

if (isset($_GET['uid'])) {
    // ** Checks if a user already typed anything in the Login user id field.

    $typed_uid = $_GET['uid'];
}

function message_box($operation, $msg){
    // ** A function for generating a feedback message box in the DOM.

    $output = "<div class ='message_box ";
    $output .= $operation;
    $output .= "'>";
    $output .= $msg;
    $output .= "</div>";

    echo $output;
}

function logged_in(){
    // **  This function returns a boolean value according the login status by checking the session variables.

    if(isset($_SESSION['username']) && isset($_SESSION['id'])){
        return true;
    }else{
        return false;
    }
}
    
