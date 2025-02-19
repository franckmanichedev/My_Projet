<?php

    session_start();
    include_once("../functions/myfunctions.php");

    if(isset($_SESSION["auth"])){
        if($_SESSION['role'] != 1){
            // redirect("../../index.php", "Vous n'etes pas autorise a avoir acces a cette page");
            $_SESSION['message'] = "Vous n'etes pas autorise a avoir acces a cette page !";
            header('Location: ../index.php');
        }
    }else{
        // redirect("../../login.php", "Connectez-vous pour continuer");
        $_SESSION['message'] = "Connectez-vous pour continuer !";
        header('Location: ../../login.php');
    }

?>