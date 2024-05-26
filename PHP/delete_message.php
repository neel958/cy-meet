<?php
session_start();
include 'functions.php';


if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Vous n\'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
    exit();
}
if (!checkPremium($_SESSION['user_email'])) {
    echo "<script>alert(\"Votre abonnement a expiré ou vous n'êtes pas un utilisateur premium\"); window.location.href = 'abonnement.php';</script>";
    exit();
}
$sender_email = $_GET['sender_email'] ?? null;      // si les parametres n'existent pas, on leur assigne null
$receiver_email = $_GET['receiver_email'] ?? null;
$timestamp = $_GET['timestamp'] ?? null;
$message = $_GET['message'] ?? null;

if (Suppmsg($sender_email, $receiver_email, $timestamp, $message)) {
    echo "Message supprimé avec succès>";    //section reseau onglet reponses
} 
else {
    echo"Erreur lors de la suppression du message";
}
?>
