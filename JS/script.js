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
function supp_msg(timestamp, senderEmail, receiverEmail, element) {
    var messageContent = $(element).closest('.message').data('message');    // closest va chercher le premier parent à la classe message, data va chercher la valeur dans l'attribut de données, on cherche donc le contenu du message
    if (confirm('Voulez-vous vraiment supprimer ce message ?')) {           // pop up de validation
        $.ajax({
            url: "../php/delete_message.php",
            type: "GET",
            data: {
                timestamp: timestamp,
                sender_email: senderEmail,
                receiver_email: receiverEmail,
                message: messageContent
            },
            success: function() {
                $(element).closest('.message').fadeOut(1000, function() { $(this).remove(); });     // reduit l'opacité sur une seconde afin d'ajouter un effet visuelle
            },
            error: function() {
                console.error('Erreur lors de la suppression du message.');
            }
        });
    }
}
