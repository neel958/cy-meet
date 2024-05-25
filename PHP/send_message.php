<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Vous n\'êtes pas connecté.'); window.location.href = 'connexion.php';</script>";
    exit();
}
if (isset($_POST['receiver_email'], $_POST['message'])) {
    $sender_email = $_SESSION['user_email'];
    $receiver_email = $_POST['receiver_email'];
    $timestamp = date('Y-m-d H:i:s');
    $message = strip_tags($_POST['message']); 
    $message = str_replace(array("\r", "\n"), ' ', $message);  // remplace les sauts de ligne par des espaces, sinon il y a un problème dans le fichier dm.txt
    write_message_fichier($sender_email, $receiver_email, $timestamp, $message);
} else {
    header("Location: dm.php?status=error");
}
?>
