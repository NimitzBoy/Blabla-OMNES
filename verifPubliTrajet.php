<!DOCTYPE html>

<html>
    <head>
    
<?php 
if(isset($_POST['Adresse_de_départ'], $_POST['Adresse_d'arrivée'],  $_POST['Aller'], $_POST['Retour'], $_POST['Aller et retour'], $_POST['Prix_du_trajet_par_personne'])){
    $Adresse_de_départ = htmlspecialchars($_POST['Adresse_de_départ']);
    $Adresse_d'arrivée = htmlspecialchars($_POST['Adresse_d'arrivée']);
    $Aller = htmlspecialchars($_POST['Aller']);
    $Retour = htmlspecialchars($_POST['Retour']);
    $Aller et retour = htmlspecialchars($_POST['Aller et retour']);
    $Prix_du_trajet_par_personne = htmlspecialchars($_POST['Prix_du_trajet_par_personne']);

  if ( $_POST['Adresse_de_départ']=="Campus Omnes" && $_POST['Adresse_d'arrivée']=="Campus Omnes"){
    $_SESSION['Adresse_de_départ']=$_POST['Adresse_de_départ'];
    $_SESSION['Adresse_d'arrivée']=$_POST['Adresse_d'arrivée'];
    $_SESSION['Aller']=$_POST['Aller'];
    $_SESSION['Retour']=$_POST['Retour'];
    $_SESSION['Aller et retour']=$_POST['Aller et retour'];
    $_SESSION['Prix_du_trajet_par_personne']=$_POST['Prix_du_trajet_par_personne'];
    
    echo "publication en cours...";
  } 
    
  else{
     echo "la publication de votre trajet n'a pas aboutie";
}
}

?>
    </head>

</html> 