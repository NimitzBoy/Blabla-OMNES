<!DOCTYPE html>
<html lang= "fr">
<html>
<?php
require_once("config.php");
?>
<head>
<title > BlablaOMNES.com </title >
<meta charset= " UTF-8 ">
<link rel= " stylesheet " href= "designCreationCompte.css">
<div class= " feetpage ">Créer un compte</div ><br>
</head>

<body>

<form method="post" action="AjoutCompte.php">
        Nom: <input type="text" name="nom"><br><br>
        Prénom: <input type="text" name="prenom"><br><br>
        Numéro de téléphone: <input type="text" name="Numero_de_telephone"><br><br>
        Adresse mail: <input type="text" name="adresseMail"><br><br>
        Mot de passe: <input type="password" name="motDePasse"><br><br>
        <button type="submit">Valider</button>
</form>
</body>
</html>