<?php 

    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">

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