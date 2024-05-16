<!DOCTYPE html >
<html lang= "fr">
<link rel= " stylesheet "href= "BlablaOmnes.css">
<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=Blabla-OMNES;charset=utf8','root','root');
}
catch (Exception $e)
{
    var_dump($e);
}
?>
<head >
<title > BlablaOMNES.com </title >
<meta charset= " UTF-8 ">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head >
<body>
<div class= " container ">
    <div class= " Header ">
        <a href="Login.php" class="buttonMenu">Menu</a>
        <a href="Login.php" class="buttonLogin">Se connecter</a>
    </div >

    <div class= " body ">
        <div class="FormulaireRecherche">
            <form action="" method="post">
                <input type="text" name=" Lieu Départ" placeholder="Lieu de Départ" required>
                <input type="text" name="destination" placeholder="Destination" required>
                <input type="number" name="passagers" placeholder="Nombre de passagers" min="1" required>
                <input type="date" name="date départ" placeholder="Date de départ" required>
                <button type="submit">Rechercher</button>
            </form>
       </div >
       </div > 
<div class= " feetpage "></div >
</body>

</html >