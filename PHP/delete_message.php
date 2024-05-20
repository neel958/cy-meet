<?php
session_start();
include 'functions.php';


if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Vous n'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
    exit();
}

$sender_email = $_GET['sender_email'] ?? null;      // si les parametres n'existent pas, on leur assigne null
$receiver_email = $_GET['receiver_email'] ?? null;
$timestamp = $_GET['timestamp'] ?? null;
$message = $_GET['message'] ?? null;

if (Suppmsg($sender_email, $receiver_email, $timestamp, $message)) {
    echo "<script>alert('Message supprimé avec succès.');</script>";
} 
else {
    echo("<script>alert('Erreur lors de la suppression du message')</script>");
}


?>
