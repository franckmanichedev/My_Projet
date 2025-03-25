<?php 
    session_start();
    include("includes/header.php");
    include "includes/slider.php"; 
?>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 mb-5">
                        <p class="text-uppercase text-center">Destinations que vous pouvez visiter</p>
                        <h3 class="text-center titre mb-4">Les destinations que nous soutenons pour l'<span style="color: red;"><br>immigration</span></h3>
                        <div class="row">
                            <div class="col-md-4 mt-3 container-image position-relative">
                                <div class="noire w-100 h-100 position-absolute"></div>
                                <img src="./assets/images/bg-banner-4.jpg" alt="" class="w-100 rounded-20" height="200px">
                                <p class="pays justify-content-center align-items-center w-100 h-100 position-absolute m-0" style="position: absolute;">Allemagne</p>
                            </div>
                            <div class="col-md-4 mt-3 container-image position-relative">
                                <div class="noire w-100 h-100 position-absolute"></div>
                                <img src="./assets/images/bg-banner-3.jpg" alt="" class="w-100 rounded-20" height="200px">
                                <p class="pays justify-content-center align-items-center w-100 h-100 position-absolute m-0" style="position: absolute;">Canada</p>
                            </div>
                            <div class="col-md-4 mt-3 container-image position-relative">
                                <div class="noire w-100 h-100 position-absolute"></div>
                                <img src="./assets/images/bg-banner-1.jpg" alt="" class="w-100 rounded-20" height="200px">
                                <p class="pays justify-content-center align-items-center w-100 h-100 position-absolute m-0" style="position: absolute;">Russie</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 m-3">
                        <div class="row faq p-5">
                            <div class="col-md-5 d-flex flex-column justify-content-center">
                                <h6 class="text-white text-uppercase">Consulter notre F.A.Q</h6>
                                <h3 class="text-white mt-1 faq-title">A la recherche du <br>meilleur visa</h3>
                            </div>
                            <div class="col-md-3 d-flex flex-column justify-content-center">
                                <h6 class="col-md-12 text-white fs-5"><i class="bi bi-check"></i> Visa étude</h6>
                                <h6 class="col-md-12 text-white fs-5"><i class="bi bi-check"></i> Visa formation</h6>
                                <h6 class="col-md-12 text-white fs-5"><i class="bi bi-check"></i> Visa  travailleur qualifié</h6>
                                <h6 class="col-md-12 text-white fs-5"><i class="bi bi-check"></i> Visa Touriste</h6>
                            </div>
                            <div class="col-md-4">
                                <img src="./assets/images/bg-banner-2.png" alt="" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5 mb-5 shadow">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="fs-4 text-center whyChooseUs-title">Vous devez choisir la seule consultation de qualite</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row tableau">
                                    <div class="col-md-6 border p-3 mb-2 shadow">
                                        <h6><i class="bi bi-question-circle m-3"></i>Assistance 24h/24 et 7j/7</h6>
                                        <p>
                                            Nous sommes toujours la pour vous accompagner tout au long de
                                            votre voyage. Avec notre assiatance disponible 24h/24 et 7j/7, vous
                                            pouvez nous contacter a tout moment pour obtenir des informations precises et a jour sur le suivi de votre voyage
                                        </p>
                                    </div>
                                    <div class="col-md-6 border p-3 mb-2 shadow">
                                        <h6><i class="bi bi-handshake m-3"></i>Clients de confiance</h6>
                                        <p>
                                            Notre plus grande satisfaction est de voir nos clients partir avec le
                                            sourire. Nous sommes fiers de la confiance qu’ils nous accordent pour
                                            organiser les voyages de leurs proches. Nous mettons tout en oeuvre
                                            pour mériter cette confiance, en offrant un service personnalisé et à la
                                            hauteur de leurs attentes.
                                        </p>
                                    </div>
                                    <div class="col-md-6 border p-3 mb-2 shadow">
                                        <h6><i class="bi bi-cash-stack m-3"></i>Rentable</h6>
                                        <p>
                                            Chez ZONE TRAVEL, nous voulons que vous viviez l’expérience de
                                            voyage la plus agréable possible. C’est pourquoi nous prenons soin de
                                            votre budget, en vérifiant que vous ne dépensez pas plus que
                                            nécessaire lors de l’obtention de votre VISA et ceux jusqu’au paiement
                                            de votre logement. Ainsi, vous êtes libre de profiter pleinement de
                                            votre voyage en toute sérénité.
                                        </p>
                                    </div>
                                    <div class="col-md-6 border p-3 shadow">
                                        <h6><i class="bi bi-people m-3"></i>Entrevues directes</h6>
                                        <p>
                                            Nous sommes à vos côtés pour faciliter et rendre agréable votre
                                            processus d’obtention de 𝐕𝐈𝐒𝐀. Notre équipe d’experts vous assure
                                            une prise en charge totale, avec des entretiens réguliers pour mieux 
                                            vous guider à chaque étape.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-12 mt-5 shadow">
                        <div class="header mt-5 d-flex flex-column justify-content-center align-items-center">
                            <h5 class="text-uppercase team-title">Notre Equipe</h5>
                            <p class="text-center">Rejoignez notre équipe de professionnels en immigration pour assurer votre réussite!</p>
                        </div>
                        <div class="card-body">
                            <div id="owl-demo" class="owl-carousel owl-theme">
                                <div class="item personnel img-hover card d-flex align-items-center p-2">
                                    <img src="./assets/images/Pauline.png" alt="Assistante de direction" width="150px" height="150px" style="border-radius: 50%;">
                                    <h6 class="mt-4">Pauline</h6>
                                    <p class="color-red">Assistante de direction</p>
                                </div>
                                <div class="item personnel img-hover card d-flex align-items-center p-2">
                                    <img src="./assets/images/Maeva.png" alt="Assistante de direction" width="150px" height="150px" style="border-radius: 50%;">
                                    <h6 class="mt-4">Maeva</h6>
                                    <p class="color-red">Community Manager</p>
                                </div>
                                <div class="item personnel img-hover card d-flex align-items-center p-2">
                                    <img src="./assets/images/Nathan.png" alt="Assistante de direction" width="150px" height="150px" style="border-radius: 50%;">
                                    <h6 class="mt-4">Nathan</h6>
                                    <p class="color-red">Genral Manager</p>
                                </div>
                                <div class="item personnel img-hover card d-flex align-items-center p-2">
                                    <img src="./assets/images/Maniche.png" alt="Assistante de direction" width="150px" height="150px" style="border-radius: 50%;">
                                    <h6 class="mt-4">Franck</h6>
                                    <p class="color-red">Software Developper</p>
                                </div>
                                <div class="item personnel img-hover card d-flex align-items-center p-2">
                                    <img src="./assets/images/Cyprien.png" alt="Assistante de direction" width="150px" height="150px" style="border-radius: 50%;">
                                    <h6 class="mt-4">Cyprien</h6>
                                    <p class="color-red">Promoteur</p>
                                </div>
                                <div class="item personnel img-hover card d-flex align-items-center p-2">
                                    <img src="./assets/images/Henry.png" alt="Assistante de direction" width="150px" height="150px" style="border-radius: 50%;">
                                    <h6 class="mt-4">Henry</h6>
                                    <p class="color-red">Software Developper</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5" id="special">
                        <div class="noire-footer w-100 h-100"></div>
                        <div class="card contact col-md-6 shadow">
                            <div class="header mt-3 border-none d-flex flex-column justify-content-center align-items-center">
                                <h5 class="text-uppercase team-title">Demande d'assistance</h5>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-6 mt-1 mb-1">
                                    <label>Prenom</label>
                                    <input class="form-control" type="text" placeholder="Prenom">
                                </div>
                                <div class="col-md-6 mt-1 mb-1">
                                    <label>Nom</label>
                                    <input class="form-control" type="text" placeholder="Nom">
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    <label>E-mail <span>*</span></label>
                                    <input class="form-control" type="text" placeholder="E-mail">
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    <label>Message <span>*</span></label>
                                    <textarea class="form-control" rows="4" placeholder="Message"></textarea>
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    <button class="form-control btn btn-danger text-uppercase">Envoyer</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 contact card bg-dark">
                            <h5 class="text-white mt-3">POUR PLUS D'INFORMATION</h5>
                            <p class="text-white">info@zone-travel.net</p>
                            <h6 class="text-white">Cameroun</h6>
                            <p class="text-white">
                                WhatsApp : 
                                <a href="tel:+237655566137" class="text-white"> +237 655 566 137</a>
                                <br>
                                Telephone : 
                                <a href="tel:+237676770662" class="text-white"> +237 676 77 06 62</a>
                            </p>
                            <h6 class="text-white">Allemagne</h6>
                            <p class="text-white">
                                Telephone :
                                <a href="tel:+493098587057" class="text-white">+49 30 9858 7057</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>

<script>
    $(document).ready(function() {

        $("#owl-demo").owlCarousel({

            autoPlay: 5500, //Set AutoPlay to 3 seconds

            items : 3,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,3]

        });

    });
</script>

<style>
    .text-center{
        font-size: 12px;
    }
    .titre{
        font-size: 40px
    }
    .container-image{
        position: relative;
        border-radius: 20px;
        overflow: hidden;
    }
    .noire{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        opacity: 0;
        z-index: 1;
        border-radius: 20px;
        transition: opacity 0.5s;
    }
    .container-image img{
        transition: transform 0.5s;
    }
    .container-image:hover .noire {
        opacity: 0.6;
    }

    .container-image:hover img {
        transform: scale(1.1);
    }
    .pays {
        font-family: 'Courier';
        font-size: 20px;
        font-weight: bold;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        z-index: 2;
        margin: 0;
    }
    .rounded-20 {
        border-radius: 20px; /* Applique les bordures arrondies à l'image */
    }
    .faq{
        background-color:rgb(58, 58, 58);
        border-radius: 20px;
    }
    .faq-title{
        font-size: 40px;
    }
    .tableau i{
        color: red;
        font-size: 30px;
    }
    .personnel{
        background-color:rgb(224, 224, 224);
        border: none;
        margin: 10px;
    }
    .personnel p,
    .team-title,
    .whyChooseUs-title{
        color: red;
    }
    #special{
        height: 500px;
        background-image: url("./assets/images/bg-banner-2.png");
        background-position-x: center;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: relative;
    }
    .noire-footer{
        position: absolute;
        height: 100%;
        background-color: black;
        z-index: 1;
        opacity: 0.6;
        position: absolute;
        
    }
    .contact{
        z-index: 100;
        position: relative;
        margin-top: 100px;
    }
    .row span{
        color: red;
    }
</style>