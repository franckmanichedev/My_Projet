<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card strpied-tabled-with-hover">
                    <?php 
                        if(isset($_SESSION['message'])){
                            ?>
                                <div class="alert alert-success" role="alert">
                                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                                </div>
                            <?php
                            unset($_SESSION['message']);
                        } 
                    ?>
                    <div class="card-header fw-bold align-items-center">
                        Tout les types de visa
                        <a href="add-visa.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Ajouter un type visa</a>
                    </div>
                    <div class="card-body table-full-width table-responsive" id="category_table">
                        <table class="table table-hover cursor-pointer table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Libelles</th>
                                <th>Icones</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $category = getAll("visa");

                                    if(mysqli_num_rows($category) > 0){
                                        foreach ($category as $item){
                                            ?>
                                                <tr onclick="redirection('details-visa.php?id=<?= $item['id_visa'] ?>')">
                                                    <td><?= $item['id_visa'] ?></td>
                                                    <td><?= $item['libelle_visa'] ?></td>
                                                    <td>
                                                        <img src="../uploads/<?= $item['image'] ?>" alt="<?= $item['image'] ?>" height="50px" width="auto">
                                                    </td>
                                                    <td>
                                                        <a href="edit-visa.php?id=<?= $item['id_visa'] ?>" class="btn btn-primary">Modifier</a>
                                                    </td>
                                                    <td>
                                                        <form action="code.php" method="POST">
                                                            <input type="hidden" name="visa_id" value="<?= $item['id_visa'] ?>" />
                                                            <button class="btn btn-danger" type="submit" name="delete_visa_btn">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td class='alert alert-danger' colspan='5'>Aucune catégorie trouvée</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("./includes/footer.php"); ?>

<script>
    function redirection(url){
        window.location.href = url;
    }
</script>