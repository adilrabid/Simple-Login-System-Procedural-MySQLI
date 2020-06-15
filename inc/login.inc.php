<?php

/*
    **  All the finctions and logics used here is almost indentical to the signup.inc.php.
        Go there and check them if you want.
*/

if (isset($_POST['submit_login'])) {
    require 'db.inc.php';

    $user_ids = mysqli_real_escape_string($connection, trim($_POST['user_ids']));
    $password = mysqli_real_escape_string($connection, $_POST["pass_login"]);

    if ( empty($user_ids) || empty($password)) {
        header("Location: ../index.php?login=1&err=empty-field&uid=".$user_ids);
        exit;
    } else {
        $query = "SELECT * FROM accounts WHERE username=? OR email=?;";
        $statement = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($statement, $query)) {
            header("Location: ../index.php?err=query-failed");
            exit;
        } else {
            
            mysqli_stmt_bind_param($statement, "ss", $user_ids,$user_ids);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            
            if ($record = mysqli_fetch_assoc($result)) {
                $pass_check = password_verify($password, $record['pass']);
                // ** password_verify() - Automatically hashes the password and try to match it to the hashed one.
                
                if ($pass_check == true) {
                    session_start();
                    // ** session_start() - starts the session.

                    $_SESSION['id'] = $record['id'];
                    // ** Stores the id of the record of the current user got from MySQL server.

                    $_SESSION['username'] = $record['username'];
                    // ** Stores the username of the record of the current user got from MySQL server.

                    header("Location: ../index.php?login=success");
                    exit;

                } elseif($pass_check == false) {
                    header("Location: ../index.php?login=1&err=wrong-password");
                    exit;
                } 
                else {
                    header("Location: ../index.php?login=1&err=wrong-password");
                    exit;
                }
                
            } else {
                header("Location: ../index.php?login=1&err=user-not-found");
                exit;
            }
            
        }
        
    }

} else {
    header("Location: ../index.php");
    exit;
}
