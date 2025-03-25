<?php

    include "../middleware/adminMiddleware.php";
    include "./includes/header.php";

?>
<style>
    .slow-speed-toggle {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
        background-color: #ccc;
        border-radius: 10px;
        cursor: pointer;
    }
    
    .toggle-icon {
        position: absolute;
        top: 50%;
        left: 30%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        background-color: #fff;
        border-radius: 50%;
        transition: left 0.3s ease-in-out;
    }
    
    .slow-speed-toggle.active .toggle-icon {
        left: 70%;
    }
    
    .slow-speed-toggle.active {
        background-color: #aaa;
    }
</style>
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
                                                    <?php
                                                        $role = $item['role'];
                                                        $user_id = $item['id'];
                                                        if($role == 1){
                                                    ?>
                                                        <span class="slow-speed-toggle active" data-id="<?= $user_id ?>" data-state="1">
                                                            <span class="toggle-icon"></span>
                                                        </span>
                                                    <?php
                                                        } else {
                                                            ?>
                                                                <span class="slow-speed-toggle" data-id="<?= $user_id ?>" data-state="0">
                                                                    <span class="toggle-icon"></span>
                                                                </span>
                                                            <?php
                                                        }
                                                    ?>
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
                                            <td class='alert alert-danger' colspan='5'>Aucune utilisateurs trouvée</td>
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
    $(document).on('click', '.slow-speed-toggle', function(){
        const toogle = $(this);
        const userId = toogle.data('id');
        const currentState = toogle.data('active');
        const newState = currentState === 1 ? 0 : 1;
        // toogle.data('active', newState);
        $.ajax({
            url: 'update_role.php',
            type: 'POST',
            data: {
                toggle_state: newState,
                user_id: userId
            },
            success: function(response){
                console.log(response);
                // Mettre a jour l'interface utilisateur
                if(newState === 1){
                    toogle.addClass('active').data('state', 1);
                } else {
                    toogle.removeClass('active').data('state', 0);
                }
                alert("Role mis a jour avec succes");
            },
            error: function(error){
                console.log(error);
                alert("Erreur lors de la mise a jour du role");
            }
        });
    });
</script>