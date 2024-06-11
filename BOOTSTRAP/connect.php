<?php   
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "samueldb";

       $con = mysqli_connect($localhost, $username, $password, $dbname); // login com o banco de dados 

     if ($con->connect_error) // caso  der erro 
     {
        die ("connection failed: " .$con->connect_error); 
     }   