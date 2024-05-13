<!DOCTYPE html>

<html>
    <head>
    
<?php 
if(isset($_POST['Modèle_du_véhicule'], $_POST['Photo_du_véhicule'],  $_POST['Numéro_de_permis_de_conduire'], $_POST['Date_de_délivrance_du_permis_de_conduire'], , $_POST['Photo_du_permis_de_conduire'],  $_POST['Préférences_de_voyage'])){
    $Modèle_du_véhicule = htmlspecialchars($_POST['Modèle_du_véhicule']);
    $Photo_du_véhicule = htmlspecialchars($_POST['Photo_du_véhicule']);
    $Numéro_de_permis_de_conduire = htmlspecialchars($_POST['Numéro_de_permis_de_conduire']);
    $Date_de_délivrance_du_permis_de_conduire = htmlspecialchars($_POST['Date_de_délivrance_du_permis_de_conduire']);
    $Photo_du_permis_de_conduire = htmlspecialchars($_POST['Photo_du_permis_de_conduire']);
    $Préférences_de_voyage = htmlspecialchars($_POST['Préférences_de_voyage']);

}

?>
    </head>

</html> 