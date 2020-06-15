<?php

$dbhost =  $_SERVER['HTTP_HOST'];
$dbuser = 'root'; 
$dbpass = '';
$dbname = 'simple_login_system';
/*
    **  Databases comes with a default user called 'root' with empty password.

    **  If you want to use a custom user, then edit the $dbuser and $dbpass above.
        But make sure to grant CRUD privileges to your user.
*/
$db_prep_connection = mysqli_connect($dbhost,$dbuser,$dbpass);
/*  
    **  mysqli_connect() - enables us to connect to the server.

    **  $db_prep_connection - This is a test connection to check whether the
                              database exists or not.

    **  If not, then create the database as well as the necessary tables and fields.

    **  If database already exists, then this step will be skipped.    

    **  This section completely optional. If you don't include this piece of code,
        you have to manually create the database with required fields.
*/
if($db_prep_connection){

    $db_select = mysqli_select_db($db_prep_connection, $dbname);
    //  mysqli_select_db() - To select the database ($dbname) from the MqSQL server

    if (empty($db_select)) {
        // Checks if database can not be selected. It means database dom't exists.
        $query_create_db = mysqli_query($db_prep_connection, "CREATE DATABASE ".$dbname.";");
        /*
            **  mysqli_query() - To make a query to the server. 

            **   First parameter is to use the connection and second parameter is the actual query to perform.
        */
        if(!$query_create_db){
            header("Location: ../index.php?err=db-failed");// Redirects if database creation failed.
            exit;
        }else{
            echo "<br>database created";
            $query_use_db = mysqli_query($db_prep_connection, "USE ".$dbname.";"); // To use the specified database.
           
            $query_create_table = "CREATE TABLE accounts ( 
                id INT AUTO_INCREMENT NOT NULL,
                username VARCHAR(100) NOT NULL,
                email VARCHAR(50) NOT NULL,
                pass VARCHAR(255) NOT NULL,
                register_date TIMESTAMP,
                PRIMARY KEY (id) );";
            // The query to create differents fields inside the database. Each field has specified field type.
            
            $create_table = mysqli_query($db_prep_connection, $query_create_table);
            // To execute the table creation query. 

            if(!$query_use_db){
                die('Database is unable to use! ' . mysqli_connect_error() . ":". mysqli_connect_errno());
                /*
                    **  mysqli_connect_error() - Display the connection erron message.
                    **  mysqli_connect_errno() - Display the error no.
                */
            }elseif(!$create_table){
                die('Table creation failed! ' . mysqli_connect_error() . ":". mysqli_connect_errno());
            }else{    
                echo "Table created successfully"; // For dubugging purpose only, this won't be displayed anywhere!
            }
        }
    }
}

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
/*
    **  This is connection where the signup and login process will will be using.   

    **  If you don't create a database manually and also don't include the previous section of code,
        then everything related to CRUD will be failed.
*/
if (!$connection) {
    die('Connectin failed! ' . mysqli_connect_error(). ":" .mysqli_connect_errno() );
}else{
    echo "connection established";
}