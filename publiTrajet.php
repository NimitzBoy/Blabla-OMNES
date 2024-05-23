<!DOCTYPE html>
<?php
require_once("config.php");
?>
<html lang= "fr">
<html>
    <head>
        <title > BlablaOMNES.com </title >
        <meta charset= " UTF-8 ">
        <link rel= " stylesheet " href= "designCreationCompte.css">
        <div class= " feetpage ">Publier un nouveau trajet</div >
    </head>
    <body>
        <form method="post" action="AjoutTrajet.php">
            <br>
            Adresse de départ:<input type="text" name="Adresse_de_départ"><br>
            <br>
            Adresse d'arrivée:<input type="text" name="Adresse_d'arrivée"><br>
            <br>
            Date de départ:<input type="date" name="Date_départ"><br>
            <br>
            Sélectionnez votre trajet :
            <div>
                <input type="radio" name="type_trajet" id="aller" value="Aller" required>
                <label for="aller">Aller</label>
                <br>
            </div>
            <div>
                <input type="radio" name="type_trajet" id="retour" value="Retour" required>
                <label for="retour">Retour</label>
                <br>
            </div>
            <div>
                <input type="radio" name="type_trajet" id="aller_retour" value="Aller et retour" required>
                <label for="aller_retour">Aller et retour</label>
                <br>
            </div>
            <br>
            Prix du trajet par personne:<input type="text" name="Prix_du_trajet_par_personne">€<br>
            <br>
            <input type="submit" value="Publier un trajet">
        </form>
        <p><a href="formulaireVerifPubliTrajet.php?"></p>
    </body>
</html>