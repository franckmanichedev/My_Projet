<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- <link href="assets/css/custom.css" rel="stylesheet" /> -->
    <link href="bootstrap-icons-1.11.0/bootstrap-icons.css" rel="stylesheet" />
    <!-- ALERTIFY CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1//css/alertify.min.css" integrity="sha512-IXuoq1aFd2wXs4NqGskwX2Vb+I8UJ+tGJEu/Dc0zwLNKeQ7CW3Sr6v0yU3z5OQWe3eScVIkER4J9L7byrgR/fA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/bootstrap.min.css" integrity="sha512-6xVTeh6P+fsqDhF7t9sE9F6cljMrK+7eR7Qd+Py7PX5QEVVDLt/yZUgLO22CXUdd4dM+/S6fP0gJdX2aSzpkmg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- OWL CAROUSSEL -->
    <link href="../assets/css/owl.carousel.css" rel="stylesheet" />
    <link href="../assets/css/owl.theme.css" rel="stylesheet" />
    <link href="../assets/css/owl.transitions.css" rel="stylesheet" />
    <style>
        body {
            padding-top: 112px; /* Ajustez cette valeur en fonction de la hauteur combinée de vos barres */
        }
        .navbar ul .nav-item:hover{
            transition: 0.5s;
        }

        .navbar ul .nav-item .nav-link:hover{
            color: rgb(189, 0, 0) !important;
            text-decoration: none !important;
        }

        .social-icon {
            background-color: red;
            border-radius: 5px;
            padding: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
        }

        .social-icon i {
            color: white;
        }
    </style>
</head>
<body>

    <?php include "navbar.php" ;?>