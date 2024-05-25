<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie Privée</title>
    <link rel="stylesheet" href="../css/dm.css" type="text/css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js" type="text/javascript"></script>
</head>
<body>
    <h1>Messagerie Privée</h1>
    
    <?php
        include 'functions.php';
        if (!isset($_SESSION['user_email'])) {
            echo "<script>alert('Vous n\'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
            exit();
        }

        $sender_email = $_SESSION['user_email'];
        $receiver_email = $_GET['email'] ?? '';
        if (!checkPremium($sender_email)) {
            echo "<script>alert('Votre abonnement a expiré ou vous n\'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
            exit();
        }

        $tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Messagerie" => "messagerie.php", "Deconnexion" => "deconnexion.php");
        top_bar($tableau);
        echo "<h2>Conversation avec " . $receiver_email . "</h2>"; 

        $messages = getMessages($sender_email, $receiver_email);
        echo "<div id='messageBox'>"; 
        foreach ($messages as $message) {
            $timestamp = htmlspecialchars($message['timestamp'], ENT_QUOTES);           // htmlspecialchars et ent_quotes pour eviter les problèmes avec les apostrophes, sinon le message ne se supprime pas
            $senderEmail = htmlspecialchars($sender_email, ENT_QUOTES);
            $receiverEmail = htmlspecialchars($receiver_email, ENT_QUOTES);
            $messageContent = htmlspecialchars($message['message'], ENT_QUOTES);
            $class = ($message['sender_email'] == $sender_email ? "sent" : "received"); // attribue la classe selon le type de message
            echo "<div class='message $class' data-message='{$messageContent}'>";       // data-message est un attribut de donnéess, ici on lui donne la valeur du message
            echo "<p>" . $message['message'] . "</p>";
            if ($message['sender_email'] == $sender_email) {
                echo "<div class='delete_msg' onclick='supp_msg(\"" . $timestamp . "\", \"" . $senderEmail . "\", \"" . $receiverEmail . "\", this)'>&#128465;</div>";
            }
            echo "</div>";
        }
        echo "</div>";

        echo "<form action='send_message.php' method='post'>
        <input type='hidden' name='receiver_email' value='" . $receiver_email . "'>
        <textarea name='message' required placeholder='Écrivez votre message ici...'></textarea><br>
        <input type='submit' value='Envoyer'>
        </form>";
    ?>

</body>
</html>
