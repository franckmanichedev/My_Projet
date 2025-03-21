<?php
    require 'vendor/autoload.php';

    session_start();

    $client = new Google\Client();
    $client->setClientId('2197040766-mpcaodru4catfpcb3218qukko1tracgc.apps.googleusercontent.com'); // Mon ID client
    $client->setClientSecret('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'); // Mon code secret client
    $client->setRedirectUri('http://myprojetapplication/admin/google-callback.php'); // URI de redirection en local

    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        $oauth2 = new Google\Service\Oauth2($client);
        $userInfo = $oauth2->userinfo->get();

        // Récupérer les informations utilisateur
        $email = $userInfo->email;
        $name = $userInfo->name;

        // Vérifier si l'utilisateur existe déjà dans la base de données
        include("../config/dbconfig.php");
        $check_query = $con->prepare("SELECT * FROM users WHERE email = ?");
        $check_query->bind_param("s", $email);
        $check_query->execute();
        $result = $check_query->get_result();

        if ($result->num_rows > 0) {
            // L'utilisateur existe déjà, connectez-le
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'email' => $email,
                'nom' => $name,
            ];
            header('Location: index.php');
        } else {
            // L'utilisateur n'existe pas, créez un compte

            $role = 0; // Par défaut, utilisateur normal
            $query = $con->prepare("INSERT INTO users (nom, email, `role`) VALUES (?, ?, ?)");
            $query->bind_param("ssi", $name, $email, $role);
            $query->execute();

            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'email' => $email,
                'nom' => $name,
            ];
            header('Location: index.php');
        }
        exit();
    }
?>