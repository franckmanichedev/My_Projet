<?php

    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);

?>

<div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="" class="simple-text">
                ZONE TRAVEL Services
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item <?= $page == "index.php" ? "active":"";?>">
                <a class="nav-link" href="index.php"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                    <i class="bi bi-house-door"></i>
                    <p>Accueil</p>
                </a>
            </li>
            <li class="nav-item <?= $page == "clients.php" ? "active":"";?>">
                <a class="nav-link" href="clients.php">
                    <i class="bi bi-person"></i>
                    <p>Clients</p>
                </a>
            </li>
            <li class="nav-item <?= $page == "visa.php" ? "active":"";?>">
                <a class="nav-link" href="visa.php">
                    <i class="bi bi-credit-card"></i>
                    <p>Visa</p>
                </a>
            </li>
            <?php
                $userId = $_SESSION['auth_user']['user_id'];

                $superAdmin = getAllAdmin("admin");
                
                if(mysqli_num_rows($superAdmin) > 0){
                    while ($access = mysqli_fetch_assoc($superAdmin)){
                        if($access['id'] == $userId){
                            ?>
                                <li class="nav-item <?= $page == "admin.php" ? "active":"";?>">
                                    <a class="nav-link" href="admin.php">
                                        <i class="bi bi-person-badge"></i>
                                        <p>Administrateur</p>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                }
            ?>
            <li class="nav-item <?= $page == "users.php" ? "active":"";?>">
                <a class="nav-link" href="users.php">
                    <i class="bi bi-people"></i>
                    <p>Utilisateurs</p>
                </a>
            </li>
            <li class="nav-item <?= $page == "stat.php" ? "active":"";?>">
                <a class="nav-link" href="stat.php">
                    <i class="bi bi-graph-up"></i>
                    <p>Statistiques</p>
                </a>
            </li>
            <li class="nav-item <?= $page == "../index.php" ? "active":"";?>">
                <a class="nav-link" href="../index.php">
                    <i class="bi bi-globe"></i>
                    <p>Site web</p>
                </a>
            </li>
            <li class="nav-item active active-pro">
                <a class="nav-link active" href="../logout.php">
                    <i class="bi bi-box-arrow-right"></i>
                    <p>Se deconnecter</p>
                </a>
            </li>
        </ul>
    </div>
</div>