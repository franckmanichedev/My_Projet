<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Ajouter un nouveau type de visa
                        <a href="visa.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Libelle</label>
                                    <input type="text" name="libelle_visa" placeholder="Entrer le nom" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Description</label>
                                    <textarea rows="5" name="description_visa" placeholder="Entrer la description de categorie ici" class="form-control" required></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Selectionner un image</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-danger" name="add_visa_btn">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("./includes/footer.php"); ?>