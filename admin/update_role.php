<?php
    session_start();
    include("../config/dbconfig.php");
    include("../functions/myfunctions.php");

    if(isset($_POST['toggle_state']) && isset($_SESSION['user_id'])){
        $toggle_state = $_POST['toggle_state'];
        $user_role = $_SESSION['user_id'];
        
        // Mettre à jour le rôle dans la base de données
        $query = $con->prepare("UPDATE users SET `role` = ? WHERE id = ?");
        $query->bind_param("ii", $toggle_state, $user_id);

        if ($query->execute()) {
            if($toggle_state == 1){
                // Si le role passe a 1, inserer dans la table `admin`
                $check_admin = $con->prepare("SELECT * FROM admin WHERE user_id = ?");
                $check_admin->bind_param("i", $user_id);
                $check_admin->execute();
                $result = $check_admin->get_result();
                if($result->num_rows == 0){
                    // Inserer dans la table `admin`
                    $insert_admin = $con->prepare("INSERT INTO admin (user_id) VALUES (?)");
                    $insert_admin->bind_param("i", $user_id);
                    $insert_admin->execute();
                }
            }
            echo "Rôle mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du rôle : " . $query->error;
        }
    }

?>