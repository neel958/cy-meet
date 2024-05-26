<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations profil</title>
    <link rel="stylesheet" href="../css/profil_autre.css" type="text/css">
</head>
<body>
<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Vous n\'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
    exit();
}

$email = $_GET['email'];
$userInfo = info_mail($email);
$additionalInfo = info_aditionnel_tableau($email);

$tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Messagerie" => "messagerie.php", "Deconnexion" => "deconnexion.php");
top_bar($tableau);

if ($userInfo) {
    echo "<div class='profile-container'>";
    echo "<h1>Profil de " . htmlspecialchars($userInfo['prenom']) . " " . htmlspecialchars($userInfo['nom']) . "</h1>"; // utilisation de htmlspecialchars pour eviter 
    echo "<p>Nom : " . htmlspecialchars($userInfo['nom']) . "</p>";                                                     // les problèmes de caractères spéciaux
    echo "<p>Prénom : " . htmlspecialchars($userInfo['prenom']) . "</p>";
    echo "<p>Date de Naissance : " . htmlspecialchars($userInfo['dateNaissance']) . "</p>";
    echo "<p>Type : " . htmlspecialchars($userInfo['type']) . "</p>";
    echo "<p>Numéro Étudiant : " . htmlspecialchars($userInfo['numeroEtudiant']) . "</p>";
    
    if ($additionalInfo) {
        echo "<p>Profession : " . htmlspecialchars($additionalInfo['profession']) . "</p>";
        echo "<p>Lieu de Résidence : " . htmlspecialchars($additionalInfo['lieuResidence']) . "</p>";
        echo "<p>Situation Amoureuse : " . htmlspecialchars($additionalInfo['situationAmoureuse']) . "</p>";
        echo "<p>Description Physique : " . htmlspecialchars($additionalInfo['descriptionPhysique']) . "</p>";
        echo "<p>Informations Personnelles : " . htmlspecialchars($additionalInfo['infosPersonnelles']) . "</p>";
    }
    if (isUserPremium($_SESSION['user_email'])) {
        echo "<a class='contact-button' href='dm.php?email=" . urlencode($email) . "'>Contacter</a>";
    }
    echo "</div>";
} else {
    echo "<p>Profil non trouvé.</p>";
}
?>
</body>
</html>