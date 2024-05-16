<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Vous n'êtes pas connecté.');</script>";
    header("Location: connexion.php");
    exit();
}

$mail_target = $_GET['recherche_mail'];
$utilisateurs = lire_fichier_public_user('../Fichiers/logs.txt');

echo "<h1>Résultats de la Recherche</h1>";
$found = false;
foreach ($utilisateurs as $utilisateur) {
    if (strpos(strtolower($utilisateur['email']), strtolower($mail_target)) !== false) {
        echo "<div><p><a href='profil_autre.php?email=" . urlencode($utilisateur['email']) . "'>" . $utilisateur['email'] . "</a></p></div>";
        $found = true;
    }
}

if (!$found) {
    echo "<p>Aucun utilisateur trouvé pour '" . $mail_target . "'</p>";
}
