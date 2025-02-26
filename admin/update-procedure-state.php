<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../middleware/adminMiddleware.php");

if(!isset($con)){
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $client_id = intval($data['id_client']);
    $visa_id = intval($data['visa_id']);
    $etat_procedure = $data['etat_procedure'];

    foreach ($etat_procedure as $procedure) {
        $id_procedure = intval($procedure['id_procedure']);
        $etat = intval($procedure['etat']);

        // Vérifiez si l'entrée existe déjà
        $check_query = $con->prepare("SELECT * FROM etat_clients WHERE id_client = ? AND id_procedure = ?");
        if(!$check_query){
            echo json_encode(['success' => false, 'message' => 'Erreur de requête: ' . $con->error]);
            exit();
        }
        $check_query->bind_param("ii", $client_id, $id_procedure);
        $check_query->execute();
        $check_result = $check_query->get_result();

        if ($check_result->num_rows > 0) {
            // Mettre à jour l'état existant
            $update_query = $con->prepare("UPDATE etat_clients SET etat_procedure = ? WHERE id_client = ? AND id_procedure = ?");
            if(!$update_query){
                echo json_encode(['success' => false, 'message' => 'Erreur de requête: ' . $con->error]);
                exit();
            }
            $update_query->bind_param("iii", $etat, $client_id, $id_procedure);
            $update_query->execute();
            $update_query->close();
        } else {
            // Insérer une nouvelle entrée
            $insert_query = $con->prepare("INSERT INTO etat_clients (id_client, id_procedure, etat_procedure) VALUES (?, ?, ?)");
            if(!$insert_query){
                echo json_encode(['success' => false, 'message' => 'Erreur de requête: ' . $con->error]);
                exit();
            }
            $insert_query->bind_param("iii", $client_id, $id_procedure, $etat);
            $insert_query->execute();
            $insert_query->close();
        }
        $check_query->close();
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>