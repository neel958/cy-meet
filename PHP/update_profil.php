<?php 
include 'functions.php';
session_start();
if (isset($_POST['nom'], $_POST['prenom'], $_POST['dateNaissance'], $_POST['type'], $_POST['numeroEtudiant']) && isset($_SESSION['user_email'])) {

    $email = $_SESSION['user_email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['dateNaissance'];
    $type = $_POST['type'];
    $numeroEtudiant = $_POST['numeroEtudiant'];
    $profession = $_POST['profession'] ?? '';
    $lieuResidence = $_POST['lieuResidence'] ?? '';
    $situationAmoureuse = $_POST['situationAmoureuse'] ?? '';
    $descriptionPhysique = $_POST['descriptionPhysique'] ?? '';
    $infosPersonnelles = $_POST['infosPersonnelles'] ?? '';
    



    updateUserInfo($email, $nom, $prenom, $dateNaissance, $type, $numeroEtudiant); // mise à jour dans la base de donnée
    info_additionnel($email, $profession, $lieuResidence, $situationAmoureuse, $descriptionPhysique, $infosPersonnelles);

    header("Location: profil.php"); // quand tout est bon, redirige vers la page de modification
    exit();
} else {
    echo "Problème lors de la soumission du formulaire.";
}
