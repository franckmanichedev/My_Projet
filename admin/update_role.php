<?php

    session_start();
    include("../config/dbconfig.php");
    include("../functions/myfunctions.php");

    if(isset($_POST['toggle_state'])){
        $toggle_state = $_POST['toggle_state'];
        $user_role = $_SESSION['role'];
        
        if($toggle_state == 1 && $user_role == 0){
            $_SESSION['role'] = 1;
        } else if($toggle_state == 0 && $user_role == 1){
            $_SESSION['role'] = 0;
        }
    }

?>