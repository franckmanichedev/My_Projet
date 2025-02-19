<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
    if(isset($_POST['page_add_procedure'])){
        $visa_id = $_POST['visa_id'];

        ?>

            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header fw-bold">
                                Ajouter une nouvelle etape de la procedure
                                <a href="details-visa.php?id=<?= $visa_id; ?>" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="">Libelle</label>
                                            <input type="text" name="libelle_procedure" placeholder="Entrer le libelle de l'etape" class="form-control" required>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="">Description</label>
                                            <textarea rows="5" name="description_procedure" placeholder="Entrer la description de la procedure ici" class="form-control" required></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="">Selectionner un image</label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="hidden" name="visa_id" value="<?= $visa_id; ?>">
                                            <button type="submit" class="btn btn-danger" name="add_procedure_btn">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }
    include("./includes/footer.php"); 
?>