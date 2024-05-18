<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
    <link rel="stylesheet" href="../css/messagerie.css" type="text/css">
</head>
<body>

<?php
    include 'functions.php';
    $tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Messagerie" => "messagerie.php", "Deconnexion" => "deconnexion.php");
    top_bar($tableau); 
    session_start();
    if (isset($_SESSION['user_email'])){

        $email = $_SESSION['user_email'];

        if (isUserPremium($email)) {
            echo'<form action="recherche_mp.php" class="recherche_dm" method="get">            
            <input type="text" name="recherche_mail" placeholder="Rechercher l\'email de la personne que vous souhaitez contacter" required>
            <button>Rechercher</button>
            </form>';      
        } 
        else {
            echo('<script>alert("Veuillez souscrite à l\'ofrre premium afin d\'avoir accès à la messagerie."); window.location.href = "abonnement.php";</script>');
        }
    }
    else{
        echo('<script>alert("Vous devez être connecté pour accéder à cette page."); window.location.href = "connexion.php";</script>');
        exit();
    }
?>


</body>
</html>