<?php

    include "../middleware/adminMiddleware.php";
    include "./includes/header.php";

?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
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
                    Tout les clients voyageurs
                    <a href="add-clients.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Ajouter un client</a>
                </div>
                <div class="card-body table-full-width table-responsive" id="product_table">
                    <table class="table table-hover cursor-pointer table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Voyageur</th>
                            <th>Info</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </thead>
                        <tbody>
                            <?php 
                                $clients = getAll("clients");

                                if(mysqli_num_rows($clients) > 0){
                                    foreach ($clients as $item){
                                        ?>
                                            <tr onclick="redirection('details-clients.php?id=<?= $item['id'] ?>')">
                                                <td><?= $item['id'] ?></td>
                                                <td>
                                                    <div class="font-weight-bold"><?= $item['nom'] ?></div>
                                                    <div><?= $item['email'] ?></div>
                                                </td>
                                                <td>
                                                    <div><?= $item['telephone'] ?></div>
                                                    <div><?= $item['email'] ?></div>
                                                </td>
                                                <td>
                                                    <a href="edit-clients.php?id=<?= $item['id'] ?>" class="btn btn-primary">Voir plus...</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST">
                                                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                        <button class="btn btn-danger" type="submit" name="delete_product_btn">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                } else {
                                    echo "
                                        <tr class='col-lg-12'>
                                            <td class='alert alert-danger' colspan='5'>Aucune catégorie trouvée</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "./includes/footer.php"; ?>

<script>
    function redirection(url){
        window.location.href = url;
    }
</script>