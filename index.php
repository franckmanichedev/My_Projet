<?php 
    session_start();
    include("includes/header.php");
?>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 justify-content-center">
                    <div class="col-md-6">
                        <?php 
                            if(isset($_SESSION['message'])){
                                    ?>
                                        <div class="alert alert-warning" role="alert">
                                            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Erreur!</strong> <?= $_SESSION['message']; ?>
                                        </div>
                                    <?php
                                unset($_SESSION['message']);
                            } 
                        ?>
                    </div>
                    <h4>Hello world <i class="bi bi-person"></i> </h4>
                    <button class="btn btn-success">Click</button>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>