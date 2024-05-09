<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../css/accueil.css" type="text/css">
</head>
<body>

<div class="background_image"></div>
    <h1 class = "titre">Cy meet</h1>
<?php 
        
    session_start();
    include 'functions.php';
    $tableau = array("Accueil" => "accueil_connecté.php", "Profil"=> "profil.php");
    top_bar($tableau); 
        ?>
        </div>
        <div class = "slogan">
            <h3>Cy meet le site de rencontre pour étudiant</h3>
        </div>

</div>
</body>
</html>

