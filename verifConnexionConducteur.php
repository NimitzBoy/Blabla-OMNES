<!DOCTYPE html>
<?php
require_once("config.php");
?>
<html>
    <head>

<?php 
if(isset($_POST['Adresse_mail'], $_POST['Mot_de_passe'])){
    $Adresse_mail = htmlspecialchars($_POST['Adresse_mail']);
    $Mot_de_passe = htmlspecialchars($_POST['Mot_de_passe']);
}

?>
    </head>

</html>