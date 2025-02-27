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

// Recuperer les clients par type de visa
if (!function_exists('getClient')){
    function getClient($table, $id){
        global $con;
        $client_query = $con->prepare("SELECT * FROM $table WHERE email = ?");
        $client_query->bind_param("s", $id);
        $client_query->execute();
        $client_result = $client_query->get_result();
        return $client_result;
    }
}

function getProcedureStatus($client_id, $visa_id) {
    global $con;

    // Récupérer toutes les procédures liées au type de visa et l'état de chaque procédure pour un utilisateur particulier
    $query = "SELECT p.id_procedure, p.libelle_procedure, p.description_procedure, p.image, 
                     ec.etat_procedure, ec.updated_at 
              FROM `procedure` p
              LEFT JOIN etat_clients ec ON p.id_procedure = ec.id_procedure AND ec.id_client = ?
              WHERE p.id_visa = ?
              ORDER BY p.order ASC";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $client_id, $visa_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $procedures = [];
    while ($row = $result->fetch_assoc()) {
        $procedures[] = $row;
    }

    return $procedures;
}

?>