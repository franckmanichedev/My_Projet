<?php

    session_start();
    include_once("myfunctions.php");

    if(isset($_POST["register_btn"])){
        $name = $con->real_escape_string($_POST['nom']);
        $email = $con->real_escape_string($_POST['email']);
        $mdp = $con->real_escape_string($_POST['mdp']);
        $confirm_mdp = $con->real_escape_string($_POST['c_mdp']);

        if($mdp == $confirm_mdp){

            // Verifier si l'utilisateur existe deja dans la base de donnee
            $check_query = "SELECT * FROM users WHERE email = ?";
            $stmt = $con->prepare($check_query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $result_query = $result->num_rows;
            $stmt->close();

            // Si l'email est déjà utilisé, affiche un message d'erreur
            if ($result_query > 0) {
                redirect("../register.php", "L'email est déjà utilisé par un autre utilisateur !");
                // $_SESSION['message'] = "L'email est déjà utilisé par un autre utilisateur.";
                // header('Location: ../register.php');
                exit();
            } else {
                // Preparer la requete pour inserer un nouvel utilisateur
                $query = "INSERT INTO users (nom, email, `password`) VALUES (?, ?, ?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param("sss", $name, $email, $mdp);
            
                // Vérifie si l'insertion dans la base de données a réussi
                if ($stmt->execute()) {
                    // Si l'insertion réussit, affiche un message de succès
                    // echo "Les coordonnée de l'utilisateurs ont été ajouté avec succès.";
                    // header('Location: ../register.php');
                    // exit();
                    redirect("../register.php", "Les coordonnée de l'utilisateurs ont été ajouté avec succès.");
                } else {
                    // Si l'insertion échoue, affiche un message d'erreur avec le détail de l'erreur
                    // echo "Erreur d'ajout du client : " . $conn->error;
                    // header('Location: ../register.php');
                    // exit();
                    redirect("../register.php", "Erreur d'ajout du compte");
                }
            }
        } else {
            $_SESSION['message'] = "Les mots de passe ne correspondent pas !";
            header("Location: ../register.php");
            exit();
        }
    } else if(isset($_POST["login_btn"])){
        $email = $con->real_escape_string($_POST['email']);
        $mdp = $_POST['mdp'];

        // On verifie si l'utilisateur existe dans la base de donnee
        $check_query = "SELECT * FROM users WHERE email = ?";
        $stmt = $con->prepare($check_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result_query = $result->num_rows;

        if ($result_query > 0) {
            $row = $result->fetch_assoc();

            // Execution si le le resultat est supperieur a zero
            if(password_verify($mdp, $row['password'])){
                $_SESSION['auth'] = true;
    
                $userid = $row['id'];
                $username = $row['nom'];
                $useremail = $row['email'];
                $role = $row['role'];
    
                $_SESSION['auth_user'] = [
                    'user_id' => $userid,
                    'nom' => $username,
                    'email' => $useremail,
                ];
    
                $_SESSION['role'] = $role;
    
                // On verifie si l'utilisateur a les droit d'administrateur
                if($role == 1){
                    redirect("../admin/index.php", "Bienvenue dans votre dashboard");
                } else {
                    redirect("../index.php", "Connexion a votre compte reussi");
                }

            } else {
                redirect("../login.php", "Mot de passe incorrect");
            }
            
        } else {
            // Sinon on retourne que cet utilisateur n'existe pas
            redirect("../login.php", "L'email n'existe pas !");
        }
    }

?>