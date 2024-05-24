<!DOCTYPE html>
<?php
require_once("config.php");
?>
<html>
    <head>
    
<?php 
if(isset($_POST['Nom'], $_POST['Prenom'],  $_POST['Type_de_profil'])){
    $Nom = htmlspecialchars($_POST['Nom']);
    $Prenom = htmlspecialchars($_POST['Prenom']);
    $Type_de_profil = htmlspecialchars($_POST['Type_de_profil']);
}

?>
    </head>

</html> 