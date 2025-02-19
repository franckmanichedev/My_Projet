<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
    if(isset($_GET['id'])){
        $visa_id = $_GET['id'];
        $orderData = getVisaById('visa', $visa_id);
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
                                Details sur <?= $item['libelle_visa'] ?>
                                <a href="visa.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Details visa</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="fw-bold mb-2">Libelle visa</label>
                                                <div class="border p-1">
                                                    <?= $item['libelle_visa']; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="fw-bold mb-2">Description visa</label>
                                                <div class="border p-1">
                                                    <?= $item['description_visa']; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Icone</label>
                                                <div class="border p-1">
                                                    <img src="../uploads/<?= $item['image'] ?>" alt="<?= $item['libelle_visa'] ?>" width="50px" height="50px">
                                                    <?= $item['libelle_visa'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h4>Procedure visa</h4>
                                        <hr>
                                        <form action="add-procedure.php?id=<?= $item['id_visa'] ?>" method="POST">
                                            <div class="row" id="procedure-list">
                                                <?php
                                                    $procedure = getById($visa_id);

                                                    if(mysqli_num_rows($procedure) > 0){
                                                        foreach($procedure as $items){
                                                            ?>
                                                                <div class="row" data-id="<?= $items['id_procedure'] ?>">
                                                                    <a href="edit-procedure.php?id=<?= $items['id_procedure'] ?>" class="col-md-12 border p-1 mb-2 text-black d-flex align-items-center justify-content-between">
                                                                        <input type="hidden" name="visa_id" value="<?= $item['id_visa'] ?>">
                                                                        <?= $items['libelle_procedure'] ?>
                                                                        <img src="../uploads/<?= $items['image'] ?>" alt="<?= $items['libelle_procedure'] ?>" width="75px" height="75px">
                                                                    </a>
                                                                </div>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td class='alert alert-danger' colspan='5'>Aucun etape de procedure pour l'instant !</td></tr>";
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="hidden" name="visa_id" value="<?= $item['id_visa'] ?>">
                                                <!-- <a href="add-procedure.php?id=" class="btn btn-danger float-end" name="page_add_procedure">Ajouter une etape de procedure</a> -->
                                                <button type="submit" class="btn btn-danger float-end" name="page_add_procedure">Ajouter une etape de procedure</button>
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