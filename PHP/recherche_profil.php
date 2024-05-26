<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recherche profil</title>
    <link rel="stylesheet" href="../css/recherche_profil.css" type="text/css">
</head>
<body>
<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Vous n\'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
    exit();
}
$tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Messagerie" => "messagerie.php", "Deconnexion" => "deconnexion.php");
top_bar($tableau); 

$mail_target = $_GET['recherche_mail'];
$utilisateurs = lire_fichier_public_user('../Fichiers/logs.txt');

echo "<h1>Résultats de la Recherche</h1>";
$found = false;
foreach ($utilisateurs as $utilisateur) {
    if (strpos(strtolower($utilisateur['email']), strtolower($mail_target)) !== false) {
        echo "<div><p><a href='profil_autre.php?email=" . urlencode($utilisateur['email']) . "'>" . $utilisateur['email'] . "</a></p></div>";
        $found = true;        // affiche les mails ayant comme caractere ce que l'utilisateur aura rentrer dans la barre de recherche                                                                                                                     
    }
}

if (!$found) {
    echo "<p>Aucun utilisateur trouvé pour '" . $mail_target . "'</p>";
}
?>

</body>
</html>