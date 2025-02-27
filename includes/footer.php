
    <div class="row col-md-12 w-100 p-5 bg-dark text-white">
        <div class="col-md-3">
            <h4><img src="../assets/images/logo.png" height="30px" alt="" class="mb-3"></h4>
            <p class="mt-3 mb-3">
                Decouvrez nos services
                d'accompagnement visa pour
                faciliter vos demarches
                adminisatratives et voyages
            </p>
            <div class="row mt-4 d-flex align-items-center">
                <a class="col-me-3 text-white social-icon me-2" href=""><i class="bi bi-facebook"></i></a>
                <a class="col-me-3 text-white social-icon me-2" href=""><i class="bi bi-youtube"></i></a>
                <a class="col-me-3 text-white social-icon me-2" href=""><i class="bi bi-instagram"></i></a>
                <a class="col-me-3 text-white social-icon" href=""><i class="bi bi-tiktok"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <h4 class="mb-3 fw-bold">Type de visa</h4>
            <p class="mt-4 mb-3">
                <ul>
                    <li class="mb-3">Visa formation</li>
                    <li class="mb-3">Visa étude</li>
                    <li class="mb-3">Visa travailleur qualifié</li>
                    <li class="">Visa tourisme</li>
                </ul>
            </p>
        </div>
        <div class="col-md-3">
            <h4 class="mb-3 fw-bold">Destinations</h4>
            <p class="mt-4 mb-3">
                <ul>
                    <li class="mb-3">Allemagne</li>
                    <li class="mb-3">Canada</li>
                    <li class="">Russie</li>
                </ul>
            </p>
        </div>
        <div class="col-md-3">
            <h4 class="mb-3 fw-bold">Contact</h4>
            <p class="mb-2"  style="line-height: 30px;">
                Cameroun <br>
                Adresse <br>
                Douala-Bonnamoussadi, Face Hopital ADLUCEM <br>
                RC/DLA/2023/B/6669 <br>
                <hr class="fw-bold">
                Email : <a class="text-white me-3" href="mailto:contact@zone-travel.net">
                            contact@zone-travel.net
                        </a>
                <hr class="fw-bold">
                Tel : <a href="tel:+237676770662" class="text-white"> +237 676 77 06 62</a> <br>
            </p>
            <p class="mt-4" style="line-height: 30px;">
                Allemagne 
                Adresse : <br>
                Warschauar Strabe 36-38 <br>
                3 Etage Treppenhous C <br>
                10243 Berlin <br>
                Tel : <a href="tel:+493098587057" class="text-white"> +49 30 9858 7057</a> <br>
            </p>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.3.7.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/owl.carousel.js"></script>

    <!-- ALERTIFY JS -->
    <script src="assets/js/alertify.min.js"></script>

    <!-- CUSTOM FILES -->
    <script src="assets/js/custom.js" type="text/javascript"></script>
    <script src="assets/js/script.js" type="text/javascript"></script>
    <script src="assets/js/cdb.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- STEPPER JS FILES -->
    <script src="assets/js/cdb.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stepperElement = document.querySelector("#stepper");
            const stepper = new CDB.Stepper(stepperElement);
        });
    </script>

    <!-- ALERTIFY -->
    <script>
        <?php 
            if(isset($_SESSION['message'])){
                ?>
                    alertify.set('notifier','position', 'top-right');
                    alertify.success('<?= addslashes($_SESSION['message']); ?>');
                <?php
                unset($_SESSION['message']);
            }
        ?>
    </script>
</body>
</html>