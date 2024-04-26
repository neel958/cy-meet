<?php

function top_bar(){
    echo("<div class='top-bar'>
    <img src='../Images\CY Cergy Paris Universite_coul.jpg' class = 'logo'>
    <ul>   
        <li><a href='accueil.php'>Accueil</a></li>
        <li><a href='connexion.php'>Se connecter</a></li>
        <li><a href='inscription.php'>Inscription</a></li>

    </ul>
</div>");
}



function formulaire_inscription(){
    echo("<form>
    <h2>Inscription</h2>
    <div class='champ'>
      <input type='text' name='nom' placeholder='Nom' required>
    </div>
    <div class='champ'>
      <input type='text' name='prenom' placeholder='Prénom' required>
    </div>
    <div class='champ'>
      <input type='date' id='dateNaissance' name='dateNaissance' placeholder='Date de naissance' required>
    </div>
    <div class='champ'>
      <input type='email' id='email' name='email' placeholder='Email' required>
    </div>
    <div class='champ'>
      <input type='password' id='jsp1'  name='motDePasse' placeholder='Mot de passe' required>
      <img src='https://tse2.mm.bing.net/th?id=OIP.dadmIJUfMNKr8IJhXPxYqwHaFj&pid=Api' class='mdp_visible1' onclick='mdp_visble1()'>
    </div>
    <div class='champ'>
      <input type='password' id='jsp' name='confirmationMotDePasse' placeholder='Confirmation du mot de passe' required>
      <img src='https://tse2.mm.bing.net/th?id=OIP.dadmIJUfMNKr8IJhXPxYqwHaFj&pid=Api' class='mdp_visible2' onclick='mdp_visble2()'>
    </div>
    <div class='champ'>
      <input type='text' id='numeroEtudiant' name='numeroEtudiant' placeholder='Numéro d'étudiant' pattern='[0-9]{11}' required>
    </div>
    <button type='submit'>S'inscrire</button>
    <hr>Ou bien vous avez déjà un compte ? Dans ces cas là connextez-vous <a href='connexion.php'>ici</a>
  </form>");
}

function formulaire_connexion(){
    echo("<div class='formulaire'>
    <h2>Connexion</h2>
    <form method='post' action='connexion.php' >
        <div class='champ'>
            <input type='email' id='email' name='email' placeholder='Email' required>
        </div>
        <div class='champ'>
            <input type='password' name='password' id='jsp' placeholder='Mot de passe' required>
            <img src='https://tse2.mm.bing.net/th?id=OIP.dadmIJUfMNKr8IJhXPxYqwHaFj&pid=Api' class='mdp_visible' onclick='mdp_visble()'>
            
        </div>
        <div>
            <button type='submit'>Se connecter</button>
            <hr>Ou bien vous n'avez pas de compte ? Dans ce cas là inscrivez-vous <a href='inscription.php'>ici.</a>
            </form>
        </div>");
}

