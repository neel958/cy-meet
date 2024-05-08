<?php

function top_bar($tableau){
    echo("<div class='top-bar'>
    <img src=\"../Images\CY Cergy Paris Universite_coul.jpg\" class = \"logo\">
    <ul>");   
    foreach($tableau as $page_name => $page_url){
      echo("<li><a href=\"$page_url\">$page_name</a></li>");
    }
    echo("</ul>
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
    Vous êtes : <input checked type='radio' id='type' value =\"Homme\" name='type' >Homme
    <input type = 'radio' value =\"Femme\" name = 'type' >Femme
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
  $donnees = $email."\t".$mdp."\n";
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
          $data = explode("\t", $line);
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

function enregistrerDonneesUtilisateur($nom, $prenom, $dateNaissance, $sexe, $numeroEtudiant, $email) {
  $cheminFichier = "../Fichiers/data.txt";

  $dateFormatted = date("d-m-Y", strtotime($dateNaissance));
  $ligne = $nom . "\t" . $prenom . "\t" . $dateFormatted . "\t" . $sexe . "\t" . $numeroEtudiant . "\t" . $email . "\n";

  // Vérifier si le fichier existe, sinon le créer
  if (!file_exists($cheminFichier)) {
      $fichier = fopen($cheminFichier, 'w'); // Création du fichier si non existant
      fclose($fichier);
  }

  // Récupérer le contenu existant pour vérifier si les données sont déjà présentes
  $contenuFichier = file_get_contents($cheminFichier);
  if (strpos($contenuFichier, $ligne) !== false) {
      // Si les données sont déjà présentes, ne rien faire
      return;
  }

  // Si les données ne sont pas encore dans le fichier, les ajouter
  file_put_contents($cheminFichier, $ligne, FILE_APPEND);
}


function info_mail($email) {
  $fichier = "../Fichiers/data.txt";
  $handle = fopen($fichier, 'r');
  if ($handle) {
      while (($line = fgets($handle)) !== false) {
          $data = explode("\t", $line);
          if (trim($data[5]) == $email) {
              fclose($handle);
              return [
                  'nom' => trim($data[0]),
                  'prenom' => trim($data[1]),
                  'dateNaissance' => trim($data[2]),
                  'type' => trim($data[3]),
                  'numeroEtudiant' => trim($data[4])
              ];
          }
      }
      fclose($handle);
  } else {
      echo "Erreur : impossible d'ouvrir le fichier $fichier";
  }
  return null;
}


function updateUserInfo($email, $nom, $prenom, $dateNaissance, $type, $numeroEtudiant) {
  $fichier = "../Fichiers/data.txt";
  $tempFile = "../Fichiers/temp.txt";
  $handle = fopen($fichier, 'r');
  $tempHandle = fopen($tempFile, 'w');

  if ($handle && $tempHandle) {
      while (($line = fgets($handle)) !== false) {
          $data = explode("\t", $line);
          if (trim($data[5]) == $email) {

              $newLine = "$nom\t$prenom\t$dateNaissance\t$type\t$numeroEtudiant\t$email\n"; // creer  la nouvelle ligne avec les informations mise à jour
              fputs($tempHandle, $newLine);
          } else {

              fputs($tempHandle, $line);
          }
      }
      fclose($handle);
      fclose($tempHandle);


      if (!rename($tempFile, $fichier)) {
          echo "Erreur lors de la mise à jour des informations.";
          return false;
      }
      return true;
  } else {
      if ($handle) fclose($handle);
      if ($tempHandle) fclose($tempHandle);
      echo "Erreur : impossible d'ouvrir le fichier.";
      return false;
  }
}
function info_additionnel($email, $profession, $lieuResidence, $situationAmoureuse, $descriptionPhysique, $infosPersonnelles) {
  $cheminFichier = "../Fichiers/additionnel_info.txt";
  $ligne = "$profession\t$lieuResidence\t$situationAmoureuse\t$descriptionPhysique\t$infosPersonnelles\t$email\n";

  if (!file_exists($cheminFichier)) {
      $fichier = fopen($cheminFichier, 'w');
      fclose($fichier);
  }

  $lines = file($cheminFichier, FILE_IGNORE_NEW_LINES);


  $emailFound = false;
  foreach ($lines as $key => $line) {
      $fields = explode("\t", $line);
      if ($fields[count($fields) - 1] == $email) {
          $lines[$key] = $ligne; // modifie la ligne si le mail est trouvé
          $emailFound = true;
          break;
      }
  }

  if (!$emailFound) { // sinon on ajoute simplement la nouvelle ligne
      $lines[] = $ligne;
  }

  file_put_contents($cheminFichier, implode("\n", $lines));
}

function info_aditionnel_tableau($email) {
  $file = "../Fichiers/additionnel_info.txt";
  $info = [];

  if (!file_exists($file)) {
    touch($file); // Crée le fichier s'il n'existe pas
  }
  $handle = fopen($file, 'r');
  if ($handle) {

      while (($line = fgets($handle)) !== false) {

          $data = explode("\t", $line);

          if (trim($data[5]) == $email) {
              $info = [
                  'profession' => trim($data[0]),
                  'lieuResidence' => trim($data[1]),
                  'situationAmoureuse' => trim($data[2]),
                  'descriptionPhysique' => trim($data[3]),
                  'infosPersonnelles' => trim($data[4])
              ];
              fclose($handle);
              return $info;
          }
      }

      fclose($handle);
  } else {
      echo "Erreur : impossible d'ouvrir le fichier $file";
  }
  return null;
}
