<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscirption</title>
    <link rel="stylesheet" href="../CSS/inscription.css" type="text/css">
    <script src="../JS/script.js" type="text/javascript"></script>
</head>
<body>
<?php 
  include 'functions.php';
  $tableau = array("Accueil" => "accueil.php", "Se connecter"=> "connexion.php", "Inscription" => "inscription.php");
  top_bar($tableau); 
  formulaire_inscription();
?>

</body>
</html>