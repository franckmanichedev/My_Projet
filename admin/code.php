<?php

    session_start();
    include("../config/dbconfig.php");
    include("../functions/myfunctions.php");

    // Create Update Delete Visa Part
    if (isset($_POST['add_visa_btn'])){
        $libelle_visa = $con->real_escape_string(($_POST["libelle_visa"]));
        $description_visa = $con->real_escape_string(($_POST["description_visa"]));

        $image = $_FILES['image']['name'];
        $path = "../uploads";
        
        $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $filename = time().".".$image_ext;

        // Préparez la requête pour insérer une nouvelle catégorie
        $visa_query = $con->prepare("INSERT INTO visa 
        (libelle_visa, `description_visa`, `image`)
        VALUES(?, ?, ?)");
        $visa_query->bind_param("sss", $libelle_visa, $description_visa, $filename);
        
        // Vérifiez si l'insertion dans la base de données a réussi
        if($visa_query->execute()){
            // Verifier si le fichier est charge avec success
            if(move_uploaded_file($_FILES['image']['tmp_name'], $path ."/". $filename)){
                $_SESSION['message'] = "Categorie ajoute avec succes !";
                header('Location: visa.php');
                // redirect("visa.php", "Categorie ajoute avec succes !");
            } else {
                // Affichez des erreurs détaillées
                $error_message = "Erreur lors du telechargement du fichier !";
                switch ($_FILES['image']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        $error_message .= " Le fichier téléchargé est trop lourd 2Mo maximum";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $error_message .= " Le fichier téléchargé dépasse la directive (2Mo maximum)";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $error_message .= " Le fichier n'a été que partiellement téléchargé.";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $error_message .= " Aucun fichier n'a été téléchargé.";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $error_message .= " Il manque un dossier temporaire.";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $error_message .= " Échec de l'écriture du fichier sur le disque.";
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        $error_message .= " Une extension PHP a arrêté le téléchargement du fichier.";
                        break;
                    default:
                        $error_message .= " Erreur inconnue.";
                        break;
                }
                $_SESSION['message'] = $error_message;
                header('Location: visa.php');
                // redirect("visa.php",$error_message);
            }
        } else {
            $_SESSION['message'] = "Erreur d'ajout du type de visa !" . $visa_query->error;
            header('Location: visa.php');
            // redirect("visa.php", "Erreur d'ajout de la categorie !" . $visa_query->error);
        }
        $visa_query->close();
    } else if (isset($_POST['update_visa_btn'])){
        $visa_id = $_POST['visa_id'];
        $libelle_visa = $con->real_escape_string(($_POST["libelle_visa"]));
        $description_visa = $con->real_escape_string(($_POST["description_visa"]));

        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];

        if($new_image != ""){
            $update_filename = time() . "." . strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
        } else {
            $update_filename = $old_image;
        }

        $path = "../uploads";

        $update_query = $con->prepare("UPDATE visa SET `libelle_visa`=?, description_visa=?, `image`=? WHERE id_visa=?");
        $update_query->bind_param("ssii", $libelle_visa, $description_visa, $update_filename, $visa_id);
        if($update_query->execute()){
            if ($new_image != "") {
                if(move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $update_filename)){
                    if(file_exists('../uploads/'.$old_image)){
                        unlink('../uploads/'.$old_image);
                    }
                } else {
                    $_SESSION['message'] = "Categorie ajoute avec succes !";
                    header('Location: visa.php');
                    // redirect("edit-visa.php?id=$visa_id", "Categorie ajoute avec succes !");
                    exit();
                }
            }
            $_SESSION['message'] = "Type de visa modifier avec succes !";
            header('Location: visa.php');
            // redirect("edit-category.php?id=$visa_id", "Type de visa modifier avec succes !");
        } else {
            $_SESSION['message'] = "Erreur de mise a jour du type de visa !";
            header('Location: visa.php?id=$visa_id');
            // redirect("edit-category.php?id=$visa_id", "Erreur de mise a jour du type de visa !" . $update_query->error);
        }
        $update_query->close();
    } else if(isset($_POST['delete_visa_btn'])){
        $visa_id = $_POST['visa_id'];

        $visa_query = $con->prepare("SELECT * FROM visa WHERE id_visa = ?");
        $visa_query->bind_param("i", $visa_id);
        $visa_query->execute();
        $result = $visa_query->get_result();
        $visa_result = $result->fetch_assoc();

        $image = $visa_result['image'];

        $delete_query = $con->prepare("DELETE FROM visa WHERE id_visa=?");
        $delete_query->bind_param("i", $visa_id);
        $delete_query->execute();

        if($delete_query->affected_rows > 0){
            if(file_exists('../uploads/'.$image)){
                unlink('../uploads/'.$image);
            }
            $_SESSION['message'] = "Categorie supprimer avec succes !";
            header('Location: visa.php');
            // redirect("visa.php", "Category supprimer avec success !");
            // echo 200;
        } else {
            $_SESSION['message'] = "Erreur lors du chargement du fichier !";
            header('Location: visa.php');
            // redirect("visa.php", "Erreur lors du chargement du fichier !");
            // echo 500;
        }
    
    } 
    
    // Create Update Delete Users Part
    else if(isset($_POST['add_client_btn'])){
        if (isset($_POST['visa_id'])) {
            $visa_id = $_POST['visa_id'];
        } else {
            $_SESSION['message'] = "Id_visa non spécifié !";
            header('Location: add-clients.php');
            exit();
        }
        $nom = $con->real_escape_string($_POST['nom']);
        $prenom = $con->real_escape_string($_POST['prenom']);
        $phone = $con->real_escape_string($_POST['phone']);
        $email = $con->real_escape_string($_POST['email']);
        $age = $con->real_escape_string($_POST['age']);
        $profession = $con->real_escape_string($_POST['profession']);

        $check_query = $con->prepare("SELECT * FROM clients WHERE telephone = ? OR email = ?");
        $check_query->bind_param("ss", $phone, $email);
        $check_query->execute();
        $result = $check_query->get_result();

        $check_users = $con->prepare("SELECT * FROM users WHERE email = ?");
        $check_users->bind_param("s", $email);
        $check_users->execute();
        $result = $check_users->get_result();

        if(mysqli_num_rows($result) == 0){
            $query_client = $con->prepare("INSERT INTO clients(nom, prenom, age, profession, email, telephone, visa_client) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
            $query_client->bind_param("ssssssi", $nom, $prenom, $age, $profession, $email, $phone, $visa_id);

            if($query_client->execute()){
                $_SESSION['message'] = "Voyageurs ajoute avec succes !";
                header('Location: clients.php');
                // redirect("visa.php", "Categorie ajoute avec succes !");
            }
            
            $role = 0;
            $query_user = $con->prepare("INSERT INTO users (nom, email, `role`) VALUES (?, ?, ?)");
            $query_user->bind_param("ssi", $nom, $email, $role);
            $query_user->execute();

        } else {
            $_SESSION['message'] = "L'email est déjà utilisé par un autre utilisateur.";
            header('Location: add-clients.php');
            // redirect("add-clients.php", "Le numéro de téléphone ou l'email est déjà utilisé par un autre utilisateur !");
        }
    } 

    // Create Update Delete Procedure Stape Part
    else if(isset($_POST['add_procedure_btn'])){
        $visa_id = intval($_POST['visa_id']);
        $libelle = $con->real_escape_string($_POST['libelle_procedure']);
        $description = $con->real_escape_string($_POST['description_procedure']);

        $image = $_FILES['image']['name'];
        $path = "../uploads";
        
        $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $filename = time().".".$image_ext;

        // Insérez la nouvelle étape dans la base de données
        $query_procedure = $con->prepare("INSERT INTO `procedure`
        (id_visa, libelle_procedure, description_procedure, `image`) VALUES 
        (?, ?, ?, ?)");
        $query_procedure->bind_param("isss", $visa_id, $libelle, $description, $filename);
        if ($query_procedure->execute()) {
            if(move_uploaded_file($_FILES['image']['tmp_name'], $path ."/". $filename)){
                $_SESSION['message'] = "Categorie ajoute avec succes !";
                header("Location: details-visa.php?id=$visa_id");
                // redirect("visa.php", "Categorie ajoute avec succes !");
            } else {
                // Affichez des erreurs détaillées
                $error_message = "Erreur lors du telechargement du fichier !";
                switch ($_FILES['image']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        $error_message .= " Le fichier téléchargé est trop lourd 2Mo maximum";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $error_message .= " Le fichier téléchargé dépasse la directive (2Mo maximum)";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $error_message .= " Le fichier n'a été que partiellement téléchargé.";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $error_message .= " Aucun fichier n'a été téléchargé.";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $error_message .= " Il manque un dossier temporaire.";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $error_message .= " Échec de l'écriture du fichier sur le disque.";
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        $error_message .= " Une extension PHP a arrêté le téléchargement du fichier.";
                        break;
                    default:
                        $error_message .= " Erreur inconnue.";
                        break;
                }
                $_SESSION['message'] = $error_message;
                header('Location: visa.php');
                // redirect("visa.php",$error_message);
            }
        } else {
            echo "Erreur lors de l'ajout de l'étape : " . $con->error;
        }
    } else if(isset($_POST['update_procedure_btn'])){
        $visa_id = $_POST['visa_id'];
        $procedure_id = $_POST['procedure_id'];
        $libelle_procedure = $con->real_escape_string(($_POST["libelle_procedure"]));
        $description_procedure = $con->real_escape_string(($_POST["description_procedure"]));

        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];

        if($new_image != ""){
            $update_filename = time() . "." . strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
        } else {
            $update_filename = $old_image;
        }

        $path = "../uploads";

        $update_query = $con->prepare("UPDATE `procedure` SET `libelle_procedure` = ?, description_procedure = ?, `image`=? WHERE id_procedure=?");
        $update_query->bind_param("ssii", $libelle_procedure, $description_procedure, $update_filename, $procedure_id);
        if($update_query->execute()){
            if ($new_image != "") {
                if(move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $update_filename)){
                    if(file_exists('../uploads/'.$old_image)){
                        unlink('../uploads/'.$old_image);
                    }
                } else {
                    $_SESSION['message'] = "Etape de procedure ajoute avec succes !";
                    header("Location: details-visa.php?id=$visa_id");
                    // redirect("details-visa.php?id=$visa_id", "Etape de procedure ajoute avec success !");
                    exit();
                }
            }
            $_SESSION['message'] = "Etape de procedure modifier avec succes !";
            header("Location: details-visa.php?id=$visa_id");
            // redirect("details-visa.php?id=$visa_id", "Etape de procedure mise a jour avec succes !");
        } else {
            $_SESSION['message'] = "Erreur de mise a jour de l'etape de procedure !";
            header("Location: details-visa.php?id=$visa_id");
            // redirect("details-visa.php?id=$visa_id", "Erreur de mise a jour de l'etape de procedure !" . $update_query->error);
        }
        $update_query->close();
    } 
    
    // Create Update Stape Client Part
    else if(isset($_POST[''])){

    }
    
    else {
        header("Location: index.php");
    }

?>