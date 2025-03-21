<?php

    include("../config/dbconfig.php");

    // Fonction pour recuperer tout les elements dans une table quelquonque de la base de donnee
    if (!function_exists('getAll')){
        function getAll($table){
            global $con;
            $query = "SELECT * FROM $table";
            $query_run = mysqli_query($con, $query);
            return $query_run;
        }
    }

    // Fonction pour recuperer tout les utilisateurs ayant un role = 0 dans la base de donnee
    if (!function_exists('getAllClient')){
        function getAllClient($table){
            global $con;
            $query = "SELECT * FROM $table WHERE `role` = '0'";
            $query_run = mysqli_query($con, $query);
            return $query_run;
        }
    }

    // Recuperer les clients par type de visa
    if (!function_exists('getClient')){
        function getClient($table, $id){
            global $con;
            $client_query = $con->prepare("SELECT * FROM $table WHERE id = ?");
            $client_query->bind_param("i", $id);
            $client_query->execute();
            $client_result = $client_query->get_result();
            return $client_result;
        }
    }

    // Recuperer le libelle du visa en fonction de l'id visa du client
    function getVisaLibelleById($visa_id) {
        global $con;
        $query = "SELECT libelle_visa FROM visa WHERE id_visa = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $visa_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $visa = $result->fetch_assoc();
        return $visa['libelle_visa'];
    }

    // Récupérez les procédures associées au type de visa du client
    if (!function_exists('getAllStapesByVisaId')){
        function getAllStapesByVisaId($client_id, $id_visa){
            global $con;
            $procedure_query = $con->prepare("SELECT p.*, IFNULL(cp.etat_procedure, 0) AS etat_procedure
                                            FROM `procedure` p
                                            LEFT JOIN etat_clients cp
                                            ON p.id_procedure = cp.id_procedure
                                            AND cp.id_client = ?
                                            WHERE p.id_visa = ?  ORDER BY `order` ASC");
            $procedure_query->bind_param("ii", $client_id, $id_visa);
            $procedure_query->execute();
            $procedure_result = $procedure_query->get_result();
            return $procedure_result;
        }
    }

    // Fonction pour inserer tout les utilisateurs ayant un role = 1 dans la table des administrateurs
    if (!function_exists('insertClient')){
        function insertClient($data){
            global $con;
            $check_query = $con->prepare("SELECT * FROM clients WHERE telephone = ? OR email = ?");
            $check_query->bind_param("ss", $phone, $email);
            $check_query->execute();
            $result = $check_query->get_result();
            if(mysqli_num_rows($result) == 0){
                $query = "INSERT INTO clients(nom, prenom, age, profession, email, telephone, `password`, visa_client) VALUES (?, ?, ?, ?, ?, ?, ?, '$item[id_visa]')";
                mysqli_query($con, $query);
            }
        }
    }

    // Fonction pour recuperer tout les utilisateurs ayant un role = 1 dans la base de donnee
    if (!function_exists('getAllAdmin')){
        function getAllAdmin($table){
            global $con;
            $query = "SELECT * FROM $table WHERE `role` = '1'";
            $query_run = mysqli_query($con, $query);
            return $query_run;
        }
    }

    // Fonction pour inserer tout les utilisateurs ayant un role = 1 dans la table des administrateurs
    if (!function_exists('insertAdmin')){
        function insertAdmin($data){
            global $con;
            $checkquery = $con->prepare("SELECT * FROM `admin` WHERE email = ?");
            $checkquery->bind_param("s", $data['email']);
            $checkquery->execute();
            $result = $checkquery->get_result();
            if(mysqli_num_rows($result) == 0){
                $query = "INSERT INTO `admin` (nom, email, `role`) VALUES ('$data[nom]', '$data[email]', '$data[role]')";
                mysqli_query($con, $query);
            }
        }
    }

    if (!function_exists('getById')){
        function getById($visa_id){
            global $con;
            $query = $con->prepare("SELECT * FROM `procedure` WHERE id_visa = ? ORDER BY `order` ASC");
            $query->bind_param("i", $visa_id);
            $query->execute();
            $result = $query->get_result();
            return $result;
        }
    }

    // Fonction pour selectionner tout les type de visa ayant pour Id...
    if (!function_exists('getVisaById')){
        function getVisaById($table, $id){
            global $con;
            $query = $con->prepare("SELECT * FROM `$table` WHERE id_visa = ?");
            $query->bind_param("i", $id);
            $query->execute();
            $result = $query->get_result();
            return $result;
        }
    }

    if (!function_exists('getStapeById')){
        function getStapeById($table, $id, $column = 'id_visa'){
            global $con;
            $query = $con->prepare("SELECT * FROM `$table` WHERE $column = ?");
            $query->bind_param("i", $id);
            $query->execute();
            $result = $query->get_result();
            return $result;
        }
    }

    //
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

    // Fonction pour rediriger les utilisateur
    if (!function_exists('redirect')){
        function redirect($url, $message){
            $_SESSION['message'] = $message;
            header('Location: ' . $url);
            exit();
        }
    } 
      
?>