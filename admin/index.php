<?php

    include "../middleware/adminMiddleware.php";
    include "./includes/header.php";

?>
<div class="content">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card p-3 border-radius-lg text-white mb-4" style="background: rgb(112, 0, 0);">
                    <h3 class="mb-0 h4 font-weight-bolder mb-3 text-info">Bienvenue <?= $_SESSION['auth_user']['nom'] ?> !</h3>
                    <p class="mb-4">
                        Votre page d'accueil est votre guide, elle vous aide dans la gerance de l'avancement des procedures de vos clients
                    </p>
                </div>
            </div>
            <div class="mt-3 mb-3">
                <h5 class="fw-bold">Vos actions</h5>
                <p>Ce que vous pouvez effectuer</p>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <a href="clients.php" class="card">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-center">
                            <div class>
                                <img src="./assets/images/Travelling.png" alt="" class="w-100">
                                <h4 class="text-center">Gestion des clients</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <a href="visa.php" class="card">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-center">
                            <div>
                                <img src="./assets/images/Document.png" alt="" class="w-100">
                                <h4 class="text-center">Gerer les types de visa</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <a href="users.php" class="card">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-center">
                            <div>
                                <img src="./assets/images/Checklist.png" alt="" class="w-100">
                                <h4 class="text-center">Gerer les utilisateurs</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6">
                <a href="admin.php" class="card">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-center">
                            <div>
                                <img src="./assets/images/Manage-admin.png" alt="" class="w-100">
                                <h4 class="text-center">Gerer le personnel</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    </div>
</div>

<!-- Bouton pour générer le PDF -->
<div class="text-center mt-4">
    <a href="generate_pdf.php" class="btn btn-primary">Télécharger le PDF</a>
</div>

<?php 
    include "./includes/footer.php"; 
?>
<style>
    .row .col-xl-3:hover{
        transform: translateY(-5px);
        opacity: 0.8;
    }
</style>