<!DOCTYPE html>
<html lang= "fr">
<html>

<head>
<title > BlablaOMNES.com </title >
<meta charset= " UTF-8 ">
<link rel= " stylesheet " href= "designCreationCompte.css">
<div class= " feetpage ">Créer un compte</div >
</head>

<body>

<form method="post" action="formulaireVerifCreationCompte.php">

<br>
Nom:<div><input type="text" name="Nom"><br></div>
<br>
Prénom:<div><input type="text" name="Prénom"><br></div>
<br>
Adresse mail:<div><input type="text" name="Adresse_mail"><br></div>
<br>
Numéro de téléphone:<div><input type="text" name="Numéro_de_téléphone"><br></div>
<br>
Photo de profil:<form action="/upload" method="post" enctype="multipart/form-data">
  <label for="fileInput"></label>
  <input type="file" id="fileInput" name="file">
</form>
<br>
Mot de passe:<div><input type="password" name="Mot_de_passe"><br></div>
<br>
Confirmation du mot de passe:<div><input type="password" name="Confirmation_du_mot_de_passe"><br></div>
<br>
<br>
        <form method="post" action="AjoutCompte.php">
            <button type="submit">Valider</button>
</form>

        <p><a href="formulaireVerifCreationCompte.php?"></p>

</body>
</html>