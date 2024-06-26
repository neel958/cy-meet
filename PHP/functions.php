<?php
date_default_timezone_set('Europe/Paris');
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
    $email = pasdebarre($email);
    $mdp = pasdebarre($mdp);
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
  foreach ($tableau as $utilisateur) {
      if ($utilisateur["email"] == $email && $utilisateur["mot_de_passe"] == $mot_de_passe) {
          $_SESSION['user_email'] = $email;
          header("Location: accueil_connecté.php");  // Redirection vers la page d'accueil connecté si la verification est correcte
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

function enregistrerDonneesUtilisateur($nom, $prenom, $dateNaissance, $type, $numeroEtudiant, $email) {
    $nom = pasdebarre($nom);
    $prenom = pasdebarre($prenom);
    $type = pasdebarre($type);
    $numeroEtudiant = pasdebarre($numeroEtudiant);
    $email = pasdebarre($email);
    $cheminFichier = "../Fichiers/data.txt";

    $dateFormatted = date("d-m-Y", strtotime($dateNaissance));
    $ligne = $nom . "|" . $prenom . "|" . $dateFormatted . "|" . $type . "|" . $numeroEtudiant . "|" . $email . "\n";

    if (!file_exists($cheminFichier)) {
        $fichier = fopen($cheminFichier, 'w'); // Création du fichier si non existant
        fclose($fichier);
    }

    $contenuFichier = file_get_contents($cheminFichier);
    if (strpos($contenuFichier, $ligne) !== false) {
        // Si les données sont déjà présentes, ne rien faire
        return;
    }

    file_put_contents($cheminFichier, $ligne, FILE_APPEND);    // Si les données ne sont pas encore dans le fichier, les ajouter
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
    $email = pasdebarre($email);
    $nom = pasdebarre($nom);
    $prenom = pasdebarre($prenom);
    $type = pasdebarre($type);
    $numeroEtudiant = pasdebarre($numeroEtudiant);
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
    $email = pasdebarre($email);
    $newPassword = pasdebarre($newPassword);
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
    $email = pasdebarre($email);
    $profession = pasdebarre($profession);
    $lieuResidence = pasdebarre($lieuResidence);
    $situationAmoureuse = pasdebarre($situationAmoureuse);
    $descriptionPhysique = pasdebarre($descriptionPhysique);
    $infosPersonnelles = pasdebarre($infosPersonnelles);
    $cheminFichier = "../Fichiers/additionnel_info.txt";
    $ligne = "$profession|$lieuResidence|$situationAmoureuse|$descriptionPhysique|$infosPersonnelles|$email";

    if (!file_exists($cheminFichier)) {
        $fichier = fopen($cheminFichier, 'w');
        fclose($fichier);
    }

    $lines = file($cheminFichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


    $emailFound = false;
    foreach ($lines as $key => $line) {
        $neymar = explode("|", $line);
        if ($neymar[count($neymar) - 1] == $email) {
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
          $date->modify('+2 minutes');
          break;
  }
  return $date->format('Y-m-d H:i:s');
}

function updatePremiumStatus($email, $isPremium, $endDate = null) {
    $email = pasdebarre($email);
    $chemin_fichier = "../Fichiers/premium.txt";
    $status = $isPremium ? 'premium' : 'non premium';
    if (!file_exists($chemin_fichier)) {
        file_put_contents($chemin_fichier, "");
    }

    $lines = file($chemin_fichier, FILE_IGNORE_NEW_LINES);
    $found = false;
    $updatedContent = [];

    foreach ($lines as $line) {
        list($mail_actuelle, $statut_actuelle, $date_actuelle) = explode("|", $line);
        if ($mail_actuelle === $email) {
            $newEndDate = $endDate ? $endDate : $date_actuelle;
            $updatedContent[] = "$email|$status|$newEndDate";
            $found = true;
        } else {
            $updatedContent[] = $line;
        }
    }

    if (!$found) {
        $newEndDate = $endDate ? $endDate : date('Y-m-d H:i:s');
        $updatedContent[] = "$email|$status|$newEndDate";
    }

    file_put_contents($chemin_fichier, implode("\n", $updatedContent));
}

function checkpremium($email) {
    $filename = "../Fichiers/premium.txt";
    $date = new DateTime();
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        list($userEmail, $status, $endDate) = explode("|", $line);
        if ($userEmail === $email) {
            $endDateObj = new DateTime($endDate);   // creer un objet pour la date d'expriation
            if ($date > $endDateObj) {              // compare la date actuelle avec la date de fin de l'abonnement
                updatePremiumStatus($email, false, $endDateObj->format('Y-m-d H:i:s')); // si la date d'abonnement de l'utilisateur a expiré, modifier son statut dans la base de donnée
                return false;
            }
            return $status === 'premium';
        }
    }
    return false;
}




function isUserPremium($email) {
    $filename = "../Fichiers/premium.txt";
    $file = fopen($filename, "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {                  // Lis ligne par ligne
            list($userEmail, $status) = explode('|', trim($line));  // Sépare l'email de l'adjectif premium
            if ($userEmail === $email) {                            // compare l'email visé et l'email de la ligne
                fclose($file); 
                return $status === 'premium';                       // Retourne vrai si l'utilisateur est premium ($status === 'premium' vaut true si il vaut preimium)
            }
        }
        fclose($file);
    }
    return false;
}

function getMessages($sender_email, $receiver_email) {
    $filePath = '../Fichiers/dm.txt';
    $messages = [];

    if (!file_exists($filePath)) {
        $fichier = fopen($filePath, 'w');
        fclose($fichier);
    }
    if (file_exists($filePath)) {
        $fileContent = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 
        foreach ($fileContent as $line) {
            $parts = explode('|', $line);
            list($sender, $receiver, $timestamp, $message) = $parts;
            $message = str_replace(array("\r", "\n"), '', $message);    // enleve les sauts de lignes et les remplace par un vide
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
    $sender_email = pasdebarre($sender_email);
    $receiver_email = pasdebarre($receiver_email);
    $timestamp = pasdebarre($timestamp);
    $message = pasdebarre($message);
    $filePath = '../Fichiers/dm.txt';
    $logMessage = $sender_email . "|" . $receiver_email . "|" . $timestamp . "|" . $message . "\n";
    file_put_contents($filePath, $logMessage, FILE_APPEND | LOCK_EX);   // Lock_ex utile pour eviter des données corrompues ou incomplete
    header("Location: dm.php?email=" . urlencode($receiver_email) . "&status=success");
}

function Suppmsg($sender_email, $receiver_email, $timestamp, $message) {
    $sender_email = pasdebarre($sender_email);
    $receiver_email = pasdebarre($receiver_email);
    $timestamp = pasdebarre($timestamp);
    $message = pasdebarre($message);
    $filePath = "../Fichiers/dm.txt";
    $new = [];
    $found = false;
    if (!file_exists($filePath)) {
        $fichier = fopen($filePath, 'w');
        fclose($fichier);
    }

    else if(file_exists($filePath)) {
        $filecontent = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($filecontent as $line) {
            list($fileSender, $fileReceiver, $fileTimestamp, $fileMessage) = explode("|", $line);
            if ($fileSender == $sender_email && $fileReceiver == $receiver_email && $fileTimestamp == $timestamp && $fileMessage == $message) {
                $found = true;
                continue;   // continue va passer au compteur suivant de foreach, la ligne à supprimer ne sera donc pas ajouté dans $new
            }
            $new[] = $line;  // si la ligne n'est pas le message à supprimer, alors l'ajouter à $new
        }

        if ($found) {   // si le message a supprimer a été trouver alors on reecrit le fichier
            $mbappe = implode("\n", $new) . (count($new) > 0 ? "\n" : "");  // saut de ligne conditionnel : ca compte le nombre de ligne et si il y en a une, il y a un saut de ligne, si il n'y a pas de ligne (fichier vide) on ne fait rien
            file_put_contents($filePath, $mbappe);         // on ajoute $new (tableau contenant le fichier sans la ligne à reecrire) en separant chaque ligne d'un saut de ligne
            return true;
        } else {

            return false;  // sinon on  retourne false
        }
    }

    return false;
}


function pasdebarre($str){
    return str_replace("|", "l", $str);     // remplace les | par des L minuscule pour eviter tout probleme dans les données (le séparateur etant |)
}