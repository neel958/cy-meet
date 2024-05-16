<?php 
    include 'functions.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["email"]) && isset($_POST["motDePasse"])) {
        verifie_identifiant();
    }
