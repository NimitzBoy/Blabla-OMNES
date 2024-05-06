<?php

if (isset($_POST['mail'],$_POST['password'])){
    $prenom = htmlspecialchars($_POST['mail']);
    $nom = htmlspecialchars($_POST['password']);

    if (($_POST['mail'] == "william.richard@edu.ece.fr" && $_POST['password'] == "Vernantes.49") ||
    ($_POST['mail'] == "mathilde.portefaix@edu.ece.fr" && $_POST['password'] == "Paulpetit") ||
    ($_POST['mail'] == "arnaud.pechier@edu.ece.fr" && $_POST['password'] == "jaimeleshommes69")
    ) {hjfhjyf
    echo "Login correct";
        
    

    }else{
        echo "Login incorrect";
    }

}

?>
