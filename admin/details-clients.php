<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
    if(isset($_GET['id'])){
        $client_id = $_GET['id'];

        $orderData = getClient('clients',$client_id);
        if(mysqli_num_rows($orderData) <= 0){
            ?>
                <h4>Quelque chose c'est tres mal passe !</h4>
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
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    Information sur l'etat de  <?= $item['nom'] ." ". $item['prenom']; ?>
                                    <a href="clients.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                                </div>
                                <div class="col-md-12">
                                    <h4>Details visa</h4>
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
                                                <?= $item['visa_client']; ?>
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
                                        <h4>Procedure visa</h4>
                                        <hr>
                                        <form action="edit-client-procedure.php?id=<?= $item['visa_client'] ?>" method="POST">
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
                                                                            <div>
                                                                                <?php
                                                                                    foreach($procedure as $items){
                                                                                        if($items['etat_procedure'] == 0){
                                                                                            ?>
                                                                                                <div class="card-body" id="procedure-list" id="upcoming">
                                                                                                    <div class="row" rows="5" data-id="<?= $items['id_procedure'] ?>">
                                                                                                        <a href="edit-client-procedure.php?id=<?= $items['id_procedure'] ?>" class="col-md-12 cursor-move border p-1 mb-1 text-black d-flex align-items-center justify-content-between">
                                                                                                            <input type="hidden" name="visa_id" value="<?= $item['visa_client'] ?>">
                                                                                                            <?= $items['libelle_procedure'] ?>
                                                                                                            <img src="../uploads/<?= $items['image'] ?>" alt="<?= $items['libelle_procedure'] ?>" width="25px" height="25px">
                                                                                                        </a>
                                                                                                    </div>
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
                                                                                <!-- Les étapes "En cours" seront ajoutées ici -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h6>Cloturée</h6>
                                                                            </div>
                                                                            <div class="card-body" id="completed">
                                                                                <!-- Les étapes "Cloturée" seront ajoutées ici -->
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
    const procedureList = document.getElementById('procedure-list');
    const sortable = new Sortable(procedureList, {
        animation: 150,
        onEnd: function (evt) {
            const order = [];
            procedureList.querySelectorAll('.row').forEach((row, index) => {
                order.push({
                    id: row.getAttribute('data-id'),
                    position: index + 1
                });
            });

            fetch('update-procedure-order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(order)
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      console.log('Etape de procedure reordonnee');
                  } else {
                      console.error('Echec de chargement de l\'etape');
                  }
              });
        }
    });
</script>