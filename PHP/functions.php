<?php

function top_bar(){
    echo("<div class='top-bar'>
    <img src=\"../Images\CY Cergy Paris Universite_coul.jpg\" class = \"logo\">
    <ul>   
        <li><a href=\"accueil.php\">Accueil</a></li>
        <li><a href=\"connexion.php\">Se connecter</a></li>
        <li><a href=\"inscription.php\">Inscription</a></li>

    </ul>
</div>");
}
function top_bar_connecté(){
  echo("<div class='top-bar'>
  <img src='../Images\CY Cergy Paris Universite_coul.jpg' class = 'logo'>
  <ul>   
      <li><a href='accueil_connecté.php'>Accueil</a></li>
      <li><a href='#'>Profil</a></li>

  </ul>
</div>");
}


function formulaire_inscription(){
    echo("<form method='post' action=\"connexion.php\">
    <h2>Inscription</h2>
    <div class='champ'>
      <input type='text' name='nom' placeholder='Nom' >
    </div>
    <div class='champ'>
      <input type='text' name='prenom' placeholder='Prénom' >
    </div>
    <div class='champ'>
      <input type='date' id='dateNaissance' name='dateNaissance' placeholder='Date de naissance' >
    </div>
    <div class='champ'>
      <input type='email' id='email' name='email' placeholder='Email' required>
    </div>
    <div class='type'>
    Vous êtes : <input type='radio' id='type' name='type' >Homme
    <input type = 'radio' name = 'type' >Femme
    </div>
    <div class='champ'>
      <input type='password' id='mdp1'  name='motDePasse' placeholder='Mot de passe' required>
      <img src='../Images\show_password.jpg' class='mdp_visible1' onclick='mdp_visble1()'>
    </div>
    <div class='champ'>
      <input type='password' id='mdp2' name='confirmationMotDePasse' placeholder='Confirmation du mot de passe' required>
      <img src='../Images/show_password.jpg' class='mdp_visible2' onclick='mdp_visble2()'>
    </div>
    <div class='champ'>
      <input type='text' id='numeroEtudiant' name='numeroEtudiant' placeholder='Numéro étudiant' pattern='[0-9]{11}' >
    </div>
    <button type='submit' onclick='no_space()' >S'inscrire</button>
    <hr>Ou bien vous avez déjà un compte ? Dans ces cas là connectez-vous <a href='connexion.php'>ici</a>
  </form>");
}

function formulaire_connexion(){
    echo("<div class='formulaire'>
    <h2>Connexion</h2>
    <form method='post'  action=\"traitement_connexion.php\">
        <div class='champ'>
            <input type='email' name=\"email\" placeholder='Email' required>
        </div>
        <div class='champ'>
            <input type='password' name=\"motDePasse\" id='mdp' placeholder='Mot de passe' required>
            <img src='../Images/show_password.jpg' class='mdp_visible' onclick='mdp_visble()'>
            
        </div>
        <div>
            <button type='submit'>Se connecter</button>
            <hr>Ou bien vous n'avez pas de compte ? Dans ce cas là inscrivez-vous <a href='inscription.php'>ici.</a>
            </form>
        </div>");
}
function EcrireLogs($email, $mdp) {
  if (!file_exists('../Fichiers/logs.txt')) {
    $fichier = fopen('../Fichiers/logs.txt', 'w');
    fclose($fichier);
}
  $emplacement_fichier = '../Fichiers/logs.txt';
  $donnees = "$email $mdp\n";
  $contenuFichier = file_get_contents($emplacement_fichier); // $contenu_fichier prend les données du fichier logs.txt
  if (strpos($contenuFichier, $donnees) !== false) { // cherche $donnes dans $contenu_fichier, si != false (existe) alors ne rien ecrire
      return;
  }
  file_put_contents($emplacement_fichier, $donnees, FILE_APPEND); // si $donnees n'existe pas dans $contenu_fichier, alors ecrire $donnees dans $contenu_fichier (à la fin du fichier d'où le file_append)
}

function lire_fichier_public_user($fichier) {
  $tableau_associatif = array();
  $handle = fopen($fichier, 'r');
  if ($handle) {
      while (($line = fgets($handle)) !== false) {
          $data = explode(' ', $line);
          $email = trim($data[0]);
          $mot_de_passe = trim($data[1]);
          $tableau_associatif[] = array('email' => $email, 'mot_de_passe' => $mot_de_passe);
      }
      fclose($handle);
  } else {
      echo "Erreur : impossible d'ouvrir le fichier $fichier";
  }
  return $tableau_associatif;
}

function verifie_identifiant(){
  $tableau = lire_fichier_public_user('../Fichiers/logs.txt');
  $email = $_POST["email"];
  $mot_de_passe = $_POST["motDePasse"]; // Nom du champ dans le formulaire
  $trouve = false;
  foreach ($tableau as $utilisateur) {
      if ($utilisateur["email"] == $email && $utilisateur["mot_de_passe"] == $mot_de_passe) {
          $trouve = true;
          break;
      }
  }
  if($trouve){
    header("Location: accueil_connecté.php");
  }
  else{
    echo "<script>alert('Identifiants incorrects')</script>";
    echo "<script>window.location.href='connexion.php'</script>";
  }
}

function verifier_email_existe($email) {
  $fichier_logs = '../Fichiers/logs.txt';

  $contenu_fichier = file_get_contents($fichier_logs);
  $a = strpos($contenu_fichier, $email);
  if (strpos($contenu_fichier, $email) !== false) {
      return true; // L'email existe
  } else {
      return false; // L'email n'existe pas
  }
}