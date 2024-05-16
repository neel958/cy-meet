<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Vous n'êtes pas connecté.');</script>";
    header("Location: connexion.php");
    exit();
}

$email = $_GET['email'];
$userInfo = info_mail($email);
$additionalInfo = info_aditionnel_tableau($email);

if ($userInfo) {
    echo "<h1>Profil de " . $userInfo['prenom'] . " " . $userInfo['nom'] . "</h1>";
    echo "<p>Nom : " . $userInfo['nom'] . "</p>";
    echo "<p>Prénom : " . $userInfo['prenom'] . "</p>";
    echo "<p>Date de Naissance : " . $userInfo['dateNaissance'] . "</p>";
    echo "<p>Type : " . $userInfo['type'] . "</p>";
    echo "<p>Numéro Étudiant : " . $userInfo['numeroEtudiant'] . "</p>";
    
    if ($additionalInfo) {
        echo "<p>Profession : " . $additionalInfo['profession'] . "</p>";
        echo "<p>Lieu de Résidence : " . $additionalInfo['lieuResidence'] . "</p>";
        echo "<p>Situation Amoureuse : " . $additionalInfo['situationAmoureuse'] . "</p>";
        echo "<p>Description Physique : " . $additionalInfo['descriptionPhysique'] . "</p>";
        echo "<p>Informations Personnelles : " . $additionalInfo['infosPersonnelles'] . "</p>";
    }
} else {
    echo "<p>Profil non trouvé.</p>";
}
?>
