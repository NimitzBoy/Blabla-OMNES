<!DOCTYPE html>
<html lang="fr">
<head>
    <title>BlablaOMNES.com</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="designCreationCompte.css">
</head>
<body>
    <div class="feetpage">Connexion passager</div>
    <form method="post" action="verifConnexionPassager.php">
        <br>
        Adresse mail:<div><input type="text" name="Adresse_mail" required><br></div>
        <br>
        Mot de passe:<div><input type="password" name="Mot_de_passe" required><br></div>
        <br>
        <button type="submit">Valider</button>
    </form>
    <br>
    <form method="post" action="creationCompte.php">
        <button type="submit">Créer un compte</button>
    </form>
</body>
</html>
