<?php

    include "../middleware/adminMiddleware.php";
    include "./includes/header.php";

?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header fw-bold align-items-center">
                    Tout les utilisateurs
                    <!-- <a href="./add-clients.php" class="btn btn-primary float-end">Ajouter un utilisateurs</a> -->
                </div>
                <div class="card-body table-full-width table-responsive" id="product_table">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Administrateur</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </thead>
                        <tbody>
                            <?php 
                                $users = getAll("users");

                                if(mysqli_num_rows($users) > 0){
                                    foreach ($users as $item){
                                        ?>
                                            <tr>
                                                <td><?= $item['id'] ?></td>
                                                <td><?= $item['nom'] ?></td>
                                                <td><?= $item['email'] ?></td>
                                                <td>
                                                    <input type="checkbox"  <?= $item['role'] == '1' ? "checked" : "" ?>>
                                                    <?= $item['role'] == '1' ? "Oui" : "Non" ?>
                                                </td>
                                                <td>
                                                    <a href="edit-product.php?id=<?= $item['id'] ?>" class="btn btn-primary">Modifier</a>
                                                    <!-- <form action="code.php" method="POST">
                                                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                        <button class="btn btn-danger" type="submit" name="delete_product_btn">Supprimer</button>
                                                    </form> -->
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST">
                                                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                        <button class="btn btn-danger" type="submit" name="delete_product_btn">Supprimer</button>
                                                    </form>
                                                    <!-- <button type="button" class="btn btn-danger delete_product_btn" value="<?= $item['id'] ?>">Supprimer</button> -->
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