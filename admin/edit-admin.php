<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                
                <?php
                    if(isset($_GET['id']) && !empty($_GET['id'])){
                        $id = $_GET['id'];

                        $admin = getAllAdmin("admin");

                        if(mysqli_num_rows($admin) > 0){
                            while ($data = mysqli_fetch_assoc($admin)){
                                insertAdmin($data);
                            }
                        } 
                        // Recuperer les données insérer dans le tableau
                            $admin = getAllAdmin("admin");
                        if(mysqli_num_rows($admin) > 0){
                            foreach ($admin as $data){
                                ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Modifier un type de visa
                                                <a href="admin.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="row col-lg-6">
                                                        <input type="hidden" name="admin_id" value="<?= $data['id']?>">
                                                        <input type="hidden" name="email_id" value="<?= $data['email']?>">
                                                        <div class="col-lg-12">
                                                            <label for="">Nom</label>
                                                            <input type="text" name="nom" value="<?= $data['nom']?>" placeholder="Entrer le nouveau nom" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">Email</label>
                                                        <input type="text" name="email" value="<?= $data['email']?>" placeholder="Entrer le nouveau email" class="form-control" required>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label for="">Mot de passe</label>
                                                        <input type="password" name="password" value="<?= $data['password']?>" placeholder="Entrer le nouveau password" class="form-control" required>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary" name="update_admin_btn">Modifier</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php
                            }
                        } else {
                            echo "<p class='alert alert-danger'>Oops, l'id a ete perdu !</p>";
                        }

                    } else {
                        echo "<p class='alert alert-danger'>Hey, l'id a ete perdu !</p>";
                    }
                ?>
            </div>
        </div>
    </div>

<?php include("./includes/footer.php"); ?>