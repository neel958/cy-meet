<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
    <link rel="stylesheet" href="../CSS/messagerie.css" type="text/css">
</head>
<body>

<?php
    session_start();
    include 'functions.php';


    if (!isset($_SESSION['user_email'])) {
        echo "<script>alert('Vous n\'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
        exit();
    }
    if (!checkPremium($_SESSION['user_email'])) {
        echo "<script>alert(\"Votre abonnement a expiré ou vous n'êtes pas un utilisateur premium\"); window.location.href = 'abonnement.php';</script>";
        exit();
    }
    $tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Messagerie" => "messagerie.php", "Deconnexion" => "deconnexion.php");
    top_bar($tableau); 


    $email = $_SESSION['user_email'];
    if (isUserPremium($email)) {
        echo'<form action="recherche_mp.php" class="recherche_dm" method="get">            
        <input type="text" name="recherche_mail" placeholder="Rechercher l\'email de la personne que vous souhaitez contacter" required>
        <button>Rechercher</button>
        </form>';      
        } 

?>


</body>
</html>