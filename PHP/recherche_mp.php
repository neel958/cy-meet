<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche mail</title>
</head>
<body>
<?php
    session_start();
    include 'functions.php';
    if (!isset($_SESSION['user_email'])) {
        echo "<script>alert('Vous n'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
        exit();
    }

    $mail_target = $_GET['recherche_mail'];
    $utilisateurs = lire_fichier_public_user('../Fichiers/logs.txt');

    echo "<h1>Résultats de la Recherche</h1>";
    $found = false;

    foreach ($utilisateurs as $utilisateur) {
        if (strpos(strtolower($utilisateur['email']), strtolower($mail_target)) !== false) {
            echo "<div><p><a href='dm.php?email=" . urlencode($utilisateur['email']) . "'>" . $utilisateur['email'] . "</a></p></div>";
            $found = true;
        }
    }
    if (!$found) {
        echo "<p>Aucun utilisateur trouvé pour '" . $mail_target . "'</p>";
    }
?>

</body>
</html>