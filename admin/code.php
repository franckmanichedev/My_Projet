<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

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
                // $_SESSION['message'] = "Categorie ajoute avec succes !";
                // header('Location: visa.php');
                redirect("visa.php", "Categorie ajoute avec succes !");
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
                // $_SESSION['message'] = $error_message;
                // header('Location: visa.php');
                redirect("visa.php",$error_message);
            }
        } else {
            // $_SESSION['message'] = "Erreur d'ajout du type de visa !" . $visa_query->error;
            // header('Location: visa.php');
            redirect("visa.php", "Erreur d'ajout de la categorie !" . $visa_query->error);
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
                    // $_SESSION['message'] = "Categorie ajoute avec succes !";
                    // header('Location: visa.php');
                    redirect("edit-visa.php?id=$visa_id", "Categorie ajoute avec succes !");
                    // exit();
                }
            }
            // $_SESSION['message'] = "Type de visa modifier avec succes !";
            // header('Location: visa.php');
            redirect("visa.php", "Type de visa modifier avec succes !");
        } else {
            // $_SESSION['message'] = "Erreur de mise a jour du type de visa !";
            // header('Location: visa.php?id=$visa_id');
            redirect("edit-visa.php?id=$visa_id", "Erreur de mise a jour du type de visa !" . $update_query->error);
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
            // $_SESSION['message'] = "Categorie supprimer avec succes !";
            // header('Location: visa.php');
            redirect("visa.php", "Category supprimer avec success !");
            // echo 200;
        } else {
            // $_SESSION['message'] = "Erreur lors du chargement du fichier !";
            // header('Location: visa.php');
            redirect("visa.php", "Erreur lors du chargement du fichier !");
            // echo 500;
        }
    
    } 
    
    // Create Update Delete Users Part
    else if(isset($_POST['add_client_btn'])){
        $email = $con->real_escape_string($_POST['email']);

        // Verifier si l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirect("add-clients.php", "L'email n'est pas valide !");
            // $_SESSION['message'] = "L'email n'est pas valide !";
            // header('Location: add-clients.php');
            // exit();
        }

        // Verifier si l'email existe reellement
        $apiKey = "01420130d22c46088e948d87b5633df3";
        $url = "https://emailvalidation.abstractapi.com/v1/?api_key=$apiKey&email=$email";

        $response = file_get_contents($url);
        $result = json_decode($response, true);

        if (!$result['is_valid_format']['value'] || $result['deliverability'] !== 'DELIVERABLE') {
            redirect("add-clients.php", "L'email que vous avez entré n'existe pas !");
            // $_SESSION['message'] = "L'email que vous avez entré n'existe pas !";
            // header('Location: add-clients.php');
            exit();
        }else{
            if (isset($_POST['visa_id'])) {
                $visa_id = $_POST['visa_id'];
            } else {
                redirect("add-clients.php", "Id_visa non spécifié !");
                // $_SESSION['message'] = "Id_visa non spécifié !";
                // header('Location: add-clients.php');
                // exit();
            }
            $nom = $con->real_escape_string($_POST['nom']);
            $prenom = $con->real_escape_string($_POST['prenom']);
            $phone = $con->real_escape_string($_POST['phone']);
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
                $query_client = $con->prepare("INSERT INTO clients(nom, prenom, age, profession, email, telephone, visa_client) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $query_client->bind_param("ssssssi", $nom, $prenom, $age, $profession, $email, $phone, $visa_id);

                if($query_client->execute()){
                    $client_id = $query_client->insert_id; // Recupere l'id du client
                    
                    // Envoyer un email de au client pour l'inviter a entrer un mot de passe
                    $mail = new PHPMailer(true);

                    try {
                        //Configuration du serveur SMTP
                        $mail->isSMTP();  // Serveur SMTP
                        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                        $mail->SMTPAuth = true; // Activation de l'authentification SMTP
                        $mail->Username = 'franckmaniche6@gmail.com';
                        $mail->Password = 'thpp ipjq dkjh kvdl'; // SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Desactivation du debogage
                        $mail->Port = 587;

                        //Configuration de l'email
                        $mail->setFrom('franckmaniche6@gmail.com', 'Franck Maniche');
                        $mail->addAddress($email, $nom . ' ' . $prenom);

                        //Contenu de l'email
                        $mail->isHTML(true);
                        $mail->Subject = 'Invitation a creer un mot de passe';
                        $mail->Body = "
                            <h3>Bonjour $nom,</h3>
                            <p>Cher client votre compte viens d'etre creer, merci de nous faire confiance.<br>
                            Veuillez cliquer sur le lien ci-dessous pour définir votre mot de passe :</p>
                            <a href='http://localhost:8080/My%20Projet/admin/add-password.php?id=$client_id' class='btn btn-info col-md-3'>Définir mon mot de passe</a>
                            <p>Merci,</p>
                            <p>L'équipe de la direction visa</p>
                        ";
                        $mail->AltBody = 'Veuillez cliquer sur le lien pour définir votre mot de passe.';
                        
                        $mail->send();
                        // $_SESSION['message'] = "Client ajoute avec succes !";
                        // header("Location: add-password.php?id=$client_id");
                        redirect("clients.php", "Client ajoute avec succes !");
                        // exit();
                    } catch (Exception $e) {
                        // $_SESSION['message'] = "Erreur lors de l'envoi de l'email : " . $mail->ErrorInfo;
                        // header("Location: add-clients.php");
                        redirect("add-clients.php", "Erreur lors de l'envoi de l'email : " . $mail->ErrorInfo);
                        // exit();
                    }
                } else {
                    // $_SESSION['message'] = "Erreur d'ajout du client !" . $query_client->error;
                    // header("Location: add-clients.php");
                    redirect("add-clients.php", "Erreur d'ajout du client !" . $query_client->error);
                    // exit();
                }
                
                $role = 0;
                var_dump($nom, $email, $role);
                $query_user = $con->prepare("INSERT INTO users (nom, email, `role`) VALUES (?, ?, ?)");
                $query_user->bind_param("ssi", $nom, $email, $role);
                
                if(!$query_user->execute()){
                    // $_SESSION['message'] = "Erreur d'ajout de l'utilisateur !" . $query_user->error;
                    // header("Location: add-clients.php");
                    redirect("add-clients.php", "Erreur d'ajout de l'utilisateur !");
                    // exit();
                } else {
                    // $_SESSION['message'] = "Utilisateur ajoute avec succes !";
                    // header("Location: add-clients.php");
                    redirect("add-clients.php", "Utilisateur ajoute avec succes !");
                    // exit();
                }

            } else {
                $_SESSION['message'] = "L'email est déjà utilisé par un autre utilisateur.";
                header('Location: add-clients.php');
                // redirect("add-clients.php", "Le numéro de téléphone ou l'email est déjà utilisé par un autre utilisateur !");
            }
        }
    } else if(isset($_POST['add_pwd_client_btn'])){ 
        $id_client = intval($_POST['id_client']);
        $password = $con->real_escape_string($_POST['password']);
        $confirm_password = $con->real_escape_string($_POST['confirm_password']);

        if ($confirm_password == $password){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = $con->prepare("UPDATE clients SET password = ? WHERE id = ?");
            $query->bind_param("si", $hashed_password, $id_client);

            if($query->execute()){
                // $_SESSION['message'] = "Mot de passe ajoute avec succes !";
                // header('Location: clients.php');
                redirect("clients.php", "Mot de passe ajoute avec succes !");
                // exit();
            } else {
                // $_SESSION['message'] = "Erreur d'ajout du mot de passe !" . $query->error;
                // header('Location: add-password.php?id=' . $id_client);
                redirect("add-password.php?id=' . $id_client", "Erreur d'ajout du mot de passe !" . $visa_query->error);
                // exit();
            }
        } else {
            $_SESSION['message'] = "Les mots de passe ne correspondent pas !";
            header('Location: add-password.php?id=' . $id_client);
        }
    } else if(isset($_POST['update_client_info_btn'])){
        $email_id = ($_POST['email_id']);
        $client_id = intval($_POST['client_id']);
        $nom = $con->real_escape_string($_POST['nom']);
        $prenom = $con->real_escape_string($_POST['prenom']);
        $age = $con->real_escape_string($_POST['age']);
        $profession = $con->real_escape_string($_POST['profession']);
        $email = $con->real_escape_string($_POST['email']);
        $telephone = $con->real_escape_string($_POST['telephone']);
        $password = $con->real_escape_string($_POST['password']);
        $visa_id = intval($_POST['visa_id']);

        $hpwd = password_hash($password, PASSWORD_DEFAULT);

        // Préparez la requête pour mettre à jour les informations du client
        $update_query = $con->prepare("UPDATE clients SET nom = ?, prenom = ?, age = ?, profession = ?, email = ?, telephone = ?, password = ?, visa_client = ? WHERE id = ?");
        $update_query->bind_param("ssssssssi", $nom, $prenom, $age, $profession, $email, $telephone, $hpwd, $visa_id, $client_id);


        $query_user = $con->prepare("UPDATE users SET nom = ?, email = ?, `password` = ? WHERE email = ?");
        $query_user->bind_param("ssss", $nom, $email, $hpwd, $email_id);

        // Exécutez les requêtes et vérifiez si la mise à jour a réussi
        $client_update = $update_query->execute();
        $user_update = $query_user->execute();
        if ($client_update && $user_update) {
            // $_SESSION['message'] = "Informations du client mises à jour avec succès !";
            // header('Location: clients.php');
            redirect("clients.php", "Informations du client mises à jour avec succès !");
        } else {
            // $_SESSION['message'] = "Erreur de mise à jour des informations du client : " . $update_query->error;
            // header('Location: edit-clients.php?id=' . $client_id);
            redirect("edit-clients.php", "Erreur de mise à jour des informations du client : " . $update_query->error);
        }

        $update_query->close();
        $query_user->close();
    } else if(isset($_POST['delete_client_btn'])){
        $client_id = intval($_POST['client_id']);
        // $nom = $_POST['nom'];
        // $prenom = $_POST['prenom'];
        // $email = $_POST['email'];
        // $telephone = $_POST['telephone'];
        // $profession = $_POST['profession'];
        // $age = $_POST['age'];
        // $password = $_POST['password'];
        // $created_at = $_POST['created_at'];
        // $visa_client = $_POST['visa_client'];

        $orderData = getClient('clients', $client_id);
        if(mysqli_num_rows($orderData) > 0){
            $item = mysqli_fetch_assoc($orderData);

            $insert_old_client = $con->prepare("INSERT INTO old_client (id, nom, prenom, age, profession, email, telephone, `password`, visa_client, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_old_client->bind_param(
                "isssssssis", 
                $client_id, 
                $item['nom'], 
                $item['prenom'], 
                $item['age'], 
                $item['profession'], 
                $item['email'], 
                $item['telephone'], 
                $item['password'], 
                $item['visa_client'], 
                $item['created_at']
            );

            if($insert_old_client->execute()){
                // Supprimer le client de la table clients
                $delete_query = $con->prepare("DELETE FROM clients WHERE id = ?");
                $delete_query->bind_param("i", $client_id);
                if($delete_query->execute()){
                    // $_SESSION['message'] = "Voyageurs supprimé avec succes !";
                    // header("Location: clients.php");
                    redirect("clients.php", "Voyageurs supprimé avec succes !");
                    // exit();
                } else {
                    // $_SESSION['message'] = "Erreur lors de la suppression du client !" . $delete_query->error;
                    // header("Location: clients.php");
                    redirect("clients.php", "Erreur lors de la suppression du client !");
                    // exit();
                }
            } else {
                // $_SESSION['message'] = "Erreur lors de la suppression !";
                // header("Location: clients.php");
                redirect("clients.php", "Erreur lors de la suppression !");
                // exit();
            }

            $insert_old_client->close();
            $delete_query->close();
        } else {
            // $_SESSION['message'] = "Client introuvable !";
            // header("Location: clients.php");
            redirect("clients.php", "Client introuvable !");
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
                // $_SESSION['message'] = "Categorie ajoute avec succes !";
                // header("Location: details-visa.php?id=$visa_id");
                redirect("details-visa.php?id=$visa_id", "Categorie ajoute avec succes !");
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
                // $_SESSION['message'] = $error_message;
                // header('Location: visa.php');
                redirect("visa.php",$error_message);
            }
        } else {
            $_SESSION['message'] = "Erreur lors de l'ajout de l'étape : " . $con->error;
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
                    // $_SESSION['message'] = "Etape de procedure ajoute avec succes !";
                    // header("Location: details-visa.php?id=$visa_id");
                    redirect("details-visa.php?id=$visa_id", "Erreur de mise a jour de l'image procedure !");
                    // exit();
                }
            }
            // $_SESSION['message'] = "Etape de procedure modifier avec succes !";
            // header("Location: details-visa.php?id=$visa_id");
            redirect("visa.php", "Etape de procedure mise a jour avec succes !");
        } else {
            // $_SESSION['message'] = "Erreur de mise a jour de l'etape de procedure !";
            // header("Location: details-visa.php?id=$visa_id");
            redirect("details-visa.php?id=$visa_id", "Erreur de mise a jour de l'etape de procedure !" . $update_query->error);
        }
        $update_query->close();
    } 
    
    // Create Update Delete Users Part
    else if(isset($_POST['add_admin_btn'])){
        $nom = $con->real_escape_string($_POST['nom']);
        $email = $con->real_escape_string($_POST['email']);
        $mdp = $_POST['password'];
        $cmdp = $_POST['confirm_password'];

        $check_query = $con->prepare("SELECT * FROM `admin` WHERE email = ?");
        $check_query->bind_param("s", $email);
        $check_query->execute();
        $result = $check_query->get_result();
        
        $check_users = $con->prepare("SELECT * FROM users WHERE email = ?");
        $check_users->bind_param("s", $email);
        $check_users->execute();
        $result = $check_users->get_result();

        if(mysqli_num_rows($result) == 0){
            if ($cmdp == $mdp){
                $hpwd = password_hash($mdp, PASSWORD_DEFAULT);

                $query_admin = $con->prepare("INSERT INTO `admin` (nom, email, `password`) VALUES (?, ?, ?)");
                $query_admin->bind_param("sss", $nom, $email, $hpwd);

                $role = 1;
                $query_user = $con->prepare("INSERT INTO users (nom, email, `password`, `role`) VALUES (?, ?, ?, ?)");
                $query_user->bind_param("sssi", $nom, $email, $hpwd, $role);
                $query_user->execute();

                if($query_admin->execute()){
                    $client_id = $query_admin->insert_id;
                    redirect("admin.php", "Administrateur ajoute avec succes !");
                }
            } else {
                redirect("add-admin.php", "Les mots de passe ne correspondent pas !");
            }

        } else {
            redirect("add-admin.php", "L'email est déjà utilisé par un autre utilisateur.");
        }
    } else if(isset($_POST['update_admin_btn'])){
        $admin_id = intval($_POST['admin_id']);
        $nom = $con->real_escape_string($_POST['nom']);
        $email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);
        $email_id = $con->real_escape_string($_POST['email_id']);

        $hpwd = password_hash($password, PASSWORD_DEFAULT);

        // Préparez la requête pour mettre à jour les informations du client
        $update_query = $con->prepare("UPDATE `admin` SET nom = ?, email = ?, `password` = ? WHERE id = ?");
        $update_query->bind_param("sssi", $nom, $email, $hpwd, $admin_id);

        $query_user = $con->prepare("UPDATE users SET nom = ?, email = ?, `password` = ? WHERE email = ?");
        $query_user->bind_param("ssss", $nom, $email, $hpwd, $email_id);

        // Exécutez les requêtes et vérifiez si la mise à jour a réussi
        $client_update = $update_query->execute();
        $user_update = $query_user->execute();
        if ($client_update && $user_update) {
            $_SESSION['message'] = "Informations d'administrateur mises à jour avec succès !";
            header('Location: admin.php');
        } else {
            $_SESSION['message'] = "Erreur de mise à jour des informations d'administrateur : " . $update_query->error;
            header('Location: edit-admin.php?id=' . $client_id);
        }

        $update_query->close();
        $query_user->close();
    }
    
    else {
        header("Location: index.php");
    }
?>