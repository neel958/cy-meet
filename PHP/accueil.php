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
  include 'functions.php';
  $tableau = array("Accueil" => "accueil.php", "Se connecter"=> "connexion.php", "Inscription" => "inscription.php");
  top_bar($tableau); 
?>
    </div>
    <div class = "slogan">
        <h3>Cy meet le site de rencontre pour étudiant</h3>
    </div>
    <div class="rectangle_blanc">
        <div class="offres">
            <div class="offre gratuite">
              <h2>Offre gratuite</h2>
              <p>L'offre accessible à tous, certaines fonctionnalitées sont restreintes.</p>
              <a href="#">S'inscrire à l'offre gratuite</a>
            </div>
            <div class="offre premium">
              <h2>Offre premium</h2>
              <p>Pour .€/mois vous avez accés à la totalité des fonctionnalitées.</p>
              <a href="#">S'inscrire à l'offre premium</a>
            </div>
            <div class="offre free_tour">
              <h2>Tour gratuit</h2>
              <p>Un rapide apperçu (5 min) des fonctionnalitées premium.</p>
              <a href="#">Faire une visite gratuite</a>
            </div>
          </div>
    </div>
    
</body>
</html>
