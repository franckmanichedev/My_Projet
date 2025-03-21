<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
?>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <?php 
                        if(isset($_SESSION['message'])){
                            ?>
                                <div class="alert alert-warning" role="alert">
                                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Oops!</strong> <?= $_SESSION['message']; ?>
                                </div>
                            <?php
                            unset($_SESSION['message']);
                        } 
                    ?>
                    <div class="card-header">
                        Ajouter un nouveau clients
                        <a href="clients.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Nom</label>
                                    <input type="text" name="nom" placeholder="Entrer le nom" class="form-control" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Email</label>
                                    <input type="email" name="email" placeholder="Entrer l'email" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Mot de passe</label>
                                    <input type="password" name="password"  placeholder="Entrer le nouveau password" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Confirmer le mot de passe</label>
                                    <input type="password" name="confirm_password"  placeholder="Confirmer le nouveau password" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary" name="add_admin_btn">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("./includes/footer.php"); ?>