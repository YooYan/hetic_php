<?php
session_start();
require('bdd.php');

$AfficherFormulaire=1;

if(isset($_POST['pseudo'],$_POST['prenom'],$_POST['nom'],$_POST['mail'],$_POST['mdp'])){

    if(empty($_POST['pseudo'])){//le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "Le champ Pseudo est vide.";
    }

    elseif(empty($_POST['prenom'])){//le champ mot de passe est vide
        echo "Le champ Prenom est vide.";
    }

    elseif(empty($_POST['nom'])){//le champ mot de passe est vide
        echo "Le champ Nom est vide.";
    }

    elseif(empty($_POST['mail'])){//le champ mot de passe est vide
        echo "Le champ Mail est vide.";
    }

    elseif(empty($_POST['mdp'])){//le champ mot de passe est vide
        echo "Le champ Mot de passe est vide.";
    }

    elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='".$_POST['pseudo']."'")) ==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
        echo "Ce pseudo est déjà utilisé.";
    } 

    else {

        if(!mysqli_query($mysqli,"INSERT INTO membres SET pseudo='".$_POST['pseudo']."',prenom='".$_POST['prenom']."',nom='".$_POST['nom']."',mail='".$_POST['mail']."', mdp='".md5($_POST['mdp'])."'")){
            echo "Une erreur s'est produite: ".mysqli_error($mysqli);
        } else {
            echo "Vous êtes inscrit avec succès!";
            header('Location: connexion.php');
        }
    }
}
if($AfficherFormulaire==1){
    ?>
    <head> 
        <link rel="stylesheet" href="css/inscription.css" type="text/css"> 
    </head>

    <form method="post" action="inscription.php">
        <div class="login-page">
            <div class="form">
                <input type="text" placeholder="Prenom" name="prenom"/>
                <input type="text" placeholder="Nom" name="nom"/>
                <input type="mail" placeholder="Mail" name="mail"/>
                <input type="text" placeholder="Pseudo" name="pseudo"/>
                <input type="password" placeholder="Mot de passe" name="mdp"/>
                <button>Inscription</button>
                <p class="message">Déja enrengistré? <a href="connexion.php">Inscription</a></p>
            </div>
        </div>        
    </form>
    <?php
}
?>
