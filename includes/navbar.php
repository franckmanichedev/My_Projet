 <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark shadow">
        <div class="container">
            <div class="row w-100 d-flex justify-content-between align-items-center">
                <div class="col-md-8 d-none d-md-flex align-items-center">
                    <a class="text-white me-3" href="mailto:contact@zone-travel.net" target="_blank"><i class="bi bi-envelope-fill"></i>contact@zone-travel.net</a>
                    <a class="text-white" href="https://maps.app.goo.gl/HV9F7c6EDoDikTtHA" target="_blank"><i class="bi bi-geo-alt-fill"></i>Douala-Bonnamoussadi, Face Hopital ADLUCEM</a>
                </div>
                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <a class="text-white social-icon me-2" href=""><i class="bi bi-facebook"></i></a>
                    <a class="text-white social-icon me-2" href=""><i class="bi bi-youtube"></i></a>
                    <a class="text-white social-icon me-2" href=""><i class="bi bi-instagram"></i></a>
                    <a class="text-white social-icon" href=""><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light" style="top: 45px;">
        <div class="container p-2">
            <a class="navbar-brand fw-bold text-black" href="index.php"><img src="../assets/images/logo.png" height="30px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon color-black"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-black active" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="procedure.php">Ma procedure</a>
                    </li>
                    <?php
                        if(isset($_SESSION['auth'])){
                            if(($_SESSION['role'] == 1)){
                    ?>
                                <li class="nav-item">
                                    <a class="nav-link text-black" href="admin/index.php">Dashboard</a>
                                </li>
                                <?php
                            }
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['auth_user']['nom']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-black" href="#">Action</a></li>
                                <li><a class="dropdown-item text-black" href="#">Another action</a></li>
                                <li><a class="dropdown-item text-black" href="../logout.php">Se deconnecter</a></li>
                            </ul>
                        </li>
                    <?php 
                        } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="register.php">S'incrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="login.php">Se connecter</a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>