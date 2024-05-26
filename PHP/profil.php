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
            echo "<form class='profil' action='update_profil.php' method='post'>";
            echo "<br>";
            echo "Nom : <input type='text' name='nom' value='" . htmlspecialchars($userInfo['nom'], ENT_QUOTES) . "' placeholder='Nom' required><br>";      // utilisation de hmtlspecialchars avec ent_quotes en parametres pour eviter les problemes dues aux caracteres speciaux
            echo "<br>";
            echo "Prénom : <input type='text' name='prenom' value='" . htmlspecialchars($userInfo['prenom'], ENT_QUOTES) . "' placeholder='Prénom' required><br>";
            echo "<br>";
            echo "Email : <input type='text' name='email' value='" . htmlspecialchars($email, ENT_QUOTES) . "' placeholder='Email' required><br>";
            echo "<br>";
            echo "Mot de passe : <input type='text' name='motdepasse' value='" . htmlspecialchars($mdp, ENT_QUOTES) . "' placeholder='Mot de passe' required><br>";
            echo "<br>";
            echo "Date de naissance : <input type='text' name='dateNaissance' value='" . htmlspecialchars($userInfo['dateNaissance'], ENT_QUOTES) . "' placeholder='Date de Naissance' required><br>";
            echo "<br>";
            echo "Sexe : <select name='type'>";
            echo "<option value='Homme'" . ($userInfo['type'] == 'Homme' ? ' selected' : '') . ">Homme</option>";
            echo "<option value='Femme'" . ($userInfo['type'] == 'Femme' ? ' selected' : '') . ">Femme</option>";
            echo "</select><br>";
            echo "<br>";
            echo "Numéro étudiant : <input type='text' name='numeroEtudiant' value='" . htmlspecialchars($userInfo['numeroEtudiant'], ENT_QUOTES) . "' placeholder='Numéro Étudiant' required><br>";
    
            echo "<br>";
            echo "Profession : <input type='text' name='profession' value='" . htmlspecialchars($userbonus['profession'] ?? '', ENT_QUOTES) . "' placeholder='Profession'><br>";
            echo "<br>";
            echo "Lieu de résidence : <input type='text' name='lieuResidence' value='" . htmlspecialchars($userbonus['lieuResidence'] ?? '', ENT_QUOTES) . "' placeholder='Lieu de résidence'><br>";
            echo "<br>";
            echo "Situation familiale/amoureuse : <textarea name='situationAmoureuse' placeholder='Situation amoureuse et familiale'>" . htmlspecialchars($userbonus['situationAmoureuse'] ?? '', ENT_QUOTES) . "</textarea><br>";
            echo "<br>";
            echo "Description physique :<textarea name='descriptionPhysique' placeholder='Description physique'>" . htmlspecialchars($userbonus['descriptionPhysique'] ?? '', ENT_QUOTES) . "</textarea><br>";
            echo "<br>";
            echo "Informations personnelles : <textarea name='infosPersonnelles' placeholder='Informations personnelles'>" . htmlspecialchars($userbonus['infosPersonnelles'] ?? '', ENT_QUOTES) . "</textarea><br>";
            echo "<br>";
            echo "Photo : <input type='file' name='photo' multiple><br>";
            echo "<br>";
            echo "<input type='submit' value='Mettre à jour'>";
            echo "</form>";
        }
    
         else {
            echo "<p>Aucune information disponible pour cet utilisateur.</p>";
        }
    } else {
        echo "<script>alert('Vous n\'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";

        exit();
    }
    



    $tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Messagerie" => "messagerie.php", "Deconnexion" => "deconnexion.php");
    top_bar($tableau);
?>
