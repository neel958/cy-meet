<?php
include 'functions.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['user_email'])){
        $email = $_SESSION['user_email'];
        $type = $_POST['subscription'];
        $_SESSION['user_status'] = $type;
        $date_fin = calculateEndDate($type);
        $is_premium = true;
        updatePremiumStatus($email, $is_premium, $date_fin);
        header("Location: accueil_connecté.php");
        exit();
        }
    else{
        header("Location: connexion.php");
        exit();
    }
}


?>