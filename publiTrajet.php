<!DOCTYPE html>
<?php
require_once("config.php");
?>
<html lang= "fr">
<html>
<head>
<title > BlablaOMNES.com </title >
<meta charset= " UTF-8 ">
<link rel= " stylesheet " href= "creationCompte.css">
<div class= " feetpage ">Publier un nouveau trajet</div >
</head>

    <body>

<form method="post" action="formulaireVerifPubliTrajet.php">

<br>
Adresse de départ:<input type="text" name="Adresse_de_départ"><br>
<br>
Adresse d'arrivée:<input type="text" name="Adresse_d'arrivée"><br>
<br>

Sélectionnez votre trajet :

    <form method="post" action="traitement.php">
        <div>
        <input type="checkbox" name="aller" id="aller">
        <label for="aller">Aller</label>
        <br>
        </div>
        <div>
        <input type="checkbox" name="retour" id="retour">
        <label for="retour">Retour</label>
        <br>
        </div>
        <div>
        <input type="checkbox" name="Aller et retour" id="Aller et retour">
        <label for="Aller et retour">Aller et retour</label>
        <br>
        </div>
    
    </form>

<br>
Prix du trajet par personne:<input type="text" name="Prix_du_trajet_par_personne">€<br>
<br>


        <input type="submit" value="Publier un trajet">

        <p><a href="formulaireVerifPubliTrajet.php?"></p>

    
</body>
</html>