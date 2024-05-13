<!DOCTYPE html >
<html lang= "fr">
<link rel= " stylesheet " href= "BlablaOmnes.css">

 
<head >
<title > BlablaOMNES.com </title >
<meta charset= " UTF-8 ">
</head >
<div class= " container ">
    <div class= " Header ">
        <a href="Login.php" class="buttonMenu">Menu</a>
        <a href="Login.php" class="buttonLogin">Se connecter</a>
    </div >
    <body>
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
</body>
</div > 
<div class= " feetpage "></div >
</html >