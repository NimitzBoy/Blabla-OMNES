<!DOCTYPE html >
<html lang= "fr">

<?php
require_once("config.php");
?>
<head>
<meta charset= " UTF-8 ">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel= " stylesheet " href= "BlablaOmnes.css">
<title > BlablaOMNES.com </title>
</head>

<body>
<div class= " container ">
    <div class= " Header ">
        <a href="#" class="buttonMenu" onclick="toggleMenu()">Menu</a>
        <a href="choixUtilisateur.php" class="buttonLogin">Se connecter</a>
    </div>
         <nav>
            <ul class="menu" id="menu">
                <li><a href="monProfil.php">Mon profil</a></li>
                
            </ul>
        </nav>
    
    <div class= "body">
        <div class="FormulaireRecherche">
            <form action="" method="post">
                <input type="text" name=" Lieu Départ" placeholder="Lieu de Départ" required>
                <input type="text" name="destination" placeholder="Destination" required>
                <input type="number" name="passagers" placeholder="Nombre de passagers" min="1" required>
                <input type="date" name="date départ" placeholder="Date de départ" required>
                <button type="submit">Rechercher</button>
            </form>
            <form action="publiTrajet.php" method="post">
                <button type="submit">Créer un trajet</button>
            </form>
        </div >
    </div > 
    <div class= " feetpage "></div >
</div>
<script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            if (menu.style.display === 'block' || menu.style.display === '') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }
    </script>
</body>
</html >
