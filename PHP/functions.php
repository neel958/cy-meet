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
  $donnees = $email."|".$mdp."\n";
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
          $data = explode("|", $line);
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
          $_SESSION['user_email'] = $email;
          header("Location: accueil_connecté.php");  // Redirection vers la page d'accueil connecté
          exit();
      }
  }

  echo "<script>alert('Identifiants incorrects')</script>";
  echo "<script>window.location.href='connexion.php'</script>";
  exit();
}

function verifier_email_existe($email) {
  $fichier_logs = '../Fichiers/logs.txt';

  $contenu_fichier = file_get_contents($fichier_logs);
  if (strpos($contenu_fichier, $email) !== false) {
      return true; // L'email existe
  } else {
      return false; // L'email n'existe pas
  }
}

function enregistrerDonneesUtilisateur($nom, $prenom, $dateNaissance, $sexe, $numeroEtudiant, $email) {
  $cheminFichier = "../Fichiers/data.txt";

  $dateFormatted = date("d-m-Y", strtotime($dateNaissance));
  $ligne = $nom . "|" . $prenom . "|" . $dateFormatted . "|" . $sexe . "|" . $numeroEtudiant . "|" . $email . "\n";

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
          $data = explode("|", $line);
          if (trim($data[5]) == $email) {
              fclose($handle);
              return [
                  'nom' => trim($data[0]),
                  'prenom' => trim($data[1]),
                  'dateNaissance' => trim($data[2]),
                  'type' => trim($data[3]),
                  'numeroEtudiant' => trim($data[4]),
                  'email' => trim($data[5])
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
          $data = explode("|", $line);
          if (trim($data[5]) == $email) {

              $newLine = "$nom|$prenom|$dateNaissance|$type|$numeroEtudiant|$email\n"; // creer  la nouvelle ligne avec les informations mise à jour
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


function updatePassword($email, $newPassword) {
  $fichier = "../Fichiers/logs.txt";
  $tempFile = "../Fichiers/temp.txt";
  $handle = fopen($fichier, 'r');
  $tempHandle = fopen($tempFile, 'w');

  if ($handle && $tempHandle) {
      while (($line = fgets($handle)) !== false) {
          $data = explode("|", $line);
          if (trim($data[0]) == $email) {
              $newLine = "$email|$newPassword\n";
              fputs($tempHandle, $newLine);
          } else {
              fputs($tempHandle, $line); 
          }
      }
      fclose($handle);
      fclose($tempHandle);

      if (!rename($tempFile, $fichier)) {
          echo "Erreur lors de la mise à jour du mot de passe.";
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
  $ligne = "$profession|$lieuResidence|$situationAmoureuse|$descriptionPhysique|$infosPersonnelles|$email";

  if (!file_exists($cheminFichier)) {
      $fichier = fopen($cheminFichier, 'w');
      fclose($fichier);
  }

  $lines = file($cheminFichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


  $emailFound = false;
  foreach ($lines as $key => $line) {
      $fields = explode("|", $line);
      if ($fields[count($fields) - 1] == $email) {
          $lines[$key] = $ligne; // modifie la ligne si le mail est trouvé
          $emailFound = true;
          break;
      }
  }

  if (!$emailFound) { // sinon on ajoute simplement la nouvelle ligne
      $lines[] = $ligne;
  }

  file_put_contents($cheminFichier, implode("\n", $lines). "\n");
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

          $data = explode("|", $line);
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


function getLast20Emails() {
  $lines = file("../Fichiers/logs.txt");
  $last20Lines = array_slice($lines, -20);
  $last20Emails = [];

  foreach ($last20Lines as $line) {
      $parts = explode("|", $line);
      $last20Emails[] = $parts[0];
  }

  return $last20Emails;
}


function trouverMotDePasseParEmail($email) {

  $fichier = fopen("../Fichiers/logs.txt", "r");
  if ($fichier) {
      while (($ligne = fgets($fichier)) !== false) {
          list($target_mail, $motDePasse) = explode('|', trim($ligne));

          if ($target_mail == $email) {
              fclose($fichier);
              return $motDePasse;
          }
      }
      fclose($fichier);
  }
  return null;
}


function calculateEndDate($type) {
  $date = new DateTime();
  switch ($type) {
      case 'monthly':
          $date->modify('+1 month');
          break;
      case 'quarterly':
          $date->modify('+3 months');
          break;
      case 'yearly':
          $date->modify('+1 year');
          break;
      case 'trial':
          $date->modify('+1 day');
          break;
  }
  return $date->format('Y-m-d');
}

function updatePremiumStatus($email, $isPremium) {
  $chemin_fichier = "../Fichiers/premium.txt";
  $status = $isPremium ? 'premium' : 'non premium';

  if (!file_exists($chemin_fichier)) {
      file_put_contents($chemin_fichier, "");
  }

  $lines = file($chemin_fichier, FILE_IGNORE_NEW_LINES);
  $found = false;
  $updatedContent = [];

  foreach ($lines as $line) {
      list($currentEmail, $statu) = explode("|", $line);
      if ($currentEmail === $email) {
          $updatedContent[] = "$email|$status";
          $found = true;
      } else {
          $updatedContent[] = $line;
      }
  }

  if (!$found) {
      $updatedContent[] = "$email|$status";
  }

  file_put_contents($chemin_fichier, implode("\n", $updatedContent));
}

function isUserPremium($email) {
    $filename = "../Fichiers/premium.txt";


    $file = fopen($filename, "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {  // Lis ligne par ligne
            list($userEmail, $status) = explode('|', trim($line));  // Sépare l'email de l'adjectif premium
            if ($userEmail === $email) { // compare l'email visé et l'email de la ligne
                fclose($file); 
                return $status === 'premium';  // Retourne vrai si l'utilisateur est premium ($status === 'premium' vaut true si il vaut preimium)
            }
        }
        fclose($file);
    }
    return false;
}

function getMessages($sender_email, $receiver_email) {
    $filePath = '../Fichiers/dm.txt';
    $messages = [];

    if (file_exists($filePath)) {
        $fileContent = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 
        
        foreach ($fileContent as $line) {
            $parts = explode('|', $line);
            list($sender, $receiver, $timestamp, $message) = $parts;
            $message = str_replace(array("\r", "\n"), '', $message);
            if (($sender === $sender_email && $receiver === $receiver_email) || ($sender === $receiver_email && $receiver === $sender_email)) {
                $messages[] = [
                    'sender_email' => $sender,
                    'receiver_email' => $receiver,
                    'timestamp' => $timestamp,
                    'message' => $message
                ];
            }
        }
    }

    return $messages;
}
function write_message_fichier($sender_email, $receiver_email, $timestamp, $message ){
    $filePath = '../Fichiers/dm.txt';
    $logMessage = $sender_email . "|" . $receiver_email . "|" . $timestamp . "|" . $message . "\n";
    file_put_contents($filePath, $logMessage, FILE_APPEND | LOCK_EX);   // Lock_ex utile pour eviter des données corrompues ou incomplete
    header("Location: dm.php?email=" . urlencode($receiver_email) . "&status=success");
}