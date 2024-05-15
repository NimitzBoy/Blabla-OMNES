<!DOCTYPE html>
<?php
require_once("config.php");
?>
<html>
    <head>
    
<?php 
if(isset($_POST['Nom'], $_POST['Prénom'],  $_POST['Adresse_mail'], $_POST['Numéro_de_téléphone'], , $_POST['Photo_de_profil'],  $_POST['Mot_de_passe'], $_POST['Confirmation_du_mot_de_passe'])){
    $Nom = htmlspecialchars($_POST['Nom']);
    $Prénom = htmlspecialchars($_POST['Prénom']);
    $Adresse_mail = htmlspecialchars($_POST['Adresse_mail']);
    $Numéro_de_téléphone = htmlspecialchars($_POST['Numéro_de_téléphone']);
    $Photo_de_profil = htmlspecialchars($_POST['Photo_de_profil']);
    $Mot_de_passe = htmlspecialchars($_POST['Mot_de_passe']);
    $Confirmation_du_mot_de_passe = htmlspecialchars($_POST['Confirmation_du_mot_de_passe']);
}

?>
    </head>

</html> 