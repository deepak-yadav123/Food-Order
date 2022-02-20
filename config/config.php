<?php  
   // Start Session
   session_start();
//    SITEURL = 'http://localhost/Food-Order/';

   

// it's all are database localhost,database username,database passwords;
    define('SITEURL','http://localhost/Food-Order/');
    define('LOCALHOST','localhost');
    define('USERNAME','root');
    define('PASSWORD','');
    define('DBNAME','food-order');

    $conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn,DBNAME) or die(mysqli_error());  // selecting database

?>