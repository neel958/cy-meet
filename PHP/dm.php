<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie Privée</title>
    <link rel="stylesheet" href="../css/dm.css" type="text/css" >
</head>
<body>
    <h1>Messagerie Privée</h1>
    <?php
        session_start();
        include 'functions.php';
        $tableau = array("Accueil" => "accueil_connecté.php", "Profil" => "profil.php", "Messagerie" => "messagerie.php", "Deconnexion" => "deconnexion.php");
        top_bar($tableau); 
        
        if (!isset($_SESSION['user_email'])) {
            echo "<script>alert('Vous n'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
            exit();
        }

        $sender_email = $_SESSION['user_email'];
        $receiver_email = $_GET['email'] ?? ''; 

        echo "<h2>Conversation avec " . $receiver_email . "</h2>"; 

        $messages = getMessages($sender_email, $receiver_email);
        echo "<div id='messageBox'>"; 
        foreach ($messages as $message) {
            $class = ($message['sender_email'] == $sender_email ? "sent" : "received");
            echo "<div class='message $class'>"; 
            echo "<p>" . $message['message'] . "</p>";
            echo "</div>";
        }
        echo "</div>";

        echo "<form action='send_message.php' method='post'>";
        echo "<input type='hidden' name='receiver_email' value='" . $receiver_email . "'>";
        echo "<textarea name='message' required placeholder='Écrivez votre message ici...'></textarea><br>";
        echo "<input type='submit' value='Envoyer'>";
        echo "</form>";
    ?>

</body>
</html>
