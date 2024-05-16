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
    session_start();
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['dateNaissance']) && isset($_POST['type']) && isset($_POST['numeroEtudiant'])&& isset($_POST["email"]) && isset($_POST["motDePasse"])){
      $email = $_POST["email"];
      $mdp = $_POST["motDePasse"];
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $dateNaissance = $_POST['dateNaissance'];
      $type = $_POST['type'];
      $numeroEtudiant = $_POST['numeroEtudiant'];
      $_SESSION['user_email'] = $email;

      if (verifier_email_existe($email)) {
        echo "<script>alert('L\'adresse e-mail est déjà utilisée. Veuillez en choisir une autre.');</script>";
        echo "<script>window.location.href='connexion.php'</script>";
    } 
        else {
            EcrireLogs($email, $mdp);
            enregistrerDonneesUtilisateur($nom, $prenom, $dateNaissance, $type, $numeroEtudiant, $email);
        }
    }
    $tableau = array("Accueil" => "accueil.php", "Se connecter"=> "connexion.php", "Inscription" => "inscription.php");
    top_bar($tableau);
    formulaire_connexion();
?>


</body>
</html>