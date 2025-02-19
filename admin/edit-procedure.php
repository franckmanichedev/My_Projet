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
                        $procedure = getStapeById("procedure", $id, 'id_procedure');

                        if(mysqli_num_rows($procedure) > 0){
                            $data = mysqli_fetch_assoc($procedure);
                            ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Modifier un type de visa
                                            <a href="details-visa.php?id=<?= $data['id_visa']?>" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="code.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="row col-lg-12">
                                                    <input type="hidden" name="visa_id" value="<?= $data['id_visa']?>">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="libelle_procedure" value="<?= $data['id_procedure']?>">
                                                        <label for="">Libelle</label>
                                                        <input type="text" name="libelle_procedure" value="<?= $data['libelle_procedure']?>" placeholder="Entrer le nouveau libelle" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="">Description</label>
                                                    <textarea rows="5" name="description_procedure" class="form-control" required><?= $data['description_procedure']?></textarea>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="">Modifier image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    <label for="">Image actuelle</label>
                                                    <input type="hidden" name="old_image" value="<?= $data['image']?>">
                                                    <img src="../uploads/<?= $data['image'] ;?>" alt="<?= $data['image'] ;?>" height="50px" width="auto">
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="procedure_id" value="<?= $data['id_procedure']?>">
                                                    <button type="submit" class="btn btn-primary" name="update_procedure_btn">Modifier</button>
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