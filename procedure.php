<?php 
    session_start();
    include "functions/usersfunctions.php";
    include "includes/header.php";

    if (isset($_SESSION['auth'])){
        // Récupérer l'email de l'utilisateur authentifié
        $user_email = $_SESSION['auth_user']['email'];
        $client = getClient('clients', $user_email);

        if ($client->num_rows != 0) {
            $client_data = $client->fetch_assoc();
            $client_id = $client_data['id'];
            $visa_id = $client_data['visa_client'];

            $procedures = getProcedureStatus($client_id, $visa_id);

            // Debugging: Vérifier que les données sont bien récupérées
            // echo "<pre>";
            // print_r($procedures);
            // echo "</pre>";

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

                <div class="py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    if(isset($_SESSION['auth'])){
                                        if(($_SESSION['role'] == 1)){
                                            ?>
                                                <div class="col-md-12 py-5">
                                                    <em class="bg-danger form-control p-2 text-white">Vous n'etes pas autorise pour cette fonctionnalite !</em>
                                                </div>
                                            <?php
                                        } else {
                                            if($all_steps_completed){
                                                ?>
                                                    <div class="col-md-12 py-5 text-center">
                                                        <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                                                        <p class="fs-4 fw-bold">Félicitations ! Votre procédure est terminée.</p>
                                                    </div>
                                                <?php
                                            } elseif($no_step_started){
                                                ?>
                                                    <div class="col-md-12 py-5 text-center">
                                                        <i class="bi bi-hourglass-split text-muted  icon-rotate" style="font-size: 3rem;"></i>
                                                        <p class="fs-4 fw-bold">Votre procédure sera lancée d'ici peu.</p>
                                                    </div>
                                                <?php
                                            } else {
                                                ?>
                                                    <div class="stepper" id="stepper">
                                                        <div class="steps-container">
                                                            <div class="steps">
                                                                <?php foreach ($procedures as $index => $procedure): ?>
                                                                    <div class="band"></div>
                                                                    <div class="step <?= $index == $recent_procedure_index ? 'active' : '' ?>" id="step-<?= $index + 1 ?>">
                                                                        <div class="step-title">
                                                                            <span class="step-number <?= $procedure['etat_procedure'] == 2 ? 'text-success' : ($procedure['etat_procedure'] == 1 ? 'text-warning' : 'text-muted') ?> <?= $index == $recent_procedure_index ? 'recent-step' : '' ?>" onclick="showContent(<?= $index + 1 ?>)">
                                                                                <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
                                                                            </span>
                                                                            <!-- <div class="step-text"><?= htmlspecialchars($procedure['libelle_procedure']) ?></div> -->
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                        <div class="stepper-content-container">
                                                            <?php foreach ($procedures as $index => $procedure): ?>
                                                                <div class="stepper-content <?= $index == $recent_procedure_index ? 'active' : '' ?>" id="content-<?= $index + 1 ?>">
                                                                    <div class="content d-flex flex-column">
                                                                        <div class="col-md-12">
                                                                            <label class="fs-5">Statut</label>
                                                                            <p class="float-end fs-5 fw-bold">
                                                                                <?php 
                                                                                    if ($procedure['etat_procedure'] == 0) {
                                                                                        echo '<i class="bi bi-hourglass-split text-muted fw-bold"> A venir</i>';
                                                                                    } elseif ($procedure['etat_procedure'] == 1) {
                                                                                        echo '<i class="bi bi-hourglass-bottom text-warning fw-bold"> En cours</i>';
                                                                                    } elseif ($procedure['etat_procedure'] == 2) {
                                                                                        echo '<i class="bi bi-check-circle text-success fw-bold"> Cloturee</i>';
                                                                                    }
                                                                                ?>
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-center fs-4 fw-bold"><?= htmlspecialchars_decode($procedure['libelle_procedure']) ?></p>
                                                                        <img src="uploads/<?= htmlspecialchars_decode($procedure['image']) ?>" alt="Procedure Image" class="img-fluid image-animate" />
                                                                        <div>
                                                                            <?php if ($index > 0): ?>
                                                                                <button class="btn btn-dark mt-2" onclick="navigateStepper(<?= $index ?>)">Précédent</button>
                                                                            <?php endif; ?>
                                                                            <?php if ($index < count($procedures) - 1): ?>
                                                                                <button class="btn btn-dark mt-2 float-end" onclick="navigateStepper(<?= $index + 2 ?>)">Suivant</button>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inclusions des fichiers CSS nécessaires -->
                <link rel="stylesheet" href="assets/css/stepper.css">

                <!-- Inclusions des fichiers JavaScript nécessaires -->
                <script src="assets/js/stepper.js"></script>
                <script>
                    function showContent(step) {
                        document.querySelectorAll('.stepper-content').forEach(content => {
                            content.style.display = 'none';
                            content.classList.remove('active');
                        });
                        document.querySelectorAll('.step').forEach(stepElem => {
                            stepElem.classList.remove('active');
                        });
                        document.getElementById('content-' + step).style.display = 'block';
                        document.getElementById('content-' + step).classList.add('active');
                        document.getElementById('step-' + step).classList.add('active');
                    }

                    function navigateStepper(step) {
                        showContent(step);
                    }

                    // Afficher le contenu de l'étape la plus récente au chargement de la page
                    document.addEventListener('DOMContentLoaded', function() {
                        showContent(<?= $recent_procedure_index + 1 ?>);
                    });

                    // Déconnexion automatique après 30 minutes d'inactivité
                    let timeout;
                    function resetTimeout() {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => {
                            window.location.href = 'logout.php';
                        }, 18000); // 30 minutes (180000)
                    }

                    document.addEventListener('mousemove', resetTimeout);
                    document.addEventListener('keypress', resetTimeout);
                    resetTimeout(); // Initialiser le timeout au chargement de la page
                </script>

            <?php
        } else {
            ?>
                <div class="col-md-12 py-5 text-center">
                    <i class="bi bi-x text-danger" style="font-size: 5rem;"></i>
                    <p class="fs-4 fw-bold">Aucun client trouvé avec cet email !</p>
                </div>
            <?php
            echo "Aucun client trouvé avec cet email.";
        }
    } else {
        ?>
            <div class="py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 py-5 text-center">
                            <!-- <i class="bi bi-x text-danger" style="font-size: 5rem;"></i> -->
                            <em class="fs-4 fw-bold bg-warning form-control p-2 text-dark">Veuillez vous connecter pour continuer !</em>
                        </div>
                        <div class="col-md-12 py-5 text-center">
                            <a href="login.php" class="btn btn-dark">Se connecter</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    include("includes/footer.php") 
?>