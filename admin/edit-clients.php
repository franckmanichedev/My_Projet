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
                        $visa = getClient("clients", $id);

                        if(mysqli_num_rows($visa) > 0){
                            $data = mysqli_fetch_assoc($visa);
                            $libelle_visa = getVisaLibelleById($data['visa_client']);
                            ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Modifier un type de visa
                                            <a href="clients.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="code.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="row col-lg-6">
                                                    <input type="hidden" name="client_id" value="<?= $data['id']?>">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="nom" value="<?= $data['id']?>">
                                                        <label for="">Nom</label>
                                                        <input type="text" name="nom" value="<?= $data['nom']?>" placeholder="Entrer le nouveau nom" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Prenom</label>
                                                    <input type="text" name="prenom" value="<?= $data['prenom']?>" placeholder="Entrer le nouveau prenom" class="form-control" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Age</label>
                                                    <input type="text" name="age" value="<?= $data['age']?>" placeholder="Entrer le nouveau age" class="form-control" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Profession</label>
                                                    <input type="text" name="profession" value="<?= $data['profession']?>" placeholder="Entrer le nouveau profession" class="form-control" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="email_id" value="<?= $data['email']?>">
                                                    <label for="">Email</label>
                                                    <input type="text" name="email" value="<?= $data['email']?>" placeholder="Entrer le nouveau email" class="form-control" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Telephone</label>
                                                    <input type="text" name="telephone" value="<?= $data['telephone']?>" placeholder="Entrer le nouveau telephone" class="form-control" required>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="">Mot de passe</label>
                                                    <input type="password" name="password" value="<?= $data['password']?>" placeholder="Entrer le nouveau password" class="form-control" required>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="" class="">Visa demandé</label>
                                                    <select required id="" onchange="showLevelSelect(this.value)" name="visa_id" class="form-select bordered" required>
                                                        <option selected value="<?= $data['visa_client'] ; ?>"><?= $libelle_visa ; ?></option>
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
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-primary" name="update_client_info_btn">Modifier</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
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