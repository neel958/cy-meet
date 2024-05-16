<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../css/profil.css" type="text/css">
</head>
<body>

<div>
<form action="recherche_profil.php" class="barre_recherche" method="get">
    <input type="text" name="recherche_mail" placeholder="Rechercher un utilisateur par mail" required>
    <button type="submit">Rechercher</button>
</form>
</div>
<?php 
    session_start();
    include 'functions.php';

    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
        $userInfo = info_mail($email);
        $userbonus = info_aditionnel_tableau($email);
        $mdp = trouverMotDePasseParEmail($email);
        if ($userInfo) {
            echo "<h1>Modifier Votre Profil</h1>";
            echo "<form class =\"profil\" action='update_profil.php' method='post'>";
            echo "<br>";
            echo "Nom : <input type='text' name='nom' value='" . $userInfo['nom'] . "' placeholder='Nom' required><br>";
            echo "<br>";
            echo "Prenom : <input type='text' name='prenom' value='" . $userInfo['prenom'] . "' placeholder='Prénom' required><br>";
            echo "<br>";
            echo "Email : <input type='text' name='emaile' value='" . $email . "'placeholder = 'Email' requiered><br>";
            echo "<br>";
            echo "Mot de passe : <input type='text' name='motdepasse' value='" . $mdp . "'placeholder = 'Mot de passe' requiered><br>";
            echo "<br>";
            echo "Date de naissance : <input type='text' name='dateNaissance' value='" . $userInfo['dateNaissance'] . "' placeholder='Date de Naissance' required><br>";
            echo "<br>";
            echo "Sexe : <select name='type'>";
            echo "<option value='Homme'" . ($userInfo['type'] == 'Homme' ? ' selected' : '') . ">Homme</option>";
            echo "<option value='Femme'" . ($userInfo['type'] == 'Femme' ? ' selected' : '') . ">Femme</option>";
            echo "</select><br>";
            echo "<br>";
            echo "Numéro étudiant : <input type='text' name='numeroEtudiant' value='" . $userInfo['numeroEtudiant'] . "' placeholder='Numéro Étudiant' required><br>";

            echo "<br>";
            echo "Profession : <input type='text' name='profession' value='" . ($userbonus['profession'] ?? '') . "' placeholder='Profession'><br>";
            echo "<br>";
            echo "Lieur de residence : <input type='text' name='lieuResidence' value='" . ($userbonus['lieuResidence'] ?? '') . "' placeholder='Lieu de résidence'><br>";
            echo "<br>";
            echo "Situation familiale/amoureuse : <textarea name='situationAmoureuse' placeholder='Situation amoureuse et familiale'>" . ($userbonus['situationAmoureuse'] ?? '') . "</textarea><br>";
            echo "<br>";
            echo "Description physique :<textarea name='descriptionPhysique' placeholder='Description physique'>" . ($userbonus['descriptionPhysique'] ?? '') . "</textarea><br>";
            echo "<br>";
            echo "Info personnelles : <textarea name='infosPersonnelles' placeholder='Informations personnelles'>" . ($userbonus['infosPersonnelles'] ?? '') . "</textarea><br>";
            echo "<br>";
            echo "Photo : <input type='file' name='photo' multiple><br>";
            echo "<br>";
            echo "<input type='submit' value='Mettre à jour'>";  
            echo "</form>";
            
            
        } else {
            echo "<p>Aucune information disponible pour cet utilisateur.</p>";
        }
    } else {
        echo "<script>alert(\"Vous n'êtes pas connecté.\");</script>";
        header("Location: accueil.php");
        exit();
    }
    



    $tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Deconnexion" => "deconnexion.php");
    top_bar($tableau);
?>
