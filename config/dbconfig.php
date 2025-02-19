<?php
    $servername = "localhost";
    $dbname = "my_projet_application";
    $username = "root";
    $password = "";

    $con = new MySqli ($servername,$username,$password,$dbname);
    if($con->connect_error ){
        die("ERREUR: Oops, il y'a eu une erreur de connexion." .$conn->connect_error);
    } else {
        // echo "Connecion db reussit";
    }
?>