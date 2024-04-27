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
  top_bar();
  formulaire_connexion();
  if(isset($_POST["email"]) && isset($_POST["motDePasse"])) {

    $email = $_POST["email"];
    $mdp = $_POST["motDePasse"];
    EcrireLogs($email, $mdp);
}
?>


</body>
</html>