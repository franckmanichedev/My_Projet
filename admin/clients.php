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
                            <th>Etat</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </thead>
                        <tbody>
                            <?php 
                                $clients = getAll("clients");

                                if(mysqli_num_rows($clients) > 0){
                                    foreach ($clients as $item){
                                        $client_id = $item['id'];
                                        $visa_id = $item['visa_client'];

                                        $procedures = getProcedureStatus($client_id, $visa_id);
                                        
                                        // Trouver l'élément ayant la date la plus récente avec etat_procedure = 1
                                        $recent_procedure_index = -1;
                                        $no_step_started = true;
                                        $all_steps_completed = true;
                                        foreach ($procedures as $index => $procedure) {
                                            if ($procedure['etat_procedure'] == 1){
                                                if ($recent_procedure_index == -1 || strtotime($procedure['updated_at']) > strtotime($procedures[$recent_procedure_index]['updated_at'])) {
                                                    $recent_procedure_index = $index;
                                                }
                                            }
                                            if ($procedure['etat_procedure'] != 2){
                                                $all_steps_completed = false;
                                            }
                                            if ($procedure['etat_procedure'] != 0){
                                                $no_step_started = false;
                                            }
                                        }
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
                                                    <?php
                                                        if($recent_procedure_index != -1){
                                                            echo $procedure = $procedures[$recent_procedure_index]['libelle_procedure'];
                                                        } else if($all_steps_completed){
                                                            echo "Procedure terminées !";
                                                        } else if($no_step_started){
                                                            echo "Aucune étape n'a été commencée !";
                                                        }else {
                                                            echo "Aucune étape en cours !";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="edit-clients.php?id=<?= $item['id'] ?>" class="btn btn-primary">Voir plus...</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST">
                                                        <input type="hidden" name="client_id" value="<?= $client_id ?>">
                                                        <!-- <a href="code.php?id=<?= $client_id ?>" name="delete_client_btn" class="btn btn-danger">Supprimer</a> -->
                                                        <button class="btn btn-danger" type="submit" name="delete_client_btn">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                } else {
                                    echo "
                                        <tr class='col-lg-12'>
                                            <td class='alert alert-danger text-white' colspan='5'>Aucun client trouvée</td>
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