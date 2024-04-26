<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/connexion.css" type="text/css">
</head>
<body>
<?php 
  include 'top_bar.php';
  top_bar(); 
?>
    <div class="formulaire">
        <h2>Connexion</h2>
        <form method="post" action="connexion.php" >
            <div class="champ">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="champ">
                <input type="password" name="password" id="jsp" placeholder="Mot de passe" required>
                <img src="https://tse2.mm.bing.net/th?id=OIP.dadmIJUfMNKr8IJhXPxYqwHaFj&pid=Api" class="mdp_visible" onclick="mdp_visble()">
                
            </div>
            <div>
                <button type="submit">Se connecter</button>
                <hr>Ou bien vous n'avez pas de compte ? Dans ce cas là inscrivez-vous <a href="inscription.php">ici.</a>
                </form>
            </div>

      <script>
            function mdp_visble() {
                var temp = document.getElementById("jsp");
                if (temp.type === "password") {
                    temp.type = "text";
                }
                else {
                    temp.type = "password";
                }
            }
    </script>
</body>
</html>