<?php 

if (isset($_POST['submit_signup'])) { 
    /*
        **  Checks if the user entered here via clicking the signup button, 
            otherwise redirect him back to the signup page!

        **  Usefull for security purpose!
    */

    require 'db.inc.php'; // fetching the database connections handler page.

    $username = mysqli_real_escape_string($connection, trim($_POST['name']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email_signup']));
    $password = mysqli_real_escape_string($connection, $_POST['pass_signup']);
    $password_repeat = mysqli_real_escape_string($connection, $_POST['pass_repeat']);

    /*
        **  trim() is a php function that trims of the extra spaces of any input data.
            Usefull if any user accidently put any extra space before and after the inputs.

        **  mysqli_real_escape_string() - by using this function, sql server will not see it 
            as any type of code that is used by the SQL. Used for anti sql injection.
            
        **  Usefull for safety against sql injections!
    */

    if ( empty($username) || empty($email) || empty($password) || empty($password_repeat)) {
        // ** Checks if any input field is empty
        header("Location: ../index.php?err=empty-field&name=".$username."&email=".$email);
        exit; 
        /* 
            **  header() is the function which is used to redirect to the given url.
            
            **  'exit' stops to read the scripts immediately.
        */

    } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",$username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        /*
            **  Checks if the username or email fullfills the regular expressions aka regex. 

            **  preg_match() checks if the input string (we're using '$username' here) which is the second parameter, 
                fullfills the regular expression generated inside "/ /" as forst parameter amd returns a boolean value.

            **  filter_var() filters the value that is passed through the first parameter with the filter
                called FILTER_VALIDATE_EMAIL as the second parameter.

            **  FILTER_VALIDATE_EMAIL validates whether the value is a valid e-mail address or not. 
                if helps us by not to write a long regular expression to validate email.
        */
        header("Location: ../index.php?err=invalid-name-email");
        exit;

    } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",$username) ) {
        // ** Checks if only the $username is invalid. 
        header("Location: ../index.php?err=invalid-name&email=".$email);
        exit;

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        // ** Checks if only the $email is invalid. 
        header("Location: ../index.php?err=invalid-email&name=".$username);
        exit;

    } elseif ( $password !== $password_repeat) {
        // ** Checks if the confirmation password matched or not. 
        header("Location: ../index.php?err=pass-unmatched&name=".$username."&email=".$email);
        exit;

    } else{
        // ** to check if there is already a user with the this email.
        $query = "SELECT id FROM accounts WHERE email = ?;";

        /*
            **  $query - the query to send to the database.

            **  Here 'SELECT' - to select the 'id'(fieldname)
                     'FROM' - from the 'accounts' table
                     'WHERE' - where the email is $email

                **  Here $email has replaced by a placeholder '?' 
                    Because we're not going to insert the $email directly 
                    to the database rather than sanitizing it first!

                **  Actually we're going to use a term called prepared statement.
                    it basically send the SQL code with some placeholder to the SQL
                    then afterwards send the data that is going to replace the placeholder.
                    And because we're sending this data later, MySQL will see this as a general
                    string not as a code!
        */

        $statement = mysqli_stmt_init($connection);
        /*
            **  mysqli_stml_init() - initializing prepared statement. $connection is the connection
                                     to use.
        */
        if(!mysqli_stmt_prepare($statement, $query)){
            /*  
                ** Preparing a prepared statement. It returns a boolean value.
                
                **  Here we're checking if the statemnet can be prepared or not.  
            */      
            header("Location: ../index.php?err=query-failed");
            exit;

        } else {
            mysqli_stmt_bind_param($statement, "s", $email); 
            // ** mysqli_stmt_bind_param() - Binding the $email parameter to the previously written '?'.
            
            mysqli_stmt_execute($statement);
            // **  mysqli_stmt_execute() - Executing the prepared statemensts. 

            mysqli_stmt_store_result($statement);
            // **  mysqli_stmt_store_result() - Stores the valye returned to us.

            $matched_results = mysqli_stmt_num_rows($statement); 
            // ** mysqli_stmt_num_rows() - To get the nnumber of records.

            if($matched_results > 0){
                // ** Checking if there is at least on matching records.
                header("Location: ../index.php?err=email-taken&email=".$email."&name=".$username);
                exit;

            } else {
                // ** Inserting the user informations to the database 
                $query = "INSERT INTO accounts (username, pass, email) VALUES (?,?,?);"; 
                $statement = mysqli_stmt_init($connection);
                // ** Initializing another prepared statement.

                if(!mysqli_stmt_prepare($statement, $query)){
                    header("Location: ../index.php?err=query-failed");
                    exit;

                } else {
                    $encrypted_pass = password_hash($password, PASSWORD_DEFAULT);
                    /*
                        **  password_hash() - Encrypt the password in a given algorithom

                        **  PASSWORD_DEFAULT - Uses the bcrypt algorithm which is one of the best hashing method
                                               managed by the developers of PHP. Its algorithm is constantly changes
                                               and thats why it is very secure.
                    */
                    mysqli_stmt_bind_param($statement, "sss", $username, $encrypted_pass , $email);
                    /*
                        **  "sss" - Define the datatype we want to bind.
                                    s - for string
                                    i - for integer
                                    d - for double etc
                        
                        **  Use multiple character to bind multiple data. We are using three data here.
                        
                        **  Make sure they are in correct order.
                    */

                    mysqli_stmt_execute($statement);
                    header("Location: ../index.php?signup=success");
                    exit;

                }   
            } 
        }
        
        // ** closing the connections 
        mysqli_stmt_close($statement); // Closes the prepared statements.
        mysqli_close($connection); // Closes the Mysql server connection.
    
    } 
    
}else{
    // ** Redirects if the user somehow tricked and typed the url to get here.
    header("location: ../");
    exit;
}
