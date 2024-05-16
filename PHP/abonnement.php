<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement</title>
    <link rel="stylesheet" href="../css/abonnement.css" type="text/css">
</head>
<body>
<h1>Choisissez votre abonnement</h1>
<form action="process_paiement.php" method="POST">
    Version d'essai - 24 heures à 0.99€ <input type="radio" id="trial" name="subscription" value="trial"><br>
    Abonnement mensuel - 10€/mois <input type="radio" id="monthly" name="subscription" value="monthly"><br>
    Abonnement trimestriel - 27€/trimestre <input type="radio" id="quarterly" name="subscription" value="quarterly"><br>
    Abonnement annuel - 100€/an <input type="radio" id="yearly" name="subscription" value="yearly"><br>
    <button type="submit">S'abonner</button>
</form>

</body>
</html>