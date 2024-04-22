<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="connexion.css" type="text/css">
</head>
<body>
    <div class="top-bar">
        <img src="https://tse4.mm.bing.net/th?id=OIP.y52QrvFkK2sK_g8YtkLf5QHaCd&pid=Api" class="logo">
        <ul>   
            <li><a href="accueil.html">Accueil</a></li>
            <li><a href="connexion.html">Se connecter</a></li>
            <li><a href="inscription.html">Inscription</a></li>
        </ul>
    </div>
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
                <hr>Ou bien vous n'avez pas de compte ? Dans ce cas là inscrivez-vous <a href="inscription.html">ici.</a>
                <hr><a href="mot_de_passe_oublier.html">Mot de passe oublier ?</a>
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