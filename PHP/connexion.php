<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/connexion.css" type="text/css">
    <script src="../js/script.js" type="text/javascript"></script>
</head>
<body>
<?php 
  include 'functions.php';

  if(isset($_POST["email"]) && isset($_POST["motDePasse"])){
    $email = $_POST["email"];
    $mdp = $_POST["motDePasse"];
    if (verifier_email_existe($email)) {
      echo "<script>alert('L\'adresse e-mail est déjà utilisée. Veuillez en choisir une autre.');</script>";
      header("Refresh: 1; URL=inscription.php"); //redirige apres 1 seocnde vers inscription.php, obligé sinon ca dirige vers connexion.php
      exit();
  } 
  else {
      EcrireLogs($email, $mdp);
  }
  }
  top_bar();
  formulaire_connexion();
?>


</body>
</html>