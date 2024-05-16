<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../css/accueil_connecté.css" type="text/css">
</head>
<body>

<div class="background_image"></div>
    <h1 class = "titre">Cy meet</h1>
<?php 
    include 'functions.php';
    $tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Deconnexion" => "deconnexion.php");
    top_bar($tableau); 


    session_start();
    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];

        $vingt_dernier_mail = getLast20Emails();
        $tableau_final = [];

        foreach ($vingt_dernier_mail as $mail) {

            $basicInfo = info_mail($mail);
            $additionalInfo = info_aditionnel_tableau($mail);
            if ($basicInfo) {
                $userInfo = $basicInfo;
                if ($additionalInfo) {
                    $userInfo = array_merge($basicInfo, $additionalInfo);
                }
                $tableau_final[] = $userInfo;
            }
        }
        $tableau_final = array_reverse($tableau_final);
    }
        ?>
    <div class="list-container">
        <h2>Derniers inscrits</h2>
        <ul>
        <?php foreach ($tableau_final as $userInfo): ?>
            <li>
                <?= $userInfo['nom'] ?> <?= $userInfo['prenom'] ?> - Date de naissance: <?= $userInfo['dateNaissance'] ?> - Type: <?= $userInfo['type'] ?> - Email: <?= $userInfo['email'] ?>
                <?php if (isset($userInfo['profession'])): ?>
                    
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>


        </div>
        <div class = "slogan">
            <h3>Cy meet le site de rencontre pour étudiant</h3>
        </div>

</div>
<a href="abonnement.php" class="subscribe-button">Abonnements</a>
</body>
</html>

