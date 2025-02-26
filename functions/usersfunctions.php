<?php

include("config/dbconfig.php");

// Fonction pour recuperer tout les elements dans une table quelquonque de la base de donnee
if (!function_exists('getAll')){
    function getAll($table){
        global $con;
        $query = "SELECT * FROM $table";
        $query_run = mysqli_query($con, $query);
        return $query_run;
    }
}

// Recuperer les clients par type de visa
if (!function_exists('getAdmin')){
    function getAdmin($table, $id){
        global $con;
        $client_query = $con->prepare("SELECT * FROM $table WHERE id = ?");
        $client_query->bind_param("i", $id);
        $client_query->execute();
        $client_result = $client_query->get_result();
        return $client_result;
    }
}

?>