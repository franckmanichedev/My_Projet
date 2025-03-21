<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Initialiser Dompdf avec les options
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

// Récupérer le contenu HTML de la section content
ob_start();
include 'index.php';
$html = ob_get_clean();

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);

// (Optionnel) Définir la taille et l'orientation du papier
$dompdf->setPaper('A4', 'portrait');

// Rendre le PDF
$dompdf->render();

// Envoyer le PDF au navigateur
$dompdf->stream("dashboard.pdf", ["Attachment" => false]);