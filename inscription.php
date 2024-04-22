<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscirption</title>
    <link rel="stylesheet" href="inscription.css" type="text/css">
</head>
<body>
<?php 
  include 'top_bar.php'; 
?>

    <form>
        <h2>Inscription</h2>
        <div class="champ">
          <input type="text" name="nom" placeholder="Nom" required>
        </div>
        <div class="champ">
          <input type="text" name="prenom" placeholder="Prénom" required>
        </div>
        <div class="champ">
          <input type="date" id="dateNaissance" name="dateNaissance" placeholder="Date de naissance" required>
        </div>
        <div class="champ">
          <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="champ">
          <input type="password" id="jsp1"  name="motDePasse" placeholder="Mot de passe" required>
          <img src="https://tse2.mm.bing.net/th?id=OIP.dadmIJUfMNKr8IJhXPxYqwHaFj&pid=Api" class="mdp_visible1" onclick="mdp_visble1()">
        </div>
        <div class="champ">
          <input type="password" id="jsp2" name="confirmationMotDePasse" placeholder="Confirmation du mot de passe" required>
          <img src="https://tse2.mm.bing.net/th?id=OIP.dadmIJUfMNKr8IJhXPxYqwHaFj&pid=Api" class="mdp_visible2" onclick="mdp_visble2()">
        </div>
        <div class="champ">
          <input type="text" id="numeroEtudiant" name="numeroEtudiant" placeholder="Numéro d'étudiant" pattern="[0-9]{11}" required>
        </div>
        <button type="submit">S'inscrire</button>
        <hr>Ou bien vous avez déjà un compte ? Dans ces cas là connextez-vous <a href="connexion.html">ici</a>
      </form>
      <script>
        function mdp_visble1() {
            var temp = document.getElementById("jsp1");
            if (temp.type === "password") {
                temp.type = "text";
            }
            else {
                temp.type = "password";
            }
        }
        function mdp_visble2() {
            var temp = document.getElementById("jsp2");
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