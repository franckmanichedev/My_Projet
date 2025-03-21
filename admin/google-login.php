<?php
    require '../vendor/autoload.php';

    session_start();

    $client = new Google\Client();
    $client->setClientId('2197040766-mpcaodru4catfpcb3218qukko1tracgc.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://myprojetapplication/admin/google-callback.php');
    $client->addScope('email');
    $client->addScope('profile');

    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit();
?>