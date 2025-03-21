<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
    if(isset($_GET['id'])){
        $client_id = $_GET['id'];

        $orderData = getClient('clients', $client_id);
        if(mysqli_num_rows($orderData) <= 0){
            ?>
                <h4>Quelque chose c'est encore mal passe !</h4>
            <?php 
            die();
        }
    } else {
            ?>
                <h4>Quelque chose c'est mal passe !</h4> 
            <?php
            die();
    }
    $item = mysqli_fetch_assoc($orderData);
    $libelle_visa = getVisaLibelleById($item['visa_client']);
        ?>

            <div class="container">
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <?php 
                            if(isset($_SESSION['message'])){
                                ?>
                                    <div class="alert alert-warning" role="alert">
                                        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                                    </div>
                                <?php
                                unset($_SESSION['message']);
                            } 
                        ?>
                        <div id="alert-container"></div>
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    Information sur l'etat de  <?= $item['nom'] ." ". $item['prenom']; ?>
                                    <a href="clients.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                                </div>
                                <div class="col-md-12">
                                    <h4>Details voyageur</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="fw-bold mb-2">Nom & Prenom</label>
                                            <div class="border p-1 text-uppercase">
                                                <?= $item['nom'] . " " . $item['prenom']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fw-bold mb-2">Categorie</label>
                                            <div class="border p-1 text-uppercase">
                                                <?= $libelle_visa ; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fw-bold mb-2">Telephone</label>
                                            <div class="border p-1 text-uppercase">
                                                <?= $item['telephone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="fw-bold mb-2">Profession</label>
                                            <div class="border p-1 text-uppercase">
                                                <?= $item['profession']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mt-2 d-flex justify-content-between align-items-center">
                                            <h4 class="col-md-6">Procedure visa</h4>
                                            <button id="saveChanges" name="save_state_client" type="submit" class="btn btn-success col-md-2 float-end">Enregistrer</button>
                                        </div>
                                        <form action="details-clients.php?id=<?= $client_id ?>" method="POST">
                                            <div class="row">
                                                <?php
                                                    $visa_id = $item['visa_client'];
                                                    $procedure = getAllStapesByVisaId($client_id, $visa_id);

                                                    if(mysqli_num_rows($procedure) > 0){
                                                        ?>
                                                            <!-- <div class="row"> -->
                                                                <div class="col-md-4">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h6>A venir</h6>
                                                                        </div>
                                                                        <div class="card-body" id="upcoming">
                                                                            <?php
                                                                                foreach($procedure as $items){
                                                                                    if($items['etat_procedure'] == 0){
                                                                                        ?>
                                                                                            <div class="row" rows="5" data-id="<?= $items['id_procedure'] ?>">
                                                                                                <a href="edit-client-procedure.php?id=<?= $items['id_procedure'] ?>" class="col-md-12 cursor-move border p-1 mb-1 text-black d-flex align-items-center justify-content-between">
                                                                                                    <input type="hidden" name="visa_id" value="<?= $item['visa_client'] ?>">
                                                                                                    <?= $items['libelle_procedure'] ?>
                                                                                                    <img src="../uploads/<?= $items['image'] ?>" alt="<?= $items['libelle_procedure'] ?>" width="25px" height="25px">
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h6>En cours...</h6>
                                                                        </div>
                                                                        <div class="card-body" id="in-progress">
                                                                            <?php
                                                                                foreach($procedure as $items){
                                                                                    if($items['etat_procedure'] == 1){
                                                                                        ?>
                                                                                            <div class="row" rows="5" data-id="<?= $items['id_procedure'] ?>">
                                                                                                <a href="edit-client-procedure.php?id=<?= $items['id_procedure'] ?>" class="col-md-12 cursor-move border p-1 mb-1 text-black d-flex align-items-center justify-content-between">
                                                                                                    <input type="hidden" name="visa_id" value="<?= $item['visa_client'] ?>">
                                                                                                    <?= $items['libelle_procedure'] ?>
                                                                                                    <img src="../uploads/<?= $items['image'] ?>" alt="<?= $items['libelle_procedure'] ?>" width="25px" height="25px">
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h6>Cloturée</h6>
                                                                        </div>
                                                                        <div class="card-body" id="completed">
                                                                            <?php
                                                                                foreach($procedure as $items){
                                                                                    if($items['etat_procedure'] == 2){
                                                                                        ?>
                                                                                            <div class="row" rows="5" data-id="<?= $items['id_procedure'] ?>">
                                                                                                <a href="edit-client-procedure.php?id=<?= $items['id_procedure'] ?>" class="col-md-12 cursor-move border p-1 mb-1 text-black d-flex align-items-center justify-content-between">
                                                                                                    <input type="hidden" name="visa_id" value="<?= $item['visa_client'] ?>">
                                                                                                    <?= $items['libelle_procedure'] ?>
                                                                                                    <img src="../uploads/<?= $items['image'] ?>" alt="<?= $items['libelle_procedure'] ?>" width="25px" height="25px">
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!-- </div> -->
                                                        <?php
                                                    } else {
                                                        echo "<tr><td class='alert alert-danger' colspan='5'>Aucun etape de procedure pour l'instant !</td></tr>";
                                                    }
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    include("./includes/footer.php"); 
?>

<script src="./assets/js/sortable.min.js"></script>
<script>
    const upcomingList = document.getElementById('upcoming');
    const inProgressList = document.getElementById('in-progress');
    const completedList = document.getElementById('completed');
    const saveButton = document.getElementById('saveChanges');
    const alertContainer = document.getElementById('alert-container');

    const sortableOptions = {
        group: 'shared',
        animation: 150
    };

    new Sortable(upcomingList, sortableOptions);
    new Sortable(inProgressList, sortableOptions);
    new Sortable(completedList, sortableOptions);

    function showAlert(message, type = 'success') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.role = 'alert';
        alertDiv.innerHTML = `
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}
        `;
        alertContainer.appendChild(alertDiv);
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }

    saveButton.addEventListener('click', function(event) {
        event.preventDefault();

        const order = [];
        const lists = [upcomingList, inProgressList, completedList];
        lists.forEach(list => {
            list.querySelectorAll('.row').forEach((row, index) => {
                order.push({
                    id: row.getAttribute('data-id'),
                    position: index + 1,
                    status: list.id // "upcoming", "in-progress" ou "completed"
                });
            });
        });

        // Mise à jour de l'état (tous les éléments sont traités)
        const procedureState = order.map(item => ({
            id_procedure: item.id,
            etat: item.status === 'upcoming' ? 0 : item.status === 'in-progress' ? 1 : 2
        }));

        fetch('update-procedure-state.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id_client: <?= $client_id ?>,
                visa_id: <?= $item['visa_client']?>,
                etat_procedure: procedureState
            })
        })
        .then(response => {
            if(!response.ok) {
                return response.text().then(text => {
                    throw new Error(text);
                });
            }
            return response.json();
        })
        .then(data => {
            if(data.success) {
                showAlert('Etat de procedure mis à jour', 'success');
            } else {
                showAlert('Echec de mise à jour de l\'etat', 'danger');
            }
        }).catch(error => showAlert(error.message, 'danger'));
    });
</script>