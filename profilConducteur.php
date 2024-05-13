<!DOCTYPE html>
<html lang= "fr">
<html>

<head>
<title > BlablaOMNES.com </title >
<meta charset= " UTF-8 ">
<link rel= " stylesheet " href= "creationCompte.css">
<div class= " feetpage ">Créer un profil conducteur</div >
</head>


    <body>
    
<form method="post" action="formulaireVerifProfilConducteur.php">
<br>
Modèle du véhicule:<div><input type="text" name="Modèle_du_véhicule"><br></div>
<br>
Photo du véhicule:<div><form action="/upload" method="post" enctype="multipart/form-data">
                        <label for="fileInput"></label>
                        <input type="file" id="fileInput" name="file">
                        </form></div>
<br>
Numéro de permis de conduire:<div><input type="text" name="Numéro_de_permis_de_conduire"><br></div>
<br>
Date de délivrance du permis de conduire:<div><input type="text" name="Date_de_délivrance_du_permis_de_conduire"><br></div>
<br>
Photo du permis de conduire:<div><form action="/upload" method="post" enctype="multipart/form-data">
                            <label for="fileInput"></label>
                            <input type="file" id="fileInput" name="file">
                            </form><div>
<br>
Préférences de voyage:<div><input type="password" name="Préférences_de_voyage"><br></div>
<br>

        <form method="post" action="login_conducteur.php">
            <button type="submit">Valider</button>
</form>

        <p><a href="formulaireVerifProfilConducteur.php?"></p>

</body>
</html>