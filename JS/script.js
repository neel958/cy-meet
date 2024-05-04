function mdp_visble1() {
    var temp = document.getElementById("mdp1");
    if (temp.type === "password") {
      temp.type = "text";
    }
    else {
        temp.type = "password";
    }
}

function mdp_visble2() {
    var temp = document.getElementById("mdp2");
    if (temp.type === "password") {
        temp.type = "text";
    }
    else {
        temp.type = "password";
    }
  
}
function mdp_visble() {
    var temp = document.getElementById("mdp");
    if (temp.type === "password") {
        temp.type = "text";
    }
    else {
        temp.type = "password";
    }
}

function no_space() {
    let mdp = document.getElementById('mdp1').value;
    if (mdp.includes(' ')) { // verifie si le mdp a un espace
        alert('Espace interdit');
        location.reload(); // actualise la page
    }
    else{
        same_password(); // si il n'y a pas d'espace, on regarde si ils sont identiques
    }
    
}

function same_password(){
    let mdp1 = document.getElementById('mdp1').value;
    let mdp2 = document.getElementById('mdp2').value;
    if(mdp1!==mdp2){
        alert('Les mots de passe ne sont pas identiques.');
        location.reload(); // actualise la page
    } 
}
