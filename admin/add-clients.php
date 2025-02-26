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
                                <div class="col-lg-12">
                                    <label for="" class="">Visa demandé</label>
                                    <select required id="" onchange="showLevelSelect(this.value)" name="visa_id" class="form-select bordered" required>
                                        <option selected disabled>Selectionnez type visa</option>
                                        <?php
                                            $visa = getAll("visa");

                                            if(mysqli_num_rows($visa) > 0){
                                                foreach ($visa as $item){
                                                    ?>
                                                        <option  value="<?= $item['id_visa'] ; ?>"><?= $item['libelle_visa'] ; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                echo"<option>Aucune visa trouve !</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Nom</label>
                                    <input type="text" name="nom" placeholder="Entrer le nom" class="form-control" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Prenom</label>
                                    <input type="text" name="prenom" placeholder="Entrer le prenom" class="form-control" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Age</label>
                                    <input type="number" name="age" placeholder="Entrer l'age" class="form-control" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Profession</label>
                                    <input type="text" name="profession" placeholder="Entrer l'age" class="form-control" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Telephone</label>
                                    <input type="text" name="phone" placeholder="Entrer le numero de telephone" class="form-control" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Email</label>
                                    <input type="email" name="email" placeholder="Entrer l'email" class="form-control" required>
                                </div>
                                <div class="col-md-12" id="levelSelect" style="display: none;">
                                    <label for="">Niveau langue</label>
                                    <select name="niveau" class="form-select bordered" required>
                                        <option selected disabled>Selectionnez le niveau</option>
                                        <option value="a1">Niveau debutant (A1)</option>
                                        <option value="a2">Niveau intermediaire (A2)</option>
                                        <option value="b1">Niveau classique (B1)</option>
                                        <option value="b2">Niveau avance (B1)</option>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary" name="add_client_btn">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("./includes/footer.php"); ?>