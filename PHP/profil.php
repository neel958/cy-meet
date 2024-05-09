<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../css/profil.css" type="text/css">
</head>
<body>


<?php 
    session_start();
    include 'functions.php';

    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
        $userInfo = info_mail($email);
        $userbonus = info_aditionnel_tableau($email);
        if ($userInfo) {
            echo "<br> <br> <br> <br> <br>";
            echo "<h1>Modifier Votre Profil</h1>";
            echo "<form action='update_profil.php' method='post'>";
            echo "<br>";
            echo "<input type='text' name='nom' value='" . $userInfo['nom'] . "' placeholder='Nom' required><br>";
            echo "<br>";
            echo "<input type='text' name='prenom' value='" . $userInfo['prenom'] . "' placeholder='Prénom' required><br>";
            echo "<br>";
            echo "<input type='text' name='dateNaissance' value='" . $userInfo['dateNaissance'] . "' placeholder='Date de Naissance' required><br>";
            echo "<br>";
            echo "<select name='type'>";
            echo "<option value='Homme'" . ($userInfo['type'] == 'Homme' ? ' selected' : '') . ">Homme</option>";
            echo "<option value='Femme'" . ($userInfo['type'] == 'Femme' ? ' selected' : '') . ">Femme</option>";
            echo "</select><br>";
            echo "<br>";
            echo "<input type='text' name='numeroEtudiant' value='" . $userInfo['numeroEtudiant'] . "' placeholder='Numéro Étudiant' required><br>";

            echo "<br>";
            echo "<input type='text' name='profession' value='" . ($userbonus['profession'] ?? '') . "' placeholder='Profession'><br>";
            echo "<br>";
            echo "<input type='text' name='lieuResidence' value='" . ($userbonus['lieuResidence'] ?? '') . "' placeholder='Lieu de résidence'><br>";
            echo "<br>";
            echo "<textarea name='situationAmoureuse' placeholder='Situation amoureuse et familiale'>" . ($userbonus['situationAmoureuse'] ?? '') . "</textarea><br>";
            echo "<br>";
            echo "<textarea name='descriptionPhysique' placeholder='Description physique'>" . ($userbonus['descriptionPhysique'] ?? '') . "</textarea><br>";
            echo "<br>";
            echo "<textarea name='infosPersonnelles' placeholder='Informations personnelles'>" . ($userbonus['infosPersonnelles'] ?? '') . "</textarea><br>";
            echo "<br>";
            echo "<input type='file' name='photo' multiple><br>";
            echo "<br>";
            echo "<input type='submit' value='Mettre à jour'>";  
            echo "</form>";
            
            
        } else {
            echo "<p>Aucune information disponible pour cet utilisateur.</p>";
        }
    } else {
        echo "Vous n'êtes pas connecté. Veuillez vous connecter.";
        header("Location: connexion.php");
        exit();
    }



    $tableau = array("Accueil" => "accueil_connecté.php", "Profil"=> "profil.php");
    top_bar($tableau);
?>
